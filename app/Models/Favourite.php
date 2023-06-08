<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;
    protected $table = 'favourites';
    protected $fillable = [
        'id',
        'name_favourite',
        'id_user',
        'id_cuisine',
    ];

    // protected $with = ['user', 'cuisine',];


    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'id_user', 'id');
    // }
    // public function cuisine()
    // {
    //     return $this->belongsTo(Cuisine::class, 'id_cuisine', 'id');
    // }
}
