@component('layouts.include.content' , ['title' => 'لیست دسترسی ها'])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="#">پنل مدیریت</a></li>
<li class="breadcrumb-item active">لیست دسترسی ها </li>
@endslot
@section('sidebar-permission','active')
@section('sidebar-settings','active menu-open')


<div class="col-12">
    <div class="card ">
        <div class="card-header">
            <div class="card-body p-0">
                <div class="card-tools d-flex flex-row-reverse">
                    @can('permission-create')
                    <!-- Button trigger modal -->
                    <button id="button-Order" type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                        ایجاد دسترسی
                    </button>
                    <!-- Modal -->
                    @endcan

                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999 !important;">
                        <div class="modal-lg modal-dialog-centered modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">فرم ایجاد دسترسی</h5>
                                    <button type="button" class="close m-0 p-0" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('permission.store') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <div class="card border-0 ">

                                                <div class="card-body">
                                                    <div class="form-row ">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <input autocomplete="off" type="text" class="form-control ltr text-left @error('name') is-invalid @enderror" name="name" placeholder="دسترسی (انگلیسی)" required autocomplete="name" value="{{ old('name') }}">
                                                                @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <input autocomplete="off" type="text" class="form-control @error('label') is-invalid @enderror" name="label" placeholder="شرح دسترسی (فارسی)" required autocomplete="label" value="{{ old('label') }}">
                                                                @error('label')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary ml-2 mr-2" data-dismiss="modal">بازگشت
                                        </button>
                                        <button type="submit" class="btn btn-info ml-2 mr-2">ذخیره اطلاعات</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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

                    @forelse ($permissions as $permission)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $permission->label }}</td>
                        <td>{{ $permission->name }}</td>
                        @can('permission-delete','permission-update')
                        <td class="d-flex justify-content-center">
                            @can('permission-delete')
                            <form action="{{ route('permission.destroy',$permission->id) }}" method="post" onclick="return confirm('آیا آیتم مورد نظر حذف شود');">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm ml-2 ">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                                <!-- Modal -->
                            </form>
                            @endcan
                            @can('permission-update')
                            <a name="" id="" class="btn btn-primary btn-sm" href="{{ route('permission.edit',$permission->id,'edit') }}" role="button">
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