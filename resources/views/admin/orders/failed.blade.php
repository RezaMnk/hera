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
                                    <th class="d-none d-md-table-cell">آدرس</th>
                                    <th>شماره تراکنش</th>
                                    <th class="d-none d-md-table-cell">زمان ایجاد</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($orders as $k => $order)
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
                                    <td class="d-none d-md-table-cell">
                                        {{ $order->map->address() }}
                                    </td>
                                    <td>
                                        {{ ltrim($order->transaction_id, '0') }}
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        {{ $order->created_at() }}
                                    </td>
                                </tr>
                            @empty
                                <tr role="row">
                                    <td colspan="7">
                                        سفارشی یافت نشد!
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $orders->withQueryString()->links('vendor.pagination.admin', ['search' => request('search')]) }}
            </div>
        </div>
    </div>
@endsection

@section('footer-assets')
    <script src="{{ asset('admin/vendors/dataTable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/dataTable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/dataTable/jquery.dataTables.min.js') }}"></script>
@endsection

