<x-app-layout>
    <x-slot name="header">
        <div class="w-full bg-cover p-16 mb-6" style="background-image: url('{{ asset($post->image) }}'); background-position: center; height: 400px">
            <h1 class="text-6xl font-bold mt-6 mb-6 text-center">{{ $post->title }}</h1>
        </div>
    </x-slot>

    <div>{!! nl2br($post->content) !!}</div>
</x-app-layout>

