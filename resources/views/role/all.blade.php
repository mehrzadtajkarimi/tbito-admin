@component('layouts.include.content' , ['title' => 'لیست نقش ها'])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="#">پنل مدیریت</a></li>
<li class="breadcrumb-item active">لیست نقش ها </li>
@endslot
@section('sidebar-role','active')
@section('sidebar-settings','active menu-open')


<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div class="card-body p-0">
                @can('permission-create')
                <div class="card-tools d-flex flex-row-reverse">
                    <a class="btn btn-success" href="{{ route('role.create') }}">
                        ایجاد نقش
                    </a>
                </div>
                @endcan
            </div>
        </div>
        <!-- /.card-header -->

        <div class="card-body table-responsive p-0 ">
            <table class="table table-hover text-center">
                <tbody>
                    <tr>
                        <th>ردیف</th>
                        <th>شرح</th>
                        <th>عنوان</th>
                        @can('permission-delete','permission-update')
                        <th>حذف / ویرایش</th>
                        @endcan
                    </tr>

                    @forelse($roles as $role)
                    <tr>
                        <td>{{$loop->index + $role->firstItem() }}</td>
                        <td>{{ $role->label }}</td>
                        <td>{{ $role->name }}</td>
                        @can('permission-delete','permission-update')
                        <td class="d-flex justify-content-center">
                            @can('permission-delete')
                            <form action="{{ route('role.destroy',$role->id) }}" onclick="return confirm('آیا آیتم مورد نظر حذف شود');" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm ml-2 ">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                            @endcan
                            @can('permission-update')
                            <a name="" id="" class="btn btn-primary btn-sm" href="{{ route('role.edit',$role->id,'edit') }}" role="button">
                                <i class="fas fa-pen-alt"></i>
                            </a>
                            @endcan
                        </td>
                        @endcan
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

        </div>
    </div>
</div>



@endcomponent