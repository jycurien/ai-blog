<x-app-layout title="Home">
    <x-slot name="header">
        <div class="text-center p-16">
            <h1 class="text-6xl font-bold text-orange-600">Welcome to our AI-generated blog!</h1>
            <p class="mt-6 text-lg leading-8 text-gray-900 mx-auto max-w-7xl">Explore the frontiers of technology with us as we cover cutting-edge advancements and fascinating insights powered by the latest machine learning algorithms. Discover the limitless possibilities of AI with our innovative content.</p>
        </div>
    </x-slot>

    <h2 class="text-4xl font-bold mb-6">Latest Posts</h2>
    @include('posts.partials.list')
</x-app-layout>
