<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="row bg-light rounded">
                    <nav class="navbar navbar-expand-lg navbar-light ">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                @can('user-read')
                                <li class="nav-item ">
                                    <a class="nav-link {{ request()->route()->getName() == 'user.show' ? 'font-weight-bold' : 'text-muted' }}" href="{{ route('user.show' ,$data['user']->id ) }}">داشبورد کاربر</a>
                                </li>
                                @endcan
                                @can('user-hard-update')
                                <li class="nav-item ">
                                    <a class="nav-link {{ request()->route()->getName() == 'user.showHardUpdate' ? 'font-weight-bold' : 'text-muted' }}" href="{{ route('user.showHardUpdate' ,$data['user']->id ) }}">ویرایش اطلاعات </a>
                                </li>
                                @endcan
                                @can('bank-account-read')
                                <li class="nav-item ">
                                    <a class="nav-link {{ request()->route()->getName() == 'user.showBankAccount' ? 'font-weight-bold' : 'text-muted' }}" href="{{ route('user.showBankAccount' ,$data['user']->id ) }}">حساب های بانکی</a>
                                </li>
                                @endcan
                                @can('ticket-read')
                                <li class="nav-item ">
                                    <a class="nav-link {{ request()->route()->getName() == 'user.ticket' ? 'font-weight-bold' : 'text-muted' }}" href="{{ route('user.ticket' ,$data['user']->id ) }}">تیکت ها</a>
                                </li>
                                @endcan
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 text-center">
                        <img class="profile-user-img img-fluid img-circle " src="{{ asset('/admin/dist/img/user.png')}}" alt="User profile picture">
                        <h3 class="profile-username text-center mt-4"> {{ $data['user']->firstname }} {{ $data['user']->lastname }}</h3>
                        <div class="mt-3">
                            @if($data['user']->user_level_id ===1)
                            <small>ثبت نام اولیه :</small>
                            <i class="far fa-star text-light+"></i>
                            @elseif($data['user']->user_level_id ===2)
                            <small>نقره ای :</small>
                            <i class="far fa-star text-secondary"></i>
                            <i class="far fa-star text-secondary"></i>
                            @elseif($data['user']->user_level_id ===3)
                            <small>طلایی :</small>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            @endif
                        </div>
                        <div>
                            <small>وضعیت کاربر : </small>
                            @if($data['user']->enabled)
                            <i class="far fa-check-circle text-success"></i>
                            @else
                            <i class="far fa-times-circle text-danger"></i>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-5">
                        <ul class="list-group list-group-unbordered ltr">
                            <li class="list-group-item border-0">
                                <div class="row">
                                    <div class="col-9 ">
                                        <span>{{ App\Helpers\TableCodeHelper::id2Code($data['user']->id) }}<sub class="text-muted">/{{ $data['user']->id }}</sub></span>
                                    </div>
                                    <div class="col-3">
                                        <b>: شناسه کاربر </b>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item ">
                                <div class="row">
                                    <div class="col-9">
                                        <bdi class="arabic-num ">{{ \App\Helpers\DateTimeHelper::getDateTime($data['user']->created_at->timestamp ?? '')  }}</bdi>
                                    </div>
                                    <div class="col-3">
                                        <b class>: تاریخ ثبت نام </b>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item ">
                                <div class="row">
                                    <div class="col-9">
                                        @if($data['user']->referral_code_id)
                                        ( <span>{{ $data['user']->referralCode->friend_percent }}%</span> )
                                        ( رفرال : <span>{{ App\Helpers\TableCodeHelper::id2Code($data['user']->referral_code_id) }}</span> )
                                        <a href="{{ route('user.show',$data['user']->referralUser->id ) }}" class="">{{ $data['user']->referralUser->firstname }} {{ $data['user']->referralUser->lastname  }} </a>
                                        @else
                                        <span>--</span>
                                        @endif
                                    </div>
                                    <div class="col-3">
                                        <b>: کاربر معرف </b>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item ">
                                <bdi>
                                    <div class="row">
                                        <div class="col-3">
                                            <b>ایمیل کاربری : </b>
                                        </div>
                                        <div class="col-6">
                                            <spam>{{ $data['user']->email }}</spam>
                                        </div>
                                        <div class="col-3">
                                            @if($data['user']->email_verified_at)
                                            <i class="far fa-check-circle text-success"></i>
                                            @else
                                            <i class="far fa-times-circle text-danger"></i>
                                            @endif
                                        </div>
                                    </div>
                                </bdi>
                            </li>
                            <li class="list-group-item ">
                                <bdi>
                                    <div class="row">
                                        <div class="col-3">
                                            <b> موبایل : </b>
                                        </div>
                                        <div class="col-6">
                                            <spam>{{ $data['user']->mobile }}</spam>
                                        </div>
                                        <div class="col-3">
                                            @if($data['user']->mobile_verified_at)
                                            <i class="far fa-check-circle text-success"></i>
                                            @else
                                            <i class="far fa-times-circle text-danger"></i>
                                            @endif
                                        </div>
                                    </div>
                                </bdi>
                            </li>
                            <li class="list-group-item  border-0">
                                <div class="row">
                                    @if($data['user']->phone)
                                    <div class="col-3">
                                        @php
                                        $phoneStatus = $data['user']->getPhoneStatus();
                                        @endphp
                                        <i class="far fa-{{ $phoneStatus['icon'] }} text-{{ $phoneStatus['color'] }}"></i>
                                    </div>
                                    <div class="col-6">
                                        <spam>{{ $data['user']->phone  }}</spam>
                                    </div>
                                    @else
                                    <div class="col-9">
                                        <spam>--</spam>
                                    </div>
                                    @endif
                                    <div class="col-3">
                                        <b>: تلفن ثابت</b>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-5">
                        <ul class="list-group list-group-unbordered ltr">
                            <li class="list-group-item border-0">
                                <div class="row">
                                    <div class="col">
                                        <div class="row">

                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <span class="arabic-num ">{{ \App\Helpers\DateTimeHelper::getDateTime($data['loginLog']->date ?? '')  }}</span>
                                            </div>
                                            <div class="col">
                                                <b> : آخرین ورود </b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item ">
                                <div class="row">
                                    <div class="col-9">
                                        <spam>{{ $data['user']->national_code ?? '--' }}</spam>
                                    </div>
                                    <div class="col-3">
                                        <b>: کد ملی </b>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item ">
                                <div class="row">
                                    <div class="col-3">
                                        @if (!empty($data['user']->national_card_pic))
                                        @if($data['user']->personal_info_verified ===1)
                                        <i class="far fa-check-circle text-success"></i>
                                        @elseif($data['user']->personal_info_verified ===2)
                                        <i class="far fa-question-circle text-info"></i>
                                        @elseif($data['user']->personal_info_verified ===0)
                                        <i class="far fa-times-circle text-danger"></i>
                                        @endif
                                        @endif
                                    </div>
                                    @if (!empty($data['user']->national_card_pic))
                                    <div class="col-6">
                                        @can('user-pics-read')
                                        <form action="{{ route('user.nationalCardPicShow',$data['user']->id)}}" method="POST" id="form_national_card_pic_show">
                                            @method('POST')
                                            @csrf
                                            <button type="submit" class="btn bg-transparent p-0 text-primary" data-toggle="modal" data-target="#national_card_pic_show">
                                                مشاهده
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                    @else
                                    <div class="col-6">--</div>
                                    @endif
                                    <div class="col-3">
                                        <b>: تصویر کارت ملی</b>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item ">
                                <div class="row">
                                    <div class="col-3">
                                        @if (!empty($data['user']->auth_pic))
                                        @if($data['user']->auth_pic_verified ===1)
                                        <i class="far fa-check-circle text-success"></i>
                                        @elseif($data['user']->auth_pic_verified ===2)
                                        <i class="far fa-question-circle text-info"></i>
                                        @elseif($data['user']->auth_pic_verified ===0)
                                        <i class="far fa-times-circle text-danger"></i>
                                        @endif
                                        @endif
                                    </div>
                                    @if (!empty($data['user']->auth_pic))
                                    <div class="col-6">
                                        @can('user-pics-read')
                                        <form action="{{ route('user.authPicVerifyShow',$data['user']->id)}}" method="POST" id="form_auth_pic_verified_show">
                                            @method('POST')
                                            @csrf
                                            <button type="submit" class="btn bg-transparent p-0 text-primary" data-toggle="modal" data-target="#auth_pic_verified_show">
                                                مشاهده
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                    @else
                                    <div class="col-6">--</div>
                                    @endif
                                    <div class="col-3">
                                        <b>: عکس سلفی </b>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item ">
                                <div class="row">
                                    <div class="col-9">
                                        @if($data['user']->two_fa)
                                        <span>{{ $data['user']->two_fa }}</span>
                                        @else
                                        <span>--</span>
                                        @endif
                                    </div>
                                    <div class="col-3">
                                        <b> : ورود دو عاملی </b>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item border-0">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal national_card_pic-->
<div class="modal fade" id="national_card_pic_show" tabindex="-1" role="dialog" aria-labelledby="national_card_pic_show" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-radius-10">
            <div class="modal-body text-center m-5" id="ajax_national_card_pic_show">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                @can('user-pics-delete')
                <form action="{{  route('user.nationalCardPicRemove',$data['user']->id) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger mr-1">حذف عکس</button>
                </form>
                @endcan
            </div>
        </div>
    </div>
</div>

<!-- Modal auth_pic_verified-->
<div class="modal fade" id="auth_pic_verified_show" tabindex="-1" role="dialog" aria-labelledby="auth_pic_verified_show" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-radius-10">
            <div class="modal-body  text-center m-5" id="ajax_auth_pic_verified_show">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                @can('user-pics-delete')
                <form action="{{  route('user.authPicVerifyRemove',$data['user']->id) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger mr-1">حذف عکس</button>
                </form>
                @endcan
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // alert($('#form_national_card_pic').serialize());
        $('#form_national_card_pic_show').submit(function(event) {
            event.preventDefault();
            var form = $('#form_national_card_pic_show');
            var resultsTag = $('#ajax_national_card_pic_show');
            resultsTag.html("<img  class='rounded' src='{{ asset('/admin/dist/img/loading-black.svg') }}' >");
            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: form.serialize(),
                success: function(response) {
                    resultsTag.html('<img class="img-fluid rounded" src="data:image/jpeg;base64,' + response + '"/>');
                },
            });
        });
        $('#form_auth_pic_verified_show').submit(function(event) {
            event.preventDefault();
            var form = $('#form_auth_pic_verified_show');
            var resultsTag = $('#ajax_auth_pic_verified_show');
            resultsTag.html("<img class='rounded' src='{{ asset('/admin/dist/img/loading-black.svg') }}' >");
            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: form.serialize(),
                success: function(response) {
                    resultsTag.html('<img class="img-fluid rounded" src="data:image/jpeg;base64,' + response + '"/>');
                }
            });
        });
    });
</script>