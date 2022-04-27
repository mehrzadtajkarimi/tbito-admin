@component('layouts.include.content' , ['title' => 'ریز فعالیت مدیران'])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="#">پنل مدیریت</a></li>
<li class="breadcrumb-item active">ریز فعالیت مدیران</li>
@endslot
@section('sidebar-activity-log','active')
@section('sidebar-settings','active menu-open')



<div class="col-12">
    <div class="card ">
        <div class="card-header">
            <div class="card-body ">
                <div class="card-tools">
                    <form action="{{route('activity-log.index')}}" method='get' autocomplete="off">
                        <div class="row">
                            <div class="form-row col-12">
                                <div class="form-group col">
                                    <input autocomplete="off" type="text" class="form-control" name="subject_id" value="{{ request()->query('subject_id') }}" placeholder="modelid">
                                </div>
                                <div class="form-group col">
                                    <input autocomplete="off" type="text" class="form-control" name="subject_type" value="{{ request()->query('subject_type') }}" placeholder="model">
                                </div>
                                <div class="form-group col">
                                    <input autocomplete="off" type="text" class="form-control" name="user_id" value="{{ request()->query('user_id') }}" placeholder="userid">
                                </div>
                                <div class="form-group col">
                                    <select name="causer_id" class="custom-select mr-sm-2">
                                        <option value=""> admin</option>
                                        @foreach($data['admins'] as $admin)
                                        <option value="{{ $admin->id }}" {{  request()->query('causer_id') == $admin->id  ? 'selected' : ''}}>{{ $admin->name }} {{ $admin->post }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <select name="action_type" class="custom-select mr-sm-2">
                                        <option value=""> actiontype </option>
                                        <option value="created" {{  request()->query('action_type') == "created" ? 'selected' : ''}}>create</option>
                                        <option value="updated" {{  request()->query('action_type') == "updated" ? 'selected' : ''}}>update</option>
                                        <option value="deleted" {{  request()->query('action_type') == "deleted" ? 'selected' : ''}}>delete</option>
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <select name="causer_type" class="custom-select mr-sm-2">
                                        <option value=""> causertype </option>
                                        <option value="Admin" {{  request()->query('causer_type') == "Admin" ? 'selected' : ''}}>Admins</option>
                                        <option value="User" {{  request()->query('causer_type') == "User" ? 'selected' : ''}}>Users</option>
                                    </select>
                                </div>

                            </div>
                            <div class="form-row col-12">
                                <div class="form-group col-3">
                                    <!-- <input autocomplete="off" type="text" class="form-control start_at"  id="Input1"  name="date_start" placeholder="از تاریخ"> -->
                                    <input autocomplete="off" type="text" class="form-control start_at" id="Input1" value="{{ request()->query('start_at') }}" placeholder="از تاریخ">
                                    <input autocomplete="off" type="hidden" id="start_at" name="start_at" value="{{ request()->query('start_at') }}">
                                </div>
                                <div class="form-group col-3">
                                    <!-- <input autocomplete="off" type="text" class="form-control finish_at"  id="Input2"  name="date_end" placeholder="تا تاریخ"> -->
                                    <input autocomplete="off" type="text" class="form-control finish_at" id="Input2" value="{{ request()->query('finish_at') }}" placeholder="تا تاریخ">
                                    <input autocomplete="off" type="hidden" id="finish_at" name="finish_at" value="{{ request()->query('finish_at') }}">
                                </div>
                            </div>
                            <div class="form-row col-12">
                                <div class="offset-9"></div>
                                <div class="form-group col-1 "">
                                    <a class=" btn btn-danger btn-block mr-1" href="{{route('activity-log.index')}}">
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
            </div>
        </div>
        <!-- /.card-header -->

        <div class="card-body table-responsive p-0  ltr">
            <table class="table table-hover text-center ">
                <thead>
                    <div class="text-left m-2">
                        <span>Showing {{$data['activityLog']->firstItem()}} to {{$data['activityLog']->lastItem()}}</span>
                        <span>of {{$data['activityLog']->total()}} </span>
                    </div>
                </thead>
                <tbody>
                    <tr>
                        <th>#</th>
                        <th>role</th>
                        <th>causer</th>
                        <th>model</th>
                        <th>id</th>
                        <th>activity</th>
                        <th>date</th>
                        <th>more</th>
                    </tr>
                    @forelse ($data['activityLog'] as $value)
                    <tr class="vertical-align">
                        <td>{{$loop->index + $data['activityLog']->firstItem() }}</td>
                        <td class="text-sm">
                            {{ $value->causer_type ?? '***'}}
                        </td>
                        <td>
                            @if($value->causer_type == 'Admin')
                            <span>{{ $value->causer->name ?? '--' }}</span><br>
                            <small class="text-muted">{{ $value->causer->post ?? '--'}}</small>
                            @elseif($value->causer_type == 'User')
                            <span>{{ $value->causer->lastname .' '.$value->causer->firstname ?? '--' }}</span><br>
                            <small class="text-muted">{{ $value->causer->mobile ?? '--'}}</small>
                            @else
                            <span>****</span><br>
                            <small class="text-muted">**</small>
                            @endif
                        </td>
                        <td>{{ $value->subject_type }}</td>
                        <td>{{ $value->subject_id }}</td>
                        <td>{{ $value->description }}</td>
                        <td>
                            <span>{{ \Carbon\Carbon::parse($value->created_at)->format('Y/m/d - H:i')}}</span> <br>
                            <!-- <span>{{ $value->created_at }}</span> <br> -->
                            <span class="arabic-num">{{ App\Helpers\DateTimeHelper::getDateTime($value->created_at->timestamp, "Y/m/d - H:i") }}</span>
                        </td>
                        <td>
                            <a href="#" type="button" data-toggle="collapse" data-target="#more{{$value->id}}" aria-expanded="false" aria-controls="more">
                                <img src="{{ asset('/admin/dist/img/add.png')}}" alt="more">
                            </a>
                        </td>
                    </tr>
                    <tr class="collapse multi-collapse " id="more{{$value->id}}">
                        <td colspan="10" id="attr">
                            <pre class="ltr text-left">{!! json_encode($value->properties, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}</pre>
                            </pre>
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
                {{ $data['activityLog']->links()  }}
            </span>
        </div>
    </div>
</div>

@endcomponent