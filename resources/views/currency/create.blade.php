@component('layouts.include.content' , ['title' => 'ایجاد رمز ارز'])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="{{ url('/') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item active">ایجاد رمز ارز</li>
@endslot
@section('sidebar-currency','active')
@section('sidebar-currencies','active menu-open')

<div class="col-12">
    <div class="card">
        <form class="form-horizontal" action="{{ route('currency.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="col-lg-12">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-2">
                                <label>اولویت رمز ارز : </label>
                            </div>
                            <div class="col-10">
                                <input name="sort" autocomplete="off" type="number" class="form-control ltr @error('sort') is-invalid @enderror" value="{{ old('sort')}}">
                                @error('sort')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-2">
                                <label>نام اختصاری : </label>
                            </div>
                            <div class="col-10">
                                <input name="title" autocomplete="off" type="text" class="form-control ltr @error('title') is-invalid @enderror" value="{{ old('title')}}">
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-2">
                                <label>نام فارسی : </label>
                            </div>
                            <div class="col-10">
                                <input name="name_fa" autocomplete="off" type="text" class="form-control  @error('name_fa') is-invalid @enderror" value="{{ old('name_fa')}}">
                                @error('name_fa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-2">
                                <label>نام انگلیسی : </label>
                            </div>
                            <div class="col-10">
                                <input name="name_en" autocomplete="off" type="text" class="form-control ltr @error('name_en') is-invalid @enderror" value="{{ old('name_en')}}">
                                @error('name_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-2">
                                <label>تگ : </label>
                            </div>
                            <div class="col-10">
                                <input name="tag_name" autocomplete="off" type="text" class="form-control ltr @error('tag_name') is-invalid @enderror" value="{{ old('tag_name')}}">
                                @error('tag_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-2">
                                <label> تعداد تایید شبکه : </label>
                            </div>
                            <div class="col-10">
                                <input name="deposit_confirm_count" value="0" autocomplete="off" type="number" class="form-control ltr @error('deposit_confirm_count') is-invalid @enderror" value="{{ old('deposit_confirm_count')}}">
                                @error('deposit_confirm_count')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="row">
                            <div class="col-2">
                                <label>تعداد ارقام اعشار : </label>
                            </div>
                            <div class="col-10">
                                <input name="decimals" value="0" autocomplete="off" type="text" class="form-control ltr @error('decimals') is-invalid @enderror" value="{{ old('decimals')}}">
                                @error('decimals')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-2">
                                <label>حداقل برداشت : </label>
                            </div>
                            <div class="col-10">
                                <input name="withdraw_min" value="0" autocomplete="off" type="text" class="form-control ltr @error('withdraw_min') is-invalid @enderror" value="{{ old('withdraw_min')}}">
                                @error('withdraw_min')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-2">
                                <label>کارمزد برداشت : </label>
                            </div>
                            <div class="col-10">
                                <input name="withdraw_fee" value="0" autocomplete="off" type="text" class="form-control ltr @error('withdraw_fee') is-invalid @enderror" value="{{ old('withdraw_fee')}}">
                                @error('withdraw_fee')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-2">
                                <label>عکس رمز ارز : </label>
                            </div>
                            <div class="col-10">
                                <input name="" autocomplete="off" type="file" class="form-control ltr @error('withdraw_fee') is-invalid @enderror" value="{{ old('withdraw_fee')}}" disabled>
                                @error('withdraw_fee')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-2">
                                <label>شبکه : </label>
                            </div>
                            <div class="col-10">
                                <select class="form-control" name="has_networks">
                                    <option value="">انتخاب کنید</option>
                                    <option value="1" {{ $currency->has_networks ===1 ? 'selected' : '' }}>دارد</option>
                                    <option value="0" {{ $currency->has_networks ===0 ? 'selected' : '' }}>ندارد</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-2">
                                <label>وضعیت : </label>
                            </div>
                            <div class="col-10">
                                <select class="form-control" name="status">
                                    <option value="">انتخاب کنید</option>
                                    <option value="1" {{ $currency->status ===1 ? 'selected' : '' }}>فعال</option>
                                    <option value="0" {{ $currency->status ===0 ? 'selected' : '' }}>غیر فعال</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- /.card-body -->
            <div class="card-footer">
                <span class="float-right">
                    <button type="submit" class="btn btn-info "> ذخیره اطلاعات</button>
                </span>
                <span class="float-left">
                    <a href="{{ route('currency.index') }}" class="btn btn-secondary"> بازگشت به لیست</a>
                </span>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>

</div>




@endcomponent