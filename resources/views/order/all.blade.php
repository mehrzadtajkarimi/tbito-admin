@component('layouts.include.content' , ['title' => 'لیست سفارشات'])
namespace App;

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="/">پنل مدیریت</a></li>
<li class="breadcrumb-item "><a href="{{url('order')}}"> سفارشات و ترید ها</a></li>
<li class="breadcrumb-item active">لیست سفارشات</li>
@endslot
@if(request('status') == 2 )
@section('sidebar-order-waiting','active')
@else
@section('sidebar-order','active')
@endif
@section('sidebar-orders','active menu-open')



<div class="card ">
    <form action="{{route('order.index')}}" method='get'>
        <div class="card-header pb-0 border-0">
            <div class="card-body pb-0">
                <input type="hidden" name="order" value="{{ request()->query('order') }}">
                <div class="row">
                    <div class="col">
                        <div class="form-row">
                            <div class="form-group col-8 ltr">
                                <input autocomplete="off" type="number" class="form-control" name="code" value="{{ request()->query('code') }}" placeholder="code">
                            </div>
                            <div class="form-group col-4 ltr">
                                <input autocomplete="off" type="number" class="form-control" name="id" value="{{ request()->query('id') }}" placeholder="id">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <select name="side" class="custom-select ">
                                    <option value="">خرید و فروش</option>
                                    <option value="1" {{  request()->query('side') == 1  ? 'selected' : ''}}>خرید</option>
                                    <option value="2" {{  request()->query('side') == 2 ? 'selected' : ''}}>فروش</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <select name="market" class="custom-select ltr">
                                    <option value="">مارکت ها</option>
                                    @foreach($data['markets'] as $value)
                                    <option value="{{ $value->id }}" {{  request()->query('market') == $value->id  ? 'selected' : ''}}>{{ $value->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-row">
                            <div class="form-group col">
                                <input autocomplete="off" type="text" class="form-control" name="user" value="{{ request()->query('user') }}" placeholder="کاربر : شناسه , نام , موبایل , ایمیل , کد ملی">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <select name="fee" class="custom-select ltr">
                                    <option value="">کارمزد</option>
                                    @foreach($data['currencies'] as $value)
                                    <option value="{{ $value->id }}" {{  request()->query('fee') == $value->id  ? 'selected' : ''}}>{{ $value->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <select name="status" class="custom-select ">
                                    <option value="">وضعیت</option>
                                    <option value="1" {{  request()->query('status') == 1  ? 'selected' : ''}}>انجـــام شـــده</option>
                                    <option value="2" {{  request()->query('status') == 2 ? 'selected' : ''}}>بــــــاز</option>
                                    <option value="3" {{  request()->query('status') == 3 ? 'selected' : ''}}>لــــغو شــــده</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-row">
                            <div class="form-group col">
                                <input autocomplete="off" type="text" class="form-control start_at" id="Input1" value="{{ request()->query('start_at') }}" placeholder="از تاریخ">
                                <input autocomplete="off" type="hidden" id="start_at" name="start_at" value="{{ request()->query('start_at') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-row">
                            <div class="form-group col">
                                <input autocomplete="off" type="text" class="form-control finish_at" id="Input2" value="{{ request()->query('finish_at') }}" placeholder="تا تاریخ">
                                <input autocomplete="off" type="hidden" id="finish_at" name="finish_at" value="{{ request()->query('finish_at') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="form-group  form-check ">
                            <label class="form-check-label pt-3 ">
                                <input type="checkbox" name="is_robot" class="form-check-input " value="1" {{  request()->query('is_robot') == 1  ? 'checked' : ''}}>
                                <!-- <img class="opacity-60" width="25٪" src="{{ asset('/admin/dist/img/robot.png') }}"> -->
                                <b class="text-muted"> نمایش سفارشهای ربات تریدر</b>
                            </label>
                        </div>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-1">
                        <div class="form-group ">
                            <a class=" btn btn-danger btn-block " href="{{route('order.index')}}">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group vertical-align">
                            <button type="submit" name='search' value='1' class="btn btn-success btn-block  vertical-align d-flex justify-content-between align-items-center">
                                <span> جستجو موارد</span> <i class="fas fa-search vertical-align"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="card-body table-responsive p-0 ">
        <table class="table table-hover ">
            <thead class="">
                <div class="text-left m-2">
                    <span>{{$data['orders']->firstItem()}} تا</span>
                    <span>{{$data['orders']->lastItem()}} </span>
                    / <span>{{$data['orders']->total()}} مورد</span>
                </div>
            </thead>
            <tbody>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">شناسه</th>
                    <th>کاربر</th>
                    <th class="text-center">مارکت</th>
                    <th>سفارش</th>
                    <th>انجام شده</th>
                    <th>کارمزد</th>
                    <th class="text-center">تاریخ</th>
                    <th class="text-center">وضعیت</th>
                </tr>
                @forelse ($data['orders'] as $value)
                <tr class="vertical-align @if($value->status == 3 && empty($value->amount_filled)) opacity-30 @endif">
                    @if($value->is_robot==1)
                    <td class="text-center">
                        <img class=" position-relative " width="40" src="{{ asset('/admin/dist/img/robot.png') }}">
                    </td>
                    @else
                    <td class="text-center" width="10px">{{$loop->index + $data['orders']->firstItem() }}</td>
                    @endif
                    <td class="text-center">
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
                    <td class="">
                        <div class="text-center market_info">
                            <span class="market_image">
                                <img class="ml-2 position-relative " style="right: 11px;" src="{{ asset('/admin/dist/img/currency_photo/'.strtolower($value->currency2->title).'.png') }}">
                                <img class=" position-relative " style="left: 11px;" src="{{ asset('/admin/dist/img/currency_photo/'.strtolower($value->currency1->title).'.png') }}">
                            </span>
                            @if($value->side == 1)
                            <div class="text-success mt-2">خرید</div>
                            <div class="mt-2">{{$value->market->title }}</div>
                            @else
                            <div class="text-danger mt-2">فروش</div>
                            <div class="mt-2">{{$value->market->title }}</div>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div>
                            <span>مقدار :</span>
                            <span>{{ number_format($value->amount , $value->currency1->decimals ) }}</span>
                            <small class="text-muted mr-2">{{ $value->currency1->title }}</small>
                        </div>
                        <div>
                            <span>قیمت :</span>
                            <span>{{ number_format($value->price , $value->currency2->decimals ) }}</span>
                            <small class="text-muted mr-2">{{ $value->currency2->title }}</small>
                        </div>
                        <div>
                            <span>مبــــلغ :</span>
                            <span>{{ number_format(($value->amount * $value->price) , $value->currency2->decimals ) }}</span>
                            <small class="text-muted mr-2">{{ $value->currency2->title }}</small>
                        </div>
                    </td>
                    <td>
                        <div>
                            <span>مقدار :</span>
                            <span>{{ number_format($value->amount_filled , $value->currency1->decimals ) }}</span>
                            <small class="mr-1 vertical-align">(%{{ number_format($value->amount_filled / $value->amount *100) }})</small>
                            <small class="text-muted mr-2">{{ $value->currency1->title }}</small>
                        </div>
                        <div>
                            <span>قیمت :</span>
                            <span>{{ number_format($value->price_avg , $value->currency2->decimals ) }}</span>
                            <small class="text-muted mr-2">{{ $value->currency2->title }}</small>
                        </div>
                        <div>
                            <span>مبــــلغ :</span>
                            <span>{{ number_format(($value->amount_filled * $value->price_avg) , $value->currency2->decimals ) }}</span>
                            <small class="text-muted mr-2">{{ $value->currency2->title }}</small>
                        </div>
                    </td>

                    <td>
                        <div>
                            <span>{{ $value->currencyFee->title }}</span>
                            <span>({{ $value->fee_percent  }}%)</span>
                        </div>
                        @if ($value->status == 1 || $value->status == 3)
                        <small>
                            <span>سایت :</span>
                            <span>{{number_format($value->fee_site, $value->currencyFee->decimals) }}</span>
                        </small>
                        @if(!empty($value->referral_percent))
                        <small>
                            <span>کــــاربر :</span>
                            <span>{{number_format($value->fee_user,$value->currencyFee->decimals) }}</span>
                        </small>
                        <small>
                            <span>رفـــرال :</span>
                            <span>{{number_format(($value->fee_user - $value->fee_site),$value->currencyFee->decimals) }}</span>
                        </small>
                        @endif
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="arabic-num ">{{ \App\Helpers\DateTimeHelper::getDate($value->created_at->timestamp)  }}</div>
                        <div class="arabic-num ">{{ \App\Helpers\DateTimeHelper::getTime($value->created_at->timestamp)  }}</div>
                    </td>
                    <td class="text-center ">
                        @if ($value->status == 1)
                        <h5> <span class="badge  badge-success shadow">انجام شده</span></h5>
                        @elseif($value->status == 2)
                        <h5> <span class="badge  badge-primary shadow pr-4 pl-4">بـــــاز</span></h5>
                        @elseif($value->status == 3)
                        <h5> <span class="badge  badge-secondary shadow">لـغو شــــده</span></h5>
                        @endif
                        <div>
                            @if($value->amount_filled)
                            <form action="{{ route('order.trades',$value->id ,'trades')}}" method="post" class="form-show-trade">
                                @csrf
                                <button type="button" class="btn btn-link mt-1 form-show-trade-btn" data-toggle="modal" data-target="#show-trade">
                                    مشاهده تریدها
                                </button>
                            </form>
                            @endif
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
            {{ $data['orders']->links()  }}
        </span>
    </div>
</div>






@include('order.all-script-show-trade')
<div class="modal fade" id="show-trade" tabindex="-1" role="dialog" aria-labelledby="show-trade" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header border-0 ">
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span class=" p-3" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center d-block mb-3 position-relative" style="top:-30px">
                    <span id="ajax-show-trade-image">

                    </span>
                </div>
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th width="20%">کاربر خریدار</th>
                            <th width="20%">مقدار</th>
                            <th width="20%">قیمت</th>
                            <th width="20%">تاریخ</th>
                            <th width="20%">کاربر فروشنده</th>
                        </tr>
                    </thead>
                    <tbody id="ajax-show-trade" class="ltr">


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>










@endcomponent