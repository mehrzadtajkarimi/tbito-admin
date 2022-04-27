@component('layouts.include.content' , ['title' => ''])

@slot('breadcrumb')

@endslot
@section('sidebar-aaa','active')
@section('sidebar-contents','active menu-open')

@include('users.menu')

<?php $count = 1; ?>

<div class="row">
    @forelse($data['bankAccount'] as $value)
    <div class="col-{{ count($data['bankAccount'])>1 ? 6 : 12 }}">
        <div class="card shadow " style="border-color: red !important">
            <div class="card-body">
                <div class="row">
                    <div class="col ">
                        <div class="card" style="margin-bottom: 0px !important;">
                            <div class="card-header">
                                <span>
                                    {{ $value->bank_name }}
                                </span>
                                <span class="float-left">
                                    @if($value->verified ===1)
                                    <span class="bg-success p-1 pr-3 pl-3 rounded ">
                                        <span>تایید شده</span>
                                        <i class="far fa-check-circle"></i>
                                    </span>
                                    @elseif($value->verified ===2)
                                    <span class="bg-info p-1 pr-3 pl-3 rounded">
                                        <span>در انتظار تایید</span>
                                        <i class="far fa-question-circle"></i>
                                    </span>
                                    @elseif($value->verified ===0)
                                    <span class="bg-danger p-1 pr-3 pl-3 rounded">
                                        <span>عدم تایید</span>
                                        <i class="far fa-times-circle"></i>
                                    </span>
                                    @endif
                                </span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <p class="">صاحب حساب : -----</p>
                                        <small>
                                            <b>کد شناسه : </b>
                                            <span>{{ App\Helpers\TableCodeHelper::id2Code($value->id) }}<sub class="text-muted">/{{ $value->id }}</sub></span>
                                        </small>
                                    </div>
                                    <div class="col-8 ltr ">
                                        <p class="card-title text-left">
                                            {{ preg_replace('/(?<=\d)(?=(\d{4})+$)/', ' - ', $value->card_num )}}
                                        </p>
                                        <p class="card-text text-left">
                                            <b class="text-left"> IR </b>
                                            {{ preg_replace('/(?<=\d)(?=(\d{4})+$)/', ' ', $value->iban_num )}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('user.storBankAccount' , $data['user']->id )}}" method="POST">
                                @method('POST')
                                @csrf
                                <input type="hidden" name="input_hidden_bank_account_id" value="{{ $value->id }}">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <span class="form-check text-danger ">
                                            <label class="form-check-label">
                                                <input class="form-check-input radio_bank_account_unverify" value="0" type="radio" name="verified_bank_account" {{ $value->verified ===0 ? 'checked' : '' }}>
                                                <h5>
                                                    عدم تایید
                                                </h5>
                                            </label>
                                        </span>
                                        <span class="form-check text-success mr-3">
                                            <label class="form-check-label">
                                                <input class="form-check-input radio_bank_account_verify" value="1" type="radio" name="verified_bank_account" {{ $value->verified ===1 ? 'checked' : '' }} required>
                                                <h5>
                                                    تایید
                                                </h5>
                                            </label>
                                            <small class="m-2 text-muted {{ $value->verified != 1 ? 'd-none' : '' }}"> {{ \App\Helpers\DateTimeHelper::getDateTime($value->verified_at , "تایید شده در تاریخ Y/m/d ساعت H:i")  }} </small>
                                        </span>
                                    </div>
                                    <div class="form-group textarea" style="{{  $value->verified === 0 ? 'display: block;' : 'display: none;'}}">
                                        <textarea class="form-control" name="verified_bank_accounts_textarea" rows="3" placeholder="لطفا علت عدم تایید خود را ذکر نمایید ..">{{ $value->disapproval_reason ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        @can('bank-account-update')
                                        <div class="col">
                                            <button type="submit" class="btn btn-info btn-block" onclick="return confirm('آیا برای ذخیره اطلاعات اطمینان دارید');">ذخیره اطلاعات</button>
                                        </div>
                                        @endcan
                                        <div class="col">
                                            <button type="button" class="btn btn-warning btn-block">استعلام</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col">
        <div class="card shadow">
            <div class="card-body pt-4">
                <div class="alert alert-secondary col" role="alert">
                    حساب بانکی برای نمایش ثبت نشده است..
                </div>
            </div>
        </div>
    </div>
    @endforelse

</div>


<script>
    $(document).ready(function() {
        $(".radio_bank_account_verify").click(function() {
            var $textarea = $(this).closest('.card-body').find('.textarea');
            $textarea.hide(200);
            $textarea.find('textarea').prop('required', false);
        });

        $(".radio_bank_account_unverify").click(function() {
            var $textarea = $(this).closest('.card-body').find('.textarea');
            $textarea.show(200);
            $textarea.find('textarea').prop('required', true);

        });
    });
</script>


@endcomponent