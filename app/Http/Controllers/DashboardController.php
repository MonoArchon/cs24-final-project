<?php

namespace App\Http\Controllers;

use App\Models\Target;
use App\Models\Assessment;
use App\Models\Finding;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $targets = Target::query();
        $assessments = Assessment::query();
        $findings = Finding::query();

        // Assessors can only see their own records.
        if ($user->role !== 'admin') {
            $targets->where('user_id', $user->id);

            $assessments->where('user_id', $user->id);

            $findings->whereHas('assessment', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        }

        $statistics = [
            'targets' => $targets->count(),

            'assessments' => $assessments->count(),

            'findings' => $findings->count(),

            'pending' => (clone $findings)
                ->where('status', 'pending_verification')
                ->count(),
        ];

        $recentAssessments = (clone $assessments)
            ->with('target')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'statistics',
            'recentAssessments'
        ));
    }
}