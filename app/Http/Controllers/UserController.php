<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        return view('dashboard', compact('user'));
    }

    /**
     * Display a listing of the resource.
     */
    public function followers(string $name)
    {
        $user = User::where('name', $name)->with(['profile.link'])->firstOrFail();

        return view('follower', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user->name = $data['name'];
        $user->save();

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profiles', 'public');
            $user->profile->profile_photo = $path;
            $user->profile->save();
        }

        return redirect()->back()->with('success', 'Perfil actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
