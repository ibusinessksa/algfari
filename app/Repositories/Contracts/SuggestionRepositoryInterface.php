<?php

namespace App\Repositories\Contracts;

use App\Models\Suggestion;

interface SuggestionRepositoryInterface
{
    /**
     * @param  array<string, mixed>  $attributes
     */
    public function create(array $attributes): Suggestion;
}
