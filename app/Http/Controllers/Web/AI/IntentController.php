<?php

namespace App\Http\Controllers\Web\AI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IntentController extends Controller
{
    public function index(){
        return view("admin.pages.ai.intent");
    }
}
