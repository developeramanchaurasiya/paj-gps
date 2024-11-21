<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index(Request $request)
    {
        $devices = $request->user()->accesses->map->device;
        return response()->json($devices);
    }

    public function show($id)
    {
        $device = Device::findOrFail($id);
        return response()->json($device);
    }
}

