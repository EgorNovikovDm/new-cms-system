<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    //
    public function index(Role $roles) {
        $roles = Role::all();
        return view('admin.roles.index', [
            'roles'=>$roles
        ]);
    }
    public function store(Role $roles) {
        request()->validate([
            'name'=>['required']
        ]);
        Role::create([
            'name'=>Str::ucfirst(request('name')),
            'slug'=>Str::of(Str::lower(request('name')))->slug('-'),
        ]);
        session()->flash('role-created', 'Role create'. $roles->name);
        return back();
    }
    public function destroy(Role $role){
        $role->delete();
        session()->flash('role-deleted', 'Role deleted '.$role->name);
        return back();
    }
    public function edit(Role $role) {
        return view('admin.roles.edit', [
            'role'=>$role,
            'permissions'=>Permission::all(),
        ]);
    }
    public function update(Role $role) {
        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::of(request('name'))->slug('-');
        if ($role->isDirty('name')) {
            session()->flash('role-update', 'Role updated: '.$role->name);
            $role->update();
        } else {
            session()->flash('role-update', 'Role not changed: ');

        }
        $role->update();
        return redirect()->route('roles.index');
    }
    public function attach (Role $role) {
        $role->permissions()->attach(request('permission'));
        return back();
    }
    public function detach (Role $role) {
        $role->permissions()->detach(request('permission'));
        return back();
    }
}
