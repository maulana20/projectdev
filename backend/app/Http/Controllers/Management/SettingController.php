<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Management\Setting\UpdateRequest;
use App\Http\Resources\SettingResource;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index(Request $request) : JsonResponse
    {
        return response()->json(SettingResource::collection(Setting::all()));  
    }

    public function update(UpdateRequest $request)
    {
        foreach ($request->bulk as $data) {
            if ($setting = Setting::find($data["id"])) $setting->update(["value" => $data["value"]]);
        }
        return response()->noContent(204);
    }
}
