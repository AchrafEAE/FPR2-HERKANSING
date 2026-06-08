<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManageBioRequest;
use App\Models\Bio;
use App\Models\StudyResult;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Arr;

class BioController extends Controller
{
    public function edit(Request $request): View
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $bio = Bio::query()->firstOrNew(
            ['user_id' => $user->id],
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
        /** @var \App\Models\User $user */
        $user = $request->user();
        $bio = Bio::query()->where('user_id', $user->id)->first();

        $studyResults = StudyResult::query()
            ->where('user_id', $user->id)
            ->pluck('earned_ec', 'course_code')
            ->toArray();

        return view('bio.show', [
            'bio' => $bio,
            'user' => $user,
            'isOwner' => true,
            'studyResults' => $studyResults,
            'studyProgress' => config('portfolio.study_progress'),
        ]);
    }

    public function publicShow(User $user): View
    {
        $bio = Bio::query()->where('user_id', $user->getKey())->first();

        $studyResults = StudyResult::query()
            ->where('user_id', $user->id)
            ->pluck('earned_ec', 'course_code')
            ->toArray();

        return view('bio.show', [
            'bio' => $bio,
            'user' => $user,
            'isOwner' => false,
            'studyResults' => $studyResults,
            'studyProgress' => config('portfolio.study_progress'),
        ]);
    }

    public function index(): View
    {
        $users = User::with('bio')->get();

        return view('bio.index', compact('users'));
    }

    public function update(ManageBioRequest $request): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        Bio::query()->updateOrCreate(
            ['user_id' => $user->id],
            array_merge($request->validated(), ['user_id' => $user->id])
        );

        return redirect()->route('bio.edit')->with('status', 'Bio succesvol opgeslagen.');
    }
}
