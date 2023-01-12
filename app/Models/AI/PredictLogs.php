<?php

namespace App\Models\AI;

use App\Models\Project\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PredictLogs extends Model
{
    use HasFactory;

    protected $table = "predict_logs";
    protected $guarded = [];

    public function project(){
        return $this->belongsTo(Project::class, "project_id", "id");
    }
}
