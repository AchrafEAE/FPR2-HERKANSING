<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateBioRequest;
use App\Models\Bio;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BioController extends Controller
{
    public function show(Request $request): JsonResponse
    {
        $this->authorize('view', Bio::class);

        $bio = Bio::query()->firstOrCreate(
            ['user_id' => $request->user()->id],
            ['headline' => 'Voeg je headline toe', 'summary' => 'Voeg je professionele samenvatting toe.'],
        );

        return response()->json(['data' => $bio]);
    }

    public function update(UpdateBioRequest $request): JsonResponse
    {
        $this->authorize('update', Bio::class);

        $bio = Bio::query()->updateOrCreate(
            ['user_id' => $request->user()->id],
            $request->validated(),
        );

        return response()->json([
            'message' => 'Bio succesvol bijgewerkt.',
            'data' => $bio,
        ]);
    }
}
