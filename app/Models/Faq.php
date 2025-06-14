<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    // Izinkan kolom 'question' dan 'answer' untuk diisi secara massal
    protected $fillable = ['question', 'answer'];
}