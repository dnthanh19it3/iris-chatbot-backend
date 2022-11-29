<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AiRequestController extends Controller
{
    function predictAi(Request $request)
    {
        try {
            $projectId = $request->project_id;
            $message = $request->message;
            $response = Http::get("localhost:5000/predict", ["msg" => $message]);

            if ($response->status() == 200) {
                $body = json_decode($response->body());
                $type = $body->type;
                switch ($type) {
                    case 0:
                        if (isset($body->class[0][1]) && ($body->class[0][1] > 0.6)) {
                            $response_raw = [
                                "error" => 0,
                                "data" => [
                                    "message" => $body->response
                                ],
                                "details" => ""
                            ];
                            return response()->json($response_raw, 200);
                        }
                        $response_raw = [
                            "error" => 0,
                            "data" => [
                                "message" => "Tôi chưa hiểu ý của bạn lắm"
                            ],
                            "details" => ""
                        ];
                        return response()->json($response_raw, 200);
                    default:
                        $response_raw = [
                            "error" => 0,
                            "data" => [
                                "message" => "Tôi chưa hiểu ý của bạn lắm"
                            ],
                            "details" => ""
                        ];
                        return response()->json($response_raw, 200);
                }
            }
        } catch (\Throwable $e) {
            $response_raw = [
                "error" => 1,
                "data" => [
                ],
                "details" => $e->getMessage()
            ];
            return response()->json($response_raw, 404);
        }

        dd(Http::get("localhost:5000/predict", ["msg" => $message])->body(), $request->all());


//        return response()->json([
//            "error" => 0,
//            "data" => [
//                "message" => "Phản hồi từ server từ tin nhắn: " . $request["message"]
//            ],
//            "details" => ""
//        ]);
//        if($r)

    }
}
