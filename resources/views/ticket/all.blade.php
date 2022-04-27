@component('layouts.include.content' , ['title' => 'تیکت ها'])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="{{ url('/') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item active">تیکت ها</li>
@endslot
@section('sidebar-ticket','active')

<div class="col-12" id="ajax_form_confirm">
    <div class="card">
        <div class="card-header">
            <form action="{{route('ticket.index')}}" method='get'>
                <div class="row ">
                    <div class="form-row col">
                        <div class="form-group col-1">
                            <input autocomplete="off" type="text" class="form-control ltr" name="id" value="{{ request()->query('id') }}" placeholder="id">
                        </div>
                        <div class="form-group col-3">
                            <input autocomplete="off" type="text" class="form-control ltr" name="code" value="{{ request()->query('code') }}" placeholder="code">
                        </div>
                        <div class="form-group col">
                            <input autocomplete="off" type="text" class="form-control" name="user" value="{{ request()->query('user') }}" placeholder="کاربر : شناسه , نام , موبایل , ایمیل , کد ملی">
                        </div>
                        <div class="form-group col">
                            <select name="priority" class="custom-select ">
                                <option value="">اولویت </option>
                                <option value="1" {{  request()->query('priority') == 1 ? 'selected' : ''}}> زیاد </option>
                                <option value="2" {{  request()->query('priority') == 2 ? 'selected' : ''}}> متوسط</option>
                                <option value="3" {{  request()->query('priority') == 3 ? 'selected' : ''}}> کم</option>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="row ">
                    <div class="form-row col">
                        <div class="form-group col">
                            <select name="status" class="custom-select ">
                                <option value="">وضعیت </option>
                                <option value="1" {{  request()->query('status') == 1 ? 'selected' : ''}}> در انتظار بررسی </option>
                                <option value="2" {{  request()->query('status') == 2 ? 'selected' : ''}}> در حال بررسی</option>
                                <option value="3" {{  request()->query('status') == 3 ? 'selected' : ''}}> پاسخ مشتری</option>
                                <option value="4" {{  request()->query('status') == 4 ? 'selected' : ''}}>پاسخ پشتیبان</option>
                                <option value="5" {{  request()->query('status') == 5 ? 'selected' : ''}}>بسته شده</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <select name="admin_id" class="custom-select">
                                <option value=""> نام ادمین</option>
                                @foreach($data['admins'] as $admin)
                                <option value="{{ $admin->id }}" {{  request()->query('admin_id') == $admin->id  ? 'selected' : ''}}>{{ $admin->name }} {{ $admin->post }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col">
                            <input autocomplete="off" type="text" class="form-control start_at" id="Input1" value="{{ request()->query('start_at') }}" placeholder="از تاریخ">
                            <input autocomplete="off" type="hidden" id="start_at" name="start_at" value="{{ request()->query('start_at') }}">
                        </div>
                        <div class="form-group col">
                            <input autocomplete="off" type="text" class="form-control finish_at" id="Input2" value="{{ request()->query('finish_at') }}" placeholder="تا تاریخ">
                            <input autocomplete="off" type="hidden" id="finish_at" name="finish_at" value="{{ request()->query('finish_at') }}">
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="form-row col-12">
                        <div class="offset-9"></div>
                        <div class="form-group col-1 "">
                                    <a class=" btn btn-danger btn-block mr-1" href="{{route('ticket.index')}}">
                            <i class="fas fa-times"></i>
                            </a>
                        </div>
                        <div class="form-group col-2 vertical-align">
                            <button type="submit" name='search' value='1' class="btn btn-success btn-block mr-2 vertical-align d-flex justify-content-between align-items-center">
                                <span> جستجو موارد</span> <i class="fas fa-search vertical-align"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
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
                        <th>اطلاعات کاربر</th>
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
                        <td>
                            <div>
                                <a href="{{ route('user.show', $value->user->id)}}">
                                    <span>{{ $value->user->firstname }}</span>
                                    <span>{{ $value->user->lastname }}</span>
                                </a>
                            </div>
                            <div>
                                <small>{{ $value->user->mobile }}</small>
                            </div>
                            <div>
                                <small>{{ $value->user->email }}</small>
                            </div>
                            <div>
                                <small>{{ $value->user->national_code }}</small>
                            </div>
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
</div>






@endcomponent