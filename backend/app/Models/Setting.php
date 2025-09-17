<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\ConversionValueCast;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        "value"
    ];

    public $timestamps = false;

    protected $casts = [
        "value"         => ConversionValueCast::class,
        "default_value" => ConversionValueCast::class
    ];
}