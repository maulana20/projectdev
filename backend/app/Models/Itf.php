<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
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
        return $query->where("status", StatusEnum::ACTIVE);
    }

    public function scopeOrderUsedAt($query)
    {
        return $query->orderBy("used_at", "ASC");
    }

    public function scopeFree($query)
    {
        $query->where("using", UsingEnum::NO);
        $query->where("used_at", "<", Carbon::now()->subMinutes(2))->orWhere("used_at", null);
        return $query;
    }
}