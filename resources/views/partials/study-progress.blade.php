<section class="feature-card text-left">
    <div class="flex items-start justify-between gap-4 flex-wrap">
        <div>
            <h2 class="text-2xl font-bold">{{ $studyProgress['title'] }}</h2>
            <p class="text-sm text-gray-600 mt-1">Huidige fase: {{ $studyProgress['phase'] }}</p>
        </div>
        <div class="text-right">
            <span class="text-3xl font-bold text-gray-900">{{ $studyProgress['percentage'] }}%</span>
        </div>
    </div>

    <p class="mt-4 text-gray-700">{{ $studyProgress['description'] }}</p>

    <div class="mt-5 h-3 w-full rounded-full bg-gray-200 overflow-hidden">
        <div class="h-full rounded-full bg-blue-600" style="width: {{ $studyProgress['percentage'] }}%"></div>
    </div>

    <div class="mt-6">
        <h3 class="text-sm font-semibold uppercase tracking-wide text-gray-500">Mijlpalen</h3>
        <ul class="mt-3 space-y-3">
            @foreach ($studyProgress['milestones'] as $milestone)
            <li class="flex items-center justify-between gap-4 text-sm">
                <span class="text-gray-700">{{ $milestone['label'] }}</span>
                <span class="font-medium text-gray-900">{{ $milestone['status'] }}</span>
            </li>
            @endforeach
        </ul>
    </div>
</section>