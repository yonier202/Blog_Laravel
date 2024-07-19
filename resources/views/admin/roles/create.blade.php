<x-admin-layout :breadcrumb="[
    [
        'name' => 'Home',
        'url' => route('admin.dashboard')

    ],
    [
        'name' => 'Permisos',
        'url' => route('admin.roles.index')
    ],
    [
        'name' => 'Nuevo'
    ]
]">
    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{route('admin.roles.store')}}" method="POST">
            @csrf

            <x-validation-errors class="mb-4"></x-validation-errors>

            {{-- <div class="mb-4">
                <x-label class="mb-1">Permisos</x-label>
                <select multiple wire:model="permissions" name="permissions[]" class="w-full">
                    @foreach($permissions as $permission)
                        <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                    @endforeach
                </select>
            </div> --}}

           <div class="mb-4">
                <x-label class="mb-1">Nombre del Rol</x-label>
                <x-input name="name" 
                    value="{{old('name')}}"
                    class="w-full" placeholder="Ingrese elnombre del rol"></x-input>
           </div>

           <div class="mb-4">
            <ul>
                <p class="font-semibold">Permisos</p>
                @foreach ($permissions as $permission )
                    <li>
                        <label>
                            <x-checkbox
                                name="permissions[]"
                                :checked="in_array($permission->id, old('permissions', []))"
                                value="{{$permission->id }}"/>
                                {{ $permission->name }}
                        </label>
                    </li>
                @endforeach
            </ul>
       </div>
            
            <x-button>Crear Rol</x-button>
        </form>
    </div>
</x-admin-layout>