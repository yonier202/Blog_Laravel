<x-app-layout>
    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white p-8 rounded shadow-lg">
            <form action="{{route('contacts.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <x-validation-errors class="mb-4"></x-validation-errors>

                <div class="mb-4">
                    <x-label>Nombre</x-label>
                    <x-input type="text" name="name" 
                        class="w-full" 
                        placeholder="Ingresa el nombre del contacto"
                        value="{{old('name')}}"
                        ></x-input>
                </div>
                <div class="mb-4">
                    <x-label>Correo</x-label>
                    <x-input name="email" 
                    value="{{old('email')}}"
                    type="email" class="w-full" placeholder="Ingresa el correo del contacto"></x-input>
                </div>
                <div class="mb-4">
                    <x-label>Mensaje</x-label>
                    <textarea value="{{old('message')}}" 
                    class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="message" id="" cols="30" rows="4" placeholder="Ingrese el mensaje del contacto"></textarea>
                </div>
                <div class="mb-4">
                    <x-label>File</x-label>
                    <input type="file" name="file" class="w-full">
                </div>
                <div class="flex justify-end">
                    <x-button>Enviar</x-button>
                </div>

               
            </form>

        </div>

    </section>
</x-app-layout>