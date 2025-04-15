<?php

namespace Dev\LaravelStatusModule\Utils;

use Illuminate\Support\Str;

class SlugGenerator
{
    public function generateSlug(string $name, ?string $slug = null): string
    {
        return $slug ?? Str::slug($name);
    }
}
