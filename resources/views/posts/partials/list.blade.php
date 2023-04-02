<div class="flex flex-wrap -mx-2">
    @foreach ($posts as $post)
    <div class="w-1/2 flex flex-col lg:flex-row p-2">
        <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-tr-none lg:rounded-l text-center overflow-hidden" style="background-image: url('{{ asset($post->image) }}')">
        </div>
        <div class="flex-1 border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
            <div class="mb-8">
                <div class="text-gray-900 font-bold text-xl mb-2">{{ $post->title }}</div>
                <p class="text-gray-700 text-base">{!! nl2br(mb_substr($post->content, 0, 100)) !!}</p>
            </div>
            <x-link :href="route('posts.show', $post->id)">
                Read More
            </x-link>
        </div>
    </div>
    @endforeach
</div>
