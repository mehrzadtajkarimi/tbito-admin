@component('layouts.include.content' , ['title' => 'گزارش عملکرد'])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="/">پنل مدیریت</a></li>
<li class="breadcrumb-item active">گزارش عملکرد</li>
@endslot
@section('sidebar-siteFee','active')
@section('sidebar-reports','active menu-open')


@can('site-fee-read')
<div class="card shadow ">
    <div class="row justify-content-center">
        <div class="col ">
            <form action="{{ route('siteFee.refresh') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-warning ml-2 float-left m-3">
                    بروزرسانی گزارش
                </button>
            </form>
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
                            <th class="text-center">گزارش تفکیکی روزانه</th>
                        </tr>

                        @forelse($data['siteFee'] as $value)
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
                                    <bdi>{{ number_format( $value->deposit_total , $value->currency->decimals) }}</bdi>
                                </div>
                                <div>
                                    <span>کارمزد : </span>
                                    <bdi class="{{ $value->deposit_fee_total > 0 ? 'text-success' : ($value->deposit_fee_total < 0 ? 'text-danger' : 0)  }}">{{number_format( $value->deposit_fee_total, $value->currency->decimals)}} </bdi>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <span>کل : </span>
                                    <bdi>{{ number_format($value->withdraw_total , $value->currency->decimals)}}</bdi>
                                </div>
                                <div>
                                    <span>کارمزد : </span>
                                    <bdi class="{{ $value->withdraw_fee_total > 0 ? 'text-success' : ($value->withdraw_fee_total < 0 ? 'text-danger' : 0) }}">{{ number_format($value->withdraw_fee_total, $value->currency->decimals)}}</bdi>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <span>کل : </span>
                                    <bdi>{{ number_format($value->trade_total,  $value->currency->decimals) }}</bdi>
                                </div>
                                <div>
                                    <span>کارمزد : </span>
                                    <bdi class="{{ $value->trade_fee_total > 0 ? 'text-success' : ($value->trade_fee_total < 0 ? 'text-danger' : 0) }}">{{ number_format($value->trade_fee_total, $value->currency->decimals)}}</bdi>
                                </div>
                            </td>
                            <td>
                                <bdi class='{{ (!empty($value->site_transaction_fee_total))? "text-danger" : ""}}'>{{ number_format( $value->site_transaction_fee_total , $value->currency->decimals)}}</bdi>
                            </td>
                            <td>
                                <bdi class="{{ $value->sum_fee_total > 0 ? 'text-success' : ($value->sum_fee_total < 0 ? 'text-danger' : 0) }}">{{ number_format($value->sum_fee_total , $value->currency->decimals)}}</bdi>
                            </td>
                            <td class="text-center">
                                <div class="arabic-num ">{{ \App\Helpers\DateTimeHelper::getDate($value->date)  }}</div>
                                <!-- <div class="arabic-num ">{{ \App\Helpers\DateTimeHelper::getTime($value->date)  }}</div> -->
                            </td>
                            <td class="text-center">
                                <a href="{{ route('siteFee.indexByCurrency',$value->currency->id)}}">مشاهده</a>
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
        </div>
    </div>
</div>
@endcan


@endcomponent