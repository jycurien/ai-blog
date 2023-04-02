<?php

namespace App\Providers;

use App\Service\OpenAiApi;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->when(OpenAiApi::class)
            ->needs('$apiTextUrl')
            ->give('https://api.openai.com/v1/chat/completions');
        
        $this->app->when(OpenAiApi::class)
            ->needs('$apiImageUrl')
            ->give('https://api.openai.com/v1/images/generations');
            
        $this->app->when(OpenAiApi::class)
            ->needs('$apiKey')
            ->give(env('OPENAI_API_KEY'));    
    }
}
