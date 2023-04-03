<x-app-layout title="Admin - Posts List">
    <x-slot name="header">
        <div class="text-center">
            <h1 class="text-3xl lg:text-6xl font-bold text-blue-900">{{ __('Posts list') }}</h1>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <x-link :href="route('admin.posts.create')">Create</x-link>
                    </div>
                    <table class="w-full text-left border-collapse">
                        <thead>
                        <tr>
                            <th class="px-6 py-4 text-sm font-bold uppercase bg-gray-100 border-b text-gray-dark border-gray-light">
                                #
                            </th>
                            <th class="px-6 py-4 text-sm font-bold uppercase bg-gray-100 border-b text-gray-dark border-gray-light">
                                Title
                            </th>
                            <th class="px-6 py-4 text-sm font-bold uppercase bg-gray-100 border-b text-gray-dark border-gray-light"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($posts as $post)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 border-b border-gray-200">{{ $post->id }}</td>
                                <td class="px-6 py-4 border-b border-gray-200">{{ $post->title }}</td>
                                <td class="px-6 py-4 border-b border-gray-200">
                                    <x-link href="{{ route('admin.posts.edit', $post->id) }}">
                                        Edit
                                    </x-link>

                                    <x-danger-button
                                        x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', {name: 'confirm-post-deletion', form_route: '{{ route('admin.posts.destroy', $post->id) }}'})"
                                    >{{ __('Delete') }}</x-danger-button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <x-modal name="confirm-post-deletion" focusable>
                        <form method="POST" action="" class="p-6" x-ref="modalForm">
                            @csrf
                            @method('DELETE')
                
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Are you sure you want to delete this post?') }}
                            </h2>
                
                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>
                
                                <x-danger-button class="ml-3">
                                    {{ __('Delete') }}
                                </x-danger-button>
                            </div>
                        </form>
                    </x-modal>

                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>