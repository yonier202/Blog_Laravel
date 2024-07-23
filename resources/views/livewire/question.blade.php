<div>
    {{-- @dump($model) --}}
   <div class="flex">
        <figure>
            <img class="w-12 h-12 object-cover object-center rounded-full"  src="{{auth()->user()->profile_photo_url}}" alt="">
        </figure>
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
        @foreach ($questions as $question)
            <li>
                <div class="flex">
                    <figure class="mr-4">
                        <img src="{{$question->user->profile_photo_url}}" alt="" class="w-12 h-12 object-cover object-center rounded-full">
                    </figure>
                    <div class="flex-1">
                        <p class="font-semibold">
                            {{$question->user->name}}
                            <span class="text-gray-500 text-sm font-normal">
                                {{$question->created_at->diffForHumans()}} 
                            </span>
                        </p>
                        <p>
                            {{$question->body}}
                        </p>
                    </div>
                    <div>
                        <x-dropdown>
                            
                        </x-dropdown>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    </ul>
</div>
