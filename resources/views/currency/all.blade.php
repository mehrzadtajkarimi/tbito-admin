@component('layouts.include.content' , ['title' => 'مدیریت رمز ارزها'])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="#">پنل مدیریت</a></li>
<li class="breadcrumb-item active">مدیریت رمز ارز ها </li>
@endslot
@section('sidebar-currency','active')
@section('sidebar-currencies','active menu-open')


<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div class="card-body p-0">
                @can('currency-create')
                <div class="card-tools d-flex flex-row-reverse">
                    <a class="btn btn-success" href="{{ route('currency.create') }}">
                        ایجاد رمز ارز
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
                        <th>شناسه</th>
                        <th class="text-right pr-5">عنوان</th>
                        <th>حداقل برداشت</th>
                        <th>کارمزد برداشت</th>
                        <th>تعداد ارقام اعشار</th>
                        <th>تعداد تایید شبکه</th>
                        <th> شبکه</th>
                        <th> تگ</th>
                        <th> فعال</th>
                        @can('currency-delete','currency-update')
                        <th>عملیات</th>
                        @endcan
                    </tr>

                    @forelse( $data['currencies'] as $value)
                    <tr class="vertical-align">
                        <td>{{$value->sort}}</td>
                        <td>
                            <span>{{ $value->id }}</span>
                        </td>
                        <td>
                            <div class="row text-right">
                                <div class="col-3 mt-3">
                                    <img class="ml-2" src="{{ asset('/admin/dist/img/currency_photo/'.strtolower($value->title).'.png') }}" alt="بیت‌کوین">
                                </div>
                                <span class="col-9">
                                    <div>{{ $value->title }}</div>
                                    <div>{{ $value->name_en }}</div>
                                    <div>{{ $value->name_fa }}</div>
                                </span>
                            </div>
                        </td>
                        <td>{{ $value->withdraw_min ? number_format($value->withdraw_min,$value->decimals) : '--' }}</td>
                        <td>{{ $value->withdraw_fee ? number_format($value->withdraw_fee,$value->decimals) : '--' }}</td>
                        <td>{{ $value->decimals }}</td>
                        <td>{{ $value->deposit_confirm_count ?? '--' }}</td>
                        <td>
                            @if($value->has_networks)
                            <i class="fas fa-check text-success"></i>
                            @else
                            <i class="fas fa-times text-danger"></i>
                            @endif
                        </td>
                        <td>
                            @if(empty($value->tag_name))
                            <i class="fas fa-times text-danger"></i>
                            @else
                            <i class="fas fa-check text-success"></i>
                            <small class="d-block">{{ $value->tag_name }}</small>
                            @endif
                        </td>
                        <td>
                            @if($value->status)
                            <i class="fas fa-check text-success"></i>
                            @else
                            <i class="fas fa-times text-danger"></i>
                            @endif
                        </td>
                        @can('currency-delete','currency-update')
                        <td>
                            <div class="d-flex justify-content-center align-items-center">
                                @can('permission-delete')
                                <form action="{{ route('currency.destroy',$value->id) }}" onclick="return confirm('آیا آیتم مورد نظر حذف شود');" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm ml-2 ">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                                @endcan
                                @can('currency-update')
                                <a name="" id="" class="btn btn-primary btn-sm " href="{{ route('currency.edit',$value->id,'edit') }}" value="button">
                                    <i class="fas fa-pen-alt"></i>
                                </a>
                                @endcan
                            </div>
                        </td>
                        @endcan
                    </tr>
                    @empty
                    <tr class="alert alert-secondary" value="alert">
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
                {{ $data['currencies']->links()  }}
            </span>
        </div>
    </div>
</div>



@endcomponent