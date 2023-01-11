<?php

namespace App\Models\Project;

use App\Models\AI\TraningStatus;
use App\Models\Intergration\Integration;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = "projects";
    protected $guarded = [];

    public function intergrations()
    {
        return $this->hasMany(Integration::class, "project_id", "id");
    }
    public function intents()
    {
        return $this->hasMany(TraningStatus::class, "project_id", "id");
    }
    function exportDataset(){
        $intents = new \stdClass();
        $intents->intents = [];
        $tags = $this->intents;
        foreach ($tags as $tag){
            $intent = new \stdClass();
            $intent->tag = $tag->tag;
            $intent->patterns = [];
            $patterns = $tag->patterns;
            foreach ($patterns as $pattern){
                array_push($intent->patterns, $pattern->pattern);
            }
            $intent->responses = [];
            $responses = $tag->responses;
            foreach ($responses as $response){
                array_push($intent->responses, $response->response);
            }

            array_push($intents->intents, $intent);
        }
        return $intents;
    }
}
