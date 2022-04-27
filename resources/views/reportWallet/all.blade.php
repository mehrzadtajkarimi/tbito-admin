@component('layouts.include.content' , ['title' => 'گزارش صندوق'])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="/">پنل مدیریت</a></li>
<li class="breadcrumb-item active">گزارش صندوق</li>
@endslot
@section('sidebar-reportWallet','active')
@section('sidebar-reports','active menu-open')


@can('user-wallet-read')
<div class="card shadow ">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-6 ">
                <div class="table-responsive-lg">
                    <table class="table table-hover table-bordered mb-0">
                        <tbody>
                            <tr class="text-center">
                                <th>ارز</th>
                                <th>موجودی کاربران</th>
                                <th>کیفهای خارجی</th>
                                <th>کیفهای داخلی <sub class="text-muted"><small>(محاسباتی)</small></sub></th>
                            </tr>
                            @foreach($data['result'] as $value)
                            <tr class="vertical-align text-center">
                                <td>
                                    <img class="mb-2 mx-auto d-block" src="{{ asset('/admin/dist/img/currency_photo/'.strtolower($value['title']).'.png') }}">
                                    {{ $value['title'] }}
                                </td>
                                <td>
                                    <div>{{ number_format($value['user_balances'], $value['decimals']) }}</div>
                                    <a href="{{ route('userBalances.show',$value['id']) }}" class="badge badge-primary">مشاهده</a>
                                </td>
                                <td>
                                    <div>
                                        {{ number_format($value['external_wallets'], $value['decimals']) }}
                                    </div>
                                    <a href='{{route("siteTransaction.index", [$value['id']])}}' class="badge badge-primary">مشاهده</a>
                                </td>
                                <td>
                                    <div>
                                        {{ number_format($value['internal_wallets'], $value['decimals']) }}
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endcan


@endcomponent