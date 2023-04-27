<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Card;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort = (!empty($sort_request = $request->get('sort'))) ? $sort_request : "updated_at";
        $order = (!empty($order_request = $request->get('order'))) ? $order_request : "DESC";
        
        $cards = Card::orderBy($sort, $order)->paginate(10)->withQueryString();
        return view('admin.cards.index', compact('cards', 'sort', 'order'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $card = new Card;
        $categories = Category::orderBy('label')->get();
        return view('admin.cards.form', compact('card', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'text' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
            'is_published' => 'boolean',
            'category_id' => 'nullable|exists:categories,id',
        ],
        [
            'title.required' => 'Il titolo è obbligatorio',
            'title.string' => 'Il titolo deve essere una string',
            'title.max' => 'Il titolo non deve superare i 100 caratteri',
            'text.required' => 'Il testo è obbligatorio',
            'text.string' => 'Il testo deve essere una string',
            'image.image' => 'Il file caricato deve essere un\'image',
            'image.mimes' => 'Disponibili solo jpg, png e jpeg',
            'category_id.exists' => 'L\'id della categoria non è valido',
            ]
        );
        
        // dd($request->all());
        $data = $request->all();
        
        if(Arr::exists($data, 'image')){
            $path_image = Storage::put('uploads/cards', $data['image']);
            $data['image'] = $path_image;
        };
        
        $card = new Card;
        $card->fill($data);
        $card->slug = Card::generateSlug($card->title);
        $card->save();
        
        return to_route('admin.cards.show', $card)->with('message_content', "Card $card->id creata con successo");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        return view('admin.cards.show', compact('card'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card)
    {
        $categories = Category::orderBy('label')->get();
        return view('admin.cards.form', compact('card', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'text' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
            'is_published' => 'boolean',
            'category_id' => 'nullable|exists:categories,id',
        ],
        [
            'title.required' => 'Il titolo è obbligatorio',
            'title.string' => 'Il titolo deve essere una string',
            'title.max' => 'Il titolo non deve superare i 100 caratteri',
            'text.required' => 'Il testo è obbligatorio',
            'text.string' => 'Il testo deve essere una string',
            'image.image' => 'Il file caricato deve essere un\'image',
            'image.mimes' => 'Disponibili solo jpg, png e jpeg',
            'category_id.exists' => 'L\'id della categoria non è valido',
        ]
    );

    $data = $request->all();
    $card['slug'] = Card::generateSlug($card['title']);
    $card['is_published'] = $request->has("is_published") ? 1 : 0;

    if(Arr::exists($data, 'image')){
        if($card->image) Storage::delete($card->image);
        $path_image = Storage::put('uploads/cards', $data['image']);
        $data['image'] = $path_image;
    };

    $card->update($data);

    return to_route('admin.cards.show', $card)
        ->with('message_content', "Card $card->id modificata con successo");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        $id_card = $card->id;
        // if($card->image) Storage::delete($card->image);

        $card->delete();

        return to_route('admin.cards.index')
            ->with('message_type', "danger")
            ->with('message_content', "Card $id_card spostata nel cestino");
    }

    public function trash(Request $request){

        $sort = (!empty($sort_request = $request->get('sort'))) ? $sort_request : "updated_at";
        $order = (!empty($order_request = $request->get('order'))) ? $order_request : "DESC";
        $cards = Card::onlyTrashed()->orderBy($sort, $order)->paginate(10)->withQueryString();

        return view('admin.cards.trash', compact('cards', 'sort', 'order'));
    }

        /**
     * Force delete the specified resource from storage.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(Int $id)
    {
        $card = Card::where('id', $id)->onlyTrashed()->first();
        $id_card = $card->id;
        if($card->image) Storage::delete($card->image);

        $card->forceDelete();

        return to_route('admin.cards.trash')
            ->with('message_type', "danger")
            ->with('message_content', "Card $id_card eliminato definitivamente");
    }

            /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function restore(Int $id)
    {
        $card = Card::where('id', $id)->onlyTrashed()->first();
        $card->restore();

        return to_route('admin.cards.index')
            ->with('message_type', "danger")
            ->with('message_content', "Card $id ripristinato");
    }
}