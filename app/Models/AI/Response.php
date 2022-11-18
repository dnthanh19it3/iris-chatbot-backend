<?php

namespace App\Models\AI;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $table = "ai_responses";

    protected $fillable = [
        "intent_id",
        "response"
    ];

    public function intent()
    {
        $this->belongsTo("intent", "intent_id", "id");
    }
}
