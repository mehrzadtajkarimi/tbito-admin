<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\AdminLoginLog;
use App\Models\Google2fa;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('can:admin-create')->only(['create', 'store']);
    //     $this->middleware('can:admin-read')->only(['index']);
    //     $this->middleware('can:admin-update')->only(['edit', 'update']);
    //     $this->middleware('can:admin-delete')->only(['destroy']);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('admin-read');


        $data['admins'] = Admin::orderBy('is_super_admin', 'desc')->with('google2fa')->latest()->get();

        return view('admins.all', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Admin $admin)
    {
        $this->authorize('admin-create');

        return view('admins.create', compact('admin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('admin-create');

        $data = $request->validate([
            'name' => 'required|unique:admins',
            'email' => 'required|unique:admins|email',
            'post' => 'required|string',
            'password' => 'required|min:6',
            'roles' => 'nullable|array',
        ]);

        $admin =  Admin::create($data);
        $data['roles'] = (empty($data['roles'])) ? [] : $data['roles'];
        $admin->roles()->sync($data['roles']);
        return redirect()->route('admins.edit', $admin->id)->with('success', 'عملیات با موفقیت انجام شد!');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {

        $this->authorize('admin-update');
        $data['admin'] = $admin->load('google2fa');
        $data['loginLogs'] = AdminLoginLog::orderBy('id', 'desc')->where('admin_id',  $data['admin']->id)->paginate();
        return view('admins.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $this->authorize('admin-update');





        # code...
        $data = $request->validate([
            'name' => ['required', 'string', Rule::unique('admins')->ignore($admin->id)],
            'email' => ['required', 'email', Rule::unique('admins')->ignore($admin->id)],
            'roles' => ['nullable', 'array'],
            'post' => 'required|string',
        ]);

        if (!is_null($request->password)) {
            $request->validate([
                'password' => 'required|string|min:6',
            ]);
            $data['password'] = $request->password;
        }

        if ($request->has('enabled') || $admin->is_super_admin) {
            $data['enabled'] = 1;
        } else {
            $data['enabled'] = 0;
        }
        
        try {
            $admin->update($data);
            $data['roles'] = (empty($data['roles'])) ? [] : $data['roles'];
            $admin->roles()->sync($data['roles']);
        } catch (\Exception $th) {
            return back()->with('error', ' موفقیت آمیز نبود مجددا بررسی نمایید!');
        }

        return back()->with('success', 'عملیات با موفقیت انجام شد!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $this->authorize('admin-delete');
        $admin->delete($admin);
        return back();
    }


    public function resetGoogle2fa(Request $request, Admin $admin)
    {
        if ($request->has('resetPassword')) {
            try {
                Google2fa::where('admin_id', $admin->id)
                    ->Where('confirmed', 1)
                    ->update([
                        'resetted' => 1,
                        'resetted_at' => now()
                    ]);
                return back()->with('success', 'حساب کاربری با موفقیت ریست شد!');
            } catch (\Exception $th) {
                return back()->with('error', ' موفقیت آمیز نبود مجددا بررسی نمایید!');
            }
        }
        return back()->with('error', ' مقادیر مورد نظر ارسال نشده است !');
    }
}
