<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\InterfaceSession;

class Itf extends Model
{
    use HasFactory;

    protected $table = "interfaces";

    protected $fillable = [
        "hosttohost_id",
        "name",
        "username",
        "password",
        "url",
        "using",
        "session",
    ];

    protected function casts(): array
    {
        return [
            "session" => InterfaceSession::class,
        ];
    }

    public function hosttohost()
    {
        return $this->belongsTo("App\Models\Hosttohost");
    }
}