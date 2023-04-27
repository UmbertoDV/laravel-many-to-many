<?php

namespace App\Models;

use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['category_id','title','image', 'text', 'is_published'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getAbstract($max = 50){
        return substr($this->text, 0, $max) . "...";
    }

    public static function generateSlug($title){
        $possible_slug = Str::of($title)->slug('-');
        $cards = Card::where('slug', $possible_slug)->get();

        $original_slug = $possible_slug;

        $i = 2;
        while(count($cards)){
            $possible_slug = $original_slug . "-" . $i;
            $cards = Card::where('slug', $possible_slug)->get();
            $i++;
        }

        return $possible_slug;
    }

    protected function getUpdatedAtAttribute($value){
        return date('d/m/Y H:i', strtotime($value));
    }

    public function getImageUri(){
        return $this->image ? asset('storage/'. $this->image) : "https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/681px-Placeholder_view_vector.svg.png";
    }

    protected function getCreatedAtAttribute($value){
        return date('d/m/Y H:i', strtotime($value));
    }

}