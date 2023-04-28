<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function cards(){
        return $this->belongsToMany(Card::class);
    }

    public function getBadgeHTML(){
        return '<span class="badge rounded-pill" style="background-color:' . $this->color . '"> ' . $this->label .'</span>';
    }
}