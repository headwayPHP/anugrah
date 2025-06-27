@extends('admin.pages.dashboard')


@section('sub-section')
    @php
        $contacts = \Illuminate\Support\Facades\DB::table('req_requests')->orderBy('created_at', 'desc')->get();
    @endphp

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Registration requests</h4>
        <!-- Button to open modal for creating course -->

    </div>
    <div class="table-responsive scrollbar">
        <table class="table table-hover">
            <thead>
                <tr class="bg-grey text-black">
                    <th>#ID</th>
                    <th>Name</th>
                    <th>DOB</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>City</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $i => $req)
                    <tr class="hover-actions-trigger {{ $loop->odd ? 'bg-light' : '' }}">
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $req->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($req->dob)->format('d-m-Y') }}</td>
                        <td>{{ $req->gender }}</td>
                        <td>{{ $req->phone }}</td>
                        <td>{{ $req->email }}</td>
                        <td>{{ $req->city }}</td>
                        <td>
                            <form method="POST" action="{{ route('req_requests.updateStatus', $req->id) }}">
                                @csrf
                                <select name="status" onchange="this.form.submit()"
                                    class="form-select @if ($req->status == 'resolved') bg-success text-white @endif">
                                    <option value="pending" {{ $req->status == 'pending' ? 'selected' : '' }}>pending
                                    </option>
                                    <option value="resolved" {{ $req->status == 'resolved' ? 'selected' : '' }}>resolved
                                    </option>
                                </select>
                            </form>
                        </td>
                        <td>
                            {{-- <a href="{{ route('req_requests.show', $req->id) }}" class="btn btn-info btn-sm">View</a> --}}
                            <a href="{{ route('req_requests.show', $req->id) }}" class="btn btn-sm "
                                data-bs-toggle="tooltip" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
