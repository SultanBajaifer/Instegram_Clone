<x-app-layout>
    <x-slot name='header'>
    </x-slot>

    <div class="grid grid-cols-12 mt-7 gap-4">
        <div class='col-start-5 col-span-4'>
            <h3 class='mt-4 mb-4 text-gray-500 font-semibold text-center text-3xl'>{{__('Followers:' .
                $followers->count())}}</h3>

            @if ($followers!=null && sizeof($followers)>0)
            @foreach ($followers as $follower)
            <div class="flex flex-col mb-3">
                <div class="flex flex-row justify-around">
                    <div class="flex flex-row">
                        <a href="/profile/{{$follower->username}}">
                            <img src="{{$follower->profile_photo_url}}" alt="avatar"
                                class="rounded-full w-10 h-10 me-3"></a>
                        <div class="flex flex-col self-center">
                            <a href="/profile/{{$follower->username}}"
                                class="text-base hover:underline whitespace-nowrap">{{$follower->username}}</a>
                            <h3 class="text-sm text-gray-500 truncate whitespace-nowrap" style="max-width: 25ch">
                                {{$follower->bio}}</h3>
                        </div>
                    </div>
                    @if ($profile->status == 'private')
                    @livewire('accept-follow',['profile_id'=>$follower->id],key($follower->username))
                    @endif
                    @livewire('follow-button',['profile_id'=>$follower->id],key($follower->id))
                </div>
            </div>
            @endforeach
            <div class="pagination">
                @if ($followers->lastPage() > 1)
                <ul class="pagination-list">
                    @if ($followers->currentPage() == 1)
                    <li class="pagination-item is-disabled"><span>&laquo;</span></li>
                    @else
                    <li class="pagination-item"><a href="{{ $followers->previousPageUrl() }}" rel="prev">&laquo;</a>
                    </li>
                    @endif

                    @for ($i = 1; $i <= $followers->lastPage(); $i++)
                        @if ($i == $followers->currentPage())
                        <li class="pagination-item is-active"><span>{{ $i }}</span></li>
                        @else
                        <li class="pagination-item"><a href="{{ $followers->url($i) }}">{{ $i }}</a></li>
                        @endif
                        @endfor

                        @if ($followers->currentPage() == $followers->lastPage())
                        <li class="pagination-item is-disabled"><span>&raquo;</span></li>
                        @else
                        <li class="pagination-item"><a href="{{ $followers->nextPageUrl() }}" rel="next">&raquo;</a>
                        </li>
                        @endif
                </ul>
                @endif
            </div>
            @else
            <div class="my-10 text-center">
                <p class="font-semibold">{{__("Nothing To Show Right Now!")}}</p>
            </div>
            @endif
        </div>
    </div>


</x-app-layout>