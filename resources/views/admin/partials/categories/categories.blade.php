<ol class="dd-list">
    @foreach($list as $item)
        <li class="dd-item" data-id="{{ $item->id }}">
            <div class="nested-list-item {{ isset($category) ? $category->id == $item->id ? 'bg-light' : '' : '' }}">
                {{ $item->name }}
                @unless(isset($category) && $category->id == $item->id)
                    <a href="{{ route('admin.categories.edit', $item->id) }}" class="btn btn-default p-0 ml-2 ml-md-5 font-size-11 text-primary">
                        ویرایش
                    </a>
                    <form action="{{ route('admin.categories.destroy', $item->id) }}" method="post" class="d-inline-block pr-2">
                        @csrf
                        @method('delete')
                        <button class="btn btn-default p-0 ml-2 font-size-11 text-danger">
                            حذف
                        </button>
                    </form>
                @endunless
            </div>
            @if(count($item->children))
                @include('admin.partials.categories.categories', ['list' => $item->children])
            @endif
        </li>
    @endforeach
</ol>
