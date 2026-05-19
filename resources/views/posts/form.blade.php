<div class="form-grid form-grid--two">
    <div class="md:col-span-2 form-field">
        <label for="title" class="form-label">Titel</label>
        <input id="title" name="title" type="text" value="{{ old('title', $post->title) }}" class="form-input @error('title') is-invalid @enderror" placeholder="Bijvoorbeeld: Mijn eerste workflow post">
        <p class="form-help">De titel is het eerste wat je lezers zien.</p>
        @error('title')<p class="form-error">{{ $message }}</p>@enderror
    </div>

    <div class="md:col-span-2 form-field">
        <label for="body" class="form-label">Inhoud</label>
        <textarea id="body" name="body" rows="10" class="form-textarea @error('body') is-invalid @enderror" placeholder="Schrijf hier je concept, uitleg of artikel.">{{ old('body', $post->body) }}</textarea>
        <p class="form-help">Werk in korte alinea's en gebruik duidelijke taal.</p>
        @error('body')<p class="form-error">{{ $message }}</p>@enderror
    </div>

    <div class="form-field">
        <label for="status" class="form-label">Status</label>
        <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
            <option value="draft" @selected(old('status', $post->status?->value ?? 'draft') === 'draft')>Draft</option>
            <option value="in_review" @selected(old('status', $post->status?->value ?? 'draft') === 'in_review')>In review</option>
            <option value="published" @selected(old('status', $post->status?->value ?? 'draft') === 'published')>Published</option>
        </select>
        <p class="form-help">Kies hier de fase waarin je post zich nu bevindt.</p>
        @error('status')<p class="form-error">{{ $message }}</p>@enderror
    </div>
</div>
