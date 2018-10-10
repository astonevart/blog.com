<?php

namespace App\Http\Controllers;

use App\Mail\SubscribeEmail;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubsController extends Controller
{
    public function subscribe(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|unique:subscriptions',
        ]);
        $subs = Subscription::add($request->get('email'));

        Mail::to($subs)->send(new SubscribeEmail($subs));

        return redirect()->back()->with('email','Проверьте вашу почту!');
    }

    public function verify($token)
    {
       $sub = Subscription::where('token', $token)->firstOrFail();
       $sub->token = 'ok';
       $sub->save();
       return redirect('/')->with('email','Вы подтвердили свою подписку, спасибо!');

    }
}
