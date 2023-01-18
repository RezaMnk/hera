@extends('admin.layouts.app')


@section('title', 'سفارشات')

@section('content')
    <div class="card">
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row align-items-end">
                    <div class="col-12">
                        <form class="d-flex justify-content-end">

                            <label for="search">جستجو:
                                <input type="search" id="search" class="form-control form-control-sm" name="search" value="{{ request('search') ?? '' }}">
                            </label>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 table-responsive">
                        <table class="table table-striped table-bordered dataTable dtr-inline" role="grid" style="width: 100%;">
                            <thead>
                                <tr role="row">
                                    <th>شماره سفارش</th>
                                    <th>نام</th>
                                    <th>شماره تلفن</th>
                                    <th>آدرس</th>
                                    <th>زمان ایجاد</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $k => $order)
                                <tr role="row" class="{{ $loop->odd ? 'odd' : 'even' }}">
                                    <td>
                                        {{ $order->id }}
                                    </td>
                                    <td>
                                        <span>
                                            {{ $order->user->name }}
                                        </span>
                                    </td>
                                    <td class="ls-1">
                                        {{ $order->user->phone }}
                                    </td>
                                    <td>
                                        {{ $order->map->address() }}
                                    </td>
                                    <td>
                                        {{ $order->created_at() }}
                                    </td>
                                    <td>
                                        <a href="{{ route('order.invoice', $order->id) }}" class="btn btn-primary btn-floating">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-warning btn-floating">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $orders->appends(['search' => request('search')])->links() }}
            </div>
        </div>
    </div>
@endsection

@section('footer-assets')
    <script src="{{ asset('admin/vendors/dataTable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/dataTable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/dataTable/jquery.dataTables.min.js') }}"></script>
@endsection

