<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContatRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(StoreContatRequest $request)
    {
        $data = $request->validated();

        Contact::create($data);

        return back()->with(
            'status-message',
            'Message sent and we will contact you!'
        );
    }
}
