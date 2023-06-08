<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'name',
        'title',
        'id_user',
        'id_cuisine',
        'status',
    ];

    protected $with = ['user', 'cuisine'];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
    public function cuisine()
    {
        return $this->belongsTo(Cuisine::class, 'id_cuisine', 'id');
    }
    // public function comment()
    // {
    //     return $this->hasMany(Comment::class, 'id_comment', 'id');
    // }
}
