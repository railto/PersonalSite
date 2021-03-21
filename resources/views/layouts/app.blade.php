<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @isset($meta)
        {{ $meta }}
    @endisset

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <title>Mark Railton</title>
</head>

<body class="flex flex-col h-screen justify-between">
    <header>
        <nav class="flex items-center justify-between px-4 lg:px-32 py-2 flex-wrap w-full z-10 top-0" x-data="{ isOpen: false }" @keydown.escape="isOpen = false" :class="{ 'shadow-lg bg-indigo-600' : isOpen , 'bg-indigo-600' : !isOpen}">
            <!--Logo etc-->
            <div class="flex items-center text-white mr-6">
                <a class="flex items-center text-white" href="#">
                    <svg class="h-6 w-6 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>

                    <span class="mx-3 text-xl">Mark Railton</span>
                </a>
            </div>

            <!--Toggle button (hidden on large screens)-->
            <button @click="isOpen = !isOpen" type="button" class="block lg:hidden px-2 text-gray-500 hover:text-white focus:outline-none focus:text-white" :class="{ 'transition transform-180': isOpen }">
                <svg class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path x-show="isOpen" fill-rule="evenodd" clip-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z" />
                    <path x-show="!isOpen" fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z" />
                </svg>
            </button>

            <!--Menu-->
            <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto" :class="{ 'block shadow-3xl': isOpen, 'hidden': !isOpen }" @click.away="isOpen = false" x-show="true" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 transform" x-transition:enter-end="opacity-100 transform" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 transform" x-transition:leave-end="opacity-0 transform">

                <ul class="pt-6 lg:pt-0 mb-0 list-reset lg:flex justify-end flex-1 items-center">
                    <li class="mr-3">
                        <a class="inline-block py-2 px-4 text-white no-underline" href="{{ route('index') }}" @click="isOpen = false">Home</a>
                    </li>
                    <li class="mr-3">
                        <a class="inline-block py-2 px-4 text-white no-underline" href="" @click="isOpen = false">Blog Articles</a>
                    </li>
                    <li class="mr-3">
                        <a class="inline-block py-2 px-4 text-white no-underline" href="{{ route('uses') }}" @click="isOpen = false">Uses</a>
                    </li>
                    <li class="mr-3">
                        <a class="inline-block py-2 px-4 text-white no-underline" href="{{ route('filament.dashboard') }}" @click="isOpen = false">Admin</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        {{ $slot }}
    </main>

</body>

</html>