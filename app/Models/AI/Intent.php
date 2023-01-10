<?php

namespace App\Models\AI;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intent extends Model
{
    use HasFactory;

    protected $table = "ai_intents";

    protected $fillable = [
        "user_id",
        "project_id",
        "intent"
    ];

    public function responses()
    {
        return $this->hasMany(Response::class, "intent_id", "id");
    }

    public function patterns()
    {
        return $this->hasMany(Pattern::class, "intent_id", "id");
    }
}
