@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold">Dashboard</h2>

        <p class="text-muted">
            Welcome back, {{ auth()->user()->name }}!
        </p>
    </div>

    <span class="badge bg-primary p-2">
        {{ ucfirst(auth()->user()->role) }}
    </span>

</div>

<div class="row g-4 mb-4">

    <div class="col-md-6 col-xl-3">
        <div class="card stat-card shadow-sm">

            <div class="text-muted">Registered Targets</div>

            <h2 class="fw-bold mt-2">
                {{ $statistics['targets'] }}
            </h2>

            <i class="bi bi-globe text-primary fs-3"></i>

        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card stat-card shadow-sm">

            <div class="text-muted">Total Assessments</div>

            <h2 class="fw-bold mt-2">
                {{ $statistics['assessments'] }}
            </h2>

            <i class="bi bi-search text-success fs-3"></i>

        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card stat-card shadow-sm">

            <div class="text-muted">Total Findings</div>

            <h2 class="fw-bold mt-2">
                {{ $statistics['findings'] }}
            </h2>

            <i class="bi bi-bug text-danger fs-3"></i>

        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card stat-card shadow-sm">

            <div class="text-muted">Pending Verification</div>

            <h2 class="fw-bold mt-2">
                {{ $statistics['pending'] }}
            </h2>

            <i class="bi bi-clock-history text-warning fs-3"></i>

        </div>
    </div>

</div>

<div class="card shadow-sm border-0">

    <div class="card-body">

        <h5 class="fw-bold mb-3">
            Recent Assessments
        </h5>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>Assessment</th>
                        <th>Target</th>
                        <th>Status</th>
                        <th>Date Created</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($recentAssessments as $assessment)

                        <tr>
                            <td>
                                {{ $assessment->assessment_name }}
                            </td>

                            <td>
                                {{ $assessment->target->name ?? 'N/A' }}
                            </td>

                            <td>
                                <span class="badge bg-secondary">
                                    {{ ucfirst($assessment->status) }}
                                </span>
                            </td>

                            <td>
                                {{ $assessment->created_at->format('M d, Y') }}
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="4"
                                class="text-center text-muted py-4">

                                No assessments available yet.

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection