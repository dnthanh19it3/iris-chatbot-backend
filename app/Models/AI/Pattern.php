<?php

namespace App\Models\AI;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pattern extends Model
{
    use HasFactory;

    protected $table = "ai_patterns";

    protected $fillable = [
        "intent_id",
        "pattern"
    ];

    public function intent()
    {
        $this->belongsTo("intent", "intent_id", "id");
    }
}
