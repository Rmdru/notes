<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\NoteFormRequest;
use App\Models\Note;
use Symfony\Component\HttpFoundation\RedirectResponse;

class NoteController extends Controller
{
    public function store(NoteFormRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if (! empty($validated['title']) && ! empty($validated['description'])) {
            $validated['user_id'] = auth()->id();
            
            Note::create($validated);
        }

        return redirect()->route('dashboard');
    }
}
