@php
    if (!isset($spaces))
        $spaces = 0;
    $tab = str_repeat('---- ', $spaces);
@endphp
@foreach($categories as $category)
    @if($spaces == 0 && !$loop->first)
        <hr class="my-1">
    @endif
        <div>
            <span class="dash-line">{!! $tab !!} </span>
            <div class="custom-control custom-radio d-inline">
                <input type="radio" class="custom-control-input" name="category" value="{{ $category->id }}" {{ (old('category') ?? (isset($product) ? $product->categories->first()->id : '')) == $category->id ? 'checked' : '' }} id="category-{{ $category->id }}" required>
                <label class="custom-control-label" for="category-{{ $category->id }}">{{ $category->name }}</label>
            </div>
        </div>
    @if (count($category->children))
        @include('admin.partials.categories.shop', ['categories' => $category->children, 'spaces' => $spaces + 1])
    @endif
@endforeach
