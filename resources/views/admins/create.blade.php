@component('layouts.include.content' , ['title' => 'ایجاد ادمین'])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="{{ url('/') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item "><a href="{{ route('admins.index') }}">لیست ادمین ها </a></li>
<li class="breadcrumb-item active">ایجاد ادمین </li>
@endslot
@section('sidebar-admins','active')
@section('sidebar-settings','active menu-open')
@slot('script')
<script>
    //  console.log('hello')
    $('#roles').select2({
        'placeholder': 'نقش های مورد نظر را انتخاب کنید'
    })
</script>
@endslot
<div class="col-12">
    <div class="card">

        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" action="{{ route('admins.store') }}" method="POST">
            @csrf
            <div class="card-body">

                <div class="col-lg-12">
                    <div class="form-group">
                        <input autocomplete="off" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="نام کاربری" required value="{{ old('name')}}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <input autocomplete="off" type="text" class="form-control @error('post') is-invalid @enderror" name="post" placeholder="سمت" required value="{{ old('post')}}">
                        @error('post')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <input autocomplete="off" type="email" class="form-control ltr text-left @error('email') is-invalid @enderror" name="email" placeholder="email" required value="{{ old('email')}}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <input autocomplete="off" type="password" class="form-control ltr text-left @error('password') is-invalid @enderror" name="password" placeholder="password" required>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <select type="text" class="form-control @error('label') is-invalid @enderror" name="roles[]" id="roles" multiple>
                            @foreach(App\Models\Role::all() as $role )
                            <option value="{{ $role->id }}" {{ in_array($role->id ,$admin->roles->pluck('id')->toArray())? 'selected' : '' }}>{{ $role->name }} - {{ $role->label }}</option>
                            @endforeach
                        </select>
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
                <button type="submit" class="btn btn-info "> ذخیره اطلاعات</button>
                </span>
                <span class="float-left">
                    <a href="{{ route('admins.index') }}" class="btn btn-secondary"> بازگشت به لیست</a>
                </span>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
</div>




@endcomponent