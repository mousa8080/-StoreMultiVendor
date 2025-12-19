<?php

namespace App\Http\Controllers\dashpoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;

class AdminsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Admin::class,'admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::all();
        return view('dashpoard.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('dashpoard.admins.create', [
            'roles' => Role::all(),
            'admin' => new Admin(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8',
            'roles' => 'required|array'
        ]);
        $admin = Admin::create($request->all());
        $admin->roles()->attach($request->roles);
        return redirect()->route('dashpoard.admins.index')->with('success', 'Admin created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin = Admin::find($id);
        return view('dashpoard.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = Admin::find($id);
        $roles = Role::all();
        return view('dashpoard.admins.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $id,
            'password' => 'nullable|string|min:8',
            'roles' => 'required|array'
        ]);
        $admin = Admin::find($id);
        $admin->update($request->all());
        $admin->roles()->sync($request->roles);
        return redirect()->route('dashpoard.admins.index')->with('success', 'Admin updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = Admin::find($id);
        $admin->delete();
        return redirect()->route('dashpoard.admins.index')->with('success', 'Admin deleted successfully');
    }
}
