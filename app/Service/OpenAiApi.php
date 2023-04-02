<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;

class OpenAiApi 
{
    public function __construct(
        private readonly string $apiKey,
        private readonly string $apiTextUrl,
        private readonly string $apiImageUrl,
    )
    {
    }

    public function getTextContent(string $topic, int $nbWords): string
    {
        $response = Http::withToken($this->apiKey)->post($this->apiTextUrl, [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'user', 
                    'content' => 'Write a ' . $nbWords . ' words post about this topic:' . $topic,          
                ]
            ],
        ]);

        return json_decode($response->getBody())->choices[0]->message->content;
    }

    public function getImageContentUrl(string $topic, ?string $size = '512x512'): string
    {
        $response = Http::withToken($this->apiKey)->post($this->apiImageUrl, [
            'prompt' => $topic,
            'n' => 1,
            'size' => $size,
        ]);   
        
        return json_decode($response->getBody())->data[0]->url;
    }
}