<x-app-layout>
    <x-slot name='header'>
        <div class="flex justify-center">
            <h1 class="text-2xl md:text-5xl mt-7">{{__('Edit Post')}}</h1>
        </div>
    </x-slot>

    <div class="grid grid-cols-5 mt-7">
        <form class="col-start-2 col-span-6 max-w-4xl" method="POST" action="/posts/{{$post->id}}" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('PUT')

            <div>
                <x-label value="{{__('Caption')}}"/>
                <textarea class="block mt-1 w-full h-20" name="post_caption" id="" :value="old('post_caption')" value="{{$post->post_caption}}" autofocus cols="30" rows="10">

                    {{-- <x-input class="block mt-1 w-full h-20" type="text" name="post_caption" :value="old('post_caption')"autofocus/> --}}
                </textarea>

            </div>

            <div class="mt-4">
                <x-label value="{{__('Image')}}"/>
                <x-input class="block mt-1 w-full bg-white p-2" type="file" name="image_path" :value="old('image_path')" value="{{$post->image_path}}" autofocus/>
            </div>

            <x-button class="mt-4">
                {{__('Publish')}}
            </x-button>
        </form>
    </div>
</x-app-layout>
