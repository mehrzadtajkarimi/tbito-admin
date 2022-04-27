@component('layouts.include.content' , ['title' => 'سایر اطلاعات'])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="#">پنل مدیریت</a></li>
<li class="breadcrumb-item active">سایر اطلاعات </li>
@endslot
@section('sidebar-siteContent','active')
@section('sidebar-contents','active menu-open')

<div class="col-12">
    <div class="card card-info card-outline  shadow">
        <div class="card-body">

        
            <form action="{{route('slideshow.update' , 1)}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <div class="row">
                        <div class="col-2">
                            <label>عنوان : </label>
                        </div>
                        <div class="col-8">
                            <input name="withdraw_fee" autocomplete="off" type="text" class="form-control ltr @error('') is-invalid @enderror" value="{{ old('')}}">
                            @error('')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-info  btn-block mb-3">ذخیره اطلاعات</button>
                        </div>
                    </div>
                </div>
            </form>


            <form action="{{route('slideshow.update' , 2)}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <div class="row">
                        <div class="col-2">
                            <label>عنوان : </label>
                        </div>
                        <div class="col-8">
                            <input name="withdraw_fee" autocomplete="off" type="text" class="form-control ltr @error('') is-invalid @enderror" value="{{ old('')}}">
                            @error('')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-info  btn-block mb-3">ذخیره اطلاعات</button>
                        </div>
                    </div>
                </div>
            </form>


            <form action="{{route('slideshow.update' , 3)}}" method="post">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <div class="row">
                        <div class="col-2">
                            <label>عنوان : </label>
                        </div>
                        <div class="col-8">
                            <input name="withdraw_fee" autocomplete="off" type="text" class="form-control ltr @error('') is-invalid @enderror" value="{{ old('')}}">
                            @error('')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-info  btn-block mb-3">ذخیره اطلاعات</button>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>



@endcomponent