<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    //
   public function index (Permission $permissions) {
       return view('admin.permissions.index', [
           'permissions'=>Permission::all()
       ]);
   }
   public function store (Permission $permissions) {
       request()->validate([
           'name'=>['required']
       ]);
       Permission::create([
           'name'=>Str::ucfirst(request('name')),
           'slug'=>Str::of(Str::lower(request('name')))->slug('-'),
       ]);
       session()->flash('permissions-created', 'Permissions create'. $permissions->name);
       return back();
   }
   public function destroy (Permission $permission) {
       $permission->delete();
       session()->flash('permission-deleted', 'Permission deleted '.$permission->name);
       return back();
   }
   public function  edit (Permission $permission) {
        return view('admin.permissions.edit', [
            'permission'=>$permission
        ]);
   }
   public function  update (Permission $permission) {
       $permission->name = Str::ucfirst(request('name'));
       $permission->slug = Str::of(request('name'))->slug('-');
       if ($permission->isDirty('name')) {
           session()->flash('permission-update', 'Permission updated: '.$permission->name);
           $permission->update();
       } else {
           session()->flash('permission-update', 'Permission not changed ');

       }
       $permission->update();
       return redirect()->route('permissions.index');
   }
}
