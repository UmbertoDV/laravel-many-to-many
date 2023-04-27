<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort = (!empty($sort_request = $request->get('sort'))) ? $sort_request : "updated_at";
        $order = (!empty($order_request = $request->get('order'))) ? $order_request : "DESC";
        
        $categories = Category::orderBy($sort, $order)->paginate(10)->withQueryString();
        return view('admin.categories.index', compact('categories','sort', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();
        return view('admin.categories.form', compact('category'));
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
            'label'=> 'required|string|max:20',
            'color'=> 'required|string|size:7',
        ],[
            'label.required' => 'La label è obbligatoria',
            'label.string' => 'La label deve essere una string',
            'label.max' => 'La label può essere massimo di 20 caratteri',
            'color.required' => 'Il colore è obbligatori0',
            'color.string' => 'Il colore deve essere una string',
            'color.size' => 'Il colore può essere massimo di 7 caratteri es #ffffff',
        ]);

        $category = new Category();
        $category->fill($request->all());
        $category->save();

        return to_route('admin.categories.index')
            ->with('message_content', "Categoria $category->id creata");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.index', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.form', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'label'=> 'required|string|max:20',
            'color'=> 'required|string|size:7',
        ],[
            'label.required' => 'La label è obbligatoria',
            'label.string' => 'La label deve essere una string',
            'label.max' => 'La label può essere massimo di 20 caratteri',
            'color.required' => 'Il colore è obbligatori0',
            'color.string' => 'Il colore deve essere una string',
            'color.size' => 'Il colore può essere massimo di 7 caratteri es #ffffff',
        ]);

        $category->update($request->all());
        $category->save();

        return to_route('admin.categories.index')
            ->with('message_content', "Categoria $category->id modificata");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category_id = $category->id;
        $category->delete();
        return to_route('admin.categories.index')
            ->with('message_type', "danger")
            ->with('message_content', "Categoria $category_id eliminata");
    }
}