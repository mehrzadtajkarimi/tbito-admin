@component('layouts.include.content' , ['title' => "تیکت شناسه ".\App\Helpers\TableCodeHelper::id2code($data['ticket']->id)."/{$data['ticket']->id}"])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="{{ url('/') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item active">تیکت </li>
@endslot
@section('sidebar-ticket','active')




<div class="col-12">
    <div class="card card-info card-outline  shadow">
        <div class="card-body">
            <form action="{{route('ticket.update' , $data['ticket']->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="input-group mt-3">
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name='attach' class="custom-file-input" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">انتخاب فایل</label>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-3">
                    @php
                    $defaultText = "با درود و احترام\n\nپشتیبانی تی بیتو 🌹";
                    @endphp
                    <textarea name="body" class="form-control" id="exampleFormControlTextarea1" placeholder=" لطفا متن پیام را وارد نمایید..." rows="3">{{ $data['ticket']->body  }}</textarea>
                </div>
                <input type="hidden" name='parent_id' value="{{$data['ticket']->id}}">
                <button type="submit" class="btn btn-info btn-sm btn-lg btn-block mb-3">ذخیره اطلاعات</button>
            </form>
        </div>
    </div>
</div>








@endcomponent