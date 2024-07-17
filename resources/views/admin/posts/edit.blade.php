<x-admin-layout>
    
    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush

    <form action="{{route('admin.posts.update', $post)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <x-validation-errors class="mb-4"></x-validation-errors>

        <div class="mb-6 relative">
            <figure>
                <img id="imgPreview"
                    class="aspect-[16/9] object-cover object-center w-full" src="{{ $post->image}}" alt="Cover Image">
            </figure>

            <div class="absolute top-8 right-8">
                <label for="file_img" class="cursor-pointer bg-white px-4 py-2 rounded-lg">
                    <i class="fa-solid fa-camera mr-2"></i>
                    Actualizar Imagen
                    <input onchange="previewImage(event, '#imgPreview')" 
                        type="file" accept="image/*" name="image" id="file_img" class="hidden">
                </label>
            </div>
        </div>

        <div class="mb-4">
            <x-label class="mb-1">
                Titulo
            </x-label>
            <x-input
                name="title"
                value="{{old('title', $post->title)}}"
                class="w-full" 
                placeholder="escriba el titulo del post">

            </x-input>
        </div>
        <div class="mb-4">
            <x-label class="mb-1">
                Slug
            </x-label>
            <x-input
                name="slug"
                value="{{ old('slug', $post->slug)}}"
                class="w-full" 
                placeholder="escriba el slug del post">

            </x-input>
        </div>
        <div class="mb-4">
            <x-label>
                Categoría 
            </x-label>
            <x-select class="w-full" name="category_id">
                @foreach ($categories as $category)
                    <option @selected(old('category_id', $post->category_id)==$category->id) value="{{$category->id}}"> {{$category->name}}</option>
                @endforeach
            </x-select>
        </div>
        <div class="mb-4">
            <x-label class="mb-1">
                Resumen
            </x-label>
            <x-textarea name="excerpt" class="w-full">
                {{old('excerpt', $post->excerpt)}}
            </x-textarea>
        </div>
        <div class="mb-4">
            <x-label class="mb-1">
                Etique
            </x-label>
            <select class="tag-multiple w-full" name="tags[]" multiple="multiple">
               
                @foreach ($post->tags as $tag)
                    <option value="{{$tag->name}}" selected> 
                        {{$tag->name}}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <x-label class="mb-1">
                Cuerpo
            </x-label>
            <div class="ckeditor">
                <x-textarea id="editor" name="body" class="w-full" rows="8">
                    {{old('body', $post->body)}}
                </x-textarea>
            </div>
        </div>

        <div class="mb-4">

            <input type="hidden" name="published" value="0">

            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" 
                name="published" 
                value="1"
                @checked(old('published', $post->published) == 1) 
                class="sr-only peer">
                
                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Publicar</span>
            </label>
  
        </div>
        <div class="flex justify-end">
            <x-button class="mr-2">
                Actualizar
            </x-button>
            <x-danger-button onclick="deletePost()">
                Eliminar Categoria
            </x-danger-button>
        </div>
    </form>

    <form action="{{route('admin.posts.destroy', $post)}}"
        method="POST"
        id="formDelete"> {{--agrego id para eliminar con javascript--}}

        @csrf
        @method('DELETE')

    </form>

    @push('js')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> {{--cdn select 2--}}

        <script>
            function previewImage(event, querySelector){

            //Recuperamos el input que desencadeno la acción
            const input = event.target;

            //Recuperamos la etiqueta img donde cargaremos la imagen
            $imgPreview = document.querySelector(querySelector);

            // Verificamos si existe una imagen seleccionada
            if(!input.files.length) return

            //Recuperamos el archivo subido
            file = input.files[0];

            //Creamos la url
            objectURL = URL.createObjectURL(file);

            //Modificamos el atributo src de la etiqueta img
            $imgPreview.src = objectURL;
                        
            }
        </script>

        <script>
            $(document).ready(function() {
                $('.tag-multiple').select2({
                    tags: true, // Permite agregar nuevas etiquetas
                    tokenSeparators: [',', ' '], // Define separadores de tokens
                    ajax: {
                        url: '{{route('api.tags.index')}}', // URL para la solicitud AJAX
                        dataType: 'json', // Formato de datos esperado
                        delay: 250, // Retraso en ms para la solicitud AJAX
                        data: function(params){
                            return {
                                term: params.term // Parámetro de búsqueda enviado al servidor
                            }
                        },
                        processResults: function(data){
                            return {
                                results: data // Procesa los datos recibidos y los formatea para Select2
                            }
                        }
                    }
                });
            });

        // // Inicializar CKEditor en los elementos que tengan el ID 'editor'
        // document.addEventListener('DOMContentLoaded', function () {
        //     const editors = document.querySelectorAll('#editor',{

        //         simpleUpload: {
        //             // The URL that the images are uploaded to.
        //             uploadUrl: "{{route('images.upload')}}",

        //             // Enable the XMLHttpRequest.withCredentials property.
        //             withCredentials: true,

        //             // Headers sent along with the XMLHttpRequest to the upload server.
        //             headers: {
        //                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        //             }
        //         }
        //     });
            // editors.forEach((editor) => {
                ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });
            // });
        // });   
        </script>
        

        <script>
            function deletePost(){
                // console.log('Eliminando');
                let eliminarPost = document.querySelector('#formDelete');
                eliminarPost.submit();
            }
        </script>
     
    @endpush
</x-admin-layout>