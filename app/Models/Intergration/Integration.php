<?php

namespace App\Models\Intergration;

use App\Models\Project\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Integration extends Model
{
    use HasFactory;
    public $table = "integrations";
    public function project(){
        return $this->belongsTo(Project::class, "project_id","id");
    }
    public function messengerImplement(){
        return $this->hasOne(MessengerImplement::class, "integration_id", "id");
    }
}
