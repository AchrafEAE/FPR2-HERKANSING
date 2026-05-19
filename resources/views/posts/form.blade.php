<div class="grid md:grid-cols-2 gap-4">
    <div class="md:col-span-2">
        <label for="title">Titel</label>
        <input id="title" name="title" type="text" value="{{ old('title', $post->title) }}">
        @error('title')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
    </div>

    <div class="md:col-span-2">
        <label for="body">Inhoud</label>
        <textarea id="body" name="body" rows="10">{{ old('body', $post->body) }}</textarea>
        @error('body')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="status">Status</label>
        <select id="status" name="status">
            <option value="draft" @selected(old('status', $post->status?->value ?? 'draft') === 'draft')>Draft</option>
            <option value="in_review" @selected(old('status', $post->status?->value ?? 'draft') === 'in_review')>In review</option>
            <option value="published" @selected(old('status', $post->status?->value ?? 'draft') === 'published')>Published</option>
        </select>
        @error('status')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
    </div>
</div>
