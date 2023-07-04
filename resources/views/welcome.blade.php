<x-layout>
    <body class="font-sans">
    <nav class="bg-blue-500 py-4">
        <div class="container mx-auto px-4">
            <ul class="flex justify-between items-center">
                <li><a href="/users" class="text-white hover:text-gray-200">Workers</a></li>
                <li><a href="/services" class="text-white hover:text-gray-200">Services</a></li>
                <li>
                    <hr class="border-gray-700">
                </li>
                @auth
                    <li><a href="/reservations/create" class="text-white hover:text-gray-200">Make a reservation</a></li>
                    <li><a href="/logout" class="text-white hover:text-gray-200">Logout</a></li>
                    <li class="text-white">{{ auth()->user()->name }}</li>
                @else
                    <li><a href="/login" class="text-white hover:text-gray-200">Login</a></li>
                    <li><a href="/register" class="text-white hover:text-gray-200">Register</a></li>
                @endauth
            </ul>
        </div>
    </nav>
    <div class="container mx-auto mt-32">
        <h1 class="text-4xl text-center font-semibold">Durio's Hair Salon</h1>
        <p class="text-lg text-center text-gray-600 mt-4">Welcome to our salon. We provide top-notch hair services tailored to your needs.</p>
    </div>
    </body>
</x-layout>



