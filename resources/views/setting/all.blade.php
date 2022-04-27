@component('layouts.include.content' , ['title' => 'تنظیمات سایت'])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="{{ url('/') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item active">تنظیمات سایت</li>
@endslot
@section('sidebar-site-setting','active')
@section('sidebar-settings','active menu-open')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <h3>

                        <div class="card-tools">
                            @can('site-settings-create')
                            <div class="card-tools d-flex flex-row-reverse">
                                <a class="btn btn-success " role="button" href="{{ route('site-setting.create') }}">
                                    ایجاد تنظیمات
                                </a>
                            </div>
                            @endcan
                        </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-center">
                    <tbody>
                        <tr>
                            <th>#</th>
                            <th>tag</th>
                            <th>key</th>
                            <th>title</th>
                            <th>text</th>
                            <th>value</th>
                            @canany('site-settings-delete','site-settings-update')
                            <th>edit / delete</th>
                            @endcan
                        </tr>
                        @forelse($data['siteSetting'] as $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $value->tag  }}</td>
                            <td>{{ $value->key  }}</td>
                            <td>{{ $value->title  }}</td>
                            <td>{{ $value->text  }}</td>
                            <td>{{ $value->value  }}</td>
                            <td class="d-flex justify-content-center">
                                @can('site-settings-delete')
                                <form action="{{ route('site-setting.destroy',$value->id) }}" onclick="return confirm('آیا آیتم مورد نظر حذف شود');" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm ml-2">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                                @endcan
                                @can('site-settings-update')
                                <a name="" id="" class="btn btn-primary btn-sm" href="{{ route('site-setting.edit',$value->id,'edit') }}" role="button">
                                    <i class="fas fa-pen-alt"></i>
                                </a>
                                @endcan
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
        </div>
    </div>
</div>



@endcomponent