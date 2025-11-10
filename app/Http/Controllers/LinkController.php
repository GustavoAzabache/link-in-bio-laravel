<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'adult_content' => 'boolean'
        ]);

        $link = new Link();
        $link->title = $data['title'];
        $link->url = $data['url'];
        $link->adult_content = $data['adult_content'] ?? false;
        $link->profile_id = Auth::user()->profile->id;
        $link->save();

        return redirect()->back()->with('success', 'Link agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $link = Link::findOrFail($id);

        return view('dashboard', compact('link'));
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
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'adult_content' => 'boolean'
        ]);

        $link = Link::findOrFail($id);
        $link->title = $data['title'];
        $link->url = $data['url'];
        $link->adult_content = $data['adult_content'] ?? false;

        if ($link->profile_id !== Auth::user()->profile->id) {
            abort(403, 'No tienes permiso para eliminar este link.');
        }

        $link->save();

        return redirect()->back()->with('success', 'Link actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $link = Link::findOrFail($id);

        if ($link->profile_id !== Auth::user()->profile->id) {
            abort(403, 'No tienes permiso para eliminar este link.');
        }

        $link->delete();

        return redirect()->back()->with('success', 'Link eliminado correctamente.');
    }
}
