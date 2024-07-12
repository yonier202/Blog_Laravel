
@php
    $links=[
        [
            'name' => 'Dashboard',
            'url' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard'),
            'icon' => 'fa-solid fa-gauge',
        ],
        [
            'name' => 'Categorías',
            'url' => route('admin.categories.index'),
            'active' => request()->routeIs('admin.categories.*'),
            'icon' => 'fa-solid fa-inbox',
         ],
         [
            'name' => 'Posts',
            'url' => route('admin.posts.index'),
            'active' => request()->routeIs('admin.posts.*'),
            'icon' => 'fa-solid fa-blog',
         ]
        
    ];

@endphp


<aside id="logo-sidebar"
   class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" 
   :class="{
      '-translate-x-full' :!open,
      'transform-none' : open,
   }"
   aria-label="Sidebar">
      <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
         <ul class="space-y-2 font-medium">
            @foreach ($links as $link)
               <li>
                  <a href="{{$link['url']}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{$link['active'] ? 'bg-gray-100' : '' }}">
                  {{-- <a href="{{route('admin.dashboard')}}" class="pointer-events-auto"> --}}
                     {{-- <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                        <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                     </svg> --}}
                        <i class="{{$link['icon']}} text-gray-500"></i>
                        <span class="ml-3 text-gray-500"> {{ $link['name'] }}</span>
                  </a>
               </li>
            @endforeach
         </ul>
      </div>
</aside> 