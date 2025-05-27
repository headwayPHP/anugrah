@extends('admin.pages.dashboard')


@section('sub-section')<nav style="--falcon-breadcrumb-divider: '»';" aria-label="breadcrumb">
    <ol class="breadcrumb d-flex justify-content-between">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Library</li>
        <li class="breadcrumb-item ms-auto">
            <button class="btn btn-outline-primary rounded-pill me-1 mb-1" type="button"><a href="javascript:history.back()" >Back</a></button>

        </li>
    </ol>
</nav>

<div class="row g-3 mb-3">
    <div class="col-xxl-6">
        <div class="card font-sans-serif">
            <div class="card-body d-flex gap-3 flex-column flex-sm-row align-items-center">
                <img class="rounded-3" src="{{ asset('images/profile/' . $user->profile_photo) }}" alt="" width="112">
                <table class="table table-borderless fs--1 fw-medium mb-0">
                    <tbody>
                    <tr>
                        <td class="p-1" style="width: 35%;">ID:</td>
                        <td class="p-1 text-600">{{ $user->id }}</td>
                    </tr>
                    <tr>
                        <td class="p-1">Name:</td>
                        <td class="p-1 text-600">{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td class="p-1">Date of Birth:</td>
                        <td class="p-1 text-600">{{  \Carbon\Carbon::parse($user->dob)->format('d-m-Y') ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="p-1">Gender:</td>
                        <td class="p-1 text-600">{{ ucfirst($user->gender) ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="p-1">Phone:</td>
                        <td class="p-1">
                            <a class="text-600 text-decoration-none" href="tel:{{ $user->phone }}">{{ $user->phone }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">Email:</td>
                        <td class="p-1">
                            <a class="text-600 text-decoration-none" href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">Address:</td>
                        <td class="p-1 text-600">{{ $user->address }}</td>
                    </tr>
                    <tr>
                        <td class="p-1">City:</td>
                        <td class="p-1 text-600">{{ $user->city }}</td>
                    </tr>
                    <tr>
                        <td class="p-1">Status:</td>
                        <td class="p-1 text-600">{{ ucfirst($user->status) }}</td>
                    </tr>
                    <tr>
                        <td class="p-1">Joined:</td>
                        <td class="p-1 text-600">{{ $user->created_at->format('Y/m/d H:i') }}</td>
                    </tr>
                    <tr>
                        <td class="p-1">Last Updated:</td>
                        <td class="p-1 text-600">{{ $user->updated_at->format('Y/m/d H:i') }}</td>
                    </tr>
                    </tbody>
                </table>

                <div class="dropdown btn-reveal-trigger position-absolute top-0 end-0 m-3">
                    <button class="btn btn-link btn-reveal text-600 btn-sm dropdown-toggle dropdown-caret-none" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-h fs--2"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="userDropdown">
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
