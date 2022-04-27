@component('layouts.include.content' , ['title' => "ویرایش نقش: $role->label"])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="{{ url('/') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item "><a href="{{ route('role.index') }}">لیست نقشها</a></li>
<li class="breadcrumb-item active">ویرایش نقش</li>
@endslot
@section('sidebar-role','active')
@section('sidebar-settings','active menu-open')
@slot('script')
<script>
    //  console.log('hello')
    $('#permissions').select2({
        'placeholder': 'دسترسی های مورد نظر را انتخاب کنید'
    })
</script>
@endslot
<div class="col-12">
    <div class="card">

        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" action="{{ route('role.update',$role->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="card-body">

                <div class="col-lg-12">
                    <div class="form-group">
                        <input autocomplete="off" type="text" class="form-control ltr text-left @error('name') is-invalid @enderror" name="name" placeholder="سطح دسترسی" autocomplete="name" value="{{ old('name',$role->name )}}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <input autocomplete="off" type="text" class="form-control @error('label') is-invalid @enderror" name="label" placeholder="لیبل" autocomplete="label" value="{{ old('label',$role->label) }}">
                        @error('label')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <select type="text" class="form-control @error('permissions') is-invalid @enderror" name="permissions[]" id="permissions" required multiple>
                            @foreach(App\Models\Permission::all() as $permission )
                            <option value="{{ $permission->id }}" {{ in_array($permission->id ,$role->permissions->pluck('id')->toArray())? 'selected' : '' }}>{{ $permission->name }} - {{ $permission->label }}</option>
                            @endforeach
                        </select>
                        @error('permissions')
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
                    <a href="{{ route('role.index') }}" class="btn btn-secondary"> بازگشت به لیست</a>
                    <a href="{{ route('role.create') }}" class="btn btn-success">ایجاد نقش</a>
                </span>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>

</div>




@endcomponent