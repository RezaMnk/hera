@extends('admin.layouts.app')

@section('title', 'محصولات')

@section('content')
    <div class="card">
        <div class="card-body">
            <div>
                <div class="row align-items-end">
                    <div class="col-6">
                        @owner
                        <a class="btn btn-primary mb-2" href="{{ route('admin.products.create') }}">افزودن</a>
                        @endowner
                    </div>
                    <div class="col-6">
                        <form class="d-flex justify-content-end">

                            <label for="search">جستجو:
                                <input type="search" id="search" class="form-control form-control-sm" name="search" value="{{ request('search') ?? '' }}">
                            </label>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 table-responsive">
                        <table class="table table-striped table-bordered dtr-inline" role="grid" style="width: 100%;">
                            <thead>
                            <tr role="row">
                                <th>کد</th>
                                <th>نام</th>
                                <th>قیمت</th>
                                <th>زمان ایجاد</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($products as $k => $product)
                                <tr role="row" class="{{ $loop->odd ? 'odd' : 'even' }}">
                                    <td>
                                        {{ $product->id }}
                                    </td>
                                    <td>
                                        <img src="{{ $product->get_image() }}" alt="{{ $product->name }}" class="mr-2" width="50px">
                                        <span>
                                            {{ $product->name }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($product->price > 0)
                                            {{ number_format($product->price) }} تومان
                                        @else
                                            ناموجود
                                        @endif
                                    </td>
                                    <td>
                                        {{ $product->created_at() }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.products.edit', $product->id) }}">
                                            <button type="button" class="btn btn-warning btn-floating">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('home.product', $product->slug) }}">
                                            <button type="button" class="btn btn-success btn-floating">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </button>
                                        </a>
                                        @owner
                                        <button class="btn btn-danger btn-floating" onclick="document.getElementById('delete-submit').value = {{ $product->id }}" data-toggle="modal" data-target="#delete">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                        @endowner
                                    </td>
                                </tr>
                            @empty
                                <tr role="row">
                                    <td colspan="5">
                                        محصولی یافت نشد!
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $products->withQueryString()->links('vendor.pagination.admin', ['search' => request('search')]) }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف محصول</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti ti-close font-size-10"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>آیا از حذف محصول مطمئنید ؟</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">لغو</button>
                    @owner
                    <form action="{{ route('admin.products.destroy') }}" method="post">
                        @csrf
                        <button type="submit" name="id" value="0" id="delete-submit" class="btn btn-danger">
                            <i class="fa fa-check m-r-5"></i>
                            حذف محصول
                        </button>
                    </form>
                    @endowner
                </div>
            </div>
        </div>
    </div>
@endsection
