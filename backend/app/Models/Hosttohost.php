<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hosttohost extends Model
{
    use HasFactory;

    protected $fillable = [
        "identifier",
        "io",
        "name",
        "description",
        "priority",
        "status",
    ];

    public $timestamps = false;

    public function interfaces()
    {
        return $this->hasMany("App\Models\Itf");
    }

    public function scopeIdentifier($query, $data)
    {
        return $query->where("identifier", $data);
    }
}