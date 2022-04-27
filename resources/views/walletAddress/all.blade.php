@component('layouts.include.content' , ['title' => 'آدرس های کیف پول'])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="/">پنل مدیریت</a></li>
<li class="breadcrumb-item active">آدرس های کیف پول</li>
@endslot
@section('sidebar-walletAddress','active')


<div class="card shadow ">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-6 ">
                <div class="table-responsive-lg">
                    <table class="table table-hover table-bordered mb-0">
                        <tbody>
                            <tr class="text-center">
                                <th>ارز</th>
                                <th>تعداد کل</th>
                                <th>تعداد آزاد</th>
                                <th>عملیات</th>
                            </tr>
                            @foreach($data['currency'] as $value)
                            <tr class="vertical-align text-center">
                                <td>
                                    <img class="mb-2 mx-auto d-block" src="{{ asset('/admin/dist/img/currency_photo/'.strtolower($value['title']).'.png') }}">
                                    {{ $value['title'] }}
                                </td>
                                <td>
                                    {{ $data['count'][$value->id]['all'] }}
                                </td>
                                <td>
                                    {{ $data['count'][$value->id]['free'] }}
                                </td>
                                <td width="25%">
                                    <div class="pb-3">
                                        <!-- Button trigger modal -->
                                        <form action="{{ route('walletAddress.check', $value->id)}}" method="POST" class="form-check-wallet">
                                            @csrf
                                            <button type="submit" class="btn btn-block btn-warning form-check-wallet-btn">
                                                <span>بررســــی رمز</span>
                                            </button>
                                        </form>

                                    </div>


                                    <div class="">
                                        <a href="{{ route('walletAddress.create', $value->id)}}" type="button" class="btn btn-block btn-info ">
                                            <span>مشــاهده و ثبت</span>
                                        </a>
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

@include('walletAddress.all-script-wallet-address')


@endcomponent