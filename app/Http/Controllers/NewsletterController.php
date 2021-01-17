<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $this->dispatch(function () use ($request) {
            Http::withToken(env('SENDPORAL_API_KEY'))->post(env('SENDPORTAL_API_URL') . '/workspaces/' . env('SENDPORTAL_WORKSPACE_ID') . '/subscribers', [
                'first_name' => $request->get('first_name'),
                'email' => $request->get('email'),
            ]);
        });

        return response()->json(['status' => 'success']);
    }
}
