<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'post_id', 'content'];

    // Satu balasan dimiliki oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Satu balasan terhubung ke satu post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}