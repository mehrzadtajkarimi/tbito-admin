@component('layouts.include.content' , ['title' => 'پیامهای تماس با ما'])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="/">پنل مدیریت</a></li>
<li class="breadcrumb-item active">پیامهای تماس با ما</li>
@endslot
@section('sidebar-ContactUs','active')


@can('user-wallet-read')
<div class="card shadow ">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-6 ">
                <div class="table-responsive-lg">
                    <table class="table table-hover table-bordered mb-0">
                        <tbody>
                            <tr class="text-center">
                                <th>اطلاعات تماس</th>
                                <th>تاریخ ثبت</th>
                                <th>تاریخ مشاهده</th>
                                <th>عملیات</th>
                            </tr>
                            <tr class="vertical-align text-center">
                                <td>
                                    <div>09128897603</div>
                                    <a href="3">mehrzad tajkarimi</a>
                                </td>
                                <td>
                                    <div>1399/11/19</div>
                                    <div>13:48</div>
                                </td>
                                <td>
                                    <div>1399/11/19</div>
                                    <div>13:48</div>
                                </td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-sm shadow" data-toggle="modal" data-target="#exampleModalLong">
                                        مشاهده
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis ullam quisquam velit, excepturi aperiam eveniet rerum perferendis exercitationem possimus quos, dolores omnis tenetur. Nulla facere corporis perspiciatis tempore animi architecto.
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endcan


@endcomponent