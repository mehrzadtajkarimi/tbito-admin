<?php

namespace App\Http\Controllers;

use App\Models\AdminRole;
use App\Models\Permission;
use App\Models\PermissionRole;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('can:permission-create')->only(['create', 'store']);
    //     $this->middleware('can:permission-read')->only(['index']);
    //     $this->middleware('can:permission-update')->only(['edit', 'update']);
    //     $this->middleware('can:permission-delete')->only(['destroy']);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('permission-read');

        $permissions = Permission::all();
        return view('permission.all', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('permission-create');

        $data = $request->validate([
            'name' => 'required|unique:permissions',
            'label' => 'required|unique:permissions',
        ]);

        $permission = Permission::create($data);
        return redirect()->route('permission.edit', $permission->id)->with('success', 'مقادیر مورد نظر با موفقیت ذخیره گردید!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        $this->authorize('permission-update');

        return view('permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $this->authorize('permission-update');

        $data = $request->validate([
            'name' => ['required', Rule::unique('permissions')->ignore($permission->id)],
            'label' => ['required', Rule::unique('permissions')->ignore($permission->id)],
        ]);
        try {
            $permission->update($data);
        } catch (\Exception $th) {
            return back()->with('error', ' موفقیت آمیز نبود مجددا بررسی نمایید!');
        }
        return back()->with('success', 'مقادیر مورد نظر با موفقیت ذخیره گردید!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $this->authorize('permission-delete');

        $permissionRole = PermissionRole::where('permission_id', $permission->id)->pluck('role_id')->toArray();

        if (!empty($permissionRole)) {
            return back()->with('error', 'بعلت اختصاص این سطح دسترسی به یک نقش  امکان حذف آن وجود ندارد!');
        }

        $permission->delete($permission);
        return back();
    }
}
