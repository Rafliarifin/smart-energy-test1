<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'title', 'content'];

    // Satu post dimiliki oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Satu post bisa memiliki banyak balasan
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}