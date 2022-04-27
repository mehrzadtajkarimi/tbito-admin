@component('layouts.include.content' , ['title' => "ثبت و بررسی آدرس ولت {$data['currency']->title} "])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="/">پنل مدیریت</a></li>
<li class="breadcrumb-item "><a href="{{route('walletAddress.index')}}">آدرسهای کیف پول</a></li>
<li class="breadcrumb-item active">آدرس های کیف پول</li>
@endslot
@section('sidebar-walletAddress','active')


<div class="card shadow ">
    <div class="card-body">
        <a href="#" class="mx-4">دانلود فایل نمونه</a>
        <div class="row justify-content-center">

            <div class="col">
                <div class="card-body">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <div class="input-group">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name='attach' class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">انتخاب فایل</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="float-left">
                        <!-- Button trigger modal -->
                        <form action="{{ route('walletAddress.hash', $data['currency']->id)}}" method="POST" class="form-check-wallet-hash">
                            @csrf
                            <button type="submit" class="btn btn-block btn-warning  form-check-wallet-btn-hash">
                                <span>اعتبار سنجی رمز</span>
                            </button>
                        </form>
                        @include('walletAddress.create-script-wallet-address-hash')
                    </div>
                    @can('wallet-address-create')
                    <div class="float-right ml-2">
                        <form action="{{route('walletAddress.insert',$data['currency']->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <button type="submit" class="btn btn-block btn-secondary btn-block mb-3">ثبت آدرس جدید</button>
                        </form>
                    </div>
                    @endcan
                    <div class="float-right">
                        <!-- Button trigger modal -->
                        <form action="{{ route('walletAddress.file',$data['currency']->id)}}" method="POST" class="form-check-wallet-file">
                            @csrf
                            <button type="submit" class="btn btn-block btn-secondary  form-check-wallet-btn-file">
                                <span>اعتبار سنجی فایل</span>
                            </button>
                        </form>
                        @include('walletAddress.create-script-wallet-address-file')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="card shadow ">
    <div class="card-header">
        <form action="{{route('walletAddress.create',$data['currency']->id)}}" method='get'>
            <div class="row ">
                <div class="form-row col">
                    <div class="form-group col">
                        <input autocomplete="off" type="text" class="form-control ltr" name="address" value="{{ request()->query('address') }}" placeholder="آدرس">
                    </div>
                </div>
                <div class="form-group col">
                    <select name="used" class="custom-select ">
                        <option value="">-- همه موارد -- </option>
                        <option value="1" {{  request()->query('used') == 1 ? 'selected' : ''}}>استفاده شده</option>
                        <option value="0" {{  request()->query('used') == 0 ? 'selected' : ''}}>آزاد</option>
                    </select>
                </div>
                <div class="form-group col">
                    <input autocomplete="off" type="text" class="form-control" name="user" value="{{ request()->query('user') }}" placeholder="کاربر : شناسه , نام , موبایل , ایمیل , کد ملی">
                </div>
            </div>
            <div class="row ">
                <div class="form-row col-12">
                    <div class="offset-9"></div>
                    <div class="form-group col-1 "">
                                    <a class=" btn btn-danger btn-block mr-1" href="{{route('walletAddress.create', $data['currency']->id)}}">
                        <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <div class="form-group col-2 vertical-align">
                        <button type="submit" name='search' value='1' class="btn btn-success btn-block mr-2 vertical-align d-flex justify-content-between align-items-center">
                            <span> جستجو موارد</span> <i class="fas fa-search vertical-align"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col">
                <div class="table-responsive-lg">
                    <table class="table table-hover table-bordered mb-0">
                        <thead>
                            <div class="text-left m-2">
                                <span>{{$data['walletAddress']->firstItem()}} تا</span>
                                <span>{{$data['walletAddress']->lastItem()}} </span>
                                / <span>{{$data['walletAddress']->total()}} مورد</span>
                            </div>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <th>#</th>
                                <th>شناسه</th>
                                <th>آدرس</th>
                                <th>وضعیت</th>
                                <th>کاربر</th>
                            </tr>
                            @forelse($data['walletAddress'] as $value)
                            <tr class="vertical-align text-center">
                                <td class="text-center" width="10px">{{$loop->index + $data['walletAddress']->firstItem() }}</td>
                                <td class="text-center">
                                    <span>{{ App\Helpers\TableCodeHelper::id2Code($value->id) }}<sub class="text-muted">/{{ $value->id }}</sub></span>
                                </td>
                                <td class="text-left">
                                    <span>{{$value->address}}</span>
                                </td>
                                <td>
                                    {!! ($value->used) ? "<span class='text-danger'>استفاده شده</span>" : "<span class='text-success'>آزاد</span>" !!}
                                </td>
                                <td width="25%">
                                    @if($value->user)
                                    <div>
                                        <a href="{{ route('user.show', $value->user->id)}}">
                                            <span>{{ $value->user->fullname }}</span>
                                        </a>
                                    </div>
                                    @else
                                    --
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr class="alert alert-secondary text-center" role="alert">
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
    <div class="card-footer">
        <span class="float-left">
            {{ $data['walletAddress']->links()  }}
        </span>
    </div>
</div>


@endcomponent