<x-app-layout>
    <x-slot name='header'>
    </x-slot>

    <div class="grid grid-cols-12 mt-7 gap-4">
        <div class='col-start-5 col-span-4'>
            <h3 class='mt-4 mb-4 text-gray-500 font-semibold text-center text-3xl'>{{__('Follow Requests')}}</h3>

            @if ($requests!=null && sizeof($requests)>0)
            @foreach ($requests as $request)
            <div class="flex flex-col mb-3">
                <div class="flex flex-row justify-around">
                    <div class="flex flex-row">
                        <a href="/profile/{{$request->username}}">
                            <img src="{{$request->profile_photo_url}}" alt="avatar"
                                class="rounded-full w-10 h-10 me-3"></a>
                        <div class="flex flex-col self-center">
                            <a href="/profile/{{$request->username}}"
                                class="text-base hover:underline whitespace-nowrap">{{$request->username}}</a>
                            <h3 class="text-sm text-gray-500 truncate whitespace-nowrap" style="max-width: 25ch">
                                {{$request->bio}}</h3>
                        </div>
                    </div>
                    @if ($profile->status == 'private')
                    @livewire('accept-follow',['profile_id'=>$request->id],key($request->username))
                    @endif
                    @livewire('follow-button',['profile_id'=>$request->id],key($request->id))
                </div>
            </div>
            @endforeach
            <div class="pagination">
                @if ($requests->lastPage() > 1)
                <ul class="pagination-list">
                    @if ($requests->currentPage() == 1)
                    <li class="pagination-item is-disabled"><span>&laquo;</span></li>
                    @else
                    <li class="pagination-item"><a href="{{ $requests->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                    @endif

                    @for ($i = 1; $i <= $requests->lastPage(); $i++)
                        @if ($i == $requests->currentPage())
                        <li class="pagination-item is-active"><span>{{ $i }}</span></li>
                        @else
                        <li class="pagination-item"><a href="{{ $requests->url($i) }}">{{ $i }}</a></li>
                        @endif
                        @endfor

                        @if ($requests->currentPage() == $requests->lastPage())
                        <li class="pagination-item is-disabled"><span>&raquo;</span></li>
                        @else
                        <li class="pagination-item"><a href="{{ $requests->nextPageUrl() }}" rel="next">&raquo;</a></li>
                        @endif
                </ul>
                @endif
            </div>
            @else
            <div class="my-10 text-center">
                <p class="font-semibold">{{__("Nothing To Show Right Now!")}}</p>
            </div>
            @endif
            <h3 class='mt-4 mb-4 text-gray-500 font-semibold text-center text-3xl'>{{__('Pending Follow Requests')}}
            </h3>

            @if ($pendings!=null && sizeof($pendings)>0)
            @foreach ($pendings as $pending)
            <div class="flex flex-col mb-3">
                <div class="flex flex-row justify-around">
                    <div class="flex flex-row">
                        <a href="/profile/{{$pending->username}}">
                            <img src="{{$pending->profile_photo_url}}" alt="avatar"
                                class="rounded-full w-10 h-10 me-3"></a>
                        <div class="flex flex-col self-center">
                            <a href="/profile/{{$pending->username}}"
                                class="text-base hover:underline whitespace-nowrap">{{$pending->username}}</a>
                            <h3 class="text-sm text-gray-500 truncate whitespace-nowrap" style="max-width: 25ch">
                                {{$pending->bio}}</h3>
                        </div>
                    </div>
                    @livewire('follow-button',['profile_id'=>$pending->id],key($pending->id))
                </div>
            </div>
            @endforeach
            <div class="pagination">
                @if ($pendings->lastPage() > 1)
                <ul class="pagination-list">
                    @if ($pendings->currentPage() == 1)
                    <li class="pagination-item is-disabled"><span>&laquo;</span></li>
                    @else
                    <li class="pagination-item"><a href="{{ $pendings->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                    @endif

                    @for ($i = 1; $i <= $pendings->lastPage(); $i++)
                        @if ($i == $pendings->currentPage())
                        <li class="pagination-item is-active"><span>{{ $i }}</span></li>
                        @else
                        <li class="pagination-item"><a href="{{ $pendings->url($i) }}">{{ $i }}</a></li>
                        @endif
                        @endfor

                        @if ($pendings->currentPage() == $pendings->lastPage())
                        <li class="pagination-item is-disabled"><span>&raquo;</span></li>
                        @else
                        <li class="pagination-item"><a href="{{ $pendings->nextPageUrl() }}" rel="next">&raquo;</a></li>
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