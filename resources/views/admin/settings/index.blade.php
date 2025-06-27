@extends('admin.pages.dashboard')

@section('sub-section')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Settings</h4>
        <a href="{{ route('admin.settings.edit', 1) }}" class="btn btn-primary btn-sm">Edit Settings</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr class="bg-grey text-black">
                    <th scope="col">#ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Value</th>
                    <th scope="col">Status</th>
                    <th scope="col">Group</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($settings as $setting)
                    <tr>
                        <td>{{ $setting->id }}</td>
                        <td>{{ $setting->name }}</td>
                        <td>{{ $setting->value }}</td>
                        <td>{{ $setting->status == 1 ? 'Active' : 'Inactive' }}</td>
                        <td>{{ $setting->group }}</td>
                        <td>{{ $setting->desc }}</td>
                        <td>
                            <a href="{{ route('admin.settings.edit', $setting->id) }}"
                                class="btn btn-sm btn-warning">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
