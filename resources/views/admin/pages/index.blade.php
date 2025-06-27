@extends('admin.pages.dashboard')

@section('sub-section')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            {{ session('success') }}
        </div>

        <script>
            setTimeout(function() {
                let alert = document.getElementById('success-alert');
                if (alert) {
                    // Start fading out
                    alert.classList.remove('show');
                    alert.classList.add('fade');
                    // Then remove after transition
                    setTimeout(() => alert.remove(), 500); // wait for fade transition
                }
            }, 2000); // 2000ms = 2 seconds
        </script>
    @endif

    @php
        $pages = \App\Models\Page::latest()->get();
    @endphp

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Pages Management</h4>
        <a href="{{ route('pages.create') }}" class="btn btn-primary btn-sm">
            + Add New Page
        </a>
    </div>

    <div class="table-responsive scrollbar">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pages as $i => $page)
                    <tr class="hover-actions-trigger {{ $loop->odd ? 'bg-light' : '' }}">
                        <td class="align-middle">{{ $i + 1 }}</td>
                        <td class="align-middle text-nowrap">{{ $page->title }}</td>
                        <td class="align-middle text-nowrap">
                            @if ($page->image)
                                <img src="{{ asset($page->image) }}" alt="Page Image" class="img-thumbnail"
                                    style="max-width: 50px;">
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td class="align-middle">
                            <form action="{{ route('pages.toggle-status', $page->id) }}" method="POST">
                                @csrf
                                <select name="status"
                                    class="form-select form-select-sm w-auto {{ $page->status ? 'bg-success text-white' : 'bg-danger text-white' }}"
                                    onchange="this.form.submit()">
                                    <option value="1" {{ $page->status ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !$page->status ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </form>
                        </td>
                        <td class="align-middle text-nowrap">{{ $page->created_at->format('d-m-Y') }}</td>
                        <td class="align-middle text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <!-- Edit Button -->
                                <a href="{{ route('pages.edit', $page->id) }}" class="btn btn-sm " title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('pages.destroy', $page->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this page?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm " title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-3">No pages found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($errors->has('status'))
            <div class="text-danger mt-2">
                {{ $errors->first('status') }}
            </div>
        @endif
    </div>
@endsection
