@component('layouts.include.content' , ['title' => 'فراخوانی های api'])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="#">پنل مدیریت</a></li>
<li class="breadcrumb-item active">فراخوانی های api</li>
@endslot
@section('sidebar-api-log','active')
@section('sidebar-settings','active menu-open')


<div class="col-12">
    <div class="card ">
        <div class="card-header">
            <div class="card-body ">
                <div class="card-tools">
                    <form action="{{route('api-log.index')}}" method='get'>
                        <div class="row">
                            <div class="form-row col-12">
                                <div class="form-group col">
                                    <select name="method" class="custom-select ">
                                        <option value=""> method </option>
                                        <option value="POST" {{  request()->query('method') == "POST" ? 'selected' : ''}}>POST</option>
                                        <option value="GET" {{  request()->query('method') == "GET" ? 'selected' : ''}}>GET</option>
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <input autocomplete="off" type="text" class="form-control" name="status" value="{{ request()->query('status') }}" placeholder="status">
                                </div>
                                <div class="form-group col">
                                    <select name="causer_id" class="custom-select">
                                        <option value=""> admin</option>
                                        @foreach($data['admins'] as $admin)
                                        <option value="{{ $admin->id }}" {{  request()->query('causer_id') == $admin->id  ? 'selected' : ''}}>{{ $admin->name }} {{ $admin->post }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <input autocomplete="off" type="text" class="form-control" name="user_id" value="{{ request()->query('user_id') }}" placeholder="userid">
                                </div>
                                <div class="form-group col">
                                    <select name="causer_type" class="custom-select">
                                        <option value=""> causertype </option>
                                        <option value="Admin" {{  request()->query('causer_type') == "Admin" ? 'selected' : ''}}>Admins</option>
                                        <option value="User" {{  request()->query('causer_type') == "User" ? 'selected' : ''}}>Users</option>
                                    </select>
                                </div>


                            </div>
                            <div class="form-row col-12">
                                <div class="form-group col-3">
                                    <input autocomplete="off" type="text" class="form-control start_at" id="Input1" value="{{ request()->query('start_at') }}" placeholder="از تاریخ">
                                    <input autocomplete="off" type="hidden" id="start_at" name="start_at" value="{{ request()->query('start_at') }}">
                                </div>
                                <div class="form-group col-3">
                                    <input autocomplete="off" type="text" class="form-control finish_at" id="Input2" value="{{ request()->query('finish_at') }}" placeholder="تا تاریخ">
                                    <input autocomplete="off" type="hidden" id="finish_at" name="finish_at" value="{{ request()->query('finish_at') }}">
                                </div>
                                <div class="form-group col">
                                    <input autocomplete="off" type="text" class="form-control" name="url" value="{{ request()->query('url') }}" placeholder="url">
                                </div>
                                <div class="form-group col">
                                    <input autocomplete="off" type="text" class="form-control" name="ip" value="{{ request()->query('ip') }}" placeholder="ip">
                                </div>
                            </div>
                            <div class="form-row col-12">
                                <div class="offset-9"></div>
                                <div class="form-group col-1 "">
                                    <a class=" btn btn-danger btn-block mr-1" href="{{route('api-log.index')}}">
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
                        <span>Showing {{$data['apiLog']->firstItem()}} to {{$data['apiLog']->lastItem()}}</span>
                        <span>of {{$data['apiLog']->total()}} </span>
                    </div>
                </thead>
                <tbody>
                    <tr>
                        <th>#</th>
                        <th>role</th>
                        <th>causer</th>
                        <th>status</th>
                        <th>ip</th>
                        <th>url</th>
                        <th>date</th>
                        <th>more</th>
                    </tr>
                    @forelse ($data['apiLog'] as $value)
                    <tr class="vertical-align">
                        <td>{{$loop->index + $data['apiLog']->firstItem() }}</td>
                        <td>{{$value->causer_type ?? '--'}}</td>
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
                        <td>{{$value->status ?? '--'}}</td>
                        <td>
                            <span title="{{ $value->user_agent ?? '--' }}">{{ $value->ip ?? '--' }}</span>
                        </td>
                        <td class="text-sm">
                            <span>{{ $value->method ?? '***'}}</span><br>
                            <small class="text-danger">{{ substr( $value->url,0, strpos( $value->url, "api")) ?? '--'}}</small><br>
                            <span class="text-muted">{{ substr( $value->url, strpos( $value->url, "api")) ?? '--'}}</span>
                        </td>
                        <td>
                            <span>{{ \Carbon\Carbon::parse($value->created_at)->format('Y/m/d - H:i')}}</span> <br>
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
                            <pre class="ltr text-left ">{!! json_encode(json_decode($value->params), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}</pre>
                            <pre class="ltr text-left json-word-break">{!! json_encode(json_decode($value->response), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}</pre>
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
                {{ $data['apiLog']->links()  }}
            </span>
        </div>
    </div>
</div>

@endcomponent