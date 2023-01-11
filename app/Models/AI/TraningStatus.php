<?php

namespace App\Models\AI;

use App\Models\Project\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TraningStatus extends Model
{
    use HasFactory;

    protected $table = "training";
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class, "project_id", "id")->orderBy("created_at", "DESC");
    }
}
