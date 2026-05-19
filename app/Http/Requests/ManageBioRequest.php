<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManageBioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, list<string>>
     */
    public function rules(): array
    {
        return [
            'headline' => ['required', 'string', 'max:120'],
            'summary' => ['required', 'string', 'max:2000'],
            'location' => ['nullable', 'string', 'max:120'],
            'availability' => ['nullable', 'string', 'max:120'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'years_experience' => ['nullable', 'integer', 'min:0', 'max:60'],
        ];
    }
}
