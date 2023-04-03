<?php

namespace App\Contract;

interface AiTextApi
{
    public function getPostContent(string $topic, int $nbWords): string;
}