<div class="form-grid form-grid--two">
    <div class="md:col-span-2 form-field">
        <label for="title" class="form-label">Titel <p class="form-help form-tip" tabindex="0">
                <span class="form-tip-trigger" aria-hidden="true">i</span>
                <span class="form-tip-text">De titel is het eerste wat je lezers zien.</span>
            </p></label>
        <input id="title" name="title" type="text" value="{{ old('title', $post->title) }}" class="form-input @error('title') is-invalid @enderror" placeholder="Bijvoorbeeld: Mijn eerste workflow post">

        @error('title')<p class="form-error">{{ $message }}</p>@enderror
    </div>

    <div class="md:col-span-2 form-field">
        <label for="body" class="form-label">Inhoud <p class="form-help form-tip" tabindex="0">
                <span class="form-tip-trigger" aria-hidden="true">i</span>
                <span class="form-tip-text">Werk in korte alinea's en gebruik duidelijke taal.</span>
            </p></label>
        <textarea id="body" name="body" rows="10" class="form-textarea @error('body') is-invalid @enderror" placeholder="Schrijf hier je concept, uitleg of artikel.">{{ old('body', $post->body) }}</textarea>

        @error('body')<p class="form-error">{{ $message }}</p>@enderror
    </div>

    <div class="form-field">
        <label for="status" class="form-label">Status <p class="form-help form-tip" tabindex="0">
                <span class="form-tip-trigger" aria-hidden="true">i</span>
                <span class="form-tip-text">Kies hier de fase waarin je post zich nu bevindt.</span>
            </p></label>
        <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
            <option value="draft" @selected(old('status', $post->status?->value ?? 'draft') === 'draft')>Draft</option>
            <option value="in_review" @selected(old('status', $post->status?->value ?? 'draft') === 'in_review')>In review</option>
            <option value="published" @selected(old('status', $post->status?->value ?? 'draft') === 'published')>Published</option>
        </select>

        @error('status')<p class="form-error">{{ $message }}</p>@enderror
    </div>
</div>
