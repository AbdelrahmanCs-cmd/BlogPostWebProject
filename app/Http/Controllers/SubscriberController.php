<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $data =  $request->validate([

            'email' => 'email|required|unique:subscribers,email'

        ]);
        Subscriber::Create($data);
        return back()->with('status', 'Subscribed Successfully!');

        // dd($request)->all();
    }
}
