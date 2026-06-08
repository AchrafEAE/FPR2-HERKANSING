<?php

namespace App\Http\Controllers;

use App\Models\StudyResult;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudyResultController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'course_code' => 'required|string|max:50',
            'earned_ec' => 'nullable|string|max:10',
        ]);

        /** @var \App\Models\User $user */
        $user = $request->user();

        // Convert "2.5 EC" or "2.5" to 2.5
        $earnedEcValue = 0;
        if (!empty($validated['earned_ec'])) {
            $earnedEcValue = (float) str_replace([' EC', ' ec'], '', $validated['earned_ec']);
        }

        $studyResult = StudyResult::updateOrCreate(
            [
                'user_id' => $user->id,
                'course_code' => $validated['course_code'],
            ],
            [
                'earned_ec' => $earnedEcValue,
            ]
        );

        return response()->json([
            'status' => 'success',
            'data' => $studyResult
        ]);
    }
}
