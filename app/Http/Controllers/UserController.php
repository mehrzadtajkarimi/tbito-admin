<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use App\Models\Admin;
use App\Models\Ticket;
use App\Models\Currency;
use App\Models\Province;
use App\Models\UserLevel;
use App\Models\BankAccount;
use App\Rules\NationalCode;
use Illuminate\Http\Request;
use App\Helpers\GlobalHelper;
use App\Helpers\TableCodeHelper;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('user-read');

        $data['users'] = User::query();


        if ($request->filled('name')) {
            $keyword = GlobalHelper::exchangeArabicChars($request->name);
            $keyword_array = explode(' ', trim($keyword));

            for ($i = 0; $i < count($keyword_array); $i++) {
                $keyword_i = $keyword_array[$i];
                $data['users']->where(function ($query) use ($keyword_i) {
                    $query->orWhere('firstname', 'LIKE', "%{$keyword_i}%");
                    $query->orWhere('lastname', 'LIKE', "%{$keyword_i}%");
                });
            }
        }
        if ($request->filled('national_code')) {
            $data['users']->where('national_code', 'LIKE', "%{$request->national_code}%");
        }
        if ($request->filled('mobile')) {
            $data['users']->where('mobile', 'LIKE', "%{$request->mobile}%");
        }
        if ($request->filled('email')) {
            $data['users']->where('email', 'LIKE', "%{$request->email}%");
        }
        if ($request->filled('code')) {
            $id = TableCodeHelper::code2Id($request->code);
            $data['users']->where('id', $id);
        }
        if ($request->filled('user_id')) {
            $data['users']->where('id', $request->user_id);
        }
        if ($request->filled('user_level_id')) {
            $data['users']->where('user_level_id', $request->user_level_id);
        }
        if ($request->filled('waiting')  && $request->waiting == 1) {
            $data['users']->where(function ($q) {
                $q->orWhere('personal_info_verified', 2)->orWhere('address_verified', 2)->orWhere('auth_pic_verified', 2)->orWhereHas('waitingBankAccounts');
            });
        }


        $data['users'] = $data['users']->with(['loginLog', 'verifiedBankAccounts', 'lastBankAccount'])->latest()->paginate()->appends($request->query());
        $data['userLevels'] = UserLevel::all();
        return view('users.all', compact('data'));
    }

    public function show(User $user)
    {
        $this->authorize('user-read');

        $data['currencies'] = Currency::with(['wallet' => function ($q) use ($user) {
            $q->where('user_id', $user->id);
        }])->get();

        $data['user'] = $user->load(['lastWaitingBankAccount', 'lastUnverifiedBankAccount', 'waitingBankAccounts', 'referralUser', 'referralCode']);

        $data['bank_account'] = null;
        if (!empty($data['user']->lastWaitingBankAccount)) {
            $data['bank_account'] = $data['user']->lastWaitingBankAccount;
        } elseif (!empty($data['user']->lastUnverifiedBankAccount)) {
            $data['bank_account'] = $data['user']->lastUnverifiedBankAccount;
        }
        $data['waitingBankAccounts'] = $data['user']->waitingBankAccounts->all();

        return view('users.show', compact('data'));
    }











    public function showHardUpdate(User $user)
    {
        $this->authorize('user-read');
        $this->authorize('user-hard-update');

        $data['userLevels'] = UserLevel::all();
        $data['provinces'] = Province::all();
        $data['cities'] = City::all();
        $data['user'] = $user;

        return view('users.hard', compact('data'));
    }

    public function storeHardUpdate(Request $request, User $user)
    {
        $this->authorize('user-read');
        $this->authorize('user-hard-update');

        $request->validate([
            'firstname' => ['required', 'string', 'max:255', 'min:3'],
            'lastname' => ['required', 'string', 'max:255', 'min:3'],
            'national_code' => ['nullable', new NationalCode],
            'birthdate' => ['nullable', 'string'],
            'father' => ['nullable', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'email:rfc,dns'],
            'mobile' => ['required', 'regex:/09(0[1-2]|1[0-9]|3[0-9]|2[0-1])-?[0-9]{3}-?[0-9]{4}/u'],

        ]);



        if (!is_null($request->password)) {
            $request->validate([
                'password' => 'required|string|min:6',
            ]);
            $user->password = bcrypt($request->password);
            $user->save();
        }

        try {
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->national_code = $request->national_code;
            $user->birthdate = $request->birthdate;
            $user->father = $request->father;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->enabled = $request->enabled;
            $user->two_fa = $request->two_fa == "" ? NULL : $request->two_fa;
            $user->user_level_id = $request->user_level_id;
            $user->province_id = $request->province_id;
            $user->city_id = $request->city_id;
            $user->address = $request->address;
            $user->personal_info_verified = $request->personal_info_verified == "" ? NULL : $request->personal_info_verified;
            $user->disapproval_reason_personal_info = $request->disapproval_reason_personal_info;
            $user->address_verified = $request->address_verified == "" ? NULL : $request->address_verified;
            $user->disapproval_reason_address = $request->disapproval_reason_address;
            $user->auth_pic_verified = $request->auth_pic_verified == "" ? NULL : $request->auth_pic_verified;
            $user->disapproval_reason_auth_pic = $request->disapproval_reason_auth_pic;
            $user->exclude_balance = $request->exclude_balance == 1 ? 1 : 0;
            $user->save();
        } catch (\Exception $th) {
            return back()->with('error', ' موفقیت آمیز نبود مجددا بررسی نمایید!');
        }
        return back()->with('success', 'عملیات با موفقیت انجام شد!');
    }












    public function showBankAccount(User $user)
    {
        $this->authorize('user-read');
        $this->authorize('bank-account-read');


        $data['bankAccount'] = BankAccount::where('user_id', $user->id)->orderByRaw("verified=2 desc")->latest()->get();
        $data['user'] = $user;

        return view('users.bank', compact('data'));
    }

    public function storeBankAccount(Request $request, User $user)
    {
        $this->authorize('user-read');
        $this->authorize('bank-account-read');
        $this->authorize('bank-account-update');
        try {
            $bankAccount = BankAccount::where('id', $request->input_hidden_bank_account_id)->where('user_id', $user->id)->first();

            if ($request->verified_bank_account == 1) {
                $bankAccount->verified = 1;
                $bankAccount->verified_at = time();
                $bankAccount->disapproval_reason = null;
                $bankAccount->save();
                return back()->with('success', 'عملیات با موفقیت انجام شد!');
            }
            if ($request->verified_bank_account == 0) {
                $bankAccount->verified = 0;
                $bankAccount->verified_at = null;
                $bankAccount->disapproval_reason = $request->verified_bank_accounts_textarea;
                $bankAccount->save();
                return back()->with('success', 'عملیات با موفقیت انجام شد!');
            }
        } catch (\Exception $th) {
            return back()->with('error', ' موفقیت آمیز نبود مجددا بررسی نمایید!');
        }
    }





    public function ticket(User $user)
    {
        $data['ticket'] = Ticket::where('user_id', $user->id)->whereNull('parent_id')->with(['admin'])->paginate(2);

        $data['user'] = $user;

        return view('users.ticket', compact('data'));
    }








    public function nationalCardPicShow(User $user)
    {
        $this->authorize('user-read');
        $this->authorize('user-auth');
        $this->authorize('user-pics-read');

        $coreApiUrl = env('CORE_API_V1') . "/admin/storage/users/$user->id/{$user->national_card_pic}";
        $response = Http::withHeaders([
            'x-api-key' => env('CORE_API_KEY'),
        ])->withToken(Cookie::get('tbat'))->post($coreApiUrl);
        return $response['data']['base64encode'];
    }
    public function authPicVerifyShow(User $user)
    {
        $this->authorize('user-read');
        $this->authorize('user-auth');
        $this->authorize('user-pics-read');


        $coreApiUrl = env('CORE_API_V1') . "/admin/storage/users/$user->id/{$user->auth_pic}";
        $response = Http::withHeaders([
            'x-api-key' => env('CORE_API_KEY'),
        ])->withToken(Cookie::get('tbat'))->post($coreApiUrl);
        return $response['data']['base64encode'];
    }






    public function authPicVerifyRemove(User $user)
    {
        $this->authorize('user-read');
        $this->authorize('user-auth');
        $this->authorize('user-pics-delete');

        $coreApiUrl = env('CORE_API_V1') . "/admin/user/remove/auth-pic";
        $response = Http::withHeaders([
            'x-api-key' => env('CORE_API_KEY'),
        ])->withToken(Cookie::get('tbat'))->post($coreApiUrl, [
            'user_id' => $user->id,
        ]);
        if ($response['success']) {
            return back()->with('success', $response['message']);
        } else {
            $msg = "خطا در سرور !!! " . $response['message'];
            return back()->with('error', $msg);
        }
    }
    public function nationalCardPicRemove(User $user)
    {
        $this->authorize('user-read');
        $this->authorize('user-auth');
        $this->authorize('user-pics-delete');

        $coreApiUrl = env('CORE_API_V1') . "/admin/user/remove/national-card-pic";
        $response = Http::withHeaders([
            'x-api-key' => env('CORE_API_KEY'),
        ])->withToken(Cookie::get('tbat'))->post($coreApiUrl, [
            'user_id' => $user->id,
        ]);
        if ($response['success']) {
            return back()->with('success', $response['message']);
        } else {
            $msg = "خطا در سرور !!! " . $response['message'];
            return back()->with('error', $msg);
        }
    }







    public function checkWallet(User $user)
    {
        $this->authorize('user-read');
        $this->authorize('user-auth');
        $this->authorize('user-wallet-read');

        $coreApiUrlWallet = env('CORE_API_V1') . "/admin/user-wallets/check";
        $response = Http::withHeaders([
            'x-api-key' => env('CORE_API_KEY'),
        ])->withToken(Cookie::get('tbat'))->post($coreApiUrlWallet, [
            'user_id' => $user->id
        ]);

        $response = json_decode($response, true);
        return $response;
    }
























    public function personalInfoVerified(User $user, Request $request)
    {
        $this->authorize('user-read');
        $this->authorize('user-auth');

        if ($request->personal_info_verified == 1) {
            $user->personal_info_verified = 1;
            $user->personal_info_verified_at = time();
            $user->disapproval_reason_personal_info = null;
            if ($user->verifiedBankAccounts->isNotEmpty() && $user->user_level_id < 2) {
                $user->user_level_id = 2;
            }
            $user->save();
            return back();
        }
        if ($request->personal_info_verified == 0) {
            $user->personal_info_verified = 0;
            $user->personal_info_verified_at = null;
            $user->disapproval_reason_personal_info = $request->personal_info_textarea;
            $user->save();
            return back();
        }
    }

    public function verifiedBankAccounts(User $user, Request $request)
    {
        $this->authorize('user-read');
        $this->authorize('user-auth');


        $bankAccount = BankAccount::where('id', $request->bank_account_id)->where('user_id', $user->id)->first();

        if ($request->verified_bank_account == 1) {
            $bankAccount->verified = 1;
            $bankAccount->verified_at = time();
            $bankAccount->disapproval_reason = null;
            $bankAccount->save();
            if ($user->personal_info_verified == 1 && $user->user_level_id < 2) {
                $user->user_level_id = 2;
                $user->save();
            }
            return back();
        }
        if ($request->verified_bank_account == 0) {
            $bankAccount->verified = 0;
            $bankAccount->verified_at = null;
            $bankAccount->disapproval_reason = $request->verified_bank_accounts_textarea;
            $bankAccount->save();
            return back();
        }
    }

    public function addressVerified(User $user, Request $request)
    {
        $this->authorize('user-read');
        $this->authorize('user-auth');


        if ($request->address_verified == 1) {
            $user->address_verified = 1;
            $user->address_verified_at = time();
            $user->disapproval_reason_address = null;
            $user->save();
            return back();
        }
        if ($request->address_verified == 0) {
            $user->address_verified = 0;
            $user->address_verified_at = null;
            $user->disapproval_reason_address = $request->address_verified_textarea;
            $user->save();
            return back();
        }
    }

    public function authPicVerified(User $user, Request $request)
    {
        $this->authorize('user-read');
        $this->authorize('user-auth');


        if ($request->authPicVerified == 1) {
            $user->auth_pic_verified = 1;
            $user->auth_pic_verified_at = time();
            $user->disapproval_reason_auth_pic = null;
            if ($user->user_level_id < 3) {
                $user->user_level_id = 3;
            }
            $user->save();
            return back();
        }
        if ($request->authPicVerified == 0) {
            $user->auth_pic_verified = 0;
            $user->auth_pic_verified_at = null;
            $user->disapproval_reason_auth_pic = $request->authPicVerifiedTextarea;
            $user->save();
            return back();
        }
    }
}
