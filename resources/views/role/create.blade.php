@component('layouts.include.content' , ['title' => 'ایجاد نقش'])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="{{ url('/') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item "><a href="{{ route('role.store') }}">لیست نقش ها</a></li>
<li class="breadcrumb-item active">ایجاد نقش</li>
@endslot
@section('sidebar-role','active')
@section('sidebar-settings','active menu-open')

@slot('script')
<script>
    $('#permissions').select2({
        'placeholder': 'دسترسی مورد نظر را انتخاب کنید'
    })
</script>
@endslot
<div class="col-12">
    <div class="card">

        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" action="{{ route('role.store') }}" method="POST">
            @csrf
            <div class="card-body">

                <div class="col-lg-12">
                    <div class="form-group">
                        <input autocomplete="off" type="text" class="form-control ltr @error('name') is-invalid @enderror" name="name" placeholder="نقش---انگلیسی" autocomplete="name" value="{{ old('name')}}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input autocomplete="off" type="text" class="form-control @error('label') is-invalid @enderror" name="label" placeholder="شرح نقش---فارسی" autocomplete="label" value="{{ old('label')}}">
                        @error('label')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select type="text" class="form-control @error('label') is-invalid @enderror" name="permissions[]" id="permissions" required multiple>
                            @foreach(App\Models\Permission::all() as $permission )
                            <option value="{{ $permission->id }}">{{ $permission->name }} - {{ $permission->label }}</option>
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
                <span class="float-right">
                    <button type="submit" class="btn btn-info "> ذخیره اطلاعات</button>
                </span>
                <span class="float-left">
                    <a href="{{ route('role.index') }}" class="btn btn-secondary"> بازگشت به لیست</a>
                </span>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>

</div>




@endcomponent