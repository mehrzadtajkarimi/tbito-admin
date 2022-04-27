@component('layouts.include.content' , ['title' => 'واریز ریالی'])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="{{ url('/') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item active">واریز ریالی</li>
@endslot
@section('sidebar-deposits-irt','active')

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <form action="{{route('deposits-irt.index')}}" method='get'>
                <div class="row mt-3">
                    <div class="form-row col-12">
                        <div class="form-group col-2">
                            <input autocomplete="off" type="text" class="form-control ltr" name="code" value="{{ request()->query('code') }}" placeholder="code">
                        </div>
                        <div class="form-group col-1">
                            <input autocomplete="off" type="text" class="form-control ltr" name="id" value="{{ request()->query('id') }}" placeholder="id">
                        </div>
                        <div class="form-group col">
                            <input autocomplete="off" type="text" class="form-control" name="user" value="{{ request()->query('user') }}" placeholder="کاربر : شناسه , نام , موبایل , ایمیل , کد ملی">
                        </div>
                        <div class="form-group col">
                            <input autocomplete="off" type="text" class="form-control" name="tracking_code" value="{{ request()->query('tracking_code') }}" placeholder="کد پیگیری">
                        </div>
                    </div>
                    <div class="form-row col-12">
                        <div class="form-group col">
                            <select name="creation_type" class="custom-select ">
                                <option value=""> نحوه ایجاد سند </option>
                                <option value="1" {{  request()->query('creation_type') == 1 ? 'selected' : ''}}>سیستمی</option>
                                <option value="2" {{  request()->query('creation_type') == 2 ? 'selected' : ''}}>دستی</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <select name="port_type" class="custom-select">
                                <option value=""> درگاه</option>
                                @foreach($data['gateways'] as $gateway)
                                <option value="{{ $gateway->id }}" {{  request()->query('port_type') == $gateway->id  ? 'selected' : ''}}>{{ $gateway->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <input autocomplete="off" type="text" class="form-control start_at" id="Input1" value="{{ request()->query('start_at') }}" placeholder="از تاریخ">
                            <input autocomplete="off" type="hidden" id="start_at" name="start_at" value="{{ request()->query('start_at') }}">
                        </div>
                        <div class="form-group col">
                            <input autocomplete="off" type="text" class="form-control finish_at" id="Input2" value="{{ request()->query('finish_at') }}" placeholder="تا تاریخ">
                            <input autocomplete="off" type="hidden" id="finish_at" name="finish_at" value="{{ request()->query('finish_at') }}">
                        </div>
                    </div>
                    <div class="form-row col-12">
                        <div class="offset-9"></div>
                        <div class="form-group col-1 "">
                                    <a class=" btn btn-danger btn-block mr-1" href="{{route('deposits-irt.index')}}">
                            <i class="fas fa-times"></i>
                            </a>
                        </div>
                        <div class="form-group col-2 vertical-align">
                            <button type="submit" name='search' value='1' class="btn btn-success btn-block mr-2 vertical-align d-flex justify-content-between align-items-center">
                                <span> جستجو موارد</span> <i class="fas fa-search vertical-align"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover table--vertical_middle ">
                <thead>
                    <div class="text-left m-2">
                        <span>{{$data['deposits']->firstItem()}} تا</span>
                        <span>{{$data['deposits']->lastItem()}} </span>
                        / <span>{{$data['deposits']->total()}} مورد</span>
                    </div>
                </thead>
                <tbody>
                    <tr>
                        <th>#</th>
                        <th>شناسه</th>
                        <th>کاربر</th>
                        <th>مبلغ - تومان</th>
                        <th>اطلاعات پرداخت</th>
                        <th>تاریخ</th>
                    </tr>
                    @forelse($data['deposits'] as $value)
                    <tr>
                        <td width="10px">{{$loop->index + $data['deposits']->firstItem() }}</td>
                        <td>
                            <span>{{ App\Helpers\TableCodeHelper::id2Code($value->id) }}<sub class="text-muted">/{{ $value->id }}</sub></span>
                        </td>
                        <td>
                            <div>
                                <a href="{{ route('user.show', $value->user->id)}}">
                                    <span>{{ $value->user->firstname }}</span>
                                    <span>{{ $value->user->lastname }}</span>
                                </a>
                            </div>
                            <div>
                                <small>{{ $value->user->mobile }}</small>
                            </div>
                            <div>
                                <small>{{ $value->user->email }}</small>
                            </div>
                            <div>
                                <small>{{ $value->user->national_code }}</small>
                            </div>
                        </td>
                        <td>
                            <div class="row d-flex align-items-center">
                                <div class="col-2">
                                    <img class="mb-1 mx-auto d-block" src="{{ asset('/admin/dist/img/currency_photo/irt.png') }}" alt="بیت‌کوین">
                                </div>
                                <div class="col-10">

                                    <div>
                                        <span>{{ (preg_replace('/(?<=\d)(?=(\d{3})+$)/', ',' , $value->amount)) ?? '' }}</span>
                                    </div>
                                    <div>
                                        <small>کارمزد کاربر : </small>
                                        <small>{{ $value->fee  ?? '0' }}</small>
                                    </div>
                                    <div>
                                        <small>کارمزد سایت : </small>
                                        <small class="{{ ($value->fee_site > 0 ? 'text-success' : ($value->fee_site < 0 ? 'text-danger':''))  ?? '0' }}"><bdi>{{ $value->fee_site ?? '0' }}</bdi></small>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div>
                                @if( $value->status == 0)
                                <h5><span class="badge  badge-danger">ناموفق</span></h5>
                                @elseif($value->status == 1)
                                <h5><span class="badge  badge-success">موفق</span></h5>
                                @elseif($value->status == 2)
                                <h5><span class="badge  badge-warning">در انتظار تایید</span></h5>
                                @elseif($value->status == 3)
                                <h5><span class="badge  badge-info">تایید شبکه</span></h5>
                                @endif
                            </div>
                            @if($value->creation_type == 1)
                            <div>
                                <span>سیستمی : {{ !empty($value->gateway)  ? $value->gateway->title : '' }}</span>
                            </div>
                            @elseif( $value->creation_type == 2)
                            <div>
                                <span> دستی </span>
                            </div>
                            @endif
                            <div>
                                <span>کد پیگیری : {{ $value->tracking_code ?? '--' }}</span>
                            </div>
                        </td>
                        <td>
                            <div>
                                <span>ایجاد : <bdi class="arabic-num ">{{ \App\Helpers\DateTimeHelper::getDateTime($value->created_at->timestamp) ?? '--' }}</bdi></span>
                            </div>
                            <div>
                                <span>تـایید : <bdi class="arabic-num ">{{ \App\Helpers\DateTimeHelper::getDateTime($value->confirmed_by_site_at) ?? '--' }}</bdi></span>
                            </div>
                        </td>
                    </tr>
                    @if (!empty($value->description))
                    <tr class="bg-light">
                        <td colspan="10" class="p-1">
                            <i class="fas fa-info-circle text-info vertical-align ml-2 "></i>
                            <small>
                                {{ $value->description }}
                            </small>
                        </td>
                    </tr>
                    @endif
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
                {{ $data['deposits']->links()  }}
            </span>
        </div>
    </div>
</div>



@endcomponent