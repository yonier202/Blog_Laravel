<x-app-layout>
    <figure class="mb-12">
        <img src="{{asset('img/home/economia.jpeg')}}"
        alt="Portada Home"
        class="w-full aspect-[13/5] object-cover object-center">
    </figure>
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
        <h1 class="text-3xl text-center font-semibold mb-6">
            Lista de articulos
        </h1>

        <div class="grid grid-cols-4">
            <div class="col-span-1">
                <form action="{{route('home')}}">

                    <div class="mb-4">
                        <p class="text-lg font-semibold">Ordenar:</p>

                        <select name="order" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="new" >
                                Más nuevos
                            </option>
                            <option value="old" @selected(request('order')== 'old')>
                                Más antiguos
                            </option>
                        </select>
                    </div>
                    <div class="mb-4">

                        <p class="text-lg font-semibold">Categorias:</p>
                        <ul>
                            @foreach ($categories as $category)
                                <li>
                                    <label>
                                        <x-checkbox name="categories[]" value="{{$category->id}}" :checked="in_array($category->id, request('categories') ?? [])" />
                                        <span class="ml-2 text-gray-700">{{ $category->name }}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <x-button>
                        Aplicar Filtros
                    </x-button>
                </form>
            </div>
            <div class="col-span-3">
                {{--BUSCADOR--}}

                <div class="space-y-8">
                    @foreach ($posts as $post)
                        <article class="grid grid-cols-2 gap-6">
                            <figure>
                                <img src="{{$post->image}}" alt="{{$post->title}}">
                            </figure>
                            <div>
                                <h1 class="text-xl font-semibold">
                                    {{$post->title}}
                                </h1>
                                <hr class="mt-1 mb-2">
                                <div class="mb-2">
                                    @foreach ($post->tags as $tag)
                                        <a href="{{route('home'). '?tag=' .$tag->name}}">
                                            <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                                {{$tag->name}}
                                            </span>
                                        </a>
                                    @endforeach
                                </div>
                                <p class="text-sm mb-2">
                                    {{$post->published_at->format('d M Y')}}
                                </p>
                                <div class="mb-4">
                                    {{Str::limit($post->excerpt), 100}}
                                </div>
                                <div>
                                    <a href="{{route('posts.show', $post)}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Leer más</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
               </div>
               <div class="mt-10">
                    {{$posts->links()}}
               </div>
            </div>
        </div>

      
    </section>
</x-app-layout>