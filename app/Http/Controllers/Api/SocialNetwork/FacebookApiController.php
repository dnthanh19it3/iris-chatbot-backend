<?php

namespace App\Http\Controllers\Api\SocialNetwork;

use App\Http\Controllers\ApiController;
use App\Models\Intergration\MessengerImplement;
use App\Models\Project\Project;
use App\Ultils\FacebookUltils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FacebookApiController extends ApiController
{
    public function callback(Request $request){
        Log::info($request);
    }

    public function loginCallback(Request $request){
        $userID = $request->userID;
        $shortTernUserAccessToken = $request->accessToken;
        $listPage = FacebookUltils::getListPage($userID, $shortTernUserAccessToken);
        Log::info($listPage);
        return response()->json($listPage);
    }

    public function hook(Request $request, $project_id)
    {
        Log::debug('____REQUEST____\n' . json_encode($request->all()));
        try {
            $project = Project::find($project_id);
            if (!$project) {
                Log::error("PROJECT $project_id NOT FOUND");
                return response("PROJECT_NOT_FOUND", 403);
            }
            $hub_mode = $request->hub_mode;
            $object = $request->object;
            $entry = $request->entry;
            if ($hub_mode) {
                switch ($hub_mode) {
                    case "subscribe":
                        $hub_challenge = $request->hub_challenge;
                        return response($hub_challenge, 200);
                }
            }
            $size = 1;
            ob_start();
            echo '{"success": true}';
            $size = ob_get_length();
            header("Content-Encoding: none");
            header("Content-Length: {$size}");
            header("Connection: close");
            ob_end_flush();
            @ob_flush();
            flush();
            if (session_id()) session_write_close();
            //Continue task
            Log::info("______________");
            Log::info("Continue processing");
            Log::info("______________");

            if ($object && !empty($entry)) {
                switch ($object) {
                    case "page":
                        $messageObj = $entry[0]["messaging"];
                        $sender = $messageObj[0]["sender"]["id"];
                        $msg = $messageObj[0]["message"]["text"];
                        $facebookImplement = null;
                        try {
                            $facebookImplement = $project->intergrations->where("platform", "messenger")->first()->messengerImplement;
                        } catch (\Throwable $e) {
                            throw new \Exception("Not found");
                        }
                        $predictResult = $this->predictAi($project_id, $msg);
                        if (!$predictResult) {
                            $predictResult = "T??i ch??a hi???u ?? b???n l???m";
                        }
                        Log::debug($predictResult);
                        $apiSendResult = FacebookUltils::sendMessage($facebookImplement->page_access_token, $sender, $predictResult);
                        break;
                }
            }
            return $this->responseSuccess();
        } catch (\Throwable $e) {
            Log::error($e);
            return response("EVENT_FAILED", 403);
        }
    }

    function predictAi($project_id, $message)
    {
        try {
            $response = Http::get("localhost:5000/predict", ["msg" => $message, "project_id" => $project_id]);
            if ($response->status() == 200) {
                $body = json_decode($response->body());
                $type = $body->type;
                switch ($type) {
                    case 1:
                    case 0:
                        if (isset($body->class[0][1]) && ($body->class[0][1] > 0.6)) {
                            return $body->response;
                        }
                        return false;
                    default:
                        return false;
                }
            }
        } catch (\Throwable $e) {
            return false;
        }
    }

    public function pageVerify(Request $request){
        Log::info($request->all());
        $pageList = $request["pageID"];
        $pageAccessToken = $request["accessToken"];
        foreach ($pageList as $pageID){
            $pageData = explode("_", $pageID);
            $saveHook = FacebookUltils::setPageHook($pageData[0], $pageData[1]);
            Log::debug($pageData[0]);
            Log::debug($pageData[1]);
            Log::debug($saveHook);
            if(!$saveHook){
                return $this->responseError();
            }
            $project = MessengerImplement::insert([
                "integration_id" => 222,
                "page_id" => $pageData[0],
                "access_token" => $pageData[1],
                "user_id" => $request->userID
            ]);
        }
        return response()->json($request->all());
    }

    function test(){
        $appAccessToken = FacebookUltils::getAppAccessToken();
        return response()->json($appAccessToken);
    }
}
