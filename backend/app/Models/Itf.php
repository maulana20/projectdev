<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\InterfaceSession;
use App\Enums\StatusEnum;
use App\Enums\UsingEnum;

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
        "last_use",
        "using",
        "session",
        "status"
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

    public function scopeActive($query)
    {
        $query->where("status", StatusEnum::ACTIVE);
        $query->orderBy("last_use", "ASC");
        return $query;
    }

    public function scopeFree($query)
    {
        $query->where("using", UsingEnum::NO);
        $query->where("last_use", "<", time() - 120);
        return $query;
    }
}