@component('layouts.include.content' , ['title' => 'ویرایش اطلاعات کاربر'])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="/">پنل مدیریت</a></li>
<li class="breadcrumb-item "><a href="{{url('user')}}"> مدیریت کاربران</a></li>
<li class="breadcrumb-item active">ویرایش اطلاعات کاربر</li>
@endslot
@section('sidebar-aaa','active')
@section('sidebar-contents','active menu-open')

@include('users.menu')

<?php $count = 1; ?>

<div class="row">
    <div class="col-12">
        <form action="{{ route('user.storHardUpdate' , $data['user']->id )}}" method="POST">
            @method('POST')
            @csrf
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label for="id{{$count++}}" class="col-sm-4 col-form-label">نام :</label>
                                <div class="col-sm-8">
                                    <input autocomplete="off" name="firstname" id="id{{$count - 1}}" value="{{ $data['user']->firstname }}" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id{{$count++}}" class="col-sm-4 col-form-label">نام خانوادگی :</label>
                                <div class="col-sm-8">
                                    <input autocomplete="off" name="lastname" id="id{{$count - 1}}" value="{{ $data['user']->lastname }}" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id{{$count++}}" class="col-sm-4 col-form-label">کد ملی :</label>
                                <div class="col-sm-8">
                                    <input autocomplete="off" name="national_code" id="id{{$count - 1}}" value="{{ $data['user']->national_code }}" type="text" class="form-control ltr">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id{{$count++}}" class="col-sm-4 col-form-label">تاریخ تولد :</label>
                                <div class="col-sm-8">
                                    <input autocomplete="off" name="birthdate" id="id{{$count - 1}}" value="{{ $data['user']->birthdate }}" type="text" class="form-control ltr">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id{{$count++}}" class="col-sm-4 col-form-label">نام پدر :</label>
                                <div class="col-sm-8">
                                    <input autocomplete="off" name="father" id="id{{$count - 1}}" value="{{ $data['user']->father }}" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="id{{$count++}}" class="col-sm-4 col-form-label">وضعیت حساب کاربری :</label>
                                <div class="col-sm-8">
                                    <select name="enabled" id="id{{$count - 1}}" class="form-control">
                                        <option value="1" {{$data['user']->enabled == 1 ? 'selected' : ''}}>فعال</option>
                                        <option value="0" {{$data['user']->enabled == 0 ? 'selected' : ''}}>غیر فعال</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id{{$count++}}" class="col-sm-4 col-form-label">دومین فاکتور ورود :</label>
                                <div class="col-sm-8">
                                    <select name="two_fa" id="id{{$count - 1}}" class="form-control">
                                        <option value="mobile" {{$data['user']->two_fa == 'mobile' ? 'selected' : ''}}>mobile</option>
                                        <option value="email" {{$data['user']->two_fa == 'email' ? 'selected' : ''}}>email</option>
                                        <option value="google2fa" {{$data['user']->two_fa == 'google2fa' ? 'selected' : ''}}>google2fa</option>
                                        <option value="" {{$data['user']->two_fa == '' ? 'selected' : ''}}>تنظیم نشده </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="id{{$count++}}" class="col-sm-4 col-form-label">سطح کاربری :</label>
                                <div class="col-sm-8">
                                    <select name="user_level_id" id="id{{$count - 1}}" class="form-control">
                                        @foreach($data['userLevels'] as $value)
                                        <option value="{{ $value->id }}" {{  $data['user']->user_level_id == $value->id ? 'selected' : ''}}>{{ $value->title   }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="pt-3 ">
                                <div class="form-group row">
                                    <label for="id{{$count++}}" class="col-sm-4 col-form-label"> تاریخ تایید ایمیل :</label>
                                    <div class="col-sm-8">
                                        <input name="email_verified_at" id="id{{$count - 1}}" value="{{ $data['user']->email_verified_at ? \App\Helpers\DateTimeHelper::getDateTime($data['user']->email_verified_at) : '--'  }}" type="text" class="form-control ltr" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id{{$count++}}" class="col-sm-4 col-form-label">ایمیل :</label>
                                    <div class="col-sm-8">
                                        <input autocomplete="off" name="email" id="id{{$count - 1}}" value="{{ $data['user']->email }}" type="text" class="form-control ltr">
                                    </div>
                                </div>
                            </div>
                            <div class="pt-3 ">
                                <div class="form-group row">
                                    <label for="id{{$count++}}" class="col-sm-4 col-form-label"> تاریخ تایید موبایل :</label>
                                    <div class="col-sm-8">
                                        <input name="mobile_verified_at" id="id{{$count - 1}}" value="{{ $data['user']->mobile_verified_at ? \App\Helpers\DateTimeHelper::getDateTime($data['user']->mobile_verified_at) : '--' }}" type="text" class="form-control ltr" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id{{$count++}}" class="col-sm-4 col-form-label">موبایل :</label>
                                    <div class="col-sm-8">
                                        <input autocomplete="off" name="mobile" id="id{{$count - 1}}" value="{{ $data['user']->mobile }}" type="text" class="form-control ltr">
                                    </div>
                                </div>
                            </div>
                            <div class="pt-3 ">
                                <div class="form-group row">
                                    <label for="id{{$count++}}" class="col-sm-4 col-form-label"> تاریخ تایید تلفن :</label>
                                    <div class="col-sm-8">
                                        <input name="phone_verified_at" id="id{{$count - 1}}" value="{{ $data['user']->phone_verified_at ? \App\Helpers\DateTimeHelper::getDateTime($data['user']->phone_verified_at) : '--'  }}" type="text" class="form-control ltr" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id{{$count++}}" class="col-sm-4 col-form-label"> تلفن :</label>
                                    <div class="col-sm-8">
                                        <input autocomplete="off" name="phone" id="id{{$count - 1}}" value="{{ $data['user']->phone   }}" type="text" class="form-control ltr">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label for="id{{$count++}}" class="col-sm-4 col-form-label"> کلمه عبور :</label>
                                <div class="col-sm-8">
                                    <input autocomplete="off" name="password" id="id{{$count - 1}}" value="" type="text" class="form-control ltr">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class=" ">
                                <div class="form-group row">
                                    <label for="id{{$count++}}" class="col-sm-4 col-form-label"> استان :</label>
                                    <div class="col-sm-8">
                                        <select name="province_id" id="id{{$count - 1}}" class="form-control" disabled>
                                            @foreach($data['provinces'] as $value)
                                            <option value="{{ $value->id }}" {{  $data['user']->province_id == $value->id ? 'selected' : ''}}>{{ $value->title   }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id{{$count++}}" class="col-sm-4 col-form-label"> شهر :</label>
                                    <div class="col-sm-8">
                                        <select name="city_id" id="id{{$count - 1}}" class="form-control" disabled>
                                            @foreach($data['cities'] as $value)
                                            <option value="{{ $value->id }}" {{  $data['user']->city_id == $value->id ? 'selected' : ''}}>{{ $value->title   }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id{{$count++}}" class="col-sm-4 col-form-label"> آدرس :</label>
                                    <div class="col-sm-8">
                                        <input autocomplete="off" name="address" id="id{{$count - 1}}" value="{{ $data['user']->address }}" type="text" class="form-control ">
                                    </div>
                                </div>
                            </div>
                            <div class="pt-3 ">
                                <div class="form-group row">
                                    <label for="id{{$count++}}" class="col-sm-4 col-form-label"> تاریخ تایید اطلاعات شخصی :</label>
                                    <div class="col-sm-8">
                                        <input name="personal_info_verified_at" id="id{{$count - 1}}" value="{{ $data['user']->personal_info_verified_at ? \App\Helpers\DateTimeHelper::getDateTime($data['user']->personal_info_verified_at) : '--' }}" type="text" class="form-control ltr" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id{{$count++}}" class="col-sm-4 col-form-label"> وضعیت تایید اطلاعات شخصی :</label>
                                    <div class="col-sm-8">
                                        <select name="personal_info_verified" id="id{{$count - 1}}" class="form-control">
                                            <option value="0" {{$data['user']->personal_info_verified == 0 ? 'selected' : ''}}>عدم تایید</option>
                                            <option value="1" {{$data['user']->personal_info_verified == 1 ? 'selected' : ''}}> تایید</option>
                                            <option value="2" {{$data['user']->personal_info_verified == 2 ? 'selected' : ''}}> در انتظار پاسخ</option>
                                            <option value="" {{$data['user']->personal_info_verified == '' ? 'selected' : ''}}>ارسال نشده</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id{{$count++}}" class="col-sm-4 col-form-label"> علت عدم تایید شخصی :</label>
                                    <div class="col-sm-8">
                                        <textarea name="disapproval_reason_personal_info" id="id{{$count - 1}}" rows="2" value="{{ $data['user']->disapproval_reason_personal_info }}" type="text" class="form-control "></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-3 ">
                                <div class="form-group row">
                                    <label for="id{{$count++}}" class="col-sm-4 col-form-label"> تاریخ تایید آدرس:</label>
                                    <div class="col-sm-8">
                                        <input name="address_verified_at" id="id{{$count - 1}}" value="{{ $data['user']->address_verified_at ? \App\Helpers\DateTimeHelper::getDateTime($data['user']->address_verified_at) : '--' }}" type="text" class="form-control ltr" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id{{$count++}}" class="col-sm-4 col-form-label"> وضعیت تایید آدرس:</label>
                                    <div class="col-sm-8">
                                        <select name="address_verified" id="id{{$count - 1}}" class="form-control">
                                            <option value="0" {{$data['user']->address_verified == 0 ? 'selected' : ''}}>عدم تایید</option>
                                            <option value="1" {{$data['user']->address_verified == 1 ? 'selected' : ''}}> تایید</option>
                                            <option value="2" {{$data['user']->address_verified == 2 ? 'selected' : ''}}> در انتظار پاسخ</option>
                                            <option value="" {{$data['user']->address_verified == '' ? 'selected' : ''}}>ارسال نشده</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id{{$count++}}" class="col-sm-4 col-form-label"> علت عدم تایید آدرس :</label>
                                    <div class="col-sm-8">
                                        <textarea name="disapproval_reason_address" id="id{{$count - 1}}" rows="2" value="{{ $data['user']->disapproval_reason_address }}" type="text" class="form-control "></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-3 ">
                                <div class="form-group row">
                                    <label for="id{{$count++}}" class="col-sm-4 col-form-label"> تاریخ تایید عکس:</label>
                                    <div class="col-sm-8">
                                        <input name="auth_pic_verified_at" id="id{{$count - 1}}" value="{{ $data['user']->auth_pic_verified_at ? \App\Helpers\DateTimeHelper::getDateTime($data['user']->auth_pic_verified_at) : '--' }}" type="text" class="form-control ltr" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id{{$count++}}" class="col-sm-4 col-form-label"> وضعیت تایید عکس:</label>
                                    <div class="col-sm-8">
                                        <select name="auth_pic_verified" id="id{{$count - 1}}" class="form-control">
                                            <option value="0" {{$data['user']->auth_pic_verified == 0 ? 'selected' : ''}}>عدم تایید</option>
                                            <option value="1" {{$data['user']->auth_pic_verified == 1 ? 'selected' : ''}}> تایید</option>
                                            <option value="2" {{$data['user']->auth_pic_verified == 2 ? 'selected' : ''}}> در انتظار پاسخ</option>
                                            <option value="" {{$data['user']->auth_pic_verified == '' ? 'selected' : ''}}>ارسال نشده</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id{{$count++}}" class="col-sm-4 col-form-label"> علت عدم تایید عکس :</label>
                                    <div class="col-sm-8">
                                        <textarea name="disapproval_reason_auth_pic" id="id{{$count - 1}}" rows="2" value="{{ $data['user']->disapproval_reason_auth_pic }}" type="text" class="form-control "></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id{{$count++}}" class="col-sm-4 col-form-label">محاسبه موجودی در گزارش ها :</label>
                                <div class="col-sm-8">
                                    <select name="exclude_balance" id="id{{$count - 1}}" class="form-control">
                                        <option value="0" {{$data['user']->exclude_balance == 0 ? 'selected' : ''}}>محاسبه شود</option>
                                        <option value="1" {{$data['user']->exclude_balance == 1 ? 'selected' : ''}}>محاسبه نشود</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block mt-4 mb-4" onclick="return confirm('آیا برای ذخیره اطلاعات اطمینان دارید');">ذخیره اطلاعات</button>
                </div>
            </div>
        </form>
    </div>
</div>





@endcomponent