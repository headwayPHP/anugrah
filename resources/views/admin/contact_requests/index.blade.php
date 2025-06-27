@extends('admin.pages.dashboard')


@section('sub-section')
    @php
        $contacts = \Illuminate\Support\Facades\DB::table('contact_requests')->orderBy('created_at', 'desc')->get();
    @endphp

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Contact requests</h4>
        <!-- Button to open modal for creating course -->

    </div>
    <div class="table-responsive scrollbar">
        <table class="table table-hover">
            <thead>
                <tr class="bg-grey text-black">
                    <th scope="col">#ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created</th>
                    {{--                <th scope="col" class="text-end">Actions</th> --}}
                </tr>
            </thead>
            <tbody>

                @foreach ($contacts as $i => $contact)
                    <tr class="hover-actions-trigger {{ $loop->odd ? 'bg-light' : '' }}">
                        <td class="align-middle">{{ $i + 1 }}</td>
                        <td class="align-middle text-nowrap">{{ $contact->name }}</td>
                        <td class="align-middle text-nowrap">{{ $contact->email }}</td>
                        <td class="align-middle text-nowrap">{{ $contact->phone }}</td>
                        {{--                    <td class="align-middle">{{ $contact->message }}</td> --}}
                        <td class="align-middle">
                            <form action="{{ route('contact.updateStatus', $contact->id) }}" method="POST">
                                @csrf
                                @method('POST')

                                <select name="status"
                                    class="form-select form-select-sm w-auto {{ $contact->status == 'resolved' ? 'bg-success text-white' : '' }}"
                                    onchange="this.form.submit()">
                                    <option value="pending" {{ $contact->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="resolved" {{ $contact->status == 'resolved' ? 'selected' : '' }}>Resolved
                                    </option>
                                </select>
                            </form>
                        </td>


                        <td class="align-middle text-nowrap">
                            {{ \Illuminate\Support\Carbon::parse($contact->created_at)->format('Y-m-d') }}</td>
                        {{--                    <td class="align-middle text-end"> --}}
                        {{--                        <div class="btn-group btn-group-sm"> --}}
                        {{--                            <button class="btn btn-light" data-bs-toggle="tooltip" title="Edit"> --}}
                        {{--                                <i class="fas fa-edit"></i> --}}
                        {{--                            </button> --}}
                        {{--                            <button class="btn btn-light" data-bs-toggle="tooltip" title="Delete"> --}}
                        {{--                                <i class="fas fa-trash-alt"></i> --}}
                        {{--                            </button> --}}
                        {{--                        </div> --}}
                        {{--                    </td> --}}


                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
@endsection
