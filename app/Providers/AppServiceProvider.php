<?php

namespace App\Providers;

use App\Contract\AiTextApi;
use App\Contract\AiImageApi;
use App\Service\OpenAiTextApi;
use App\Service\OpenAiImageApi;
use App\Service\AutomaticPostCreator;
use App\Contract\AutomaticPostCreator as AutomaticPostCreatorInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            AiTextApi::class, fn () => new OpenAiTextApi(
                env('OPENAI_API_KEY'),
                'https://api.openai.com/v1/chat/completions'    
            )
        );

        $this->app->singleton(
            AiImageApi::class, fn () => new OpenAiImageApi(
                env('OPENAI_API_KEY'),
                'https://api.openai.com/v1/images/generations'    
            )
        );

        $this->app->singleton(AutomaticPostCreatorInterface::class, AutomaticPostCreator::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {  
    }
}
