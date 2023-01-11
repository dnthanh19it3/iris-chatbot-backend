<?php

namespace App\Http\Controllers\Web\AI;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\AI\TraningStatus;
use App\Models\AI\Pattern;
use App\Models\AI\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingController extends ApiController
{
    public function index(){
        $project = session("project")["selected"];
        return view("admin.pages.ai.training1", ["project" => $project]);
    }
    public function checkTrainingProject(Request $request, $id){
        $lastedUpdate = TraningStatus::where("project_id", $id)->orderBy("created_at", "DESC")->first();

        if($lastedUpdate){
            if($lastedUpdate->status){
                return $this->responseSuccess([
                   "trained" => true,
                   "traning_time" => $lastedUpdate->updated_at,
                   "created_at" => $lastedUpdate->created_at
                ]);
            }
            return $this->responseSuccess([
                "trained" => false,
                "traning_time" => "",
                "created_at" => $lastedUpdate->created_at
            ]);
        }
        return $this->responseSuccess([
            "trained" => false,
            "traning_time" => "",
            "created_at" => ""
        ]);
    }
}
