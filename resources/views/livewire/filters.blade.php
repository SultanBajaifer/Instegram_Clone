<div class="max-w-4xl my-0 mx-auto">
    <div class="grid grid-cols-3 gap-4 mx-0 mt-0 mb-10">
        <div>
            <p class="text-center">{{__('Original')}}</p>
            <img src="/storage/{{$image_path}}" class="w-40 h-40 cursor-pointer" wire:model='filters'
                wire:click='applyFilter(0)'>
        </div>
        @for ($i=1;$i<=13;$i++) <div>
            <p class="text-center">{{__('filter '.$i)}}</p>
            <img src="/storage/uploads/{{$i}}.jpeg" class="w-40 h-40 cursor-pointer" wire:model='filters'
                wire:click='applyFilter({{$i}})'>
    </div>

    @endfor

</div>
</div>