@component('layouts.include.content' , ['title' => "ایجاد اسلاید شو "])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="{{ url('/') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item active">ایجاد اسلاید شو </li>
@endslot


@section('sidebar-slideshow','active')
@section('sidebar-contents','active menu-open')

<div class="col-12">
    <div class="card card-info card-outline  shadow">
        <div class="card-body">
            <form action="{{route('slideshow.store')}}" method="post">
                @csrf

                <div class="form-group">
                    <div class="row">
                        <div class="col-2">
                            <label>اولویت : </label>
                        </div>
                        <div class="col-10">
                            <input name="withdraw_fee" autocomplete="off" type="text" class="form-control ltr @error('') is-invalid @enderror" value="{{ old('')}}">
                            @error('')
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
                            <label>عنوان : </label>
                        </div>
                        <div class="col-10">
                            <input name="withdraw_fee" autocomplete="off" type="text" class="form-control ltr @error('') is-invalid @enderror" value="{{ old('')}}">
                            @error('')
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
                            <label>تصویر : </label>
                        </div>
                        <div class="col-10">
                            <input name="" autocomplete="off" type="file" class="form-control ltr @error('') is-invalid @enderror" value="{{ old('')}}">
                            @error('')
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
                            <label>لینک : </label>
                        </div>
                        <div class="col-10">
                            <input name="withdraw_fee" autocomplete="off" type="text" class="form-control ltr @error('') is-invalid @enderror" value="{{ old('')}}">
                            @error('')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
        </div>
        <button type="submit" class="btn btn-info btn-sm btn-lg btn-block mb-3">ذخیره اطلاعات</button>
        </form>
    </div>
</div>
</div>








@endcomponent