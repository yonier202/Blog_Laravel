<x-admin-layout>

    <div class="flex justify-end mb-4">
        <a class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" href="{{route('admin.posts.create')}} ">Nuevo</a>
    </div>

    <ul class="space-y-8 mb-8">
        @foreach ($posts as $post)
            <li class="grid grid-cols-1 lg:grid-cols-2 gap-4"> {{---responsivee--}}
                <div>
                    <a href="{{route('admin.posts.edit', $post)}}">
                        <img class="aspect-[16/9] object-cover object-center w-full" src="{{$post->image}}" alt="">
                    </a>
                </div>
                <div>
                    <h1 class="text-xl font-semibold">
                        <a href="{{route('admin.posts.edit', $post)}}">{{$post->title}}</a>
                    </h1>
                    <hr class="mt-1 mb-2">
                    <span @class([
                            'bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300' => $post->published,
                            'bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300' => ! $post->published
                        ])>
                        {{$post->published ? 'Publicado' : 'Borrador'}}
                    </span>
                    <p class="text-gray-700">
                        {{Str::limit($post->excerpt, 100)}} 
                    </p>
                    <div class="flex justify-end mt-4">
                        <a href="{{route('admin.posts.edit', $post)}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Editar
                        </a>                
                    </div> 
                </div>
            </li>
        @endforeach
    </ul>

    <div>
        {{$posts->links()}}
    </div>

    
</x-admin-layout>