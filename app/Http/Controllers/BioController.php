<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManageBioRequest;
use App\Models\Bio;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Arr;

class BioController extends Controller
{
    public function edit(Request $request): View
    {
        $bio = Bio::query()->firstOrNew(
            ['user_id' => $request->user()->id],
            [
                'headline' => 'Werk je bio bij',
                'summary' => 'Beschrijf hier kort je achtergrond, focus en beschikbare vaardigheden.',
                'availability' => 'Beschikbaar voor nieuwe opdrachten',
            ]
        );

        return view('bio.edit', compact('bio'));
    }

    public function show(Request $request): View
    {
        $bio = Bio::query()->where('user_id', $request->user()->getKey())->first();

        return view('bio.show', compact('bio'));
    }

    public function publicShow(User $user): View
    {
        $bio = Bio::query()->where('user_id', $user->getKey())->first();

        return view('bio.show', compact('bio'));
    }

    public function index(): View
    {
        $users = User::with('bio')->get();

        return view('bio.index', compact('users'));
    }

    public function update(ManageBioRequest $request): RedirectResponse
    {
        Bio::query()->updateOrCreate(
            ['user_id' => $request->user()->id],
            array_merge($request->validated(), ['user_id' => $request->user()->id])
        );

        return redirect()->route('bio.edit')->with('status', 'Bio succesvol opgeslagen.');
    }
}
