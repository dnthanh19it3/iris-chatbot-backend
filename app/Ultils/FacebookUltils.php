<?php

namespace App\Ultils;

use App\Http\Controllers\ApiController;
use http\Env\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

define("MESSAGE_TYPE_RESPONSE", "RESPONSE");
define("MESSAGE_TYPE_UPDATE", "UPDATE");
define("MESSAGE_TYPE_MESSAGE_TAG", "MESSAGE_TAG");
define("API_SEND_MESSAGE", "https://graph.facebook.com/v15.0/me/messages");
define("API_GET_APP_TOKEN", "https://graph.facebook.com/oauth/access_token");
define("API_GET_USER_PAGE_LIST", "https://graph.facebook.com/{USER_ID}/accounts");
define("API_SET_HOOK_PAGE", "https://graph.facebook.com/{PAGE_ID}/subscribed_apps");


class FacebookUltils extends ApiController
{
    public static function sendMessage(string $pageAccessToken, string $recipient, string $content = "", string $type = MESSAGE_TYPE_RESPONSE)
    {
        try {
            $prepareJsonBody = [
                "messaging_type" => $type,
                "recipient" => [
                    "id" => $recipient
                ],
                "message" => [
                    "text" => $content
                ]
            ];
            $response = Http::withBody(json_encode($prepareJsonBody), "application/json")
                ->post(API_SEND_MESSAGE . "?access_token=" . $pageAccessToken);
            logger($response->body());
            if($response){
                if($response->status() == 200){
                    return (new FacebookUltils)->responseSuccess();
                }
                if($response->status() == 400){
                    return (new FacebookUltils)->responseError($response->object()->error);
                }
            }
            return (new FacebookUltils)->responseError();
        } catch (\Throwable $exception) {
            return (new FacebookUltils)->responseError($exception->getMessage());
        }
    }

    public static function getAppAccessToken(){
        try {
            $params = [
                "client_id" => config("app.social.facebook.app_id"),
                "client_secret" => config("app.social.facebook.client_secret"),
                "grant_type" => "client_credentials"
            ];
            $response = Http::get(API_GET_APP_TOKEN, $params);
            if($response->status() == 200){
                $appAccessToken = $response->json()["access_token"];
                return $appAccessToken;
            }
            return false;
        } catch (\Throwable $e) {
            Log::error($e);
            return false;
        }
    }
    public static function getListPage($userId, $longternAccessToken){
        try {
            $params = [
                "fields" => "name,access_token",
                "access_token" => $longternAccessToken
            ];
            $response = Http::get(self::getApiUserPageURI($userId),$params);
            if($response->status(200)){
                return [
                    "data" => $response->json()["data"],
                    "userID" => $userId,
                    "accessToken" => $longternAccessToken
                ];
            }
            return false;
        } catch (\Throwable $e){
            Log::error($e);
            return false;
        }
    }

    public static function setPageHook($pageID, $pageAccessToken){
        try {
            $params = [
                "subscribed_fields" => "messages",
                "access_token" => $pageAccessToken
            ];
            $response = Http::post(self::getApiSetHookURI($pageID),$params);
            Log::debug($response->json());
            if($response->status(200) && $response->json()["success"]){
                return true;;
            }
            return false;
        } catch (\Throwable $e){
            Log::error($e);
            return false;
        }
    }
    public static function getApiUserPageURI($userID){
        try {
            return str_replace("{USER_ID}", $userID, API_GET_USER_PAGE_LIST);
        } catch (\Throwable $e){
            Log::error($e);
            return false;
        }
    }

    public static function getApiSetHookURI($pageID){
        try {
            return str_replace("{PAGE_ID}", $pageID, API_SET_HOOK_PAGE);
        } catch (\Throwable $e){
            Log::error($e);
            return false;
        }
    }
}
