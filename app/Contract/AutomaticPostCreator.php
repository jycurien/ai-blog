<?php

namespace App\Contract;

use App\Models\Post;

interface AutomaticPostCreator
{
    public function createPost(): Post;
}