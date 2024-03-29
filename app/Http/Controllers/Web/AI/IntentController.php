<?php

namespace App\Http\Controllers\Web\AI;

use App\Http\Controllers\Controller;
use App\Models\AI\Intent;
use App\Models\AI\Pattern;
use App\Models\AI\Response;
use App\Models\AI\TraningStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IntentController extends Controller
{
    public function index(){
        $user = Auth::user();
        $project = session("project")["selected"];
        $intents = Intent::where("project_id", $project->id)->paginate(10);
        return view("admin.pages.ai.intent", ["intents" => $intents]);
    }

    public function edit(Request $request, $id){
        $intent = Intent::with(["patterns", "responses"])->findOrFail($id);
        return view("admin.pages.ai.intent-update", ["intent" => $intent]);
    }

    public function create(Request $request){
        return view("admin.pages.ai.intent-create");
    }

    public function createPost(Request $request){
        $selected = session("project")["selected"];
        $name = $request["name"];
        $des = $request["description"];
        $intent = new Intent(["tag" => $name, "description" => $des, "project_id" => $selected->id]);
        $intent->save();
        return redirect()->route("ai.intent.index")->with("success", "Created new intnent");
    }

    public function editPost(Request $request, $id){
        $intent = Intent::with(["patterns", "responses"])->findOrFail($id);
        $data = $request->all();

        if(isset($data["tag"])){
            //Handle insert
            (Intent::find($id))->fill(["tag" => $data["tag"]])->save();
        }

        if(isset($data["pattern"]["old"])){
            //Handle insert
            Pattern::where("intent_id", $id)->whereNotIn("id", array_keys($data["pattern"]["old"]))->delete();
            foreach ($data["pattern"]["old"] as $key => $item){
                Pattern::where("id", $key)->update(["pattern" => $item]);
            }
        }
        if(isset($data["pattern"]["new"])){
            //Handle insert
            foreach ($data["pattern"]["new"] as $item){
                Pattern::insert(["intent_id" => $id, "pattern" => $item]);
            }
        }

        if(isset($data["response"]["old"])){
            //Handle insert
            Response::where("intent_id", $id)->whereNotIn("id", array_keys($data["response"]["old"]))->delete();
            foreach ($data["response"]["old"] as $key => $item){
                Response::where("id", $key)->update(["response" => $item]);
            }
        }
        if(isset($data["response"]["new"])){
            //Handle insert
            foreach ($data["response"]["new"] as $item){
                Response::insert(["intent_id" => $id, "response" => $item]);
            }
        }
        $parent = $intent->project;
        (new TraningStatus(["project_id" => $parent->id, "status" => 0, "detail" => "Update User Intent"]))->save();
        return redirect()->back()->with("success", "Thành công!");
    }
}
