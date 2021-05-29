<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('roles.index', ['roles' => Role::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = new Role();
        $permissions = Permission::all();

        return view('roles.create', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->permissions;

        $json_data = [];

        foreach ($data as $d) {
           $db_data = Permission::where('id', $d)->value('name');

           array_push($json_data, [$db_data => true]);
        }

        $dada = array_merge(...$json_data);

        
        
        $role = Role::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'permissions' => json_encode($dada)
        ]);

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('roles.show', ['role' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('roles.edit', [
            'role' => $role,
            'permissions' => $permissions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {

        $data = $request->permissions;

        $json_data = [];

        foreach ($data as $d) {
           $db_data = Permission::where('id', $d)->value('name');

           array_push($json_data, [$db_data => true]);
        }

        $dada = array_merge(...$json_data);

        $role->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'permissions' => json_encode($dada)
        ]);


        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        Role::destroy($role->id);

        return redirect()->route('roles.index');
    }
}
