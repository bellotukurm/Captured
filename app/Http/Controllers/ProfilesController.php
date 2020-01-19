<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    //
    public function index(User $user)
    {
        $subs = (auth()->user()) ? auth()->user()->subscriptions->contains($user->id) : false;

         $subscriptionCount = Cache::remember(
             'count.subscription.' .$user->id,
             now()->addSeconds(10),
             function() use ($user){
             return $user->subscriptions->count();
         });

         $subscribersCount = Cache::remember(
             'count.subscribers.' .$user->id,
             now()->addSeconds(10),
             function() use ($user){
             return $user->profile->subscribers->count();
         });

         $postCount = Cache::remember(
             'count.posts.' .$user->id,
             now()->addSeconds(10),
             function() use ($user){
             return $user->posts->count();
         });

        return view('profiles.index', compact('user','subs','subscriptionCount','subscribersCount','postCount'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);
        
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        auth()->user()->profile->update($data);
        return redirect("/profile/{$user->id}");
    }

}
