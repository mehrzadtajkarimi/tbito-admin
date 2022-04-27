@component('layouts.include.content' , ['title' => 'لیست ادمین ها '])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="{{ url('/') }}">پنل مدیریت</a></li>
<li class="breadcrumb-item active">لیست ادمین ها</li>
@endslot
@section('sidebar-admins','active')
@section('sidebar-settings','active menu-open')


<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div class="card-body p-0">
                @can('permission-create')
                <div class="card-tools d-flex flex-row-reverse">
                    <a class="btn btn-success " role="button" href="{{ route('admins.create') }}">
                        ایجاد ادمین
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
                        <th>ردیف</th>
                        <th>نام</th>
                        <th>سمت</th>
                        <th>ایمیل</th>
                        <th>وضعیت</th>
                        <th>ورود دو عاملی</th>
                        @canany('permission-delete','permission-update')
                        <th>اقدامات</th>
                        @endcan
                    </tr>
                    @forelse ($data['admins'] as $admin)

                    <tr>
                        @if($admin->is_super_admin)
                        <td>
                            <i class="fas fa-star text-warning"></i>
                        </td>
                        @else
                        <td>{{ $loop->iteration }}</td>
                        @endif
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->post }}</td>
                        <td>{{ $admin->email }}</td>
                        @if ($admin->enabled === 1)
                        <td>
                            <i class="fas fa-check text-success"></i>
                        </td>
                        @else
                        <td>
                            <i class="fas fa-times text-danger"></i>
                        </td>
                        @endif

                        @if ( $admin->google2fa)
                        <td>
                            <i class="fas fa-check text-success"></i>
                        </td>
                        @else
                        <td>
                            <i class="fas fa-times text-danger"></i>
                        </td>
                        @endif

                        <td class="d-flex justify-content-center">
                            @if(!$admin->is_super_admin)
                            @can('permission-delete')
                            <form action="{{ route('admins.destroy',$admin->id) }}" onclick="return confirm('آیا آیتم مورد نظر حذف شود');" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm ml-2">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                            @endcan
                            @endif
                            @can('permission-update')
                            <a name="" id="" class="btn btn-primary btn-sm" href="{{ route('admins.edit',$admin->id,'edit') }}" role="button">
                                <i class="fas fa-pen-alt"></i>
                            </a>
                            @endif
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



@endcomponent