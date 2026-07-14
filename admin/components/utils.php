<?php

function generateSlug(string $title): string
{
    // 1. Lowercase the string
    $slug = strtolower($title);

    // 2. Replace non-alphanumeric characters with a hyphen
    $slug = preg_replace('/[^a-z0-9\-]/', '-', $slug);

    // 3. Remove duplicate/consecutive hyphens
    $slug = preg_replace('/-+/', '-', $slug);

    // 4. Trim hyphens from the start and end of the string
    return trim($slug, '-');
}