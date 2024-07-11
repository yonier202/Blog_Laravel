<x-admin-layout>

    <div class="mb-4">
        <form action="{{route('admin.categories.store')}}" 
            method="POST"
            class="bg-white rounded-lg p-6 shadow-lg">

            @csrf

            <x-validation-errors class="mb-4"></x-validation-errors>

            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre
                </x-label>
                <x-input
                    name="name"
                    class="w-full"
                    placeholder="Escriba el nombre de la categoria">
                </x-input>
            </div>

            <div class="flex justify-end">
                <x-button>Crear Categoría</x-button>
            </div>

        </form>
    </div>
</x-admin-layout>