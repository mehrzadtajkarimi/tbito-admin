@component('layouts.include.content' , ['title' => 'اسلاید شو'])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="#">پنل مدیریت</a></li>
<li class="breadcrumb-item active">اسلاید شو </li>
@endslot
@section('sidebar-slideshow','active')
@section('sidebar-contents','active menu-open')

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div class="card-body p-0">
                @can('slideshow-create')
                <div class="card-tools d-flex flex-row-reverse">
                    <a class="btn btn-success" href="{{ route('slideshow.create') }}">
                        ایجاد اسلاید شو
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
                        <th>اولویت</th>
                        <th>عنوان</th>
                        <th>تصویر</th>
                        <th>لینک</th>

                        @can('slideshow-update')
                        <th>عملیات</th>
                        @endcan
                    </tr>

                    <tr class="vertical-align">
                        <td>
                            1
                        </td>
                        <td>
                            بیت کویین
                        </td>
                        <td>
                            <img class=" img-fluid img-circle " width="20%" src="{{ asset('/admin/dist/img/logo-web.png')}}" alt="User profile picture">
                        </td>
                        <td>
                            <a href="#">لینک</a>
                        </td>
                        @can('slideshow-delete','slideshow-update')
                        <td>
                            <div class="d-flex justify-content-center align-items-center">
                                @can('slideshow-delete')
                                <form action="{{ route('slideshow.destroy',1) }}" onclick="return confirm('آیا آیتم مورد نظر حذف شود');" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm ml-2 ">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                                @endcan
                                @can('slideshow-update')
                                <a name="" id="" class="btn btn-primary btn-sm " href="{{ route('slideshow.edit',1,'edit') }}" value="button">
                                    <i class="fas fa-pen-alt"></i>
                                </a>
                                @endcan
                            </div>
                        </td>
                        @endcan
                    </tr>
                    <tr class="alert alert-secondary" value="alert">
                        <td colspan="10">
                            آیتمی برای نمایش وجود ندارد
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <span class="float-left">
                {{ $data['slideshows']->links()  }}
            </span>
        </div>
    </div>
</div>



@endcomponent