@extends('admin.pages.dashboard')


@section('sub-section')
    @php
        $contacts = \Illuminate\Support\Facades\DB::table('contact_requests')->get();
    @endphp
    <div class="table-responsive scrollbar">
        <table class="table table-hover">
            <thead>
            <tr>
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
            @foreach($requests as $req)
                <tr>
                    <td>{{ $req->id }}</td>
                    <td>{{ $req->name }}</td>
                    <td>{{  \Carbon\Carbon::parse($req->dob)->format('d-m-Y') }}</td>
                    <td>{{ $req->gender }}</td>
                    <td>{{ $req->phone }}</td>
                    <td>{{ $req->email }}</td>
                    <td>{{ $req->city }}</td>
                    <td>
                        <form method="POST" action="{{ route('req_requests.updateStatus', $req->id) }}">
                            @csrf
                            <select name="status" onchange="this.form.submit()" class="form-select @if($req->status == 'resolved') bg-success text-white @endif">
                                <option value="pending" {{ $req->status == 'pending' ? 'selected' : '' }}>pending</option>
                                <option value="resolved" {{ $req->status == 'resolved' ? 'selected' : '' }}>resolved</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('req_requests.show', $req->id) }}" class="btn btn-info btn-sm">View</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

@endsection
