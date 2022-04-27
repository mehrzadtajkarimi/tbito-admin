@component('layouts.include.content' , ['title' => 'واریز رمز ارزی'])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="{{ url('/') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item active">واریز رمز ارزی</li>
@endslot
@section('sidebar-deposits','active')

<div class="col-12" id="ajax_form_confirm">
    <div class="card">
        <div class="card-header">
            <form action="{{route('deposits.index')}}" method='get'>
                <div class="row mt-3">
                    <div class="form-row col-12">
                        <div class="form-group col-2">
                            <input autocomplete="off" type="text" class="form-control ltr" name="code" value="{{ request()->query('code') }}" placeholder="code">
                        </div>
                        <div class="form-group col-1">
                            <input autocomplete="off" type="text" class="form-control ltr" name="id" value="{{ request()->query('id') }}" placeholder="id">
                        </div>
                        <div class="form-group col">
                            <select name="status" class="custom-select ">
                                <option value="">وضعیت </option>
                                <option value="0" {{  request()->query('status') === 0 ? 'selected' : ''}}>ناموفق</option>
                                <option value="1" {{  request()->query('status') == 1 ? 'selected' : ''}}>موفق</option>
                                <option value="2" {{  request()->query('status') == 2 ? 'selected' : ''}}>در انتظار تایید</option>
                                <option value="3" {{  request()->query('status') == 3 ? 'selected' : ''}}>تایید شبکه</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <input autocomplete="off" type="text" class="form-control" name="user" value="{{ request()->query('user') }}" placeholder="کاربر : شناسه , نام , موبایل , ایمیل , کد ملی">
                        </div>
                        <div class="form-group col">
                            <input autocomplete="off" type="text" class="form-control ltr" name="txid" value="{{ request()->query('txid') }}" placeholder="txid">
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
                            <select name="currency_id" class="custom-select">
                                <option value=""> رمز ارز</option>
                                @foreach($data['currencies'] as $currency)
                                <option value="{{  $currency->id }}" {{  request()->query('currency_id') == $currency->id  ? 'selected' : ''}}>{{ $currency->title  }}</option>
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
                                    <a class=" btn btn-danger btn-block mr-1" href="{{route('deposits.index')}}">
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
                        <th>مقدار - رمز ارز</th>
                        <th>اطلاعات پرداخت</th>
                        <th>تاریخ</th>
                        <th class="text-center">عملیات</th>
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
                            <div class="row">
                                <div class="col-3 mt-2">
                                    <img class="ml-2" src="{{ asset('/admin/dist/img/currency_photo/'.strtolower( $value->currency->title).'.png') }}" alt="بیت‌کوین">
                                </div>
                                <span class="col-9">
                                    <div>{{ $value->currency->title }}</div>
                                    <div>{{ number_format($value->amount,$value->currency->decimals) }}</div>
                                    <div>{{ $value->name_fa }}</div>
                                </span>
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
                            <p class="mb-2">سیستمی </p>
                            @elseif( $value->creation_type == 2)
                            <p class="mb-2"> دستی </p>
                            @endif
                            @if(!empty($value->txid))
                            <div>
                                <small><a href="{{$value->txid_link}}" target="_blank">لینک تراکنش</a></small>
                            </div>
                            @endif
                        </td>
                        <td>
                            <div>
                                <span>ایجاد : <bdi class="arabic-num ">{{ \App\Helpers\DateTimeHelper::getDateTime($value->created_at->timestamp) ?? '--' }}</bdi></span>
                            </div>
                            <div>
                                <span>تـایید شبکه: <bdi class="arabic-num ">{{ $value->confirmed_by_network_at ? \App\Helpers\DateTimeHelper::getDateTime($value->confirmed_by_network_at) : '--' }}</bdi></span>
                            </div>
                            @if($value->confirm_type == 2)
                            <div>
                                <span>تـایید سایت: <bdi class="arabic-num ">{{ $value->confirmed_by_site_at ? \App\Helpers\DateTimeHelper::getDateTime($value->confirmed_by_site_at) : '--' }}</bdi></span>
                            </div>
                            @endif
                        </td>
                        @if($value->status == 3 || $value->status == 2)
                        <td>
                            <div class="d-flex justify-content-center align-items-center">
                                <form action="{{ route('deposits.confirm') }}" method="post" id="form_confirm">
                                    @csrf
                                    <input type="hidden" name="hidden_id_confirm" value="{{ $value->id }}">
                                    <button type="submit" class="btn btn-dark btn-sm  m-1" onclick="return confirm('آیا آیتم مورد را تایید می کنید');">
                                        تایید
                                    </button>
                                </form>
                                <script>
                                    $(document).ready(function() {
                                        $('#form_confirm').submit(function(event) {
                                            event.preventDefault();
                                            var form = $('#form_confirm');
                                            var resultsTag = $('#ajax_form_confirm');
                                            resultsTag.html("<img  class='rounded m-5 d-block m-auto ' src='{{ asset('/admin/dist/img/loading-black.svg') }}' >");
                                            $.ajax({
                                                url: form.attr('action'),
                                                method: form.attr('method'),
                                                data: form.serialize(),
                                                success: function(response) {
                                                    resultsTag.html(response);
                                                },
                                            });
                                        });
                                    });
                                </script>
                                <button type="button" class="btn btn-dark btn-sm m-1" data-toggle="modal" data-target="#modal_unconfirm">
                                    عدم تایید
                                </button>
                                <div class="modal fade" id="modal_unconfirm" tabindex="-1" role="dialog" aria-labelledby="modal_unconfirm" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <span class="text-center d-block" id="ajax_form_unconfirm">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('deposits.unconfirm')}}" method="post" id="form_unconfirm">
                                                    @csrf
                                                    <input type="hidden" name="hidden_id_unconfirm" value="{{ $value->id }}">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <textarea class="form-control" name="unConfirmTextarea" rows="3" placeholder="لطفا علت عدم تایید خود را ذکر نمایید .."></textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-info btn-sm m-1 btn-block" onclick="return confirm('آیا از عدم تایید ایتم اطمینان دارید');">ذخیره اطلاعات</button>
                                                    </div>
                                                </form>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        @else
                        <td>
                            <div class="d-flex justify-content-center align-items-center">
                                --
                            </div>
                        </td>
                        @endif
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

<script>
    $(document).ready(function() {
        $('#form_unconfirm').submit(function(event) {
            event.preventDefault();
            var form = $('#form_unconfirm');
            var resultsTag = $('#ajax_form_unconfirm');
            resultsTag.html("<img  class='rounded m-5' src='{{ asset('/admin/dist/img/loading-black.svg') }}' >");
            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: form.serialize(),
                success: function(response) {
                    resultsTag.html(response);
                },
            });
        });
    });
</script>

@endcomponent