<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\json;
use App\Models\JsonModel;
use App\Models\ProjectUser;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JsonController extends Controller
{

    public function index()
    {
        return view('json');
    }

    public function addJson(Request $request)
    {
        $jsonData = $request->get('json');
        $userId = (int) $request->get('user');
        $token = (string) $request->get('token');
        $user = ProjectUser::find($userId);

        if ($user) {
            $userToken = $user->tokens()->whereToken($token)->first();
            if ($userToken && $userToken->expires_at > Carbon::now()) {
                $json = new JsonModel();
                $json->user_id = $userId;
                $json->data = $jsonData;
                if ($json->save()) {
                    return redirect()->back();
                }
            } else {
                return redirect()->back()->withErrors(['msg' => 'Token has expired!']);
            }
        }

        return redirect()->back()->withErrors(['msg' => 'Something went wrong']);
    }


    public function updateJson(Request $request)
    {
        $codeToExecute = $request->get('code');
        $userId = (int) $request->get('user');
        $token = (string) $request->get('token');
        $jsonId = (int) $request->get('jsonId');
        $user = ProjectUser::find($userId);
        $jsonModel = JsonModel::find($jsonId);


        if (!$jsonModel) {
            return redirect()->back()->withErrors(['msg' => 'Json model doesnt exist']);
        }

        if ($user) {
            if ($jsonModel->user_id !== $user->id) {
                return redirect()->back()->withErrors(['msg' => 'You are not owner of the file!']);
            }
            $userToken = $user->tokens()->whereToken($token)->first();
            if ($userToken && $userToken->expires_at > Carbon::now()) {
                $data = json_decode($jsonModel->data);
                eval("$codeToExecute;");
                $jsonModel->data = json_encode($data);
                $jsonModel->save();

                return redirect()->back();
            }

            return redirect()->back()->withErrors(['msg' => 'Token has expired!']);
        }

        return redirect()->back()->withErrors(['msg' => 'Something went wrong']);
    }
}
