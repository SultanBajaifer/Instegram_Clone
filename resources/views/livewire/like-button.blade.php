<div class="flex flex-col items-start ps-4 pb-1">
    <div class="flex flex-row items-center">
        <button class="text-2xl me-3 focus:outline-none" wire:model='like-button' wire:click='ToggleLike({{$post_id}})'>
            <i class="{{$isLiked ? " fa text-red-500": "far" }} fa-heart"></i></button>
        <button class="text-2xl me-3 focus:outline-none" onclick="comment(this)">
            <i class="far fa-comment">
            </i>
        </button>
        <button class="text-2xl me-3 focus:outline-none" id="{{$post_id}}" onclick="copyToClipboard({{$post_id}})"
            value="{{url('')}}/posts/{{$post_id}}"><i class="far fa-share-square"></i></button>
    </div>

    <span>{{__("Liked By ")}} {{$likeCount}}</span>
</div>