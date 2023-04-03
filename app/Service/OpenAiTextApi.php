<?php

namespace App\Service;

use App\Contract\AiTextApi;
use Illuminate\Support\Facades\Http;

class OpenAiTextApi implements AiTextApi
{
    public function __construct(
        private readonly string $apiKey,
        private readonly string $apiTextUrl
    )
    {
    }

    public function getPostContent(string $topic, int $nbWords): string
    {
        return $this->getTextContent('Write a ' . $nbWords . ' words post about this topic:' . $topic);
    }

    private function getTextContent(string $prompt): string
    {
        $response = Http::withToken($this->apiKey)->post($this->apiTextUrl, [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'user', 
                    'content' => $prompt,          
                ]
            ],
        ]);

        return json_decode($response->getBody())->choices[0]->message->content;
    }
}