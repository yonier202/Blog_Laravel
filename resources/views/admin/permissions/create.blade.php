<x-admin-layout>
    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{route('admin.permissions.store')}}" method="POST">
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
            <x-label class="mb-1">Nombre del Permiso</x-label>
            <x-input name="name" 
                value="{{old('name')}}"
                class="w-full" placeholder="Ingrese elnombre del Permiso"></x-input>
           </div>
            
            <x-button>Crear Permiso</x-button>
        </form>
    </div>
</x-admin-layout>