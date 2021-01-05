<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        Http::withToken(env('SENDPORAL_API_KEY'))->post(env('SENDPORTAL_API_URL') . '/workspaces/' . env('SENDPORTAL_WORKSPACE_ID') . '/subscribers', [
            'first_name' => $request->first_name,
            'email' => $request->email,
        ]);

        return response()->json(['status' => 'success']);
    }
}
