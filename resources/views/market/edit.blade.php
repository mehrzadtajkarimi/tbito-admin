@component('layouts.include.content' , ['title' => "ویرایش مارکت {$data['markets']->title} "])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="{{ url('/') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item active">ویرایش مرز ارز</li>
@endslot
@section('sidebar-market','active')
@section('sidebar-currencies','active menu-open')

<div class="col-12">
    <div class="card">
        <form class="form-horizontal" action="{{ route('market.update',$data['markets']->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="col">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-2">
                                <label>حداقل سفارش : <small class="text-muted">{{ $data['markets']->currency2->title }}</small></label>
                            </div>
                            <div class="col-10">
                                <input name="min_order" class="form-control ltr" value="{{ number_format($data['markets']->min_order,$data['markets']->currency1->decimals) }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-2">
                                <label>مقدار سفارش ربات: <small class="text-muted">{{ $data['markets']->currency1->title }}</small></label>
                            </div>
                            <div class="col-10">
                                <input name="robot_order_amount" class="form-control ltr" value="{{ number_format($data['markets']->robot_order_amount,$data['markets']->currency1->decimals)  }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-2">
                                <label>وضعیت : </label>
                            </div>
                            <div class="col-10">
                                <select id="my-select" class="form-control" name="status">
                                    <option value="1" {{ $data['markets']->status ===1 ? 'selected' : '' }}>فعال</option>
                                    <option value="0" {{ $data['markets']->status ===0 ? 'selected' : '' }}>غیر فعال</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.card-body -->
                <div class="mt-5">
                    <span class="float-right">
                        <button type="submit" class="btn btn-info "> ذخیره اطلاعات</button>
                    </span>
                    <span class="float-left">
                        <a href="{{ route('market.index') }}" class="btn btn-secondary"> بازگشت به لیست</a>
                    </span>
                </div>
                <!-- /.card-footer -->
        </form>
    </div>

</div>




@endcomponent