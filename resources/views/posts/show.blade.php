<x-app-layout title="{!! $post->title !!}">
    <x-slot name="header">
        <div class="text-center">
            <h1 class="font-bold text-6xl text-orange-600 mx-16">{{ $post->title }}</h1>
        </div>
    </x-slot>

    <div class="bg-white p-4 rounded shadow mt-6 mb-6">
        <img src="{{ asset($post->image) }}" alt="image for {{ $post->title }}" 
            class="post-image m-auto md:float-left md:ml-0 md:mt-0 md:mr-4 md:mb-4" width="512" height="512">
        {!! nl2br($post->content) !!}
    </div>
</x-app-layout>

