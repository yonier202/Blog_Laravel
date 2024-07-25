
<div>
    {{-- @dump($model) --}}
   <div class="flex">
        @auth
            <figure>
                <img class="w-12 h-12 object-cover object-center rounded-full"  src="{{auth()->user()->profile_photo_url}}" alt="">
            </figure>
        @else
            <figure>
                <img class="w-12 h-12 object-cover object-center rounded-full"  src="{{asset('img/home/user/user_no_login.jpg')}}">
            </figure>
        @endauth
        
        <div class="ml-4 flex-1">
            <form wire:submit.prevent="store"> {{--escuchar el evento submit(ejecutar store)--}} 
                <textarea wire:model.defer="message" {{--pasar el valor en message--}}
                placeholder="Escribe tu mensaje" rows="3" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                

                <x-input-error for="message" class="mt-1" />

                <div class="flex justify-end">
                    <x-button>
                        Comentar
                    </x-button>
               </div>
            </form>
            {{-- {{$message}} --}}
        </div>
   </div>

   <p class="text-lg font-semibold mt-6 mb-4">
        Comentarios: 
    </p>

    <ul class="space-y-6">
        @foreach ($this->questions as $question)
            <li wire:key="question-{{$question->id}}"> {{--agregar llaves identificativas--}}
                <div class="flex">
                        <figure class="mr-4">
                            <img src="{{$question->user->profile_photo_url}}" alt="" class="w-12 h-12 object-cover object-center rounded-full">
                        </figure>
                    <div class="flex-1">
                        <p class="font-semibold">
                            {{$question->user->name}}
                            <span class="text-gray-500 text-sm font-normal">
                                {{$question->created_at->diffForHumans()}} {{--Poner en tiempo humano--}}
                            </span>
                        </p>
                        @if ($question->id === $question_edit['id']) {{--si doy click en editar--}}
                            <form wire:submit.prevent="update()">
                                <textarea wire:model="question_edit.body" {{--trae el texto --}}
                                class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                                
                                <x-input-error for="question_edit.body"></x-input-error>
                                
                                <div class="flex justify-end">
                                    <x-danger-button wire:click="cancel()" 
                                        class="mr-2">Cancelar
                                    </x-danger-button>
                                    <x-button>Actualizar</x-button>
                                </div>
                            </form>
                        @else
                            <p>
                                {{$question->body}}
                            </p>
                        @endif
                    </div>
                    <div class="ml-8">
                        <x-dropdown>
                            <x-slot name="trigger">
                                <button>
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link wire:click="edit({{$question->id}})" 
                                    class="cursor-pointer">Editar</x-dropdown-link>
                                <x-dropdown-link wire:click="destroy({{$question->id}})"
                                    class="cursor-pointer">Eliminar</x-dropdown-link>
                            </x-slot>
                    
                        </x-dropdown>
                    </div>
                </div>

                @livewire('answer', compact('question'), key('answer-'.$question->id))
            </li>
        @endforeach
    </ul>
    @if ($model->questions()->count() -$cant > 0)
        <div class="flex items-center">
            <hr class="flex-1">
                <button class="text-sm font-semibold text-gray-500 hover:text-gray-600 mx-4" wire:click="show_more_question">
                    ver los {{$model->questions()->count()-$cant}} comentario restantes
                </button>
            <hr class="flex-1">
        </div>
    @endif
    {{-- @dump($question_edit)--}}
    {{-- @push('js')
        <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/balloon/ckeditor.js"></script>
        <script>
            BalloonEditor
               .create(document.querySelector('#editor'))
               .catch(error => {
                    console.error( error );
                });
        </script>
    @endpush --}}
</div>