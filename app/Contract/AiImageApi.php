<?php

namespace App\Contract;

interface AiImageApi
{
    public function getImageContentUrl(string $prompt, string $size): string;
}