<?php

namespace App\Models;

use App\Notifications\ProductApprovedNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cuisine extends Model
{
    use HasFactory;
    use Notifiable;

    // public $timestamps = false;
    protected $fillable = [
        'name', 'image', 'duration', 'user_id', 'category_id', 'difficulty', 'ingredients', 'steps', 'websiteURL', 'youtubeURL', 'status'
    ];
    protected $primarykey  = 'id';
    protected $table = 'cuisine';


    protected $with = ['user', 'favourite'];

    // public function category()
    // {
    //     return $this->belongsTo(Category::class, 'category_id', 'id');
    // }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    // public function comment()
    // {
    //     return $this->hasMany(Comment::class, 'id_cuisine', 'id');
    // }
    public function favourite()
    {
        return $this->hasMany(Favourite::class, 'id_cuisine', 'id');
    }

    // public function post()
    // {
    //     return $this->hasMany(Post::class, 'id_cuisine', 'id');
    // }
}
