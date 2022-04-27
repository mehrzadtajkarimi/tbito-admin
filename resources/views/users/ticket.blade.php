@component('layouts.include.content' , ['title' => ''])

@slot('breadcrumb')

@endslot
@section('sidebar-aaa','active')
@section('sidebar-contents','active menu-open')

@include('users.menu')




<div class="card card-info card-outline  shadow">
    <div class="card-body">
        <form action="{{route('ticket.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-row">
                <div class="col-8 input-group mt-3">
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="test" name='attach' class="form-control" id="exampleInputFile" placeholder="عنوان تیکت">
                        </div>
                    </div>
                </div>
                <div class="col-4 input-group mt-3">
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name='attach' class="custom-file-input" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">انتخاب فایل</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group mt-3">
                @php
                $defaultText = "با درود و احترام\n\nپشتیبانی تی بیتو 🌹";
                @endphp
                <textarea name="body" class="form-control" id="exampleFormControlTextarea1" placeholder=" لطفا متن پیام را وارد نمایید..." rows="3">{{old('body', $defaultText)}}</textarea>
            </div>
            <input type="hidden" name='user_id' value="{{$data['user']->id}}">
            <button type="submit" class="btn btn-info btn-block mb-3">ثبت تیکت جدید</button>
        </form>
    </div>
</div>



<div class="card shadow">
    <div class="card-body table-responsive p-0">
        <table class="table table-hover table--vertical_middle ">
            <thead>
                <div class="text-left m-2">
                    <span>{{$data['ticket']->firstItem()}} تا</span>
                    <span>{{$data['ticket']->lastItem()}} </span>
                    / <span>{{$data['ticket']->total()}} مورد</span>
                </div>
            </thead>
            <tbody>
                <tr>
                    <th>#</th>
                    <th>شناسه</th>
                    <th>عنوان</th>
                    <th>وضعیت</th>
                    <th class="text-center">پشتیبان</th>
                    <th>تاریخ</th>
                    <th class="text-center">عملیات</th>
                </tr>
                @forelse($data['ticket'] as $value)
                <tr>
                    <td width="10px">{{$loop->index + $data['ticket']->firstItem() }}</td>
                    <td>
                        <span>{{ App\Helpers\TableCodeHelper::id2Code($value->id) }}<sub class="text-muted">/{{ $value->id }}</sub></span>
                    </td>

                    <td width="350">
                        <div class="mb-2">{{ $value->title }}</div>
                        @if( $value->priority == 1)
                        <div><span class="badge font-weight-normal badge-danger">اولویت زیاد</span></div>
                        @elseif($value->priority == 2)
                        <div><span class="badge font-weight-normal badge-warning">اولویت متوسط</span></div>
                        @elseif($value->priority == 3)
                        <div><span class="badge font-weight-normal badge-info"> اولویت کم</span></div>
                        @endif
                    </td>
                    <td>
                        <div>
                            @if( $value->status == 1)
                            <h5><span class="badge font-weight-normal badge-warning">در انتظار بررسی</span></h5>
                            @elseif($value->status == 2)
                            <h5><span class="badge font-weight-normal badge-info">در حال بررسی</span></h5>
                            @elseif($value->status == 3)
                            <h5><span class="badge font-weight-normal badge-success">پاسخ مشتری</span></h5>
                            @elseif($value->status == 4)
                            <h5><span class="badge font-weight-normal badge-success">پاسخ پشتیبان</span></h5>
                            @elseif($value->status == 5)
                            <h5><span class="badge font-weight-normal badge-danger">بسته شده</span></h5>
                            @endif
                        </div>
                    </td>
                    <td class="text-center">
                        <p class="mb-1"><small> {{ $value->admin ? $value->admin->name : '--'}}</small></p>
                        @if($value->from_admin)
                        <small class="text-muted">از طرف سایت</small>
                        @endif

                    </td>
                    <td>
                        <div>
                            <span>ایجـــــــــــــاد : <bdi class="arabic-num mr-1">{{ \App\Helpers\DateTimeHelper::getDateTime($value->created_at->timestamp) ?? '--' }}</bdi></span>
                        </div>
                        <div>
                            <span>بروزرسانی : <bdi class="arabic-num mr-1">{{ \App\Helpers\DateTimeHelper::getDateTime($value->updated_at->timestamp) ?? '--' }}</bdi></span>
                        </div>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('ticket.show',$value->id)}}">مشاهده</a>
                    </td>
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
    <div class="card-footer">
        <span class="float-left">
            {{ $data['ticket']->links()  }}
        </span>
    </div>
</div>









@endcomponent