@extends('admin.layouts.app')


@section('title', 'تنظیمات')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.settings.update') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-8">
                        <h4>
                            بروزرسانی تنظیمات وبسایت
                        </h4>
                    </div>
                    <div class="col-4 text-right">
                        <button type="submit" class="btn btn-primary">
                            بروزرسانی
                        </button>
                    </div>
                </div>
                @foreach($settings as $setting)
                    <div class="row py-3">
                        <div class="col-12 col-lg-3 offset-lg-2 text-lg-right">
                            <label for="setting_{{ $setting->id }}">
                                {{ $setting->name }}
                            </label>
                        </div>
                        <div class="col-12 col-lg-4">
                            <input id="setting_{{ $setting->id }}" name="values[{{ $setting->id }}]" class="form-control @error('values.'. $setting->id) is-invalid @enderror" value="{{ $setting->value }}">

                            @error('values.'. $setting->id)
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                @endforeach
            </form>
        </div>
    </div>
@endsection
