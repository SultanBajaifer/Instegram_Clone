<x-app-layout>
    <x-slot name='header'>
    </x-slot>

    <div class="grid grid-cols-12 mt-7 gap-4">
        <div class='col-start-5 col-span-4'>
            <h3 class='mt-4 mb-4 text-gray-500 font-semibold text-center text-3xl'>{{__('Apply Filters')}}</h3>

            @livewire('filters',['post_caption'=>$post_caption,'image_path'=>$image_path])

        </div>
    </div>


</x-app-layout>