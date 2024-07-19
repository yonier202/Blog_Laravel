@props([
    'breadcrumb' => [],
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{--sweetalert2--}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- Font Awesome --}}
        <script src="https://kit.fontawesome.com/a4b5fc29b1.js" crossorigin="anonymous"></script>
        <!-- Styles -->
        @livewireStyles

        @stack('css')
    </head>
    <body class="font-sans antialiased sm:overflow-auto" 
        :class="{ 'overflow-hidden' : open}"
        x-data="{open: false}"> {{--inicializar alpine--}}

        @include('layouts.includes.admin.nav')

        @include('layouts.includes.admin.aside')
    
  
        <div class="p-4 sm:ml-64">

            <div class="mt-14 -mb-10 flex justify-between items-center">
                @include('layouts.includes.admin.breadcrumb');

                @isset($action)
                    {{ $action }}
                @endisset
            </div>

            <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            
                {{$slot}} {{--CONTENIDO--}}

            </div>
        </div>


        <div x-cloak x-show = "open" x-on:click = "open = false" class="bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-30 sm:hidden"></div>
        
        @stack('modals')

        @livewireScripts

        {{---ALERTA SWEETALERT2--}}
        @if (session('swal')) {{--si esxite esta variable de sesion--}}
            <script>
                Swal.fire(@json(session('swal'))); //convertir en json y traer la varible swal
            </script>
        
        @endif
        
        <script src="{{ asset('assets/ckeditor/main.js') }}"></script>

        @stack('js')
    </body>
</html>
