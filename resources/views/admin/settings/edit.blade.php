@extends('admin.pages.dashboard')

@section('sub-section')
    <div class="container mt-4">
        <h2>Edit Site Settings</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @foreach($settings as $setting)
                @php $label = ucwords(str_replace('_', ' ', $setting->name)); @endphp

                @if($setting->name === 'banner')
                    <div class="form-group mb-3">
                        <label for="banner">{{ $label }} Image</label><br>
                        @if($setting->value)
                            <img src="{{ asset($setting->value) }}" width="200" class="mb-2" alt="Banner">
                        @endif
                        <input type="file" name="banner" class="form-control">
                    </div>
                @elseif($setting->name === 'colour')
                    <div class="form-group mb-3">
                        <label for="colour">{{ $label }}</label>
                        <input type="color" name="colour" value="{{ $setting->value }}" class="form-control form-control-color">
                    </div>
                @else
                    <div class="form-group mb-3">
                        <label for="{{ $setting->name }}">{{ $label }}</label>
                        <input type="text" name="{{ $setting->name }}" value="{{ $setting->value }}" class="form-control">
                    </div>
                @endif
            @endforeach

            <button type="submit" class="btn btn-primary">Save Settings</button>
        </form>
    </div>
@endsection
