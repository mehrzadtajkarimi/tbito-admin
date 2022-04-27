@component('layouts.include.content' , ['title' => "تراکنشها {$data['currency']->title} "])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="/">پنل مدیریت</a></li>
<li class="breadcrumb-item active">تراکنشها</li>
@endslot
@section('sidebar-siteTransaction','active')
@section('sidebar-reports','active menu-open')



@can('currency-create')
<div class="card-tools d-flex flex-row-reverse mb-3">
  <a class="btn btn-success" href="{{ route('siteTransaction.create', ['currency'=>$data['currency']->id]) }}">
    ثبت تراکنش کیفهای خارجی
  </a>
</div>
@endcan
<div class="card shadow">

  <!-- /.card-header -->
  <table class="table table-hover">
    <thead>
      <div class="text-left p-2">
        <span>{{$data['site_transactions']->firstItem()}} تا</span>
        <span>{{$data['site_transactions']->lastItem()}} </span>
        / <span>{{$data['site_transactions']->total()}} مورد</span>
      </div>
    </thead>
    <tbody class="vertical-align text-center">
      <tr class="bg-light ">
        <th>#</th>
        <th>شناسه</th>
        <th>ارز</th>
        <th>مقدار / کارمزد</th>
        <th>موجودی</th>
        <th>تاریخ</th>

      </tr>
      @forelse($data['site_transactions'] as $value)
      <tr class="vertical-align">
        <td width="10px">{{$loop->index + $data['site_transactions']->firstItem() }}</td>
        <td>
          <span>{{ App\Helpers\TableCodeHelper::id2Code($value->id) }}<sub class="text-muted">/{{ $value->id }}</sub></span>
        </td>
        <td>
          <img class=" mb-2 " style="right: 11px;" src="{{ asset('/admin/dist/img/currency_photo/'.strtolower($value->currency->title).'.png') }}">
          <small class="">
            @if($value->sign > 0)
            <p class="{{ $value->sign > 0 ? 'text-success' : 'text-danger' }}">واریز</p>
            @else
            <p class="{{ $value->sign > 0 ? 'text-success' : 'text-danger' }}">برداشت</p>
            @endif
          </small>
        </td>
        <td>
          <div>
            <span>مقدار:</span>
            <span class="{{ $value->sign > 0 ? 'text-success' : 'text-danger' }}">{{ number_format($value->amount,$value->currency->decimals) }}</span>
          </div>
          <div>
            <small class="text-muted">کارمزد:</small>
            <small class="text-muted">{{ number_format($value->fee,$value->currency->decimals) }}</small>
          </div>
        </td>
        <td>
          {{ number_format($value->balance,$value->currency->decimals)  }}
          <p><small class="text-muted">{{ $value->currency->title}}</small></p>
        </td>
        <td>
          <div>
            <bdi class="arabic-num ">{{ \App\Helpers\DateTimeHelper::getDate($value->created_at->timestamp ?? '')  }}</bdi>
          </div>
          <div>
            <bdi class="arabic-num ">{{ \App\Helpers\DateTimeHelper::getTime($value->created_at->timestamp ?? '')  }}</bdi>
          </div>
        </td>

      </tr>
      <tr class="bg-light ">
        <td colspan="10">
          <div class="row">
            <div class="col d-flex align-items-center">
              <i class="fas fa-info-circle text-info vertical-align ml-2 "></i>
              <small>
                {{ $value->description ?? '--' }}
              </small>
            </div>
          </div>
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
  <div class="card-footer">
    <span class="float-left">
      {{ $data['site_transactions']->links()  }}
    </span>
  </div>
</div>
@endcomponent