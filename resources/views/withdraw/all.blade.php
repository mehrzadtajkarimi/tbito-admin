@component('layouts.include.content' , ['title' => 'برداشتهای رمز ارزی'])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="{{ url('/') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item active">برداشتهای رمز ارزی</li>
@endslot
@section('sidebar-withdraw','active')

<div class="col-12" id="ajax_form_confirm">
    <div class="card">
        <div class="card-header">
            <form action="{{route('withdraw.index')}}" method='get'>
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
                                <option value="1" {{  request()->query('status') == 1 ? 'selected' : ''}}>در انتظار بررسی</option>
                                <option value="2" {{  request()->query('status') == 2 ? 'selected' : ''}}>تایید شده</option>
                                <option value="3" {{  request()->query('status') == 2 ? 'selected' : ''}}>در حال واریز</option>
                                <option value="4" {{  request()->query('status') == 2 ? 'selected' : ''}}>انجام شده</option>
                                <option value="5" {{  request()->query('status') == 2 ? 'selected' : ''}}>لغو شده</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <select name="creationType" class="custom-select ">
                                <option value="">نحوه ایجاد سند </option>
                                <option value="1" {{  request()->query('status') == 1 ? 'selected' : ''}}>دستی </option>
                                <option value="2" {{  request()->query('status') == 2 ? 'selected' : ''}}>سیستمی</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="form-row col-12">
                        <div class="form-group col">
                            <select name="currency_id" class="custom-select ">
                                <option value="">رمز ارز </option>
                                @foreach($data['currencies'] as $value)
                                <option value="{{ $value->id }}" {{  request()->query('currency') ==  $value->id ? 'selected' : ''}}>{{ $value->title}}</option>
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
                </div>
                <div class="form-row col-12">
                    <div class="offset-9"></div>
                    <div class="form-group col-1 "">
                                    <a class=" btn btn-danger btn-block mr-1" href="{{route('withdraw.index')}}">
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
                            <div class="row d-flex align-items-center ">
                                <div class="col-3 ">
                                    <img class="mb-1 mx-auto d-block" src="{{ asset('/admin/dist/img/currency_photo/'.strtolower($value->currency->title).'.png') }}" alt="بیت‌کوین">
                                    <p class="m-0 text-center">
                                        {{ $value->currency->title}}
                                    </p>
                                </div>
                                <div class="col-9">

                                    <div>مبــــلغ : <bdi class=" ">{{number_format($value->amount, $value->currency->decimals) ?? '--' }}</bdi></div>
                                    <small class="d-block">کـــارمزد کاربــــــر : <bdi class=" ">{{number_format($value->fee, $value->currency->decimals) ?? '--' }}</bdi></small>
                                    @if($value->status == 4)
                                    <small class="d-block">کارمزد پرداختی : <bdi class=" ">{{number_format($value->fee_real, $value->currency->decimals) ?? '--' }}</bdi></small>
                                    <small class="d-block">کـــارمزد ســـایت : <bdi class="{{ (!empty($value->fee_site)) ? (($value->fee_site > 0) ? 'text-success' :  'text-danger') : '' }}">{{number_format($value->fee_site, $value->currency->decimals) ?? '--' }}</bdi></small>
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
                                    <form action="{{ route('withdraw.checkWallet',$value->user->id)}}" data-action="{{ route('withdraw.checkWalletWithdraw',$value->id)}}" method="POST" class="form-check-wallet">
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
                                    <form action="{{ route('withdraw.confirm', $value->id) }}" method="post">
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
                                                        <form action="{{  route('withdraw.unconfirm',$value->id) }}" method="post">
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
                                                                    <label class="d-block">fee :
                                                                        <input autocomplete="off" type="number" name="fee" class="form-control ltr" placeholder="">
                                                                    </label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="d-block">txid :
                                                                        <input autocomplete="off" type="number" name="txid" class="form-control  ltr" placeholder="">
                                                                    </label>
                                                                </div>
                                                                <div class="form-group form-check mt-3">
                                                                    <label class="form-check-label">
                                                                        <input type="checkbox" name="external_wallet" class="form-check-input">
                                                                        <p>برداشت از کیفهای خارجی</p>
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
                    @if ($value->description )
                    <tr class="bg-light ">
                        <td colspan="10" class="p-1">
                            <div class="row">
                                <div class="col-7 d-flex align-items-center">
                                    <i class="fas fa-info-circle text-info vertical-align ml-2 "></i>
                                    <small>
                                        {{ $value->description ?? '--' }}
                                    </small>
                                </div>
                                <div class="col-5 text-left ">
                                    <small class="d-block">
                                        {{ $value->address  ?? '--'   }}
                                        <b>: Address </b>
                                    </small>
                                    <small class="d-block">
                                        {{ $value->tag  ?? '--'   }}
                                        <b>: Tag </b>
                                    </small>
                                    <small class="d-block">
                                        {{ $value->txid  ?? '--'   }}
                                        <b>: Txid </b>
                                    </small>

                                </div>
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
@include('withdraw.all-script-check-withdraw')






@endcomponent