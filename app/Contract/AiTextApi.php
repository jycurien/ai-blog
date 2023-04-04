<?php

namespace App\Contract;

interface AiTextApi
{
    public function getRandomTitle(int $nbCharacters): string;

    public function getPostContent(string $topic, int $nbWords): string;
}