<x-app-layout>
    <x-slot name='header'>
    </x-slot>

    <div class="grid grid-cols-12 mt-7 gap-4">
        <div class='col-start-3 col-span-5'>
            @forelse ($posts as $post)

            <div class="flex flex-col border border-solid border-gray-300 mb-14 bg-white">
                <div class="flex flex-row p-3 border-b border-solid border-gray-300 items-center">
                    <a href="/profile/{{$post->user->username}}">
                        <img src="{{$post->user->profile_photo_url}}" alt="{{$post->user->username}}" srcset=""
                            class="rounded-full h-12 w-12 me-3 ">
                    </a>
                    <a class="hover:underline" href="/profile/{{$post->user->username}}">{{$post->user->username}}</a>
                </div>
                <div>
                    <a href="/posts/{{$post->id}}"><img class='w-full' style="max-height: 80vh"
                            src="/storage/{{$post->image_path}}" alt=""></a>
                </div>
                <div class="flex flex-row items-center mt-2">
                    @livewire('like-button',['post_id'=>$post->id], key($post->id))
                </div>
                <div class="border-b border-solid border-gray-200 ps-4 pb-1">
                    <div class="me-7 mb-2">
                        <a class="font-bold text-base hover:underline"
                            href="/profile/{{$post->user->username}}">{{$post->user->username}}</a>
                        <span>{{$post->post_caption}}</span>
                    </div>
                    @foreach ($post->comments as $comment)
                    @if ($loop->iteration==4)
                    @break
                    @endif
                    <div class="me-7">
                        <a class="font-bold hover:underline"
                            href="/profile/{{$comment->user->username}}">{{$comment->user->username}}</a>
                        <span>{{$comment->comment}}</span>
                    </div>
                    @endforeach
                    @if ($post->comments()->count()>3)
                    <a class='font-sm text-gray-700' href="/posts/{{$post->id}}">
                        {{__('View all')}} {{$post->comments()->count()}} {{__('Comments')}}</a>
                    @endif
                    <div class="text-gray-500 text-xs">
                        {{$post->created_at->format('M j o')}}
                    </div>
                </div>
                <div class="p-4">
                    <form action="/comments" method="post" autocomplete="off">
                        @csrf
                        <div class='flex flex-row items-center justify-between'>
                            <input class="w-full outline-none border-none p-0" type="text" name="comment"
                                id="{{$post->id}}" placeholder="{{__('Add Comment')}}" />
                            <input type="hidden" name="post_id" value="{{$post->id}}">
                            <button class="text-blue-500 font-semibold hover:text-blue-700"
                                type="submit">{{__('Post')}}</button>
                        </div>
                    </form>
                </div>
            </div>
            @empty
            <div class="m-10">
                <p class="font-semibold">{{__('Start your journey, Follow your frends')}}</p>
            </div>

            @endforelse
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
        <div class="col-start-8 col-span-4 ms-4">
            <div class="flex flex-row justify-between">
                <a href="/profile/{{$profile->username}}">
                    <img src="{{$profile->profile_photo_url}}" alt="avatar" class="rounded-full w-12 h-12 me-3"></a>
                <div class="flex flex-col self-center ms-3">
                    <a href="/profile/{{$profile->username}}"
                        class="text-base hover:underline">{{$profile->username}}</a>
                    <h3 class="text-sm text-gray-400">{{$profile->bio}}</h3>
                </div>
            </div>
            <h3 class="mt-4 mb-4 text-gray-500 font-semibold">{{__('Pepole you follow:')}}</h3>
            @forelse ($iFollow as $follow)
            <div class="flex flex-col mb-3">
                <div class="flex flex-row justify-between">
                    <div class="flex flex-row">
                        <a href="/profile/{{$follow->username}}"><img src="{{$follow->profile_photo_url}}" alt="avatar"
                                class="rounded-full w-12 h-12 me-3"></a>
                        <div class="flex flex-col self-center ms-3">
                            <a href="/profile/{{$follow->username}}" class="text-base hover:underline">
                                {{$follow->username}}
                            </a>
                            <h3 class="text-sm text-gray-500 ">{{$follow->bio}}</h3>
                        </div>
                    </div>
                    @livewire('follow-button',['profile_id'=>$follow->id],key($follow->id))
                </div>

            </div>

            @empty
            <div class="my-10">
                <p class="font-semibold">{{__("Nothing to show right now!")}}</p>
            </div>
            @endforelse
            <h3 class="mt-4 mb-4 text-gray-500 font-semibold">{{__("Peopole you may want to follow:")}}</h3>
            @forelse ($toFollow as $follow)
            <div class="flex flex-col mb-3">
                <div class="flex flex-row justify-between">
                    <div class="flex flex-row">
                        <a href="/profile/{{$follow->username}}"><img src="{{$follow->profile_photo_url}}" alt="avatar"
                                srcset="" class="rounded-full w-12 h-12 me-3"></a>
                        <div class="flex flex-col self-center ms-3">
                            <a href="/profile/{{$follow->username}}" class="text-base hover:underline">
                                {{$follow->username}}
                            </a>
                            <h3 class="text-sm text-gray-500 ">{{$follow->bio}}</h3>
                        </div>
                    </div>
                    @livewire('follow-button',['profile_id'=>$follow->id],key($follow->id))
                </div>

            </div>

            @empty
            <div class="my-10">
                <p class="font-semibold">{{__("Nothing to show right now!")}}</p>
            </div>
            @endforelse

        </div>

    </div>


</x-app-layout>