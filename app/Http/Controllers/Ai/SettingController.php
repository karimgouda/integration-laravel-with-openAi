<?php

namespace App\Http\Controllers\Ai;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use function Symfony\Component\String\s;

class SettingController extends Controller
{
    public function create()
    {
        $settings = DB::table('settings')->first();
        return view('setting',compact('settings'));
    }

    public function updateSetting(Request $request)
    {
        $setting = Setting::first();
        if (is_null($setting)){
            return back()->with('error_message','Setting not found !')->withInput();
        }

        $validation = Validator::make($request->all(),[
            'openai_api_secret'=>'nullable',
            'openai_model'=>'nullable',
            'oai_temp'=>'nullable',
            'oai_token'=>'nullable'
        ]);

        if ($validation->fails()){
            return back()->with('error_message',$validation->errors())->withInput();
        }

        $setting->update([
            'openai_api_secret'=>$request->openai_api_secret,
            'openai_model'=>$request->openai_model,
            'oai_temp'=>$request->oai_temp,
            'oai_token'=>$request->oai_token,
        ]);

        toast('Setting updated successfully','success');
        return to_route('setting.create');
    }
}
