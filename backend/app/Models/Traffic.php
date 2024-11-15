<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Traffic extends Model
{
    protected $table = "traffics";

    protected $fillable = [
        "hosttohost_id",
        "reason_code"
    ];

    public function hosttohost()
    {
        return $this->belongsTo("App\Models\Hosttohost");
    }

    public function reason()
    {
        return $this->belongsTo("App\Models\Reason", "reason_code", "code");
    }
}