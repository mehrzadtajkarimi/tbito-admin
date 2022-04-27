@component('layouts.include.content' , ['title' => " ویرایش تنظیمات : {$data['siteSetting']->tag}"])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="{{ url('/') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item active">ویرایش تنظیمات</li>
@endslot
@section('sidebar-deposits','active')


<?php $count = 1; ?>

<div class="col-12">
    <div class="card">
        <form class="form-horizontal" action="{{ route('site-setting.update',$data['siteSetting']->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="card-body ">
                <div class="form-group row ltr">
                    <label for="input{{ $count++ }}" class="col-1 col-form-label text-left">tag : </label>
                    <div class="col-11">
                        <input type="text" name="tag" class="form-control @error('tag') is-invalid @enderror" id="input{{ $count-1 }}" value="{{ old('tag',$data['siteSetting']->tag) }}">
                        @error('tag')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row ltr">
                    <label for="input{{ $count++ }}" class="col-1 col-form-label text-left">key : </label>
                    <div class="col-11">
                        <input type="text" name="key" class="form-control @error('key') is-invalid @enderror" id="input{{ $count-1 }}" value="{{ old('key',$data['siteSetting']->key) }}">
                        @error('key')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row ltr">
                    <label for="input{{ $count++ }}" class="col-1 col-form-label text-left">value : </label>
                    <div class="col-11">
                        <input type="text" name="value" class="form-control @error('value') is-invalid @enderror" id="input{{ $count-1 }}" value="{{ old('value',$data['siteSetting']->value) }}">
                        @error('value')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row ltr">
                    <label for="input{{ $count++ }}" class="col-1 col-form-label text-left">title : </label>
                    <div class="col-11">
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="input{{ $count-1 }}" value="{{ old('title',$data['siteSetting']->title) }}">
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row ltr">
                    <label for="input{{ $count++ }}" class="col-1 col-form-label text-left">text : </label>
                    <div class="col-11">
                        <input type="text" name="text" class="form-control @error('text') is-invalid @enderror" id="input{{ $count-1 }}" value="{{ old('text',$data['siteSetting']->text) }}">
                        @error('text')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-info "> ذخیره اطلاعات</button>
                </span>
                <span class="float-left">
                    <a href="{{ route('site-setting.index') }}" class="btn btn-secondary"> بازگشت به لیست</a>
                    <a href="{{ route('site-setting.create') }}" class="btn btn-success">ایجاد تنظیمات</a>
                </span>
            </div>
        </form>
    </div>
</div>





@endcomponent