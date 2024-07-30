<section class="space-y-6">
    <x-primary-button class="w-max !text-xs" x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-update{{ $user->id }}')">{{ __('Update') }}</x-primary-button>

    <x-modal name="confirm-user-update{{ $user->id }}" :show="$errors->userUpdate->isNotEmpty()" focusable>
        <form method="post" action="{{ route('admin.users.update', ['user' => $user->id]) }}" class="p-6">
            @csrf
            @method('put')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Edit User') }}
            </h2>

            {{-- Name --}}
            <div class="mt-6">
                <x-input-label for="update_name{{ $user->id }}" value="{{ __('Name') }}" />

                <x-text-input id="update_name{{ $user->id }}" name="name" type="text" class="mt-1 block w-3/4"
                    placeholder="{{ __('Name') }}" value="{{ $user->name }}" />

                <x-input-error :messages="$errors->userUpdate->get('name')" class="mt-2" />
            </div>

            {{-- Role --}}
            <div class="mt-6">
                <x-input-label for="update_role{{ $user->id }}" value="{{ __('Role') }}" />

                <select id="update_role{{ $user->id }}" name="role"
                    class="mt-1 block w-3/4 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" />
                @foreach (\App\Enums\UserRole::cases() as $role)
                    <option value="{{ $role->value }}" {{ $user->role === $role->value ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
                </select>

                <x-input-error :messages="$errors->userUpdate->get('role')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Update User') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</section>
