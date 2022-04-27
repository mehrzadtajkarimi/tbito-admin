@component('layouts.include.content' , ['title' => 'داشبورد'])

@slot('breadcrumb')
<li class="breadcrumb-item active">داشبورد</li>
@endslot
@section('sidebar-dashboard','active')

<div class="col-lg-12">
    <div class="card">
        <div class="card-header no-border">
            <div class="d-flex justify-content-between">
                <h3 class="card-title">فروش</h3>
                <a href="javascript:void(0);">مشاهده گزارش</a>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex">
                <p class="d-flex flex-column">
                    <span class="text-bold text-lg">تومان ۱۸,۲۳۰.۰۰</span>
                    <span>فروش در طول زمان</span>
                </p>
                <p class="mr-auto d-flex flex-column text-right">
                    <span class="text-success">
                        <i class="fa fa-arrow-up"></i> ۳۳.۱%
                    </span>
                    <span class="text-muted">از ماه گذشته</span>
                </p>
            </div>
            <!-- /.d-flex -->

            <div class="position-relative mb-4">
                <div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                    <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                    </div>
                </div>
                <canvas id="sales-chart" height="200" width="765" class="chartjs-render-monitor" style="display: block; width: 765px; height: 200px;"></canvas>
            </div>

            <div class="d-flex flex-row justify-content-end">
                <span class="ml-2">
                    <i class="fa fa-square text-primary"></i> امسال
                </span>

                <span>
                    <i class="fa fa-square text-gray"></i> سال گذشته
                </span>
            </div>
        </div>
    </div>
</div>
<!-- <h2>Admin Panel</h2> -->

@endcomponent