<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\AdminRole;
use App\Models\PermissionRole;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('can:role-create')->only(['create', 'store']);
    //     $this->middleware('can:role-read')->only(['index']);
    //     $this->middleware('can:role-update')->only(['edit', 'update']);
    //     $this->middleware('can:role-delete')->only(['destroy']);
    // }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('role-read');

        $roles = Role::all();
        return view('role.all', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('role-create');

        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('role-create');

        $data = $request->validate([
            'name' => 'required|unique:roles',
            'label' => 'required|unique:roles',
            'permissions' => 'required|array',
        ]);

        $role =  Role::create($data);
        $role->permissions()->sync($data['permissions']);
        return redirect()->route('role.edit', $role->id)->with('success', 'مقادیر مورد نظر با موفقیت ذخیره گردید!');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('role-update');

        return view('role.edit', compact('role'));
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
        $this->authorize('role-update');

        $data = $request->validate([
            'name' => ['required', Rule::unique('roles')->ignore($role->id)],
            'label' => ['required', Rule::unique('roles')->ignore($role->id)],
            'permissions' => 'required|array',
        ]);

        try {
            $role->update($data);
            $role->permissions()->sync($data['permissions']);
        } catch (\Exception $th) {
            return back()->with('error', ' موفقیت آمیز نبود مجددا بررسی نمایید!');
        }
        return back()->with('success', 'مقادیر مورد نظر با موفقیت ذخیره گردید!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('role-delete');

        $adminRole = AdminRole::where('role_id', $role->id)->pluck('admin_id')->toArray();
        if (!empty($adminRole)) {
            return back()->with('error', 'بعلت اختصاص این نقش به مدیران سایت امکان حذف آن وجود ندارد!');
        }
        PermissionRole::where('role_id', $role->id)->delete();
        // $role->permissions()->detach($role->permissions);
        $role->delete();
        return back();
    }
}
