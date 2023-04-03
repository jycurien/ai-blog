<?php

namespace App\Service;

use App\Contract\AiTextApi;
use App\Exceptions\AiApiException;
use Illuminate\Support\Facades\Http;

class OpenAiTextApi implements AiTextApi
{
    public function __construct(
        private readonly string $apiKey,
        private readonly string $apiTextUrl
    )
    {
    }

    public function getRandomTitle(int $nbCharacters): string
    {
        $title = $this->getTextContent('Give me a ' . $nbCharacters . ' characters long random post title');
        return str_replace('"', '', $title);
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

        $decodedResponse = json_decode($response->getBody());
        
        if ($decodedResponse?->error ?? false) {
            throw new AiApiException($decodedResponse?->error?->message);
        }

        return $decodedResponse->choices[0]->message->content;
    }
}