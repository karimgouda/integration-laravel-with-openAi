<?php

namespace App\Http\Controllers\Ai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    public function create()
    {
        return view('create');
    }

    public function generateGptText(Request $request)
    {
        $setting = DB::table('settings')->first();
        $openai_secret = $setting->openai_api_secret;
        try {

            $response = Http::timeout(80)->withHeaders([
                'Authorization' =>'Bearer ' . $openai_secret,
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions',[
                'model'=>$setting->openai_model,
                'message'=>[
                    'role'=>'system',
                    'content'=>'You Are a helpful assistant.',
                ],
                [
                    'role'=>'user',
                    'content'=>$request->prompt
                ],
                'max_tokens'=>$setting->oai_token,
                'temperature'=>floatval($setting->oai_temp),
            ]);
            $response = $response->json();
            if (isset($response['choices'][0]['message']['content'])){
                $completion = $response['choices'][0]['message']['content'];
                return response()->json(['completion'=>$completion]);
            }

            $errorCode = $response['error']['code'] ?? null;
            $errorType = $response['error']['type'] ?? null;
            return  response()->json(['error'=>$response['error']['message'] , 'errorCode'=>$errorCode,'errorType'=>$errorType]);
        }catch (\Exception $e) {
            return response()->json(['error' =>$e->getMessage()]);
        }
    }
}
