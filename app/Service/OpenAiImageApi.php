<?php

namespace App\Service;

use App\Contract\AiImageApi;
use Illuminate\Support\Facades\Http;

class OpenAiImageApi implements AiImageApi
{
    public function __construct(
        private readonly string $apiKey,
        private readonly string $apiImageUrl
    )
    {
    }

    public function getImageContentUrl(string $prompt, string $size): string
    {
        $response = Http::withToken($this->apiKey)->post($this->apiImageUrl, [
            'prompt' => $prompt,
            'n' => 1,
            'size' => $size,
        ]);   
        
        return json_decode($response->getBody())->data[0]->url;
    }
}