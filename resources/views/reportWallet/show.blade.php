@component('layouts.include.content' , ['title' => "مشاهده موجودی {$data['currency']->title} کاربران"])

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
                        <thead>
                            <div class="float-right m-2">
                                <img class="mb-2 mx-auto ml-2" src="{{ asset('/admin/dist/img/currency_photo/'.strtolower($data['currency']->title).'.png') }}">
                                {{ $data['currency']->name_fa }}
                            </div>
                            <div class="float-left m-2">
                                <span>{{$data['results']->firstItem()}} تا</span>
                                <span>{{$data['results']->lastItem()}} </span>
                                / <span>{{$data['results']->total()}} مورد</span>
                            </div>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <th>#</th>
                                <th>اطلاعات کاربر</th>
                                <th>موجودی</th>
                            </tr>

                            @forelse($data['results'] as $result)
                            <tr class="vertical-align">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <div>
                                        <a href="{{ route('user.show', $result->user->id)}}">
                                            <span>{{ $result->user->firstname }}</span>
                                            <span>{{ $result->user->lastname }}</span>
                                        </a>
                                    </div>
                                    <div>
                                        <small>{{ $result->user->mobile }}</small>
                                    </div>
                                    <div>
                                        <small>{{ $result->user->email }}</small>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="mb-1"><bdi>{{ number_format($result->amount, $result->currency->decimals) }} <small class="text-muted">{{ $data['currency']->title }}</small></bdi></div>
                                    <a href='{{ route("user.indexByUserCurrency", [$result->user->id,$data['currency']->id]) }}' class="badge badge-primary">گردش حساب</a>
                                </td>
                            </tr>
                            @empty
                            <tr class="alert alert-secondary" role="alert">
                                <td colspan="10" class="text-center">
                                    آیتمی برای نمایش وجود ندارد
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <span class="float-left">
                                {{ $data['results']->links()  }}
                            </span>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endcan


@endcomponent