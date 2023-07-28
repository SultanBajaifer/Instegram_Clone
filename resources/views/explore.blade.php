<x-app-layout>
    <x-slot name='header'>
    </x-slot>

    <div class="max-w-4xl my-0 mx-auto">
        <div class='grid grid-cols-3 gap-4 mx-0 mb-10'>
            @foreach ($posts as $post)
            <div class="post">
                <a href="/posts/{{$post->id}}" class="w-full h-full">
                    <img src="/storage/{{$post->image_path}}" class="w-full h-full object-cover" alt="" srcset="">
                    <div class="post-info">
                        <ul>
                            <li class="inline-block font-semibold me-7">
                                <span class="absolute h-1 w-1 overflow-hidden">{{__("Likes")}}</span>
                                <i class="fas fa-heart" aria-hidden="true"></i>
                                {{$post->likedByUsers()->count()}}
                            </li>
                            <li class="inline-block font-semibold">
                                <span class="absolute h-1 w-1 overflow-hidden">{{__("Comments")}}</span>
                                <i class="fas fa-comment" aria-hidden="true"></i>
                                {{$post->comments()->count()}}
                            </li>
                        </ul>
                    </div>
                </a>
            </div>
            @endforeach


        </div>
        <div class="pagination">
            @if ($posts->lastPage() > 1)
            <ul class="pagination-list">
                @if ($posts->currentPage() == 1)
                <li class="pagination-item is-disabled"><span>&laquo;</span></li>
                @else
                <li class="pagination-item"><a href="{{ $posts->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                @endif

                @for ($i = 1; $i <= $posts->lastPage(); $i++)
                    @if ($i == $posts->currentPage())
                    <li class="pagination-item is-active"><span>{{ $i }}</span></li>
                    @else
                    <li class="pagination-item"><a href="{{ $posts->url($i) }}">{{ $i }}</a></li>
                    @endif
                    @endfor

                    @if ($posts->currentPage() == $posts->lastPage())
                    <li class="pagination-item is-disabled"><span>&raquo;</span></li>
                    @else
                    <li class="pagination-item"><a href="{{ $posts->nextPageUrl() }}" rel="next">&raquo;</a></li>
                    @endif
            </ul>
            @endif
        </div>
    </div>


</x-app-layout>