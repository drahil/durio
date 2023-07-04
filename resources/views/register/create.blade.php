<x-layout>
    <section class="flex items-center justify-center h-screen">
        <main>
            <div class="max-w-md mx-auto px-6 py-8 bg-white shadow-md rounded-md">
                <h1 class="text-2xl font-bold mb-6">Register!</h1>

                <form method="POST" action="/register">
                    @csrf

                    <x-form.input name="name" type="name" class="mb-4"/>
                    <x-form.input name="email" type="email" />
                    <x-form.input name="password" type="password" autocomplete="new-password" class="mb-4"/>
                    <x-form.button class="w-full">Register</x-form.button>
                </form>
            </div>
        </main>
    </section>
</x-layout>

