@component('layouts.include.content' , ['title' => 'مدیریت کارمزد معاملات'])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="#">پنل مدیریت</a></li>
<li class="breadcrumb-item active">مدیریت کارمزد معاملات </li>
@endslot
@section('sidebar-commission','active')
@section('sidebar-currencies','active menu-open')


<div class="col-12">
    <div class="card shadow">
        <div class="card-body table-responsive p-0 ">
            <table class="table table-hover text-center">
                <tbody>
                    <tr>
                        <th>
                            <span> حجم معاملات ماهیانه از </span>
                            <sub class="text-muted">( تومان )</sub>
                        </th>
                        <th>
                            <span> حجم معاملات ماهیانه تا </span>
                            <sub class="text-muted">( تومان )</sub>
                        </th>
                        <th>درصد کارمزد</th>
                        @can('commission-update')
                        <th>عملیات</th>
                        @endcan
                    </tr>

                    @forelse( $data['commissions'] as $value)
                    <tr class="vertical-align">
                        <td>
                            {{ number_format($value->min_monthly_total_trades_irt) }}
                        </td>
                        <td>
                            {{ (number_format($value->max_monthly_total_trades_irt)) == 0 ? '∞' :(number_format($value->max_monthly_total_trades_irt))}}
                        </td>
                        <td>
                            {{ number_format($value->percent,2) }}
                        </td>


                        @can('commission-update')
                        <td>
                            <div class="d-flex justify-content-center align-items-center">
                                <a name="" id="" class="btn btn-primary btn-sm " href="{{ route('commission.edit',$value->id,'edit') }}" value="button">
                                    <i class="fas fa-pen-alt"></i>
                                </a>
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

    </div>
</div>



@endcomponent