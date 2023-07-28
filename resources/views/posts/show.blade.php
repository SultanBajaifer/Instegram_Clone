<x-app-layout>
    <x-slot class='header'>
    </x-slot>

    <div class="grid grid-cols-5 mt-7 gap-4">
        <div class="col-start-2 col-span-3 border boder-solid border-gray-300">
            <div class="grid grid-cols-5">
                <div class="col-span-3">
                    <div class="flex justify-center" id="postImage" style="max-height: 80vh">
                        <img src="/storage/{{$post->image_path}}" alt="" srcset="">
                    </div>
                </div>
                <div class="col-span-2 bg-white flex flex-col">
                    <div class="flex flex-row p-3 border-b border-solid border-gray-300 items-center justify-between"
                        id="sec1">
                        <div class="flex flex-row items-center">
                            <img src="{{$post->user->profile_photo_url}}" alt="{{$post->user->username}}" srcset=""
                                class="rounded-full h-10 me-3 w-10 object-cover ">
                            <a class="font-bold hover:underline"
                                href="/profile/{{$post->user->username}}">{{$post->user->username}}</a>
                        </div>
                        @can('update',$post)

                        <div class="text-gray-500">
                            <a href="/posts/{{$post->id}}/edit"><i class="fas fa-edit"></i></a>
                            <span class="font-bold mx-2">|</span>
                            <form class="inline-block" action="{{route('posts.destroy',$post->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('are you sure you want to delete this post? this post will be delted permently')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                        @endcan
                        @cannot('update',$post)
                        @livewire('follow-button',['profile_id'=>$post->user->id],key($post->user->id))
                        @endcannot
                    </div>
                    <div class="border-b border-solid border-gray-300 h-full">
                        <div class="grid grid-cols-5 overflow-y-auto" id="commentArea">
                            <div class="col-span-1 m-3">
                                <img src="{{$post->user->profile_photo_url}}" alt="{{$post->user->username}}"
                                    class="rounded-full h-10 me-3 w-10 object-cover">
                            </div>
                            <div class="col-span-4 mt-5 me-7">
                                <a class="font-bold hover:underline"
                                    href="/profile/{{$post->user->username}}">{{$post->user->username}}</a>
                                <span>{{$post->post_caption}}</span>
                            </div>
                            @foreach ($post->comments as $comment)
                            <div class="col-span-1 m-3">
                                <img src="{{$comment->user->profile_photo_url}}" alt="{{$comment->user->username}}"
                                    srcset="" class="rounded-full w-10 h-10">
                            </div>
                            <div class="mt-5 me-7 col-span-4 block">
                                <a class="font-bold hover:underline"
                                    href="/profile/{{$comment->user->username}}">{{$comment->user->username}}</a>
                                <div class="mt-1 ms-7 col-span-5 block">

                                    <span class="comment-text block ">
                                        {{"\t".$comment->comment}}
                                    </span>
                                </div>

                                <form method="POST" action="{{route('comments.update', $comment->id)}}"
                                    class="hidden comment-form">
                                    @csrf
                                    @method('PUT')
                                    <div class="flex flex-row items-center justify-between">
                                        <input class="btn btn-primary w-full outline-none border p-1" name="comment"
                                            type="text" id="comment-input" value="{{$comment->comment}}">
                                        <button class="text-blue-500 font-semibold hover:text-blue-700"
                                            type="submit">{{__('Edit')}}</button>
                                    </div>

                                    </button>
                                </form>
                                <div class="text-gray-500 text-xs">{{$comment->created_at->format('M j o')}}
                                    @can('delete',$comment)

                                    @can('update',$comment)

                                    <button type="button" class="text-xs ms-2" onclick="showEditCommentForm(this)">
                                        <i class="fas fa-edit fa-pencil-alt"></i>
                                    </button>
                                    <button type="button" class=" hidden btn btn-secondary"
                                        onclick="cancelEditComment(this)">
                                        <i class="fas fa-cancel fa-pencil-alt"></i>

                                    </button>
                                    @endcan

                                    <form action="{{route('comments.destroy',$comment->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs ms-2"
                                            onclick="return confirm('are you sure you want to delete this comment?')">
                                            <i class="fas fa-trash fa-pencil-alt"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>

                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex flex-col" id="sec3">

                        @livewire('like-button',['post_id'=>$post->id], key($post->id))


                        <div class="border-b border-solid border-gray-300 ps-4 pb-1 text-xs">
                            {{$post->created_at->format('M j o')}}
                        </div>
                    </div>
                    <div class="p-4 hidden" id="sec4">
                        @if (Auth::check())


                        <form action="/comments" method="post" autocomplete="off">
                            @csrf
                            @method('POST')
                            <div class="flex flex-row items-center justify-between">

                                <input class="w-full outline-none border-none p-1" name="comment" type="text"
                                    id="comment" placeholder="{{__('Add Comment')}}">
                                <input type="number" hidden name="post_id" value="{{$post->id}}">
                                <button class="text-blue-500 font-semibold hover:text-blue-700"
                                    type="submit">{{__('Post')}}</button>
                            </div>
                        </form>
                        @else
                        <a href="{{route('login')}}" class="text-blue-500 text-sm">{{__('Login ')}}</a><span
                            class="text-sm">{{__('To Like Or Comment')}}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>

<script>

</script>