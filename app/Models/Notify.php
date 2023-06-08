<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
    use HasFactory;
    protected $table = 'notify';
    protected $fillable = [
        'id',
        'id_user',
        'id_cuisine',
        'content',
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
}
