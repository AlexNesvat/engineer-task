<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfirmSubscriptionRequest;
use App\Http\Requests\SubscribeRequest;
use App\Mail\ConfirmSubscription;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\Newsletter\Newsletter;

class SubscribeController extends Controller
{
    public $subsService;

    public function __construct(Newsletter $subs)
    {
        $this->subsService = $subs;
    }

    /**
     *
     *
     * @param SubscribeRequest $request
     * @return array
     */
    public function subscribe(SubscribeRequest $request)
    {
        $data = $request->all();
        $user = User::where('email', $data['email'])->first();

        Mail::to($request->user())->send(new ConfirmSubscription($user));

        return ['success' => true];
    }

    /**
     * @param ConfirmSubscriptionRequest $request
     * @return array
     */
    public function confirm(ConfirmSubscriptionRequest $request)
    {
        $data = $request->all();
        $user = User::findOrFail($data['id']);

        if ($user->email === $data['email']) {
            $user->subscribed = true;
            $user->save();
            $this->subsService->subscribe($user->email);
        }

        return ['success' => true];
    }
}
