<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ProjectCreateRequest;
use App\Models\Intergration\MessengerImplement;
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
        $projects = Auth::user()->projects()->select("id", "name")->get();
        session([
            "project" => [
                "list" => $projects,
                "selected" => (count($projects) > 0) ? $projects->shift() : null
            ]
        ]);
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
        $connectedPage = null;
        if($project){
            $connected = MessengerImplement::where("project_id", $project->id)->first();
            $connectedPage = $connected ? "Linked page id: " . $connected->page_id : "Not connected";
        }
        return view('admin.pages.projects.messenger-intergration', ["project" => $project, "connectedPage" => $connectedPage]);
    }

    public function changeProject(Request $request, $id){
        $projects = Auth::user()->projects()->whereNot("id", $id)->select("id", "name")->get();
        $selectedProject = Project::find($id);

        try {
            //Set user information session
            session([
                "project" => [
                    "list" => $projects,
                    "selected" => $selectedProject
                ]
            ]);
        } catch (\Throwable $e){
            return back(500);
        }
        return redirect()->back();
    }
    function delete(Request $request, $id){
        $project = Project::find($id)->delete();
        $projects = Auth::user()->projects()->select("id", "name")->get();
        session([
            "project" => [
                "list" => $projects,
                "selected" => (count($projects) > 0) ? $projects->shift() : null
            ]
        ]);
        return redirect()->back();
    }
}
