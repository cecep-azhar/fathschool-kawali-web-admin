<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        abort_if(! userCan('roles.index'), 403);

        return inertia('Admin/Settings/Role/Index', [
            'roles' => Role::latest()->with('permissions')->paginate(15)->onEachSide(-1),
        ]);
    }

    public function create()
    {
        abort_if(! userCan('roles.create'), 403);

        $permissions = Permission::where('group_name', '!=', 'others')
            ->get()
            ->groupBy('group_name')
            ->sortByDesc(function ($group) {
                return $group->count();
            });

        return inertia('Admin/Settings/Role/Create', compact('permissions'));
    }

    public function store(Request $request)
    {
        abort_if(! userCan('roles.create'), 403);

        $request->validate([
            'name' => 'required|unique:roles,name',
            'role_permissions' => 'required|array',
        ]);

        $role = Role::create([
            'name' => ucfirst($request->name),
            'description' => $request->description,
            'guard_name' => 'web',
        ]);
        $role->syncPermissions($request->role_permissions);

        $this->flashSuccess('Role created successful');

        return redirect()->route('roles.index');
    }

    public function edit(Role $role)
    {
        abort_if($role->name == 'Admin', 403);
        abort_if($role->name == 'Teacher', 403);
        abort_if($role->name == 'Student', 403);
        abort_if($role->name == 'Parent', 403);
        abort_if($role->name == 'Accountant', 403);

        abort_if(! userCan('roles.edit'), 403);

        $role->permissions;
        $permissions = Permission::where('group_name', '!=', 'others')
            ->get()
            ->groupBy('group_name')
            ->sortByDesc(function ($group) {
                return $group->count();
            });

        return inertia('Admin/Settings/Role/Edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        abort_if($role->name == 'Admin', 403);
        abort_if($role->name == 'Teacher', 403);
        abort_if($role->name == 'Student', 403);
        abort_if($role->name == 'Parent', 403);
        abort_if($role->name == 'Accountant', 403);

        abort_if(! userCan('roles.edit'), 403);

        $request->validate([
            'name' => 'required|unique:roles,name,'.$role->id,
            'role_permissions' => 'required|array',
        ]);

        $role->update([
            'name' => ucfirst($request->name),
            'description' => $request->description,
        ]);
        $role->syncPermissions($request->role_permissions);

        $this->flashSuccess('Role updated successful');

        return redirect()->route('roles.index');
    }

    public function destroy(Role $role)
    {
        abort_if(! userCan('roles.destroy'), 403);

        abort_if($role->name == 'Admin', 403);
        abort_if($role->name == 'Teacher', 403);
        abort_if($role->name == 'Student', 403);
        abort_if($role->name == 'Parent', 403);
        abort_if($role->name == 'Accountant', 403);

        $role->delete();

        $this->flashSuccess('Role deleted successful');

        return back();
    }
}
