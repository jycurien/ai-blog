<x-app-layout>
    <x-slot name="header">
        <div class="w-full bg-cover bg-center -my-6" style="background-image: url('{{ asset($post->image) }}'); height: 400px">
            <div class="flex items-center justify-center h-full bg-white bg-opacity-60 ">
                <h1 class="font-bold text-6xl text-center text-orange-600 mx-16">{{ $post->title }}</h1>
            </div>
        </div>
    </x-slot>

    <div>{!! nl2br($post->content) !!}</div>
</x-app-layout>

