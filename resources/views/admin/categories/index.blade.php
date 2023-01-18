@extends('admin.layouts.app')

@section('title', 'دسته بندی ها')

@section('content')
    <div class="card">
        <div class="card-body">
            <div>
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
                    @if(isset($category))
                        <form action="{{ route('admin.categories.update', $category->id) }}" method="post" class="col-4" enctype="multipart/form-data">
                            @method('PATCH')
                    @else
                        <form action="{{ route('admin.categories.store') }}" method="post" class="col-4" enctype="multipart/form-data">
                    @endif
                        @csrf

                        <div class="row">
                            <div class="col-12">
                                <h6 class="card-title">ایجاد / تغییر دسته بندی</h6>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="d-block">
                                        <input name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="نام دسته بندی" type="text" @if(isset($category)) value="{{ $category->name }}" @endif>
                                    </label>

                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="custom-file mb-4">
                                    <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="image" accept="image/*">
                                    <label class="custom-file-label" for="image">انتخاب فایل تصویر</label>

                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">افزودن دسته جدید</button>
                            </div>
                        </div>
                    </form>
                    <div class="col-7 offset-1 mt-5 table-responsive">
                        <table class="table table-striped table-bordered dtr-inline" role="grid" style="width: 100%;">
                            <thead>
                            <tr role="row">
                                <th>تصویر</th>
                                <th>نام</th>
                                <th>زمان ایجاد</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $k => $category)
                                <tr role="row" class="{{ $loop->odd ? 'odd' : 'even' }}">
                                    <td>
                                        <img src="{{ $category->get_image() }}" alt="{{ $category->name }}" class="mr-2" width="50px">
                                    </td>
                                    <td>
                                        <span>
                                            {{ $category->name }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $category->created_at() }}
                                    </td>
                                    <td>
                                        @unless($category->id == 1)
                                            <a href="{{ route('admin.categories.edit', $category->id) }}">
                                                <button type="button" class="btn btn-warning btn-floating">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                            <button class="btn btn-danger btn-floating" onclick="document.getElementById('delete-submit').value = {{ $category->id }}" data-toggle="modal" data-target="#delete">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        @endunless
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $categories->appends(['search' => request('search')])->links() }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف دسته بندی</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti ti-close font-size-10"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>آیا از حذف دسته بندی مطمئنید ؟</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">لغو</button>
                    <form action="{{ route('admin.categories.destroy') }}" method="post">
                        @csrf
                        <button type="submit" name="id" value="0" id="delete-submit" class="btn btn-danger">
                            <i class="fa fa-check m-r-5"></i>
                            حذف دسته
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
