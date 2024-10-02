<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.profile');
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
    public function edit()
    {
        return view('admin.edit-profile');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
     
        $userId = auth()->user()->id;
        $validated = $request->validate([
            'name'=> 'required|string',
            'email' => 'required|email|unique:users,email,' . $userId,
            'password'=> 'nullable|min:8',
            'bio'=> 'required',
        ]);

        $updateData = [
            'name'=> $request->name,
            'email'=> $request->email,
            'bio'=> $request->bio,
        ];
        if ($request->filled('password')) {
            $updateData['password'] = bcrypt($request->password);
        }
        $updatedUser = DB::table('users')
        ->where('id', $userId)
        ->update($updateData);

        

        if ($updatedUser) {
            return to_route('profile.index')->with('success', 'Update is Successful!');
        }
        return back()->with('error', 'Update is not Successful!');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
