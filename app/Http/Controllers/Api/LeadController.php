<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;

// Per inviare le email abbiamo bisogno di questo
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewContact;

class LeadController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'message' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        // Per salvare sul DB
        $lead = new Lead();
        $lead->fill($data);
        $lead->save();
        Mail::to('info@boolpress.com')->send(new NewContact($lead));
        return response()->json($lead, 201);
    }
}
