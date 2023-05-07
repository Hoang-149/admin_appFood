<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuisine extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name', 'image', 'duration', 'category_id', 'difficulty', 'ingredients', 'steps', 'websiteURL', 'youtubeURL', 'status'
    ];
    protected $primarykey  = 'id';
    protected $table = 'cuisine';

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
