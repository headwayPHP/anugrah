<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use Illuminate\Http\Request;

class ContactRequestController extends Controller
{
    public function index()
    {
        $requests = ContactRequest::latest()->paginate(15);
        return view('admin.contact_requests.index', compact('requests'));
    }

    public function show($id)
    {
        $request = ContactRequest::findOrFail($id);
        return view('admin.contact_requests.show', compact('request'));
    }

    public function destroy($id)
    {
        $request = ContactRequest::findOrFail($id);
        $request->delete();

        return redirect()->route('admin.contact-requests.index')->with('success', 'Contact request deleted.');
    }

    public function updateStatus(Request $request, $id)
    {
        $contact = ContactRequest::findOrFail($id);
        $contact->status = $request->input('status', 'resolved');
        $contact->save();

        return redirect()->back()->with('success', 'Status updated.');
    }
}
