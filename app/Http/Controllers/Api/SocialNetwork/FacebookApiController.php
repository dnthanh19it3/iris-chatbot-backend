<?php

namespace App\Http\Controllers\Api\SocialNetwork;

use App\Http\Controllers\ApiController;
use App\Models\Intergration\Integration;
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

    public function hook(Request $request)
    {
        Log::debug('____REQUEST____\n' . json_encode($request->all()));
        try {
            $hub_mode = $request->hub_mode;
            $object = $request->object;
            $entry = $request->entry;
            if ($hub_mode) {
                switch ($hub_mode) {
                    case "subscribe":
                        Log::debug("HUB MODE");
                        $hub_challenge = $request->hub_challenge;
                        return $hub_challenge;
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
                        $id = $entry[0]["id"];
                        $sender = $messageObj[0]["sender"]["id"];
                        $msg = $messageObj[0]["message"]["text"];
                        $facebookImplement = null;
                        $project_id = null;
                        try {
                            $facebookImplement = MessengerImplement::where("page_id", $id)->first();
                            $project_id = $facebookImplement->project_id;
                        } catch (\Throwable $e) {
                            Log::error($e);
                            throw new \Exception("Not found");
                        }
                        $predictResult = $this->predictAi($project_id, $msg);
                        if (!$predictResult) {
                            $predictResult = "Tôi chưa hiểu ý bạn lắm";
                            //Log invalid
                        }
                        $apiSendResult = FacebookUltils::sendMessage($facebookImplement->access_token, $sender, $predictResult);
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

        $pageData = explode("_", $pageList);
        $saveHook = FacebookUltils::setPageHook($pageData[0], $pageData[1]);
        Log::debug($pageData[0]);
        Log::debug($pageData[1]);
        Log::debug($saveHook);
        if(!$saveHook){
            return $this->responseError();
        }
        $project = MessengerImplement::insert([
            "integration_id" => "123",
            "page_id" => $pageData[0],
            "access_token" => $pageData[1],
            "user_id" => $request->userID
        ]);

        return $this->responseSuccess();
    }

    function test(){
        $appAccessToken = FacebookUltils::getAppAccessToken();
        return response()->json($appAccessToken);
    }
}
