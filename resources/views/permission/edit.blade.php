@component('layouts.include.content' , ['title' => "ویرایش دسترسی : $permission->label"])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="{{ url('/') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item "><a href="{{ route('permission.index') }}">لیست دسترسی ها</a></li>
<li class="breadcrumb-item active">ویرایش دسترسی</li>
@endslot
@section('sidebar-permission','active')
@section('sidebar-settings','active menu-open')

<div class="col-12">
    <div class="card">

        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" action="{{ route('permission.update',$permission->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="card-body">

                <div class="col-lg-12">
                    <div class="form-group">
                        <input autocomplete="off" type="text" class="form-control ltr @error('name') is-invalid @enderror" name="name" placeholder="سطح دسترسی" required autocomplete="name" value="{{ $permission->name }}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <input autocomplete="off" type="text" class="form-control @error('label') is-invalid @enderror" name="label" placeholder="لیبل" required autocomplete="name" value="{{ $permission->label }}">
                        @error('label')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- /.card-body -->
            <div class="card-footer">
                <span class="float-right">
                    <button type="submit" class="btn btn-info "> ذخیره اطلاعات</button>
                </span>
                <span class="float-left">
                    <a href="{{ route('permission.index') }}" class="btn btn-secondary"> بازگشت به لیست</a>
                </span>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>

</div>




@endcomponent