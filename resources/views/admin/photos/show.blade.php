@extends('admin.pages.dashboard')

@section('sub-section')
    @php use Carbon\Carbon; @endphp

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Photo Details</h4>
        <a href="{{ route('photos.index') }}" class="btn btn-secondary btn-sm">← Back to Gallery</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-4">
                    <img src="{{ asset('images/photos/' . $photo->image) }}" alt="{{ $photo->alt_text }}"
                         class="img-fluid rounded" style="max-height: 250px; object-fit: cover;">
                </div>

                <div class="col-md-8">
                    <h5 class="mb-3">{{ $photo->title }}</h5>

                    <p><strong>Alt Text:</strong> {{ $photo->alt_text }}</p>
                    <p>
                        <strong>Status:</strong>
                        <span class="badge {{ $photo->status ? 'bg-success' : 'bg-danger' }}">
                            {{ $photo->status ? 'Active' : 'Inactive' }}
                        </span>
                    </p>
                    <p>
                        <strong>Featured:</strong>
                        <span class="badge {{ $photo->is_featured ? 'bg-success' : 'bg-secondary' }}">
                            {{ $photo->is_featured ? 'Yes' : 'No' }}
                        </span>
                    </p>
                    <p>
                        <strong>Uploaded:</strong>
                        {{ $photo->created_at ? Carbon::parse($photo->created_at)->format('d-m-Y') : 'N/A' }}
                    </p>

                    <div class="mt-3 d-flex gap-2">
                        <a href="{{ route('photos.edit', $photo->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>

                        <form action="{{ route('photos.destroy', $photo->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt me-1"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
