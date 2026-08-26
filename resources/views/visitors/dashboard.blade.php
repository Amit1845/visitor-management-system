@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Dashboard</h2>
        <p class="text-muted mb-0">Visitor Management System</p>
    </div>

    <a href="{{ route('visitors.create') }}" class="btn btn-primary">
        + Add Visitor
    </a>
</div>

<div class="row g-3 mb-4">

    <div class="col-md-4">
        <div class="stat-card">
            <div class="text-muted">Today's Visitors</div>
            <div class="stat-number">{{ $today }}</div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card">
            <div class="text-muted">Active Visitors</div>
            <div class="stat-number">{{ $active }}</div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card">
            <div class="text-muted">Recent Records</div>
            <div class="stat-number">{{ $recent->count() }}</div>
        </div>
    </div>

</div>

<div class="row g-4">

    <!-- Check Out Visitor -->
    <div class="col-lg-5">
        <div class="card shadow-sm">
            <div class="card-body">

                <h5>Check Out Visitor</h5>

                <form
                    method="POST"
                    action="{{ route('visitors.checkout') }}"
                    class="d-flex gap-2"
                >

                    @csrf

                    <input
                        name="receipt_id"
                        class="form-control"
                        placeholder="Receipt ID"
                        required
                    >

                    <button class="btn btn-primary">
                        Check Out
                    </button>

                </form>

                @if ($errors->has('receipt_id'))
                    <div class="text-danger mt-2">
                        {{ $errors->first('receipt_id') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success mt-3 mb-0">
                        {{ session('success') }}
                    </div>
                @endif

            </div>
        </div>
    </div>

    <!-- Recent Visitors -->
    <div class="col-lg-7">

        <div class="card shadow-sm">
            <div class="card-body">

                <h5>Recent Visitors</h5>

                <div class="table-responsive">

                    <table class="table align-middle">

                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Receipt</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($recent as $v)

                                <tr>

                                    <td>
                                        {{ $v->Name }}
                                    </td>

                                    <td>
                                        {{ $v->receipt_id }}
                                    </td>

                                    <td>

                                        <span
                                            class="badge {{ $v->Status === 'Active' ? 'text-bg-success' : 'text-bg-secondary' }}"
                                        >
                                            {{ $v->Status }}
                                        </span>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="3"
                                        class="text-muted"
                                    >
                                        No visitors found.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>
        </div>

    </div>

</div>

@endsection