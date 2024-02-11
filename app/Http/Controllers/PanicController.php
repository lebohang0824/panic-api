<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePanicRequest;
use App\Http\Resources\PanicResource;
use App\Models\Panic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PanicController extends Controller
{
    public function send(StorePanicRequest $request)
    {
        $user_id = Auth::id();
        
        $panic = Panic::create([
            'longitude'  => $request->longitude,
            'latitude'   => $request->latitude,
            'panic_type' => $request->panic_type,
            'details'    => $request->details,
            'user_id'    => $user_id
        ]);

        Log::alert("Panic created by user $user_id");

        return response()->json([
            'status' => 'success',
            'message' => 'Panic raised successfully',
            'data' => [
                'panic_id' => $panic->id
            ]
        ], 200);
    }

    public function cancel(string $id)
    {
        $user_id = Auth::id();

        $error_messages = [
            'id.required' => 'validation failure – missing/incorrect variables',
            'id.exists' => 'panic not found',
        ];

        Validator::make(['id' => $id], [
            'id' => 'required|exists:panics'
        ], $error_messages)->validate();

        Panic::find($id)->delete();

        Log::alert("Panic $id revoked by user $user_id");

        return response()->json([
            'status' => 'success',
            'message' => 'Panic cancelled successfully',
            'data' => []
        ], 200);
    }

    public function history()
    {
        $panic_list = Panic::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Action completed successfully',
            'data' => [
                'panics' => PanicResource::collection($panic_list),
            ]
        ], 200);
    }
}
