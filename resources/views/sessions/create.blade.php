<x-layout>
    <x-form.go-home-button/>
    <section class="flex items-center justify-center h-screen">
        <main>
            <div class="max-w-md mx-auto px-6 py-8 bg-white shadow-md rounded-md">
                <h1 class="text-2xl font-bold mb-6">Log in!</h1>

                <form method="POST" action="/login">
                    @csrf

                    <x-form.input name="email" type="email" class="mb-4" />
                    <x-form.input name="password" type="password" autocomplete="new-password" class="mb-4" />
                    <x-form.button class="w-full">Log in</x-form.button>
                </form>
            </div>
        </main>
    </section>
</x-layout>

