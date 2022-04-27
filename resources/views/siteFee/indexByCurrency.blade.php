@component('layouts.include.content' , ["title" => "گزارش عملکرد {$data['currency']->title} "])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="/">پنل مدیریت</a></li>
<li class="breadcrumb-item "><a href="{{ route('siteFee.index')}}">گزارش عملکرد</a></li>
<li class="breadcrumb-item active"> گزارش عملکرد {{ $data['currency']->title }}</li>
@endslot
@section('sidebar-siteFee','active')
@section('sidebar-reports','active menu-open')


@can('site-fee-read')




<div class="card shadow mb-5">
    <div class="row justify-content-center">
        <div class="col ">
            <div class="table-responsive-lg">
                <table class="table table-hover table--vertical_middle  mb-0 ">
                    <tbody>
                        <tr>
                            <th class="text-center">ارز</th>
                            <th>واریز</th>
                            <th>برداشت</th>
                            <th>معاملات</th>
                            <th>کارمزد انتقال خارجی</th>
                            <th>مجموع کارمزد</th>
                            <th class="text-center">تاریخ</th>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <div>
                                    <img class=" mb-2 " style="right: 11px;" src="{{ asset('/admin/dist/img/currency_photo/'.strtolower($data['siteFeeTotal']->currency->title).'.png') }}">
                                </div>
                                <div>
                                    <small>{{ $data['siteFeeTotal']->currency->title }}</small>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <span>کل : </span>
                                    <bdi>{{ number_format( $data['siteFeeTotal']->deposit_total , $data['siteFeeTotal']->currency->decimals) }}</bdi>
                                </div>
                                <div>
                                    <span>کارمزد : </span>
                                    <bdi class="{{ (!empty($data['siteFeeTotal']->deposit_fee_total)) ? ($data['siteFeeTotal']->deposit_fee_total > 0 ? 'text-success' : 'text-danger') : '' }}">{{number_format( $data['siteFeeTotal']->deposit_fee_total, $data['siteFeeTotal']->currency->decimals)}} </bdi>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <span>کل : </span>
                                    <bdi>{{ number_format($data['siteFeeTotal']->withdraw_total , $data['siteFeeTotal']->currency->decimals)}}</bdi>
                                </div>
                                <div>
                                    <span>کارمزد : </span>
                                    <bdi class="{{ (!empty($data['siteFeeTotal']->withdraw_fee_total)) ? ($data['siteFeeTotal']->withdraw_fee_total > 0 ? 'text-success' : 'text-danger') : '' }}">{{ number_format($data['siteFeeTotal']->withdraw_fee_total, $data['siteFeeTotal']->currency->decimals)}}</bdi>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <span>کل : </span>
                                    <bdi>{{ number_format($data['siteFeeTotal']->trade_total,  $data['siteFeeTotal']->currency->decimals) }}</bdi>
                                </div>
                                <div>
                                    <span>کارمزد : </span>
                                    <bdi class="{{ (!empty($data['siteFeeTotal']->trade_fee_total)) ? ($data['siteFeeTotal']->trade_fee_total > 0 ? 'text-success' : 'text-danger') : '' }}">{{ number_format($data['siteFeeTotal']->trade_fee_total, $data['siteFeeTotal']->currency->decimals)}}</bdi>
                                </div>
                            </td>
                            <td>
                                <bdi class='{{ (!empty($data['siteFeeTotal']->site_transaction_fee_total))? "text-danger" : ""}}'>{{ number_format( $data['siteFeeTotal']->site_transaction_fee_total , $data['siteFeeTotal']->currency->decimals)}}</bdi>
                            </td>
                            <td>
                                <bdi class="{{ (!empty($data['siteFeeTotal']->sum_fee_total)) ? ($data['siteFeeTotal']->sum_fee_total > 0 ? 'text-success' : 'text-danger') : '' }}">{{ number_format($data['siteFeeTotal']->sum_fee_total , $data['siteFeeTotal']->currency->decimals)}}</bdi>
                            </td>
                            <td class="text-center">
                                <div class="arabic-num ">{{ \App\Helpers\DateTimeHelper::getDate($data['siteFeeTotal']->date)  }}</div>
                                <!-- <div class="arabic-num ">{{ \App\Helpers\DateTimeHelper::getTime($data['siteFeeTotal']->date)  }}</div> -->
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<h5 class=" mb-3">گزارش تفکیک روزانه</h5>
<div class="card shadow ">
    <div class="card-header p-3 mt-3">

        <form action="{{route('siteFee.indexByCurrency' , $data['currency']->id)}}" method='get'>

            <div class="form-row col-12">
                <div class="form-row col-9">


                    <div class="form-group col">
                        <input autocomplete="off" type="text" class="form-control start_at" id="Input1" value="{{ request()->query('start_at') }}" placeholder="از تاریخ">
                        <input autocomplete="off" type="hidden" id="start_at" name="start_at" value="{{ request()->query('start_at') }}">
                    </div>
                    <div class="form-group col">
                        <input autocomplete="off" type="text" class="form-control finish_at" id="Input2" value="{{ request()->query('finish_at') }}" placeholder="تا تاریخ">
                        <input autocomplete="off" type="hidden" id="finish_at" name="finish_at" value="{{ request()->query('finish_at') }}">
                    </div>
                </div>

                <div class="form-group col-1 "">
                                    <a class=" btn btn-danger btn-block mr-1" href="{{route('siteFee.indexByCurrency' , $data['currency']->id)}}">
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
    <div class="row justify-content-center">
        <div class="col ">
            <div class="table-responsive-lg">
                <table class="table table-hover table--vertical_middle  mb-0 ">
                    <tbody>
                        <tr>
                            <th class="text-center">ارز</th>
                            <th>واریز</th>
                            <th>برداشت</th>
                            <th>معاملات</th>
                            <th>کارمزد انتقال خارجی</th>
                            <th>مجموع کارمزد</th>
                            <th class="text-center">تاریخ</th>
                        </tr>

                        @foreach($data['siteFee'] as $value)
                        <tr>
                            <td class="text-center">
                                <div>
                                    <img class=" mb-2 " style="right: 11px;" src="{{ asset('/admin/dist/img/currency_photo/'.strtolower($value->currency->title).'.png') }}">
                                </div>
                                <div>
                                    <small>{{ $value->currency->title }}</small>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <span>کل : </span>
                                    <bdi>{{ number_format( $value->deposit , $value->currency->decimals) }}</bdi>
                                </div>
                                <div>
                                    <span>کارمزد : </span>
                                    <bdi class="{{ $value->deposit_fee > 0 ? 'text-success' : ($value->deposit_fee < 0 ? 'text-danger' : 0)  }}">{{number_format( $value->deposit_fee, $value->currency->decimals)}} </bdi>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <span>کل : </span>
                                    <bdi>{{ number_format($value->withdraw , $value->currency->decimals)}}</bdi>
                                </div>
                                <div>
                                    <span>کارمزد : </span>
                                    <bdi class="{{ $value->withdraw_fee > 0 ? 'text-success' : ($value->withdraw_fee < 0 ? 'text-danger' : 0) }}">{{ number_format($value->withdraw_fee, $value->currency->decimals)}}</bdi>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <span>کل : </span>
                                    <bdi>{{ number_format($value->trade,  $value->currency->decimals) }}</bdi>
                                </div>
                                <div>
                                    <span>کارمزد : </span>
                                    <bdi class="{{ $value->trade_fee > 0 ? 'text-success' : ($value->trade_fee < 0 ? 'text-danger' : 0) }}">{{ number_format($value->trade_fee, $value->currency->decimals)}}</bdi>
                                </div>
                            </td>
                            <td>
                                <bdi class='{{ (!empty($value->site_transaction_fee))? "text-danger" : ""}}'>{{ number_format( $value->site_transaction_fee , $value->currency->decimals)}}</bdi>
                            </td>
                            <td>
                                <bdi class="{{ $value->sum_fee > 0 ? 'text-success' : ($value->sum_fee < 0 ? 'text-danger' : 0) }}">{{ number_format($value->sum_fee , $value->currency->decimals)}}</bdi>
                            </td>
                            <td class="text-center">
                                <div class="arabic-num ">{{ \App\Helpers\DateTimeHelper::getDate($value->date)  }}</div>
                                <!-- <div class="arabic-num ">{{ \App\Helpers\DateTimeHelper::getTime($value->date)  }}</div> -->
                            </td>

                        </tr>

                        @endforeach

                    </tbody>
                    @if(!empty($data['sum']))
                    <tfoot style="background-color: rgb(211 239 255)" class="font-weight-bold">
                        <tr>
                            <td class="text-center p-5">مجموع</td>
                            <td>
                                <div>
                                    <span>کل : </span>
                                    <bdi>{{ number_format( $data['sum']['deposit'] , $data['currency']->decimals) }}</bdi>
                                </div>
                                <div>
                                    <span>کارمزد : </span>
                                    <bdi class="{{ (!empty($data['sum']['deposit_fee'])) ? ($data['sum']['deposit_fee '] > 0 ? 'text-success' : 'text-danger') : '' }}">{{number_format( $data['sum']['deposit_fee'], $data['currency']->decimals)}} </bdi>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <span>کل : </span>
                                    <bdi>{{ number_format($data['sum']['withdraw'] , $data['currency']->decimals)}}</bdi>
                                </div>
                                <div>
                                    <span>کارمزد : </span>
                                    <bdi class="{{ (!empty($data['sum']['withdraw_fee'])) ? ($data['sum']['withdraw_fee'] > 0 ? 'text-success' : 'text-danger') : '' }}">{{ number_format($data['sum']['withdraw_fee'], $data['currency']->decimals)}}</bdi>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <span>کل : </span>
                                    <bdi>{{ number_format($data['sum']['trade'],  $data['currency']->decimals) }}</bdi>
                                </div>
                                <div>
                                    <span>کارمزد : </span>
                                    <bdi class="{{ (!empty($data['sum']['trade_fee'])) ? ($data['sum']['trade_fee'] > 0 ? 'text-success' : 'text-danger') : '' }}">{{ number_format($data['sum']['trade_fee'], $data['currency']->decimals)}}</bdi>
                                </div>
                            </td>
                            <td>
                                <bdi class='{{ (!empty($data['sum']['site_transaction_fee']))? "text-danger" : ""}}'>{{ number_format( $data['sum']['site_transaction_fee'] , $data['currency']->decimals)}}</bdi>
                            </td>
                            <td>
                                <bdi class="{{ (!empty($data['sum']['sum_fee'])) ? ($data['sum']['sum_fee'] > 0 ? 'text-success' : 'text-danger') : '' }}">{{ number_format($data['sum']['sum_fee'] , $data['currency']->decimals)}}</bdi>
                            </td>
                            <td class="text-center">{{ $data['sum']['day_count'] }} روز</td>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>

    @if(method_exists($data['siteFee'], 'links'))
    <div class="card-footer">
        <span class="float-left">
            {{ $data['siteFee']->links()  }}
        </span>
    </div>
    @endif
</div>








@endcan


@endcomponent