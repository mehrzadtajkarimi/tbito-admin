@component('layouts.include.content' , ['title' => ''])

@slot('breadcrumb')

@endslot
@section('sidebar-aaa','active')
@section('sidebar-contents','active menu-open')


@include('users.menu')

<div class="card shadow">
  <div class="card-header border-0 p-4">
    <div class="row">
      <div class="col">
        <img class="" src="{{ asset('/admin/dist/img/currency_photo/'.strtolower($data['currency']->title).'.png') }}">
        <h3 class="card-title  d-inline"> گردش حساب و تراکنش های {{ $data['currency']->name_fa }}</h3>
      </div>
      <div class="col">
        <form action="{{ route('user.checkWallet',$data['user']->id)}}" method="POST" class="form-check-wallet">
          @method('POST')
          @csrf
          <button type="button" class="btn btn-warning  float-left form-check-wallet-btn">
            <i class='btn-text'>بررسی حساب</i>
          </button>
          @include('scripts.script-check-wallet')
        </form>
      </div>
    </div>
  </div>
  <!-- /.card-header -->
  <table class="table table-hover">
    <thead>
      <div class="text-left pb-2 pl-2">
        <span>{{$data['transaction']->firstItem()}} تا</span>
        <span>{{$data['transaction']->lastItem()}} </span>
        / <span>{{$data['transaction']->total()}} مورد</span>
      </div>
    </thead>
    <tbody class="vertical-align text-center">
      <tr class="bg-light ">
        <th>#</th>
        <th>شناسه</th>
        <th>نوع</th>
        <th>مقدار / کارمزد</th>
        <th>موجودی</th>
        <th>تاریخ</th>
        <th>توضیحات</th>
      </tr>
      @forelse($data['transaction'] as $value)
      <tr class="vertical-align">
        <td width="10px">{{$loop->index + $data['transaction']->firstItem() }}</td>
        <td>
          <span>{{ App\Helpers\TableCodeHelper::id2Code($value->id) }}<sub class="text-muted">/{{ $value->id }}</sub></span>
        </td>
        <td>
          @if($value->transactionable_type === 'ReferralFee' )
          <div>رفـــرال</div>
          <div>{{ $value->market ? $value->market->title : ''}}</div>
          <div>
            @if($value->order_side == 1)
            <p>خرید</p>
            @elseif($value->order_side == 2)
            <p>فروش</p>
            @endif
          </div>
          @elseif($value->transactionable_type === 'Order' )
          <div class=" mb-1">
            <span class="market_image">
              <img class="ml-2 position-relative " style="right: 11px;" src="{{ asset('/admin/dist/img/currency_photo/'.strtolower($value->market->currency2->title).'.png') }}">
              <img class=" position-relative " style="left: 11px;" src="{{ asset('/admin/dist/img/currency_photo/'.strtolower($value->market->currency1->title).'.png') }}">
            </span>
          </div>
          <div class="mb-1 {{ $value->sign > 0 ? 'text-success' : 'text-danger' }}">
            @if($value->order_side == 1)
            <small>خرید</small>
            @elseif($value->order_side == 2)
            <small>فروش</small>
            @endif
          </div>
          <div>
            <h5>
              <a href="{{ route('order.index',['id' => $value->transactionable_id, 'is_robot'=> 1]) }}" class="badge badge-secondary">
                <small>{{ App\Helpers\TableCodeHelper::id2Code($value->transactionable_id) }}<sub class="">/{{ $value->transactionable_id }}</sub></small>
              </a>
            </h5>
          </div>
          @elseif($value->transactionable_type === 'Deposit')
          <div>واریز</div>
          <div>
            @if($value->creation_type == 1)
            <small>سیستمی</small>
            @elseif($value->creation_type == 2)
            <small>دستی</small>
            @endif
            @if($value->internal === 1)
            <small class="d-block">انتقال داخلی</small>
            @endif
          </div>
          <div class="mt-1">
            <h5>
              <a href="{{ $value->currency_id == 1 ? route('deposits-irt.index',['id' => $value->transactionable_id]) : route('deposits.index',['id' => $value->transactionable_id]) }}" class="badge badge-secondary">
                <small>{{ App\Helpers\TableCodeHelper::id2Code($value->transactionable_id) }}<sub class="">/{{ $value->transactionable_id }}</sub></small>
              </a>
            </h5>
          </div>
          @elseif($value->transactionable_type === 'Withdraw')
          <div>برداشت</div>
          <div>
            @if($value->creation_type == 1)
            <small>سیستمی</small>
            @elseif($value->creation_type == 2)
            <small>دستی</small>
            @endif
            @if($value->internal === 1)
            <small class="d-block">انتقال داخلی</small>
            @endif
          </div>
          <div class="mt-1">
            <h5>
              <a href="{{ $value->currency_id == 1 ? route('withdrawIrt.index',['id' => $value->transactionable_id]) : route('withdraw.index',['id' => $value->transactionable_id]) }}" class="badge badge-secondary">
                <small>{{ App\Helpers\TableCodeHelper::id2Code($value->transactionable_id) }}<sub class="">/{{ $value->transactionable_id }}</sub></small>
              </a>
            </h5>
          </div>
          @endif
        </td>
        <td>
          <div>
            <span>مقدار:</span>
            <span class="{{ $value->sign > 0 ? 'text-success' : 'text-danger' }}">{{ number_format($value->amount,$value->currency->decimals) }}</span>
          </div>
          <small>
            <span>کارمزد:</span>
            <span>{{ number_format($value->fee_user,$value->currencyFee->decimals)}}</span>
            <span class="text-muted">{{ $value->currencyFee->title}}</span>
          </small>
          @if($value->transactionable_type === 'ReferralFee')
          <small>
            <span>کاربر:</span>
            <a href="{{ route('user.show',$value->order_user_id) }}">{{$value->orderUserId ? $value->orderUser->fullname : '' }}</a>
          </small>
          @endif
          @if($value->transactionable_type === 'Order' && !empty($value->fee_referral))
          <div>
            <span>رفرال:</span>
            <span>{{ number_format($value->fee_referral, $value->currency->decimals) }}</span>
          </div>
          @endif
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
        <td>
          <a href="#" type="button" data-toggle="collapse" data-target="#more{{$value->id}}" aria-expanded="false" aria-controls="more">
            <img src="{{ asset('/admin/dist/img/add.png')}}" alt="more">
          </a>
        </td>
      </tr>
      <tr class="bg-light collapse multi-collapse text-right" id="more{{$value->id}}">
        <td colspan="10">
          <ul class="mb-0" style='list-style-position:inside;'>

            @if($value->transactionable_type === 'Order' )
            <li>{{ ( $value->order_side == 1)? 'خرید' : 'فروش' }} {{ number_format($value->order_amount , $value->market->currency1->decimals) }} واحد {{ $value->market->currency1->title }} به قیمت میانگین {{ number_format($value->order_price_avg , $value->market->currency2->decimals) }} {{ $value->market->currency2->title }}</li>
            @endif

            @if(!empty($value->address) )
            <li>کیف یول {{ $value->address }} تگ {{ !empty($value->tag) ? $value->tag : '' }}</li>
            @endif

            @if(!empty($value->iban_num) )
            <li>شبا : IR{{ $value->iban_num }}</li>
            @endif

            @if(!empty($value->tracking_code) )
            <li>کد پیگیری : {{ $value->tracking_code }}</li>
            @endif

            @if(!empty($value->card_num) )
            <li>شماره کارت : {{ $value->card_num }}</li>
            @endif

            @if(!empty($value->description) )
            <li> {{ $value->description }}</li>
            @endif

            @if(!empty($value->txid) )
            <li> {{ $value->txid }}</li>
            @endif

          </ul>
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
      {{ $data['transaction']->links()  }}
    </span>
  </div>
</div>
@endcomponent