@component('layouts.include.content' , ['title' => 'تراکنش کیفهای خارجی'])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="/">پنل مدیریت</a></li>
<li class="breadcrumb-item active">تراکنش کیفهای خارجی</li>
@endslot
@section('sidebar-siteTransaction','active')
@section('sidebar-reports','active menu-open')


@can('user-wallet-read')
<div class="card shadow ">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-6 p-2">

                <form action="{{route('siteTransaction.store')}}" class="form-create" style="display: block;" method="POST">
                    @csrf


                    <div class="row mb-4">

                        <div class="col">
                            <div class="form-check text-success p-0">
                                <button type="button" class="btn btn-outline-success btn-block  p-0 active shadow" data-type-btn>
                                    <label class="d-block mb-0 p-2 cursor_pointer">
                                        <span>واریز</span> <input type="radio" name='type' value="deposit" checked class='invisible'>
                                    </label>
                                </button>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check text-danger p-0 ">
                                <button type="button" class="btn btn-outline-danger btn-block  p-0 shadow" data-type-btn>
                                    <label class="d-block mb-0 p-2 cursor_pointer">
                                        <span>برداشت</span> <input type="radio" name='type' value="withdraw" class="invisible">
                                    </label>
                                </button>
                            </div>
                        </div>

                    </div>



                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <select class="form-control " name="currency_id">
                                    <option value="">انتخاب کنید</option>
                                    @foreach( $data['currencies'] as $value)
                                    <option value="{{ $value->id }}" {{ request()->query('currency') == $value->id ? "selected" : "" }}>{{ $value->name_fa }} {{ $value->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="d-block mb-4 radios-required">
                                    مبـــلغ
                                    <input autocomplete="off" class="form-control number_format " name="amount" placeholder="">
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="d-block mb-4 radios-required">
                                    کـــارمزد
                                    <input autocomplete="off" class="form-control number_format " name="fee" placeholder="">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="d-block mb-4 radios-required">
                                    توضیحات
                                    <textarea class="form-control " name="description" rows="3" placeholder=""></textarea>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-block btn-info shadow" onclick="return confirm('آیا از ادامه عملیات اطمینان دارید');"> ثبت تراکنش</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endcan
<script>
    $(document).ready(function() {
        $("button[type='button'][data-type-btn]").click(function() {
            $("button[type='button'][data-type-btn]").removeClass('active');
            $(this).addClass('active');
        });
    });
</script>

@endcomponent