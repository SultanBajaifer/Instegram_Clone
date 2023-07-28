<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    @if (session()->has('message'))
    <div class="bg-indigo-900 text-center py-4 lg:px-4">
        <div class="p-2 bg-indigo-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex"
            role="alert">
            <span class="flex rounded-full bg-indigo-500 uppercase px-2 py-1 text-xs font-bold me-3">New</span>
            <span class="font-semibold me-2 text-left flex-auto">{{ session('message') }}</span>
            <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z" />
            </svg>
        </div>
    </div>
    @endif

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
            <!-- Profile Photo File Input -->
            <input type="file" class="hidden" wire:model="photo" x-ref="photo" x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

            <x-label for="photo" value="{{ __('Photo') }}" />

            <!-- Current Profile Photo -->
            <div class="mt-2" x-show="! photoPreview">
                <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                    class="rounded-full h-20 w-20 object-cover">
            </div>

            <!-- New Profile Photo Preview -->
            <div class="mt-2" x-show="photoPreview" style="display: none;">
                <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                    x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                </span>
            </div>

            <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                {{ __('Select A New Photo') }}
            </x-secondary-button>

            @if ($this->user->profile_photo_path)
            <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                {{ __('Remove Photo') }}
            </x-secondary-button>
            @endif

            <x-input-error for="photo" class="mt-2" />
        </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name"
                autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- username -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="username" value="{{ __('username') }}" />
            <x-input id="username" type="text" class="mt-1 block w-full" wire:model.defer="state.username"
                autocomplete="username" />
            <x-input-error for="username" class="mt-2" />
        </div>

        <!-- bio -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="bio" value="{{ __('bio') }}" />
            <x-input id="bio" type="text" class="mt-1 block w-full" wire:model.defer="state.bio" autocomplete="bio" />
            <x-input-error for="bio" class="mt-2" />
        </div>

        <!-- url -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="url" value="{{ __('url') }}" />
            <x-input id="url" type="text" class="mt-1 block w-full" wire:model.defer="state.url" autocomplete="url" />
            <x-input-error for="url" class="mt-2" />
        </div>
        <!-- status -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="url" value="{{ __('Status') }}" />
            <select name="status" id="status" class="mt-1 block w-full form-input rounded-md shadow-sm"
                wire:model.defer='state.status'>
                <option value="public">{{__('Public')}}</option>
                <option value="private">{{__('Private')}}</option>
            </select>
            <x-input-error for="status" class="mt-2" />
        </div>
        <!-- language -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="url" value="{{ __('language') }}" />
            <select name="language" id="language" class="mt-1 block w-full form-input rounded-md shadow-sm"
                wire:model.defer='state.language'>
                <option value="ar">{{__('Arabic')}}</option>
                <option value="en">{{__('English')}}</option>
            </select>
            <x-input-error for="language" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email"
                autocomplete="email" />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
            !$this->user->hasVerifiedEmail())
            <p class="text-sm mt-2">
                {{ __('Your email address is unverified.') }}

                <button type="button"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    wire:click.prevent="sendEmailVerification">
                    {{ __('Click here to re-send the verification email.') }}
                </button>
            </p>

            @if ($this->verificationLinkSent)
            <p v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to your email address.') }}
            </p>
            @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>

<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('saved', function() {
            alert('Your profile information has been saved.');
        });
    });
</script>