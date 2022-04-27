@component('layouts.include.content' , ['title' => 'لیست کاربران'])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="/">پنل مدیریت</a></li>
<li class="breadcrumb-item "><a href="{{url('user')}}"> مدیریت کاربران</a></li>
<li class="breadcrumb-item active">لیست کاربران</li>
@endslot


@if(request('waiting') == 1)
@section('sidebar-user-waiting','active')
@else
@section('sidebar-user','active')
@endif
@section('sidebar-users','active menu-open')



<div class="card ">
    <div class="card-header">
        <div class="card-body ">
            <div class="card-tools">
                <form action="{{route('user.index')}}" method='get' autocomplete="off">
                    <input type="hidden" name="waiting" value="{{ request()->query('waiting') }}">
                    <div class="form-row col-md-12">
                        <div class="form-group col-md-3">
                            <input autocomplete="off" type="text" class="form-control" name="name" value="{{ request()->query('name') }}" placeholder="نام و نام خانوادگی">
                        </div>
                        <div class="form-group col-md-3">
                            <input autocomplete="off" type="text" class="form-control" name="national_code" value="{{ request()->query('national_code') }}" placeholder="کد ملی">
                        </div>
                        <div class="form-group col-md-3">
                            <input autocomplete="off" type="text" class="form-control" name="mobile" value="{{ request()->query('mobile') }}" placeholder="شماره همراه">
                        </div>
                        <div class="form-group col-md-3">
                            <input autocomplete="off" type="text" class="form-control" name="email" value="{{ request()->query('email') }}" placeholder="ایمیل">
                        </div>
                    </div>
                    <div class="form-row col-md-12">
                        <div class="form-group col-md-3">
                            <input autocomplete="off" type="text" class="form-control" name="code" value="{{ request()->query('code') }}" placeholder="شناسه کاربر">
                        </div>
                        <div class="form-group col-md-3">
                            <input autocomplete="off" type="text" class="form-control" name="user_id" value="{{ request()->query('user_id') }}" placeholder="tblid کاربر">
                        </div>
                        <div class="form-group col-md-3">
                            <select name="user_level_id" class="custom-select ">
                                <option value="">همه موارد</option>
                                @foreach($data['userLevels'] as $userLevel)
                                <option value="{{ $userLevel->id }}" {{  request()->query('user_level_id') == $userLevel->id ? 'selected' : ''}}>{{ $userLevel->title   }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row col-md-12">
                        <div class="offset-md-9"></div>
                        <div class="form-group col-md-1 "">
                                <a class=" btn btn-danger btn-block mr-1" href="{{route('user.index')}}">
                            <i class="fas fa-times"></i>
                            </a>
                        </div>
                        <div class="form-group col-md-2 vertical-align">
                            <button type="submit" name='search' value='1' class="btn btn-success btn-block mr-2 vertical-align d-flex justify-content-between align-items-center">
                                <span> جستجو موارد</span> <i class="fas fa-search vertical-align"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <div class="text-left m-2">
                    <span>{{$data['users']->firstItem()}} تا</span>
                    <span>{{$data['users']->lastItem()}} </span>
                    / <span>{{$data['users']->total()}} مورد</span>
                </div>
            </thead>
            <tbody>
                <tr>
                    <th class="text-center">ردیف</th>
                    <th class="text-center">شناسه</th>
                    <th>مشخصات</th>
                    <th>اطلاعات ورود</th>
                    <th class="text-center">وضعیت احراز هویت</th>
                    <th class="text-center">عملیات</th>
                </tr>
                @forelse ($data['users'] as $value)
                <tr class="vertical-align">
                    <td class="text-center" width="10px">{{$loop->index + $data['users']->firstItem() }}</td>
                    <td class="text-center">
                        <span>{{ App\Helpers\TableCodeHelper::id2Code($value->id) }}<sub class="text-muted">/{{ $value->id }}</sub></span>
                    </td>
                    <td>
                        <div>
                            <span>{{ $value->firstname }}</span>
                            <span>{{ $value->lastname }}</span>
                        </div>
                        <div>
                            <small>{{ $value->email }}</small>
                        </div>
                        <div>
                            <small>{{ $value->mobile }}</small>
                        </div>
                        <div>
                            <small>{{ $value->national_code }}</small>
                        </div>
                    </td>
                    <td>
                        <div>
                            <small>ورود دو عاملی : </small>
                            @if(!$value->two_fa)
                            <i class="fas fa-times text-danger"></i>
                            @else
                            <i class="fas fa-check text-success"></i>
                            <small>
                                {{ $value->two_fa }}
                            </small>
                            @endif
                        </div>
                        <div>
                            <small>آخرین ورود : </small>
                            <small>
                                <bdi class="arabic-num">{{ $value->loginLog ? \App\Helpers\DateTimeHelper::getDateTime($value->loginLog->created_at->timestamp) : " -- " }}</bdi>
                            </small>
                        </div>
                        <div>
                            <small>وضعیت کاربر : </small>
                            @if($value->enabled)
                            <i class="fas fa-check text-success"></i>
                            @else
                            <i class="fas fa-times text-danger"></i>
                            @endif
                        </div>
                        <div>
                            @if($value->user_level_id ===1)
                            <small>ثبت نام اولیه :</small>
                            <i class="far fa-star text-lighter"></i>
                            @elseif($value->user_level_id ===2)
                            <small>نقره ای : </small>
                            <i class="far fa-star text-secondary"></i>
                            <i class="far fa-star text-secondary"></i>
                            @elseif($value->user_level_id ===3)
                            <small>طلایی : </small>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="row mb-1">
                            <i class="far fa-{{ $value->getVerificationStatus($value->personal_info_verified)['icon'] }} text-{{ $value->getVerificationStatus($value->personal_info_verified)['color'] }} col-3"></i>
                            <span class="badge badge-pill badge-{{ $value->getVerificationStatus($value->personal_info_verified)['color'] }} btn-block vertical-align col-9">اطلاعات شخصی</span>
                        </div>
                        @if(request()->query('waiting') == 1)
                        <div class="row mb-1">
                            <i class="far fa-{{ $value->getWaitingBankAccountStatus()['icon'] }} text-{{ $value->getWaitingBankAccountStatus()['color'] }}  col-3"></i>
                            <span class="badge badge-pill badge-{{ $value->getWaitingBankAccountStatus()['color'] }} vertical-align col-9">اطلاعات بانکی</span>
                        </div>
                        @else
                        <div class="row mb-1">
                            <i class="far fa-{{ $value->getBankAccountStatus()['icon'] }} text-{{ $value->getBankAccountStatus()['color'] }}  col-3"></i>
                            <span class="badge badge-pill badge-{{ $value->getBankAccountStatus()['color'] }} vertical-align col-9">اطلاعات بانکی</span>
                        </div>
                        @endif
                        <div class="row mb-1">
                            <i class="far fa-{{$value->getPhoneStatus()['icon'] }}  text-{{$value->getPhoneStatus()['color'] }}  col-3"></i>
                            <span class="badge badge-pill badge-{{ $value->getPhoneStatus()['color']  }} vertical-align col-9">تلفن ثابت</span>
                        </div>
                        <div class="row mb-1">
                            <i class="far fa-{{ $value->getVerificationStatus($value->address_verified)['icon'] }} text-{{ $value->getVerificationStatus($value->address_verified)['color'] }}  col-3"></i>
                            <span class="badge badge-pill badge-{{ $value->getVerificationStatus($value->address_verified)['color'] }} vertical-align col-9">آدرس</span>
                        </div>
                        <div class="row mb-1">
                            <i class="far fa-{{ $value->getVerificationStatus($value->auth_pic_verified)['icon'] }} text-{{ $value->getVerificationStatus($value->auth_pic_verified)['color'] }}  col-3"></i>
                            <span class="badge badge-pill badge-{{ $value->getVerificationStatus($value->auth_pic_verified)['color'] }} vertical-align col-9">عکس سلفی</span>
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="row mb-1">
                            <a href="{{ route('user.show',$value->id) }}" class="btn btn-light btn-sm rounded vertical-align col-12">مشاهده جزئیات</a>
                        </div>
                        <div class="row mb-1 ">
                            <a href="{{ route('user.showBankAccount',$value->id) }}" class="btn btn-light btn-sm rounded vertical-align col-6"> حساب بانکی</a>
                            <a href="{{ route('user.ticket',$value->id) }}" class="btn btn-light btn-sm rounded vertical-align col-6"> تیکت ها</a>
                        </div>
                    </td>
                </tr>

                @empty
                <tr class="alert alert-secondary" role="alert">
                    <td colspan="10">
                        آیتمی برای نمایش وجود ندارد
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <span class="float-left">
            {{ $data['users']->links()  }}
        </span>
    </div>
</div>



@endcomponent