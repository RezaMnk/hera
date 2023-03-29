@extends('home.layouts.app')

@section('title', 'پروفایل')

@section('breadcrumb')
    <x-breadcrumb title="پروفایل" desc="اطلاعات حساب کاربری شما" />
@endsection

@section('content')
    <!-- check out section -->
    <div class="profile-section mt-100 mb-150">
        <div class="container">
            @admin
                <div class="row mb-5">
                    <div class="col-12 col-md-8 col-lg-4 offset-md-2 offset-lg-4">
                        <a href="{{ route('admin.index') }}" class="bordered-btn w-100 text-center">
                            ورود به پنل مدیریت
                        </a>
                    </div>
                </div>
            @endadmin
            <div class="row mb-4 align-items-center">
                <div class="col-6 col-md-4 user-name">
                    <p>
                        نام
                    </p>
                    <span>
                        {{ $user->name }}
                    </span>
                </div>
                <div class="col-6 col-md-4 user-name">
                    <p>
                        شماره تلفن
                    </p>
                    <span>
                        {{ $user->phone }}
                    </span>
                </div>
                <div class="col-12 col-md-4">
                    <div class="row">
                        <div class="col-7">
                            <a class="bordered-btn btn-small text-center w-100" data-toggle="modal" data-target="#edit-profile">
                                تغییر اطلاعات
                            </a>
                        </div>
                        <div class="col-5">
                            <form action="{{ route('logout') }}" method="post" class="">
                                @csrf
                                <button type="submit" class="boxed-btn btn-small text-center w-100">
                                    <i class="fa fa-turn-off"></i>
                                    خروج
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row mb-4 mt-100">
                <div class="col-6 d-flex align-items-center">
                    <h3>
                        آدرس های شما:
                    </h3>
                </div>
                @if($user->maps->count() < 5)
                    <div class="col-6 text-right">
                        <a class="boxed-btn btn-small" data-toggle="modal" onclick="add_map_modal()" data-target="#add">
                            افزودن آدرس
                        </a>
                    </div>
                @endif
            </div>
            <div class="card">
                <div class="card-body">
                    @forelse($user->maps as $map)
                        @unless($loop->first)
                            <hr>
                        @endunless
                        <div class="row py-3">
                            <div class="col-8">
                                <p>
                                    {{ $loop->iteration }}. {{ $map->address() }}
                                </p>
                            </div>
                            <div class="col-4 text-right">
                                <a class="address-edit" data-toggle="modal" onclick="update_map_modal({{ $map->id }})" data-target="#edit">
                                    ویرایش
                                </a>
                            </div>
                        </div>
                    @empty
                        آدرسی یافت نشد! با استفاده از دکمه بالا،‌آدرس جدید ثبت نمایید.
                    @endforelse
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12 mb-4">
                    <h3>
                        سفارش های اخیر:
                    </h3>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @forelse($orders as $order)
                                @unless($loop->first)
                                    <hr>
                                @endunless
                                <div class="row mb-3">
                                    <div class="col-4 col-md-3 col-lg-2">
                                        <p class="mb-0 mb-md-2">
                                            سفارش کد #{{ $order->id }}
                                        </p>
                                        <p class="d-block d-md-none order-date">
                                            <i class="fa fa-calendar"></i>
                                            {{ $order->created_at() }}
                                        </p>
                                    </div>
                                    <div class="col-4 d-none d-md-block order-date">
                                        <i class="fa fa-calendar"></i>
                                        {{ $order->created_at() }}
                                    </div>
                                    <div class="col-8 col-md-5 col-lg-6 order-total-price text-right">
                                        {{ number_format($order->total_price) }}
                                        <span>
                                            تومان
                                        </span>
                                    </div>
                                </div>
                                <div class="row pb-1">
                                    <div class="col-7">
                                        @foreach($order->products as $product)
                                            @if($loop->iteration < 4)
                                                <a href="{{ route('home.product', $product->slug) }}" class="order-product-image">
                                                    <img src="{{ $product->get_image() }}" alt="{{ $product->name }}">
                                                </a>
                                            @else
                                                <span class="more-products">
                                                    +{{ $order->products->count() - 3 }} محصول دیگر
                                                </span>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-5 text-right">
                                        <a href="{{ route('order.invoice', $order->id) }}" class="bordered-btn btn-small">
                                            مشاهده فاکتور
                                        </a>
                                    </div>
                                </div>
                            @empty
                                شما هیچ سفارشی ثبت نکرده اید.
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end check out section -->

    <div class="modal fade address-modal" id="edit-profile" tabindex="-1" role="dialog">
        <div class="modal-dialog modal modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ویرایش اطلاعات حساب کاربری</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti ti-close font-size-10"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('profile.update', $user->id) }}" method="post" class="row" id="update-profile">
                        @csrf

                        <div class="col-12 mb-3">
                            <label for="name">
                                نام و نام خانوادگی
                            </label>
                            <input type="text" placeholder="نام و نام خانوادگی" name="name" id="name" required value="{{ $user->name }}" @error('name') class="is-invalid" @enderror>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel-btn" data-dismiss="modal">لغو</button>
                    <button type="submit" class="boxed-btn" form="update-profile">
                        بروزرسانی
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade address-modal" id="edit" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ویرایش آدرس</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti ti-close font-size-10"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('map.update', $user->id) }}" method="post" class="row" id="update-maps">
                        @csrf
                        <input type="hidden" name="lat" id="update-lat">
                        <input type="hidden" name="long" id="update-long">
                        <input type="hidden" name="id" id="update-id">

                        <div class="col-12 mb-3">
                            <label for="update-address">
                                آدرس
                            </label>
                            <textarea placeholder="آدرس دقیق" name="address" id="update-address" required @error('address') class="is-invalid" @enderror></textarea>

                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="update-house_no">
                                پلاک
                            </label>
                            <input type="number" placeholder="پلاک" min="1" name="house_no" id="update-house_no" required @error('house_no') class="is-invalid" @enderror>

                            @error('house_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </form>
                    <div class="row mb-3 mt-3">
                        <div class="col-12">
                            انتخاب روی نقشه
                        </div>
                        <div class="col-12">
                            <div class="position-relative">
                                <div id="update-map" class="w-100"></div>
                                <div class="update-map-loading d-none">
                                    <div class="loading">
                                        <div class="spinner-grow text-danger" role="status">
                                            <span class="sr-only">در حال یافتن آدرس...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel-btn" data-dismiss="modal">لغو</button>
                    <button type="submit" class="boxed-btn" form="update-maps">
                        بروزرسانی
                    </button>
                </div>
            </div>
        </div>
    </div>

    @if($user->maps->count() < 5)
        <div class="modal fade address-modal" id="add" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">افزودن آدرس جدید</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="ti ti-close font-size-10"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('map.store', $user->id) }}" method="post" class="row" id="add-maps">
                            @csrf
                            <input type="hidden" name="lat" id="add-lat">
                            <input type="hidden" name="long" id="add-long">

                            <div class="col-12 mb-3">
                                <label for="add-address">
                                    آدرس
                                </label>
                                <textarea placeholder="آدرس دقیق" name="address" id="add-address" required @error('address') class="is-invalid" @enderror></textarea>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="add-house_no">
                                    پلاک
                                </label>
                                <input type="number" placeholder="پلاک" min="1" name="house_no" id="add-house_no" required @error('house_no') class="is-invalid" @enderror>

                                @error('house_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </form>
                        <div class="row mb-3 mt-3">
                            <div class="col-12">
                                انتخاب روی نقشه
                            </div>
                            <div class="col-12">
                                <div class="position-relative">
                                    <div id="add-map" class="w-100"></div>
                                    <div class="add-map-loading d-none">
                                        <div class="loading">
                                            <div class="spinner-grow text-danger" role="status">
                                                <span class="sr-only">در حال یافتن آدرس...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="cancel-btn" data-dismiss="modal">لغو</button>
                        <button type="submit" class="boxed-btn" form="add-maps">
                            افزودن
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('styles')
    <link href="https://static.neshan.org/sdk/leaflet/1.4.0/leaflet.css" rel="stylesheet" type="text/css">
@endsection

@push('scripts')
    <script src="https://static.neshan.org/sdk/leaflet/1.4.0/leaflet.js" type="text/javascript"></script>
    <script src="{{ asset('assets/js/checkout-maps.js') }}"></script>
    <script>
        icon = L.icon({
            iconUrl: '{{ asset('assets/icons/leaflet/location.svg') }}',
            iconSize: [38, 100],
            iconAnchor: [18, 67],
        });

        async function update_map_modal(id)
        {
            let map = await get_map(id);
            document.querySelector('#update-id').value = id;

            document.querySelector('#update-lat').value = map.lat;
            document.querySelector('#update-long').value = map.long;
            document.querySelector('#update-address').value = map.address;
            document.querySelector('#update-house_no').value = map.house_no;

            update_load_map(map.lat, map.long);
        }

        @if($user->maps->count() < 5)
            async function add_map_modal()
            {
                add_load_map(35.699758, 51.3359019);
            }
        @endif
    </script>
@endpush
