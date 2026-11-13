<?php

namespace App\Http\Controllers;

use App\Models\Target;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TargetController extends Controller
{

    private function targetsForUser(){
        $user = auth()->user();

        return Target::query()->when(
            $user->role !== 'admin',
            fn($query) => $query->where('user_id', $user->id)
        );
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $targets = $this->targetsForUser()
            ->withCount(['scopes', 'assessments'])
            ->latest()
            ->paginate(10);

        return view('targets.index', compact('targets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('targets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'base_url' => ['required', 'string', 'max:2048'],
            'description' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['active', 'inactive'])
            ]
        ]);

        $validated['user_id'] = auth()->id();

        Target::create($validated);

        return redirect()
            ->route('targets.index')
            ->with('success', 'Target created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Target $target)
    {
        $this->authorizeTarget($target);

        $target->load(['scopes', 'assessments']);

        return view('targets.show', compact('target'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Target $target)
    {
        $this->authorizeTarget($target);

        return view('targets.edit', compact('target'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Target $target)
    {
        $this->authorizeTarget($target);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'base_url' => ['required', 'string', 'max:2048'],
            'description' => ['nullable', 'string'],
            'status' => [
                'required', Rule::in(['active', 'inactive'])
            ]
        ]);

        $target->update($validated);

        return redirect()
            ->route('targets.index')
            ->with('success', 'Target updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Target $target)
    {
        $this->authorizeTarget($target);

        if($target->assessments()->exists()){
            return back()->with(
                'error',
                'This target cannot be deleted because it has assessments.'
            );
        }

        $target->delete();

        return redirect()
            ->route('targets.index')
            ->with('success', 'Target deleted successfully.');
    }

    private function authorizeTarget(Target $target): void{
        if(
            auth()->user()->role !== 'admin' &&
            $target->user_id !== auth()->id()
        ) {
            abort(403, 'You are not authorized to access this target.');
        }
    }
}
