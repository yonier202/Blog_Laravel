<div class="pl-16">
    <button wire:click="$set('answer_created.open', true)"> {{--Metodo magico cambiar a true--}}
        <i class="fas fa-reply"></i>
        Responder
    </button>

    @if ($answer_created['open'])
    <div class="flex ">
        @auth
            <figure class="mr-2">
                <img class="w-12 h-12 object-cover object-center rounded-full"  src="{{auth()->user()->profile_photo_url}}" alt="">
            </figure>
        @else
            <figure>
                <img class="w-12 h-12 object-cover object-center rounded-full"  src="{{asset('img/home/user/user_no_login.jpg')}}">
            </figure>
        @endauth

        <form class="flex-1" wire:submit.prevent="store()">
            <textarea placeholder="Escriba su respuesta" wire:model="answer_created.body"
            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
            
            <x-input-error for="answer_created.body"></x-input-error>
            
            <div class="flex justify-end">
                <x-danger-button wire:click="$set('answer_created.open', false)"
                    class="mr-2">Cancelar
                </x-danger-button>
                <x-button>Responder</x-button>
            </div>
        </form>
    </div>    
    @endif

    @if ($question->answers()->count()) {{--validacion si tiene respuestas--}}
        <div class="mt-2">
            <button class="font-semibold text-blue-500" wire:click="show_answer">
                @if ($this->cant < $this->question->answers()->count())
                    Mostrar respuestas
                @else
                    ocultar respuesta 
                @endif
            </button>
        </div>
    @endif

    <ul class="space-y-6 mt-4">
        @foreach ($this->answers as $answer)
            <li wire:key="answer-{{$answer->id}}"> {{--agregar llaves identificativas--}}
                <div class="flex">
                    <figure class="mr-4">
                        <img src="{{$answer->user->profile_photo_url}}" alt="" class="w-12 h-12 object-cover object-center rounded-full">
                    </figure>

                    <div class="flex-1">
                        <p class="font-semibold">
                            {{$answer->user->name}}
                            <span class="text-gray-500 text-sm font-normal">
                                {{$answer->created_at->diffForHumans()}} {{--Poner en tiempo humano--}}
                            </span>
                        </p>
                        @if ($answer->id === $answer_edit['id']) {{--si doy click en editar--}}
                            <form wire:submit.prevent="update()">
                                <textarea wire:model="answer_edit.body" {{--trae el texto --}}
                                class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                                
                                <x-input-error for="answer_edit.body"></x-input-error>
                                
                                <div class="flex justify-end">
                                    <x-danger-button wire:click="cancel()" 
                                        class="mr-2">Cancelar
                                    </x-danger-button>
                                    <x-button>Actualizar</x-button>
                                </div>
                            </form>
                        @else
                            <p>
                                {{$answer->body}}
                            </p>
                            <button wire:click="$set('answer_to_answer.id', {{$answer->id}})"> {{--Metodo magico cambiar a true--}}
                                <i class="fas fa-reply"></i>
                                Responder
                            </button>
                        @endif
                    </div>
                    <div class="ml-8">
                        <div class="ml-8">
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button>
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </x-slot>
    
                                <x-slot name="content">
                                    <x-dropdown-link wire:click="edit({{$answer->id}})" 
                                        class="cursor-pointer">Editar</x-dropdown-link>
                                    <x-dropdown-link wire:click="destroy({{$answer->id}})"
                                        class="cursor-pointer">Eliminar</x-dropdown-link>
                                </x-slot>
                        
                            </x-dropdown>
                        </div>
                    </div>
                </div>

                @if($answer_to_answer['id'] === $answer->id)
                    <div class="flex mt-4">
                        <figure class="mr-4">
                            <img src="{{$answer->user->profile_photo_url}}" alt="" class="w-12 h-12 object-cover object-center rounded-full">
                        </figure>
                        <div class="flex-1">
                            <form wire:submit.prevent="answer_to_answer_store()">
                                <textarea wire:model="answer_to_answer.body"
                                class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Ingrese una respuesta"></textarea>
                                
                                {{-- <x-input-error for="answer_edit.body"></x-input-error> --}}
                                
                                <div class="flex justify-end">
                                    <x-danger-button wire:click="$set('answer_to_answer.id', null)" 
                                        class="mr-2">Cancelar
                                    </x-danger-button>
                                    <x-button>Responder</x-button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </li>
        @endforeach
    </ul>
</div>
