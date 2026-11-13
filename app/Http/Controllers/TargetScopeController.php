<?php

namespace App\Http\Controllers;

use App\Models\Target;
use App\Models\TargetScope;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TargetScopeController extends Controller
{
    private function authorizeTarget(Target $target): void
    {
        if (
            auth()->user()->role !== 'admin' &&
            $target->user_id !== auth()->id()
        ) {
            abort(403, 'You are not authorized to access this target.');
        }
    }

    private function authorizeScope(
        Target $target,
        TargetScope $scope
    ): void {
        $this->authorizeTarget($target);

        if ($scope->target_id !== $target->id) {
            abort(404);
        }
    }

    private function validateAsset(Request $request): array
    {
        return $request->validate([
            'asset' => [
                'required',
                'string',
                'max:2048',
                function ($attribute, $value, $fail) use ($request) {
                    $type = $request->input('asset_type');

                    if ($type === 'domain') {
                        $domain = rtrim($value, '.');

                        if (!preg_match(
                            '/^(?=.{1,253}$)(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,63}$/',
                            $domain
                        )) {
                            $fail('Enter a valid domain name, such as example.com.');
                        }
                    }

                    if ($type === 'url') {
                        $valid = filter_var($value, FILTER_VALIDATE_URL);
                        $scheme = parse_url($value, PHP_URL_SCHEME);

                        if (!$valid || !in_array(
                            strtolower((string) $scheme),
                            ['http', 'https'],
                            true
                        )) {
                            $fail('Enter a valid HTTP or HTTPS URL.');
                        }
                    }

                    if (
                        $type === 'ip_address' &&
                        !filter_var($value, FILTER_VALIDATE_IP)
                    ) {
                        $fail('Enter a valid IPv4 or IPv6 address.');
                    }
                },
            ],
            'asset_type' => [
                'required',
                Rule::in(['domain', 'url', 'ip_address']),
            ],
            'scope_status' => [
                'required',
                Rule::in(['in_scope', 'out_of_scope']),
            ],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);
    }

    public function create(Target $target)
    {
        $this->authorizeTarget($target);

        return view('target-scopes.create', compact('target'));
    }

    public function store(Request $request, Target $target)
    {
        $this->authorizeTarget($target);

        $validated = $this->validateAsset($request);

        $target->scopes()->create($validated);

        return redirect()
            ->route('targets.show', $target)
            ->with('success', 'Scope asset added successfully.');
    }

    public function edit(Target $target, TargetScope $scope)
    {
        $this->authorizeScope($target, $scope);

        return view(
            'target-scopes.edit',
            compact('target', 'scope')
        );
    }

    public function update(
        Request $request,
        Target $target,
        TargetScope $scope
    ) {
        $this->authorizeScope($target, $scope);

        $validated = $this->validateAsset($request);

        $scope->update($validated);

        return redirect()
            ->route('targets.show', $target)
            ->with('success', 'Scope asset updated successfully.');
    }

    public function destroy(Target $target, TargetScope $scope)
    {
        $this->authorizeScope($target, $scope);

        $scope->delete();

        return redirect()
            ->route('targets.show', $target)
            ->with('success', 'Scope asset deleted successfully.');
    }
}
