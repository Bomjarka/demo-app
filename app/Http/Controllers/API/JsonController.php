<?php

namespace App\Http\Controllers\API;

use App\Models\JsonModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class JsonController extends BaseController
{
    public function addJson(Request $request)
    {
        $start = Carbon::now();
        $memory = memory_get_usage();

        $tokenFromRequest = $request->header('token');
        $jsonData = $request->input('data');
        $token = PersonalAccessToken::whereToken($tokenFromRequest)->first();
        if (!$token || $token->expires_at < Carbon::now()) {
            return response()->json(['msg' => 'Token has been expired or doesn\'t exit!']);
        }
        $user = $token->tokenable;

        if ($user) {
            $json = new JsonModel();
            $json->user_id = $user->id;
            $json->data = json_encode($jsonData);
            if ($json->save()) {
                $end = Carbon::now();

                return response()->json([
                    'jsonID' =>  $json->id,
                    'time' => $end->diffInMicroseconds($start) . ' microseconds',
                    'memory' => memory_get_usage() - $memory . ' bytes',
                ]);
            }
        }

        return response()->json(['msg' => 'Something went wrong']);
    }

    public function updateJson(Request $request)
    {
        $start = Carbon::now();
        $memory = memory_get_usage();

        $tokenFromRequest = $request->header('token');
        $jsonModelId = $request->get('jsonId');
        $codeToExecute = $request->get('code');
        $token = PersonalAccessToken::whereToken($tokenFromRequest)->first();

        if (!$token || $token->expires_at < Carbon::now()) {
            return response()->json(['msg' => 'Token has been expired or doesn\'t exist!']);
        }

        $user = $token->tokenable;
        $jsonModel = JsonModel::find($jsonModelId);

        if ($user) {
            if (!$jsonModel || $user->id !== $jsonModel->user_id) {
                return response()->json(['msg' => 'You are not owner or json doesn\'t exist!']);
            }
            $data = json_decode($jsonModel->data);
            eval("$codeToExecute;");
            $jsonModel->data = json_encode($data);
            $jsonModel->save();
            $end = Carbon::now();
                return response()->json([
                    'jsonID' =>  $jsonModel->id,
                    'time' => $end->diffInMicroseconds($start) . ' microseconds',
                    'memory' => memory_get_usage() - $memory . ' bytes',
                ]);
            }

        return response()->json(['msg' => 'Something went wrong']);
    }
}
