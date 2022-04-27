@component('layouts.include.content' , ['title' => " ویرایش ادمین : {$data['admin']->name}"])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="{{ url('/') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item "><a href="{{ route('admins.index') }}">لیست ادمین ها</a></li>
<li class="breadcrumb-item active">ویرایش ادمین</li>
@endslot
@section('sidebar-admins','active')
@section('sidebar-settings','active menu-open')
@slot('script')
<script>
    //  console.log('hello')
    $('#roles').select2({
        'placeholder': 'نقش مورد نظر را انتخاب کنید'
    })
</script>
@endslot
<div class="col-12">
    <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#edit" data-toggle="tab">ویرایش</a></li>
                <li class="nav-item"><a class="nav-link" href="#history" data-toggle="tab">تاریخچه ورود</a></li>
            </ul>
        </div><!-- /.card-header -->
        <!-- <div class="card-body"> -->
        <div class="tab-content">
            <div class="active tab-pane" id="edit">
                @if ($data['admin']->google2fa)
                <div class="card-header border-0">
                    <form action="{{ route('admins.resetGoogle2fa',$data['admin']->id) }}" method="">
                        @csrf
                        <input type="hidden" name="resetPassword" value="true">
                        <span class="float-left">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('آیا از ریست ورود دوعاملی {{ $data['admin']->name }} اطمینان دارید');"> ریست ورودی دوعاملی</button>
                        </span>
                    </form>
                </div>
                @endif
                <form class="form-horizontal" action="{{ route('admins.update',$data['admin']->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input autocomplete="off" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="نام کاربری" required value="{{ old('name',$data['admin']->name) }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <input autocomplete="off" type="text" class="form-control @error('post') is-invalid @enderror" name="post" placeholder="سمت" required value="{{ old('post',$data['admin']->post) }}">
                                @error('post')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <input autocomplete="off" type="email" class="form-control ltr @error('email') is-invalid @enderror" name="email" placeholder="ایمیل" required value="{{ old('email',$data['admin']->email) }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <input autocomplete="off" type="password" class="form-control ltr  @error('password') is-invalid @enderror" name="password" placeholder="password" value="">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <select type="text" class="form-control @error('label') is-invalid @enderror" name="roles[]" id="roles" multiple>
                                    @foreach(App\Models\Role::all() as $role )
                                    <option value="{{ $role->id }}" {{ in_array($role->id ,$data['admin']->roles->pluck('id')->toArray())? 'selected' : '' }}>{{ $role->name }} - {{ $role->label }}</option>
                                    @endforeach
                                </select>
                                @error('label')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        @if($data['admin']->is_super_admin == 0)
                        <div class="col-lg-12">
                            <div class="form-check ">
                                <input type="checkbox" class="form-check-input " name="enabled" value="1" id="exampleCheck1" {{ $data['admin']->enabled === 1 ? 'checked' :''}}>
                                <label class="form-check-label " for="exampleCheck1">وضعیت حساب ادمین </label>
                            </div>
                        </div>
                        @endif

                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info "> ذخیره اطلاعات</button>
                        </span>
                        <span class="float-left">
                            <a href="{{ route('admins.index') }}" class="btn btn-secondary"> بازگشت به لیست</a>
                            <a href="{{ route('admins.create') }}" class="btn btn-success">ایجاد ادمین</a>
                        </span>
                    </div>
                </form>

                <!-- /.card-footer -->
            </div>
            <div class=" tab-pane" id="history">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">لیست ورود</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-center">
                                        <tbody>
                                            <tr>
                                                <th>شماره</th>
                                                <th>تاریخ و زمان</th>
                                                <th>ip_address</th>
                                            </tr>
                                            @forelse($data['loginLogs'] as $value)
                                            <tr title="{{$value->user_agent}}">
                                                <td>{{$loop->index + $data['loginLogs']->firstItem() }}</td>
                                                <td>
                                                    <bdi>{{\App\Helpers\DateTimeHelper::getDateTime($value->date) }}</bdi>
                                                </td>
                                                <td>{{ $value->ip_address }}</td>
                                            </tr>
                                            @empty
                                            <tr class="alert alert-secondary" role="alert">
                                                <td colspan="10">
                                                    آیتمی برای نمایش وجود ندارد
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <span class="float-left">
                                        {{ $data['loginLogs']->links()  }}
                                    </span>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <!-- /.tab-content -->
    </div><!-- /.card-body -->


</div>




@endcomponent