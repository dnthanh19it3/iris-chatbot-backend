<?php

namespace App\Http\Controllers\Web\AI;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\AI\Intent;
use App\Models\AI\Pattern;
use App\Models\AI\PredictLogs;
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
    public function logs(){
        $project = session("project")["selected"];
        $logs = PredictLogs::where("project_id", $project->id)->where("status", 0)->get();
        $intents = Intent::where("project_id", $project->id)->get();
        return view("admin.pages.ai.logs", ["logs" => $logs, "intents" => $intents]);
    }
    public function improve(Request $request, $log_id){
        $pattern = new Pattern(["intent_id" => request("intent_id"), "pattern" => request("pattern")]);
        $pattern->save();
        $log = PredictLogs::find($log_id)->fill(["status" => 1]);
        $log->save();
        $parent = Intent::find(request("intent_id"))->project;
        (new TraningStatus(["project_id" => $parent->id, "status" => 0, "detail" => "Update User Intent"]))->save();
        return redirect()->back();
    }
}
