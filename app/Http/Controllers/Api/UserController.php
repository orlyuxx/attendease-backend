<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all(); 
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return $user;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $user = User::findOrFail($id);
    }
    
    public function updateUserDetails(UserRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validated();

        \Log::info('Received data:', $validated);

        if (isset($validated['firstname'])) {
            $user->firstname = $validated['firstname'];
        }
        
        if (isset($validated['lastname'])) {
            $user->lastname = $validated['lastname'];
        }
        
        if (isset($validated['email'])) {
            $user->email = $validated['email'];
        }
        
        if (isset($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        
        $user->save();

        $user->refresh();

        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validated();

        $user->firstname = $validated['firstname'];
        $user->lastname = $validated['lastname'];
        
        $user->save();

        return $user;
    }

    /**
     * Update the email of the specified resource in storage.
     */
    public function email(UserRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validated();

        $user->email = $validated['email'];

        $user->save();

        return $user;
    }

    /**
     * Update the password of the specified resource in storage.
     */
    public function password(UserRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validated();

        $user->password = Hash::make($validated['password']);;

        $user->save();

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        
        $user->delete();

        return $user;
    }

    /**
     * Update the image of the specified resource from storage.
     */
    public function image(UserRequest $request, string $id)
    {
        $user = User::findOrFail($id);
     
        if( !is_null($user->image) ) {
            Storage::disk('public')->delete($user->image);
        }

        $user->image = $request->file('image')->storePublicly('images', 'public');
        
        $user->save();

        return $user;
    }
}
