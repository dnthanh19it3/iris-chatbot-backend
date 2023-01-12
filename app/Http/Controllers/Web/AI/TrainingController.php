<?php

namespace App\Http\Controllers\Web\AI;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\AI\Intent;
use App\Models\AI\Pattern;
use App\Models\AI\Response;
use App\Models\AI\TraningStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingController extends ApiController
{
    public function index(){
        $project = session("project")["selected"];
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        return view("admin.pages.ai.training", ["project" => $project]);
    }
    public function checkTrainingProject(Request $request, $project_id){
        $lastedUpdate = TraningStatus::where("project_id", $project_id)->orderBy("created_at", "DESC")->first();
        if($lastedUpdate){
            if($lastedUpdate->status){
                return $this->responseSuccess([
                   "trained" => true,
                   "traning_time" => Carbon::make($lastedUpdate->updated_at)->longRelativeToNowDiffForHumans(),
                   "created_at" => Carbon::make($lastedUpdate->created_at)->longRelativeToNowDiffForHumans()
                ]);
            } else {
                return $this->responseSuccess([
                    "trained" => false,
                    "traning_time" => "",
                    "created_at" => Carbon::make($lastedUpdate->created_at)->longRelativeToNowDiffForHumans()
                ]);
            }
        }
        return $this->responseSuccess([
            "trained" => false,
            "traning_time" => "",
            "created_at" => ""
        ]);
    }

    public function validateTrainingProject(Request $request, $project_id){
        $lastedUpdate = TraningStatus::where("project_id", $project_id)->orderBy("created_at", "DESC")->first();
        $lastedUpdate->status = 1;

        if(!$lastedUpdate->save()){
            return $this->responseError();
        }
        return $this->responseSuccess();
    }
}
