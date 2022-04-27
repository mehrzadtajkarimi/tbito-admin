@component('layouts.include.content' , ['title' => 'مدیریت مارکت ها'])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="#">پنل مدیریت</a></li>
<li class="breadcrumb-item active">مدیریت رمز مارکت ها </li>
@endslot
@section('sidebar-market','active')
@section('sidebar-currencies','active menu-open')


<div class="col-12">
    <div class="card shadow">
        <div class="card-body table-responsive p-0 ">
            <table class="table table-hover text-center">
                <tbody>
                    <tr>
                        <th>عنوان</th>
                        <th>حداقل سفارش</th>
                        <th>مقدار سفارش ربات</th>
                        <th>وضعیت</th>
                        @can('market-update')
                        <th>عملیات</th>
                        @endcan
                    </tr>

                    @forelse( $data['markets'] as $value)
                    <tr class="vertical-align">
                        <td>
                            <div class="text-center market_info">
                                <span class="market_image">
                                    <img class="ml-2 position-relative " style="right: 11px;" src="{{ asset('/admin/dist/img/currency_photo/'.strtolower($value->currency2->title).'.png') }}">
                                    <img class=" position-relative " style="left: 11px;" src="{{ asset('/admin/dist/img/currency_photo/'.strtolower($value->currency1->title).'.png') }}">
                                </span>
                                <div class="mt-2">{{$value->title }}</div>
                            </div>
                        </td>
                        <td>
                            {{ number_format($value->min_order,$value->currency1->decimals)  }}
                            <small class="text-muted">{{ $value->currency2->title }}</small>
                        </td>
                        <td>
                            {{ number_format($value->robot_order_amount,$value->currency1->decimals)  }}
                            <small class="text-muted">{{ $value->currency1->title }}</small>
                        </td>
                        <td>
                            @if($value->status)
                            <i class="fas fa-check text-success"></i>
                            @else
                            <i class="fas fa-times text-danger"></i>
                            @endif
                        </td>


                        @can('market-update')
                        <td>
                            <div class="d-flex justify-content-center align-items-center">
                                <a name="" id="" class="btn btn-primary btn-sm " href="{{ route('market.edit',$value->id,'edit') }}" value="button">
                                    <i class="fas fa-pen-alt"></i>
                                </a>
                            </div>
                        </td>
                        @endcan
                    </tr>
                    @empty
                    <tr class="alert alert-secondary" value="alert">
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



@endcomponent