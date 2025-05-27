<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReqRequest;
use Illuminate\Http\Request;

class ReqRequestController extends Controller
{
    public function index()
    {
        $requests = ReqRequest::all();
        return view('admin.req_requests.index', compact('requests'));
    }

    public function show($id)
    {
        $user = ReqRequest::findOrFail($id);
        return view('admin.req_requests.show', compact('user'));
    }

    public function updateStatus(Request $request, $id)
    {
        $req = ReqRequest::findOrFail($id);
        $req->status = $request->input('status', 'resolved');
        $req->save();

        return redirect()->back()->with('success', 'Status updated.');
    }
}
