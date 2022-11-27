<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
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
}
