@component('layouts.include.content' , ['title' => "تیکت شناسه ".\App\Helpers\TableCodeHelper::id2code($data['ticket']->id)."/{$data['ticket']->id}"])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="{{ url('/') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item active">تیکت </li>
@endslot
@section('sidebar-ticket','active')




<div class="col-12">
    <div class="card card-info card-outline  shadow">
        <div class="card-body">
            <form action="{{route('ticket.reply',$data['ticket']->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')
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
                    <textarea name="body" class="form-control" id="exampleFormControlTextarea1" placeholder=" لطفا متن پیام را وارد نمایید..." rows="3">{{old('body', $defaultText)}}</textarea>
                </div>
                <button type="submit" class="btn btn-info btn-block mb-3">ذخیره اطلاعات</button>
            </form>
        </div>
    </div>
</div>


<button type="button" class="btn btn-danger m-2 " onclick="return confirm('آیا از انجام عملیات اطمینان دارید');">بستن</button>

<div class="col-12" id="ajax_form_confirm ">
    <!-- /.card-footer-->
    <div class="card card-success card-outline direct-chat direct-chat-success shadow">
        <div class="card-header">
            <h3 class="card-title">{{$data['ticket']->title}}</h3>

            <div class="card-tools">

                <small class="text-left d-inline-block">
                    <a href="{{ route('user.show', $data['ticket']->user_id) }}">{{$data['ticket']->user->fullname}}</a>
                </small>
                <span class="ml-2 mt-1 mr-2 vertical-align d-inline-block">/</span>
                <small class="text-left d-inline-block">
                    @if( $data['ticket']->priority == 1)
                    <span>اولویت زیاد</span>
                    @elseif($data['ticket']->priority == 2)
                    <span>اولویت متوسط</span>
                    @elseif($data['ticket']->priority == 3)
                    <span> اولویت کم</span>
                    @endif
                </small>
                <span class="ml-2 mt-1 mr-2 vertical-align d-inline-block">/</span>
                <div class="text-left d-inline-block">
                    @if( $data['ticket']->status == 1)
                    <h5><span class="badge font-weight-normal badge-warning">در انتظار بررسی</span></h5>
                    @elseif($data['ticket']->status == 2)
                    <h5><span class="badge font-weight-normal badge-info">در حال بررسی</span></h5>
                    @elseif($data['ticket']->status == 3)
                    <h5><span class="badge font-weight-normal badge-success">پاسخ مشتری</span></h5>
                    @elseif($data['ticket']->status == 4)
                    <h5><span class="badge font-weight-normal badge-success">پاسخ پشتیبان</span></h5>
                    @elseif($data['ticket']->status == 5)
                    <h5><span class="badge font-weight-normal badge-danger">بسته شده</span></h5>
                    @endif
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages h-100">
                @foreach ($data['ticket']->children as $value)

                @php
                $hideInfo = ($loop->index >0 && $value->admin_id == $data['ticket']->children[$loop->index-1]->admin_id) ? true : false;
                @endphp

                @if($value->from_admin)
                <!-- Message to the right -->
                <div class="direct-chat-msg right {{ $hideInfo ? '' : 'mt-4' }}">
                    <div class="direct-chat-info clearfix">
                        @if(!$hideInfo)
                        <span class="direct-chat-name float-right">{{ $value->admin->name }}</span>
                        @endif
                    </div>
                    <!-- /.direct-chat-info -->

                    @if(!$hideInfo)
                    <img src="{{ asset('/admin/dist/img/logo-web.png')}}" class="float-right mt-2" width="2.5%" alt="">
                    @endif
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text text-justify shadow-sm">
                        <div class="row">
                            <div class="col-11">
                                {!! nl2br($value->body) !!}
                            </div>
                            <div class="col-1 text-center opacity-90">
                                <small class="direct-chat-timestamp  text-white font-weight-bold">
                                    <bdi class="arabic-num mr-1 text-center">{{ \App\Helpers\DateTimeHelper::getDateTime($value->created_at->timestamp) ?? '--' }}</bdi>
                                </small>
                                <div class="row">
                                    <div class="col ">
                                        @can('ticket-update')
                                        <a href="{{ route('ticket.edit',$value->id,'edit') }}">
                                            <button type="button" class="btn btn-block btn-sm btn-outline-light p-0 pr-1 pl-1 ">ویرایش</button>
                                        </a>
                                        @endcan
                                    </div>
                                    <div class="col pr-0">
                                        @can('ticket-delete')
                                        <form class="mb-0" action="{{ route('ticket.destroy',$value->id) }}" onclick="return confirm('آیا آیتم مورد نظر حذف شود');" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-block btn-sm btn-outline-light p-0">حـــــذف</button>
                                        </form>
                                        @endcan
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mt-1">
                                        <a href="#">
                                            <button type="button" class="btn btn-block  btn-sm btn-outline-light p-0 ">مشاهده فایل </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->
                @else
                <!-- Message. Default to the left -->
                <div class="direct-chat-msg {{ $hideInfo ? '' : 'mt-4' }}">
                    <div class="direct-chat-info clearfix">

                        @if(!$hideInfo)
                        <span class="direct-chat-name float-left">{{ $value->user->firstname }} {{ $value->user->lastname }}</span>
                        @endif
                    </div>
                    <!-- /.direct-chat-info -->

                    @if(!$hideInfo)
                    <img class=" img-fluid img-circle float-left m-1" width="2%" src="{{ asset('/admin/dist/img/user.png')}}" alt="User profile picture">
                    @endif
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text text-justify shadow-sm">
                        <div class="row">
                            <div class="col-11">
                                {!! nl2br($value->body) !!}
                            </div>
                            <div class="col-1 text-center  opacity-80">
                                <small class="direct-chat-timestamp font-weight-bold text-dark">
                                    <bdi class="arabic-num mr-1 text-center">{{ \App\Helpers\DateTimeHelper::getDateTime($value->created_at->timestamp) ?? '--' }}</bdi>
                                </small>
                                <div class="row">
                                    <div class="col ">
                                        @can('ticket-update')
                                        <a href="{{ route('ticket.edit',$value->id,'edit') }}">
                                            <button type="button" class="btn btn-block btn-sm btn-outline-dark p-0  ">ویرایش</button>
                                        </a>
                                        @endcan
                                    </div>
                                    <div class="col pr-0">
                                        @can('ticket-delete')
                                        <form class="mb-0" action="{{ route('ticket.destroy',$value->id) }}" onclick="return confirm('آیا آیتم مورد نظر حذف شود');" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-block btn-sm btn-outline-dark p-0 ">حـــــذف</button>
                                        </form>
                                        @endcan
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mt-1">
                                        <a href="{{ route('ticket.edit',$value->id,'edit') }}">
                                            <button type="button" class="btn btn-block  btn-sm btn-outline-dark p-0 pr-2 pl-2">مشاهده فایل </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->
                @endif

                @endforeach
            </div>
            <!--/.direct-chat-messages-->
        </div>
        <!-- /.card-body -->

    </div>
</div>






@endcomponent