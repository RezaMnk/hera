@extends('admin.layouts.app')


@section('title', 'کاربران')

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
                        <table class="table table-striped table-bordered dtr-inline" role="grid" style="width: 100%;">
                            <thead>
                            <tr role="row">
                                <th>شناسه</th>
                                <th>نام</th>
                                <th>شماره تلفن</th>
                                <th>زمان ایجاد</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $k => $user)
                                <tr role="row" class="{{ $loop->odd ? 'odd' : 'even' }}">
                                    <td>
                                        {{ $user->id }}
                                    </td>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td class="ls-1">
                                        {{ $user->phone }}
                                    </td>
                                    <td>
                                        {{ $user->created_at() }}
                                    </td>
                                    <td>
                                        @if(auth()->user()->is_owner())
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-floating">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            <button class="btn btn-danger btn-floating" onclick="document.getElementById('delete-submit').value = {{ $user->id }}" data-toggle="modal" data-target="#delete">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr role="row">
                                    <td colspan="5">
                                        کاربری یافت نشد!
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $users->appends(['search' => request('search')])->links() }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف کاربر</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti ti-close font-size-10"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>آیا از حذف کاربر مطمئنید ؟</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">لغو</button>
                    <form action="{{ route('admin.users.destroy') }}" method="post">
                        @csrf
                        <button type="submit" name="id" value="0" id="delete-submit" class="btn btn-danger">
                            <i class="fa fa-check m-r-5"></i>
                            حذف کاربر
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
