<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardData extends Model
{
    use HasFactory;

    protected $fillable = ['metric_name', 'metric_value', 'period_date', 'source'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'period_date' => 'date', // <-- TAMBAHKAN BLOK INI
    ];
}