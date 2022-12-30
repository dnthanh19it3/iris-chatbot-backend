<?php

namespace App\Http\Controllers\Web\AI;

use App\Http\Controllers\Controller;
use App\Models\AI\Intent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IntentController extends Controller
{
    public function index(){
        $user = Auth::user();
        $project = session("project")["selected"];
        $intents = Intent::where("project_id", $project->id)->paginate(1);
        return view("admin.pages.ai.intent", ["intents" => $intents]);
    }

    public function edit(Request $request, $id){
        $intent = Intent::with(["patterns", "responses"])->find($id);
        dd($intent->toArray());
    }
}
