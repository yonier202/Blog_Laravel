<x-admin-layout :breadcrumb="[
    [
        'name' => 'Home',
        'url' => route('admin.dashboard')

    ],
    [
        'name' => 'Permisos',
        'url' => route('admin.permissions.index')
    ],
    [
        'name' => $permission->name,
    ]
]">
    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{route('admin.permissions.update', $permission)}}" method="POST">
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
            <x-label class="mb-1">Nombre del Permiso</x-label>
            <x-input name="name" 
                value="{{old('name', $permission->name)}}"
                class="w-full" placeholder="Ingrese el nombre del permiso"></x-input>
           </div>
            
            <div class="flex">
                <x-button>Actualizar Permiso</x-button>
                <x-danger-button class="ml-2" onclick="deletePermiso()">
                    Eliminar Permiso
                </x-danger-button>
            </div>
        </form>
    </div>

    <form action="{{route('admin.permissions.destroy', $permission)}}"
        method="POST"
        id="formDelete"> {{--agrego id para eliminar con javascript--}}

        @csrf
        @method('DELETE')

    </form>

    @push('js')
        <script>
            function deletePermiso(){
                // console.log('Eliminando');
                let eliminarPermiso= document.querySelector('#formDelete');
                eliminarPermiso.submit();
            }
        </script>
    @endpush
</x-admin-layout>