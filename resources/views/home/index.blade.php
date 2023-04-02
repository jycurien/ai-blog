<x-app-layout>
    <x-slot name="header">
        <div class="text-center p-16">
            <h1 class="text-6xl font-bold text-orange-600">Welcome to my incredible blog!</h1>
            <p class="mt-6 text-lg leading-8 text-gray-900">Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat fugiat aliqua.</p>
        </div>
    </x-slot>

    <h2 class="text-4xl font-bold mb-6">Latest Posts</h2>
    @include('posts.partials.list')
</x-app-layout>
