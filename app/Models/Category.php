<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name', 'image'
    ];
    protected $primarykey  = 'id';
    protected $table = 'category';

    // public function cuisine()
    // {
    //     return $this->hasMany(Cuisine::class);
    // }
}
