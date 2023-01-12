<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ProjectCreateRequest;
use App\Models\Project\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    function index(){
        $projects = Auth::user()->projects;
        $data = [
            "projects" => $projects
        ];
        return view("admin.pages.projects.index")->with(["data" => $data]);
    }
    function create(){
        return view("admin.pages.projects.create");
    }

    function createPost(ProjectCreateRequest $request){
        $insertData = $request->validated();
        $user = $request->user()->toArray();
        $insertData["user_id"] = $user["id"];
        $insertData["status"] = 1;
        $project = new Project($insertData);
        if(!$project->save()){
            return back(500)->withErrors(["error" => "Unknow error"])->withInput($insertData);
        }
        return redirect()->route("user.project.index");
    }
    function update(Request $request, $id){
        $project = Project::findOrFail($id);
        $data = [
            "project" => $project
        ];
        return view("admin.pages.projects.update", $data);
    }

    function updatePost(ProjectCreateRequest $request){
        $project = Project::findOrFail($request->id);
        $updateData = $request->validated();
        $user = $request->user()->toArray();
        $updateData["user_id"] = $user["id"];
        $updateData["status"] = 1;
        $project->fill($updateData);
        if(!$project->save()){
            return back(500)->withErrors(["error" => "Unknow error"])->withInput($updateData);
        }
        return redirect()->route("user.project.index");
    }

    public function exportIntents(Request $request, $id){
        $project = Project::find($id);
        $dataset = $project->exportDataset();
        return response()->json($dataset);
    }

    public function messengerIntergration(){
        $project = session("project")["selected"] ?? [];
        return view('admin.pages.projects.messenger-intergration', ["project" => $project]);
    }
}
