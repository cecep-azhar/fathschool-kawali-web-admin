<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>403 | {{ __('Forbidden') }}</title>
    <!-- Scripts -->
    @include('errors.links')
</head>

<body class="h-screen w-full flex flex-col justify-center items-center bg-[#1A2238]">
    <h1 class="text-9xl font-extrabold text-gray-400 tracking-widest">
        403
    </h1>
    <div class="bg-gray-900 px-2 text-gray-400 text-sm rounded rotate-12 absolute">
        {{ __('Forbidden') }}
    </div>
    <button class="mt-5">
        <a href="/"
            class="relative inline-block text-sm font-medium text-gray-400 group active:text-gray-500 focus:outline-none focus:ring">
            <span
                class="absolute inset-0 transition-transform translate-x-0.5 translate-y-0.5 bg-gray-900 group-hover:translate-y-0 group-hover:translate-x-0"></span>
            <span class="relative block px-8 py-3 bg-[#1A2238] border border-current">
                Home
            </span>
        </a>
    </button>
</body>

</html>
