@component('layouts.include.content' , ['title' => "ویرایش کارمزد معاملات {$data['commission']->title} "])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="{{ url('/') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item active">ویرایش مرز ارز</li>
@endslot
@section('sidebar-commission','active')
@section('sidebar-currencies','active menu-open')

<div class="col-12">
    <div class="card">
        <form class="form-horizontal" action="{{ route('commission.update',$data['commission']->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="col">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-2">
                                <label> حجم معاملات ماهیانه از : </label>
                            </div>
                            <div class="col-10">
                                <input name="min_monthly_total_trades_irt" class="form-control ltr" value="{{ number_format($data['commission']->min_monthly_total_trades_irt) }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-2">
                                <label> حجم معاملات ماهیانه تا : </label>

                                <div class="form-group form-check d-inline-block ">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="infinity" value="1" {{ is_null($data['commission']->max_monthly_total_trades_irt) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="exampleCheck1 ">∞</label>
                                </div>
                            </div>
                            <div class="col-10">
                                <input name="max_monthly_total_trades_irt" class="form-control ltr number_format" value="{{ !is_null($data['commission']->max_monthly_total_trades_irt) ? number_format($data['commission']->max_monthly_total_trades_irt) : '∞'  }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-2">
                                <label> درصد کارمزد : </label>
                            </div>
                            <div class="col-10">
                                <input name="percent" class="form-control ltr" value="{{ number_format($data['commission']->percent,2)  }}">
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
                        <a href="{{ route('commission.index') }}" class="btn btn-secondary"> بازگشت به لیست</a>
                    </span>
                </div>
                <!-- /.card-footer -->
        </form>
    </div>

</div>




@endcomponent