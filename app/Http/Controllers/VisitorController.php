<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VisitorController extends Controller
{
    public function dashboard()
    {
        $recent = Visitor::latest('Serial')->take(5)->get();
        $active = Visitor::where('Status', 'Active')->count();
        $today = Visitor::whereDate('Date', today())->count();

        return view('visitors.dashboard', compact('recent', 'active', 'today'));
    }

    public function create()
    {
        return view('visitors.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'Name' => ['required', 'string', 'max:100'],
            'Contact' => ['required', 'string', 'max:20'],
            'Purpose' => ['required', 'string', 'max:150'],
            'meetingTo' => ['required', 'string', 'max:100'],
            'Comment' => ['nullable', 'string', 'max:500'],
        ]);

        $duplicate = Visitor::where('Name', $data['Name'])
            ->where('Contact', $data['Contact'])
            ->whereDate('Date', today())
            ->where('Status', 'Active')
            ->exists();

        if ($duplicate) {
            return back()
                ->withInput()
                ->withErrors(['Name' => 'This visitor is already active today.']);
        }

        $visitor = Visitor::create([
            ...$data,
            'Date' => today(),
            'TimeIN' => now(),
            'TimeOUT' => null,
            'Status' => 'Active',
        ]);

        $visitor->receipt_id = random_int(100000, 999999);
        $visitor->save();

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Visitor added successfully! Receipt ID: ' . $visitor->receipt_id
            );
    }

    public function checkout(Request $request)
    {
        $data = $request->validate([
            'receipt_id' => ['required', 'integer']
        ]);

        $visitor = Visitor::where('receipt_id', $data['receipt_id'])
            ->where('Status', 'Active')
            ->first();

        if (!$visitor) {
            return back()->withErrors([
                'receipt_id' => 'Invalid Receipt ID or visitor already checked out.'
            ]);
        }

        $visitor->update([
            'TimeOUT' => now(),
            'Status' => 'Checked Out'
        ]);

        return back()->with('success', 'Visitor checked out successfully!');
    }

    public function checkedOut(Request $request)
    {
        $query = Visitor::where('Status', 'Checked Out');

        if ($request->filled('date')) {
            $query->whereDate('Date', $request->date);
        }

        $visitors = $query
            ->latest('Serial')
            ->paginate(12)
            ->withQueryString();

        return view('visitors.list', [
            'visitors' => $visitors,
            'title' => 'Checked Out Visitors',
            'routeName' => 'visitors.checkedout'
        ]);
    }

    public function index(Request $request)
    {
        $query = Visitor::query();

        if ($request->filled('date')) {
            $query->whereDate('Date', $request->date);
        }

        if (
            $request->filled('status') &&
            in_array($request->status, ['Active', 'Checked Out'])
        ) {
            $query->where('Status', $request->status);
        }

        if ($request->filled('search')) {
            $s = $request->search;

            $query->where(function ($q) use ($s) {
                $q->where('Name', 'like', "%$s%")
                  ->orWhere('Contact', 'like', "%$s%")
                  ->orWhere('meetingTo', 'like', "%$s%");
            });
        }

        $visitors = $query
            ->latest('Serial')
            ->paginate(12)
            ->withQueryString();

        return view('visitors.list', [
            'visitors' => $visitors,
            'title' => 'All Visitors',
            'routeName' => 'visitors.index'
        ]);
    }
}