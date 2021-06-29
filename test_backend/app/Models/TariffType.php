<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TariffType extends Model
{
    use HasFactory;

    protected $table = 'tariff_types';

    protected $fillable = [
        'name',
        'price',
        'delivery_days'      
    ];
}
