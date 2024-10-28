<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Website;
use App\Models\User;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    //
    public function store(Request $request, Website $website)
    {
//        $validator = Validator::make($request->all(), [
//            'user_id' => 'required|exists:users,id',
//        ]);

        $validatedData = $request->validate([
            'user_id' => 'required|integer',
        ]);

        $user = User::findOrFail($validatedData['user_id']);

        // Use the user's subscriptions relationship to create a new subscription
        $subscription = $user->subscriptions()->firstOrCreate([
            'website_id' => $website->id,
        ]);

        return response()->json($subscription, 201);


    }

    public function index(Website $website)
    {
        $subscriptions = $website->subscriptions()->with('user')->get();
        return response()->json($subscriptions, 200);
    }


}
