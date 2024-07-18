<x-admin-layout>
    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{route('admin.roles.update', $role)}}" method="POST">
            @csrf
            @method('PUT')

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
                value="{{old('name', $role->name)}}"
                class="w-full" placeholder="Ingrese el nombre del rol"></x-input>
           </div>
           <div class="mb-4">
                <ul>
                    <p class="font-semibold">Permisos</p>
                    @foreach ($permissions as $permission )
                        <li>
                            <label>
                                <x-checkbox
                                    name="permissions[]"
                                    :checked="in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray()))"
                                    value="{{$permission->id }}"/>
                                    {{ $permission->name }}
                            </label>
                        </li>
                    @endforeach
                </ul>
           </div>
            
            <div class="flex">
                <x-button>Actualizar Rol</x-button>
                <x-danger-button class="ml-2" onclick="deleteRol()">
                    Eliminar Rol
                </x-danger-button>
            </div>
        </form>
    </div>

    <form action="{{route('admin.roles.destroy', $role)}}"
        method="POST"
        id="formDelete"> {{--agrego id para eliminar con javascript--}}

        @csrf
        @method('DELETE')

    </form>

    @push('js')
        <script>
            function deleteRol(){
                // console.log('Eliminando');
                let eliminarRol= document.querySelector('#formDelete');
                eliminarRol.submit();
            }
        </script>
    @endpush
</x-admin-layout>