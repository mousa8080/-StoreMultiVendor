<?php

namespace App\Http\Controllers\Dashpoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\RoleAbility;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Role::class,'role');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate();
        return view('dashpoard.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashpoard.roles.create', [
            'role' => new Role(),
            'abilities' => config('abilits'),
            'role_abilities' => []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'abilities' => 'required|array',
        ]);
        $role = Role::createWithAbilities($request);
        return redirect()->route('dashpoard.roles.index')
            ->with('success', 'Role created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $abilities = config('abilits');
        $role_abilities = $role->abilities->pluck('type', 'ability')->toArray();
        return view('dashpoard.roles.edit', compact('role', 'abilities', 'role_abilities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'abilities' => 'required|array',
        ]);
        $role->updateWithAbilities($request);
        return redirect()->route('dashpoard.roles.index')
            ->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::destroy($id);
        return redirect()->route('dashpoard.roles.index')
            ->with('success', 'Role deleted successfully');
    }
}
