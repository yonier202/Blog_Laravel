<x-admin-layout>

    <div class="bg-white rounded shadow-lg p-6">
        <form action="{{ route('admin.users.update', $user)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <x-label>
                    Nombre
                </x-label>
                <x-input class="w-full"
                    name="name"
                    value="{{ old('name', $user->name) }}">
                </x-input>
            </div>
            <div class="mb-4">
                <x-label>
                    Email
                </x-label>
                <x-input type="email" class="w-full"
                    name="email"
                    value="{{ old('email', $user->email) }}">
                </x-input>
            </div>

            <div class="mb-4">
                <x-label>
                    Password
                </x-label>
                <x-input type="password" class="w-full"
                    name="password">
                </x-input>
            </div>
            <div class="mb-4">
                <x-label>
                Confirmar Password
                </x-label>
                <x-input type="password" class="w-full"
                    name="password_confirmation">
                </x-input>
            </div>

            <div class="mb-4">
                <ul>
                    @foreach ($roles as $rol)
                        <li>
                            <label>
                                <x-checkbox
                                    name="roles[]"
                                    :checked="in_array($rol->id, old('roles', $user->roles->pluck('id')->toArray()))"
                                    value="{{ $rol->id }}">
                                </x-checkbox>{{ $rol->name }}    
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
            
            <div class="flex justify-end">
                <x-button>
                    Actualizar
                </x-button>
            </div>
        </form>
    </div>
</x-admin-layout>
