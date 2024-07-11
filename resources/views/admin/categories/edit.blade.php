<x-admin-layout>

    <div class="mb-4">
        <form action="{{route('admin.categories.update', $category)}}" 
            method="POST"
            class="bg-white rounded-lg p-6 shadow-lg">

            @csrf
            @method('PUT')

            <x-validation-errors class="mb-4"></x-validation-errors>

            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre
                </x-label>
                <x-input
                    name="name"
                    class="w-full"
                    placeholder="Escriba el nombre de la categoria"
                    value="{{$category->name}}">
                </x-input>
            </div>

            <div class="flex justify-end">
                <x-button class="mr-2">
                    Actualizar Categoría
                </x-button>

                <x-danger-button onclick="deleteCategory()">
                    Eliminar Categoria
                </x-danger-button>
            </div>

        </form>
    </div>

    <form action="{{route('admin.categories.destroy', $category)}}"
        method="POST"
        id="formDelete"> {{--agrego id para eliminar con javascript--}}

        @csrf
        @method('DELETE')

    </form>

    @push('js')
        <script>
            function deleteCategory(){
                // console.log('Eliminando');
                let eliminarCategory = document.querySelector('#formDelete');
                eliminarCategory.submit();
            }
        </script>
    @endpush
</x-admin-layout>