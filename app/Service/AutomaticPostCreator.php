<?php

namespace App\Service;

use App\Models\Post;
use App\Contract\AiTextApi;
use App\Contract\AiImageApi;
use App\Contract\AutomaticPostCreator as AutomaticPostCreatorInterface;
use Illuminate\Support\Facades\Storage;

class AutomaticPostCreator implements AutomaticPostCreatorInterface 
{
    public function __construct(
        private readonly AiImageApi $imageApi,
        private readonly AiTextApi $textApi,
    )
    {
    }
    
    public function createPost(): Post
    {
        try {
            $title = $this->textApi->getRandomTitle(80);
            echo "$title\n";
            $imgUrl = $this->imageApi->getImageContentUrl($title, '512x512');
            $content = $this->textApi->getPostContent($title, 300);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

        $filename = uniqid() . '_' . time() . '.png';
        Storage::disk('public')->put('uploads/' . $filename, file_get_contents($imgUrl));
        
        return Post::create([
            'title' => $title,
            'image' => 'storage/uploads/' . $filename,
            'content' => $content,
        ]);
    }
}

