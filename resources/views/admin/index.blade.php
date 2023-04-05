@extends('admin.layouts.app')


@section('title', 'داشبورد')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h6>آمار کلی وبسایت</h6>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="card border mb-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div>
                                    <div class="icon-block icon-block-sm bg-warning icon-block-floating mr-2">
                                        <i class="fa fa-exclamation-circle"></i>
                                    </div>
                                </div>
                                <a href="{{ route('admin.orders.index') }}" class="font-size-13">سفارشات دیده نشده</a>
                                <h2 class="mb-0 ml-auto font-weight-bold text-warning primary-font line-height-30">{{ $statistics->orders_not_read->read }} از {{ $statistics->orders_not_read->new }}</h2>
                            </div>
                            <div class="progress" style="height: 5px">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $statistics->orders_not_read->read_diff_percent }}%" aria-valuenow="{{ $statistics->orders_not_read->read_diff_percent }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 mt-2 mt-md-0">
                    <div class="card border mb-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div>
                                    <div class="icon-block icon-block-sm bg-success icon-block-floating mr-2">
                                        <i class="fa fa-tag"></i>
                                    </div>
                                </div>
                                <a href="{{ route('admin.orders.index') }}" class="font-size-13">کدتخفیف های فعال</a>
                                <h2 class="mb-0 ml-auto font-weight-bold text-success primary-font line-height-30">{{ $statistics->active_discounts->all }} از {{ $statistics->active_discounts->new }}</h2>
                            </div>
                            <div class="progress" style="height: 5px">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $statistics->active_discounts->expire_at_diff_percent }}%" aria-valuenow="{{ $statistics->active_discounts->expire_at_diff_percent }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card">
                <div class="card-header">کل کاربران</div>
                <div class="card-body text-center">
                    <div class="mb-2">
                        <span class="bar-4">{{ join(',', $statistics->users->daily) }}</span>
                    </div>
                    <div class="font-size-40 font-weight-bold text-danger">{{ number_format($statistics->users->new) }}</div>
                    <p class="m-b-0">
                        <i class="fa {{ $statistics->users->increased ? 'fa-caret-up text-success' : 'fa-caret-down text-danger' }} m-r-5"></i> {{ $statistics->users->new_diff_percent }} % {{ $statistics->users->increased ? 'افزایش' : 'کاهش' }} نسبت به هفته پیش
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card">
                <div class="card-header">کل سفارشات</div>
                <div class="card-body text-center">
                    <div class="mb-2">
                        <span class="bar-5">{{ join(',', $statistics->orders->daily) }}</span>
                    </div>
                    <div class="font-size-40 font-weight-bold text-warning">{{ number_format($statistics->orders->new) }}</div>
                    <p class="m-b-0">
                        <i class="fa {{ $statistics->orders->increased ? 'fa-caret-up text-success' : 'fa-caret-down text-danger' }} m-r-5"></i> {{ $statistics->orders->new_diff_percent }} % {{ $statistics->orders->increased ? 'افزایش' : 'کاهش' }} نسبت به هفته پیش
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card">
                <div class="card-header">کل محصولات</div>
                <div class="card-body text-center">
                    <div class="mb-2">
                        <span class="bar-6">{{ join(',', $statistics->products->daily) }}</span>
                    </div>
                    <div class="font-size-40 font-weight-bold text-info">{{ number_format($statistics->products->new) }}</div>
                    <p class="m-b-0">
                        <i class="fa {{ $statistics->products->increased ? 'fa-caret-up text-success' : 'fa-caret-down text-danger' }} m-r-5"></i> {{ $statistics->products->new_diff_percent }} % {{ $statistics->products->increased ? 'افزایش' : 'کاهش' }} نسبت به هفته پیش
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card">
                <div class="card-header">کل کدتخفیف ها</div>
                <div class="card-body text-center">
                    <div class="mb-2">
                        <span class="bar-3">{{ join(',', $statistics->discounts->daily) }}</span>
                    </div>
                    <div class="font-size-40 font-weight-bold text-success">{{ number_format($statistics->discounts->new) }}</div>
                    <p class="m-b-0">
                        <i class="fa {{ $statistics->discounts->increased ? 'fa-caret-up text-success' : 'fa-caret-down text-danger' }} m-r-5"></i> {{ $statistics->discounts->new_diff_percent }} % {{ $statistics->discounts->increased ? 'افزایش' : 'کاهش' }} نسبت به هفته پیش
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    جدیدترین سفارشات
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-default p-0 font-size-11">
                        مشاهده همه
                    </a>
                </div>
                <div class="card-body py-2">
                    <ul class="list-group list-group-flush">
                        @forelse(\App\Models\Order::query()->latest()->take(4)->get() as $order)
                            <li class="list-group-item d-flex align-items-center p-l-r-0">
                                <div>
                                    <h6 class="m-b-0 primary-font">سفارش شماره {{ $order->id }}</h6>
                                    <small class="text-muted">{{ $order->user->name }} - {{ $order->user->phone }}</small>
                                </div>
                                @if($order->read)
                                    <span class="badge badge-success ml-auto">مشاهده شده</span>
                                @else
                                    <span class="badge badge-warning ml-auto">در انتظار بررسی</span>
                                @endif
                            </li>
                        @empty
                            <li class="list-group-item d-flex align-items-center p-l-r-0">
                                <div>
                                    <h6 class="m-b-0 primary-font">تا کنون سفارشی ثبت نشده است.</h6>
                                </div>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    جدیدترین کاربران
                    <a href="{{ route('admin.users.index') }}" class="btn btn-default p-0 font-size-11">
                        مشاهده همه
                    </a>
                </div>
                <div class="card-body py-2">
                    <ul class="list-group list-group-flush">
                        @foreach(\App\Models\User::query()->latest()->take(4)->get() as $user)
                            <li class="list-group-item d-flex align-items-center p-l-r-0">
                                <div>
                                    <h6 class="m-b-0 primary-font">{{ $user->name }}</h6>
                                    <small class="text-muted">{{ $user->phone }}</small>
                                </div>
                                @if($user->admin)
                                    <span class="badge badge-warning ml-auto">مدیر سایت</span>
                                @else
                                    <span class="badge badge-info ml-auto">مشتری</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-assets')
    <script src="{{ asset('admin/js/examples/charts/peity.js') }}"></script>
@endsection
