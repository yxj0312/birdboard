<?php

namespace App\Http\Controllers;

class AccessTokenController extends Controller
{
    // /settings/access
    public function show()
    {
        return view('settings.token.show');
    }

    public function update()
    {
        request()->user()->forceFill([
            'api_token' => $token = str_random(60),
            // 'api_token' => hash('sha256', str_random(60));
        ])->save();

        // var_dump($token);
        // flash()->overlay('Success', 'We have generated a new token for you');

        return back()
            ->with('message', 'We have generated a new token for you. You will only see this once, so please store it somewhere safe: '.$token);
    }
}
