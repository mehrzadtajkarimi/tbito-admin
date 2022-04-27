@component('layouts.include.content' , ['title' => 'برداشتهای ریالی'])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="{{ url('/') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item active">برداشتهای ریالی</li>
@endslot
@section('sidebar-withdrawIrt','active')

<div class="col-12" id="ajax_form_confirm">
    <div class="card">
        <div class="card-header">
            <form action="{{route('withdrawIrt.index')}}" method='get'>
                <div class="row mt-3">
                    <div class="form-row col">
                        <div class="form-group col-1">
                            <input autocomplete="off" type="text" class="form-control ltr" name="id" value="{{ request()->query('id') }}" placeholder="id">
                        </div>
                        <div class="form-group col-3">
                            <input autocomplete="off" type="text" class="form-control ltr" name="code" value="{{ request()->query('code') }}" placeholder="code">
                        </div>

                        <div class="form-group col">
                            <input autocomplete="off" type="text" class="form-control" name="user" value="{{ request()->query('user') }}" placeholder="کاربر : شناسه , نام , موبایل , ایمیل , کد ملی">
                        </div>
                        <div class="form-group col">
                            <select name="status" class="custom-select ">
                                <option value="">وضعیت </option>
                                <option value="1" {{  request()->query('status') == 1  ? 'selected' : ''}}>در انتظار بررسی</option>
                                <option value="2" {{  request()->query('status') == 2 ? 'selected' : ''}}>تایید شده</option>
                                <option value="3" {{  request()->query('status') == 2 ? 'selected' : ''}}>در حال واریز</option>
                                <option value="4" {{  request()->query('status') == 2 ? 'selected' : ''}}>انجام شده</option>
                                <option value="5" {{  request()->query('status') == 2 ? 'selected' : ''}}>لغو شده</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <select name="creationType" class="custom-select ">
                                <option value="">نحوه ایجاد سند </option>
                                <option value="1" {{  request()->query('status') == 1  ? 'selected' : ''}}>دستی </option>
                                <option value="2" {{  request()->query('status') == 2 ? 'selected' : ''}}>سیستمی</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="form-row col-12">
                        <div class="form-group col">
                            <input autocomplete="off" type="text" class="form-control ltr" name="trackingCode" value="{{ request()->query('trackingCode') }}" placeholder="کد پیگیری ">
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
                </div>
                <div class="form-row col-12">
                    <div class="offset-9"></div>
                    <div class="form-group col-1 "">
                                    <a class=" btn btn-danger btn-block mr-1" href="{{route('withdrawIrt.index')}}">
                        <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <div class="form-group col-2 vertical-align">
                        <button type="submit" name='search' value='1' class="btn btn-success btn-block mr-2 vertical-align d-flex justify-content-between align-items-center">
                            <span> جستجو موارد</span> <i class="fas fa-search vertical-align"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover table--vertical_middle">
                <thead>
                    <div class="text-left m-2">
                        <span>{{$data['withdraws']->firstItem()}} تا</span>
                        <span>{{$data['withdraws']->lastItem()}} </span>
                        / <span>{{$data['withdraws']->total()}} مورد</span>
                    </div>
                </thead>
                <tbody>
                    <tr>
                        <th>#</th>
                        <th>شناسه</th>
                        <th>کاربر</th>
                        <th>درخواست</th>
                        <th>وضعیت</th>
                        <th>تاریخ</th>
                        <th class="text-center">عملیات</th>
                    </tr>
                    @forelse($data['withdraws'] as $value)
                    <tr>
                        <td width="10px">{{$loop->index + $data['withdraws']->firstItem() }}</td>
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
                            <div class="row  d-flex align-items-center">
                                <div class="col-2">
                                    <img class="mb-1 mx-auto d-block" src="{{ asset('/admin/dist/img/currency_photo/irt.png') }}" alt="بیت‌کوین">
                                </div>
                                <div class="col-10">
                                    <div>مبــــلغ : <bdi class="arabic-num ">{{number_format($value->amount, $value->currency->decimals) ?? '--' }}</bdi></div>
                                    <small class="d-block">کـــارمزد کاربــــــر : <bdi class="arabic-num ">{{number_format($value->fee, $value->currency->decimals) ?? '--' }}</bdi></small>
                                    @if($value->status == 4)
                                    <small class="d-block">کارمزد پرداختی : <bdi class="arabic-num ">{{number_format($value->fee_real, $value->currency->decimals) ?? '--' }}</bdi></small>
                                    <small class="d-block">کـــارمزد ســـایت : <bdi class="arabic-num {{ ($value->fee_site > 0) ? 'text-success' :  'text-danger' }}">{{number_format($value->fee_site, $value->currency->decimals) ?? '--' }}</bdi></small>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <div>
                                @if( $value->status == 1)
                                <h5><span class="badge  badge-warning">در انتظار بررسی</span></h5>
                                @elseif($value->status == 2)
                                <h5><span class="badge  badge-info">تایید شده</span></h5>
                                @elseif($value->status == 3)
                                <h5><span class="badge  badge-success">در حال واریز</span></h5>
                                @elseif($value->status == 4)
                                <h5><span class="badge  badge-success">انجام شده</span></h5>
                                @elseif($value->status == 5)
                                <h5><span class="badge  badge-danger">لغو شده</span></h5>
                                @endif
                            </div>
                            @if($value->creation_type == 1)
                            <p class="mb-2">سیستمی </p>
                            @elseif( $value->creation_type == 2)
                            <p class="mb-2"> دستی </p>
                            @endif
                            @if($value->internal == 1)
                            <div>
                                <h5><span class="badge  badge-secondary">انتقال داخلی</span></h5>
                            </div>
                            @endif
                            <div>
                                <span>کد پیگیری :</span>
                                <span>{{ $value->tracking_code ?? '--'}}</span>
                            </div>
                        </td>
                        <td>
                            <div>
                                <span>ایجـــــــاد : <bdi class="arabic-num mr-1">{{ \App\Helpers\DateTimeHelper::getDateTime($value->created_at->timestamp) ?? '--' }}</bdi></span>
                            </div>
                            <div>
                                <span>تــایـــــیـد : <bdi class="arabic-num mr-1">{{ \App\Helpers\DateTimeHelper::getDateTime($value->confirmed_by_site_at) ?? '--' }}</bdi></span>
                            </div>
                            <div>
                                <span>پرداخت : <bdi class="arabic-num mr-1">{{ \App\Helpers\DateTimeHelper::getDateTime($value->paid_by_site_at) ?? '--' }}</bdi></span>
                            </div>
                        </td>
                        <td>
                            <div class="row m-2">
                                <div class="col-12">
                                    <form action="{{ route('withdrawIrt.checkWallet',$value->user->id)}}" data-action="{{ route('withdrawIrt.checkWalletWithdraw',$value->id)}}" method="POST" class="form-check-wallet">
                                        @csrf
                                        <button type="button" class="btn btn-secondary btn-sm  btn-block shadow form-check-wallet-btn">
                                            <i class='btn-text'>بررسی حساب</i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            @can('withdraws-irt-confirmation')
                            <div class="row m-2">
                                <div class="col-6">
                                    @if( $value->status === 1)
                                    <form action="{{ route('withdrawIrt.confirm', $value->id) }}" method="post">
                                        @csrf
                                        <button class="btn btn-dark btn-sm btn-block shadow " type="submit" onclick="return confirm('آیا از تایید درخواست برداشت اطمینان دارید');">تایید</button>
                                    </form>
                                    @endif
                                </div>
                                <div class="col-6">
                                    @if( $value->status === 1 || $value->status === 2 )
                                    <button class="btn btn-dark btn-sm btn-block shadow" data-toggle="modal" data-target="#unconfirm">عدم تایید / لغو</button>
                                    <div class="modal fade " id="unconfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                        <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card-body">
                                                        <form action="{{  route('withdrawIrt.unconfirm',$value->id) }}" method="post">
                                                            @csrf
                                                            <div class="form-group">
                                                                <div class="input-group ">
                                                                    <textarea autocomplete="off" class="form-control shadow-sm" name="unConfirmTextarea" rows="3" placeholder="لطفا علت عدم تایید خود را ذکر نمایید .."></textarea>
                                                                </div>
                                                                <button class="btn btn-info btn-sm btn-block shadow mt-3" type="submit" onclick="return confirm('آیا از لغو درخواست اطمینان دارید !');">ذخیره اطلاعات</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endcan
                            <div class="row m-2">
                                <div class="col-12  ">
                                    @if( $value->status === 2 && $value->internal === 0 )
                                    <button class="btn btn-secondary btn-sm btn-block rounded vertical-align shadow" data-toggle="modal" data-target="#payment-info">ثبت اطلاعات پرداخت</button>
                                    <div class="modal fade " id="payment-info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                        <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card-body">
                                                        <form action="{{  route('withdraw.paymentInfo',$value->id) }}" method="post">
                                                            @csrf
                                                            <div class="form-group">
                                                                <div class="form-group">
                                                                    <label class="d-block">کد رهگیری پرداخت :
                                                                        <input autocomplete="off" type="text" name="tracking_code" class="form-control  ltr" placeholder="">
                                                                    </label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="d-block">کارمزد پرداختی :
                                                                        <input autocomplete="off" type="text" name="fee" class="form-control mt-2 mb-5 ltr" placeholder="">
                                                                    </label>
                                                                </div>
                                                                <button class="btn btn-info btn-block shadow mt-3" type="submit" onclick="return confirm('آیا از انجام پرداخت اطمینان دارید !');">ذخیره اطلاعات</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @elseif( $value->status === 2 && $value->internal === 1 )
                                    <form action="{{  route('withdraw.internalTransfer',$value->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-secondary btn-sm btn-block rounded vertical-align shadow">انجام انتقال داخلی</button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                    @if ($value->description || $value->bankAccount )
                    <tr class="bg-light ">
                        <td colspan="10" class="p-1">
                            <div class="row">
                                <div class="col-7 d-flex align-items-center">
                                    <i class="fas fa-info-circle text-info vertical-align ml-2 "></i>
                                    <small>
                                        {{ $value->description ?? '--' }}
                                    </small>
                                </div>
                                @if ($value->bankAccount)
                                <div class="col-4 text-left ">
                                    <small class="d-block">
                                        <b class="text-left"> IR </b>
                                        {{ preg_replace('/(?<=\d)(?=(\d{4})+$)/', '  ', $value->bankAccount->iban_num  ?? '--' )  }}
                                    </small>
                                    <small>
                                        {{ preg_replace('/(?<=\d)(?=(\d{4})+$)/', '-', $value->bankAccount->card_num  ?? '--' )  }}
                                    </small>
                                </div>
                                <div class="col-1  d-flex align-items-center justify-content-center">
                                    <small class="">
                                        {{ $value->bankAccount->bank_name ?? '--'  }}
                                    </small>
                                </div>
                                @endif
                            </div>
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
                {{ $data['withdraws']->links()  }}
            </span>
        </div>
    </div>
</div>

@include('scripts.script-check-wallet')
@include('withdrawIrt.all-script-check-withdraw-irt')



@endcomponent