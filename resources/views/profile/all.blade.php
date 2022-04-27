@component('layouts.include.content' , ['title' => 'پروفایل'])
namespace App;

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="{{ url('/') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item active"> پروفایل </li>
@endslot
@section('sidebar-profile','active')
@section('sidebar-settings','active menu-open')



<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle w-50 " src="{{ asset('/admin/dist/img/user.png')}}" alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center">{{ $data['admin']->name }}</h3>
                        <p class="text-muted text-center">{{ $data['admin']->post }}</p>
                        <ul class="list-group list-group-unbordered mb-3 ltr">
                            <li class="list-group-item">
                                <bdi> <b>نام کاربری : </b> <a>{{ $data['admin']->email }}</a></bdi>
                            </li>
                            <li class="list-group-item ">
                                <bdi><b>آخرین بازدید : </b> <bdi>{{ \App\Helpers\DateTimeHelper::getDateTime($data['loginLog']->date ?? '')  }}</bdi></bdi>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link {{ request()->get('tab') == '2fa'  ? '' : 'active' }}" href="#settings" data-toggle="tab">تنظیمات</a></li>
                            <li class="nav-item"><a class="nav-link " href="#activity" data-toggle="tab"> تاریخچه ورود</a></li>
                            <li class="nav-item"><a class="nav-link {{ request()->get('tab') == '2fa'  ? 'active' : '' }}" href="{{ route("profile.index", ['tab' => '2fa']) }}" data-togglee="tab">ورود دو عاملی</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane {{ request()->get('tab') == '2fa'  ? '' : 'active' }}" id="settings">
                                <div class="card">
                                    <form class="form-horizontal" action="{{ route('profile.update',$data['admin']->id) }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <input autocomplete="off" type="text" class="form-control  @error('name') is-invalid @enderror" name="name" placeholder="نام" autocomplete="name" value="{{ old('name',$data['admin']->name)}}">
                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input autocomplete="off" type="email" class="form-control ltr @error('email') is-invalid @enderror" name="email" placeholder="email" autocomplete="email" value="{{ old('email',$data['admin']->email)}}">
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input autocomplete="off" type="password" class="form-control ltr @error('password') is-invalid @enderror" name="password" placeholder="password" autocomplete="password" value="{{ old('password')}}">
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-info">ذخیره اطلاعات</button>
                                        </div>
                                        <!-- /.card-footer -->
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>

                            <div class="tab-pane" id="activity">
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
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>
                                                                    <bdi>{{\App\Helpers\DateTimeHelper::getDateTime($value->date) }}</bdi>
                                                                </td>
                                                                <td>{{ $value->ip_address }}</td>
                                                            </tr>
                                                            <!-- <tr style='display:none;' title='sdfsdf'>
                                                                <td colspan="3"></td>
                                                            </tr> -->
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
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane {{ request()->get('tab') == '2fa'  ? 'active' : '' }}" id="otp">
                                @if (@$data['2fa']['text'])
                                <div class="alert alert-{{ $data['2fa']['style'] }}" role="alert">
                                    {{ $data['2fa']['text'] }}
                                </div>
                                @if(@$data['2fa']['btn'])
                                <p class="text-center"><a href="{{$data['2fa']['btn']}}">درخواست تولید رمز جدید</a></p>
                                @endif
                                @else
                                <div class="card">
                                    <form class="form-horizontal" action="{{ route('profile.setGoogle2fa') }}" method="">
                                        @csrf
                                        <input type="hidden" name="otp_code" value="{{ $data['2fa']['google2fa_code'] }}">

                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <img src="{{ $data['2fa']['google2fa_qrcode'] }}" class="rounded mx-auto w-25 mb-5 d-block" alt="2fa">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <span>کد پشتیبان ورود دو عاملی :</span>
                                                        </div>
                                                        <div class="col-8">
                                                            <input class="form-control form-control-sm ltr  " value="{{ $data['2fa']['google2fa_key']}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <input autocomplete="off" type="password" class="form-control ltr @error('password') is-invalid @enderror" name="password" placeholder="password" autocomplete="password" value="{{ old('password')}}" required>
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <input autocomplete="off" type="text" class="form-control ltr @error('otp') is-invalid @enderror" name="otp" placeholder="otp" autocomplete="password" value="{{ old('otp')}}" required>
                                                    @error('otp')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-info">فعال سازی</button>
                                        </div>
                                        <!-- /.card-footer -->
                                    </form>
                                </div>
                                @endif
                                <!-- /.tab-pane -->
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->









@endcomponent