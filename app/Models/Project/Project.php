<?php

namespace App\Models\Project;

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
}
