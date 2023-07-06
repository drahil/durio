<x-layout>
    <x-form.go-home-button/>
    <section class="flex items-center justify-center h-screen">
        <main>
            <div class="max-w-md mx-auto px-6 py-8 bg-white shadow-md rounded-md">
                <h1 class="text-2xl font-bold mb-6">Add a worker!</h1>

                <form method="POST" action="/users" enctype="multipart/form-data">
                    @csrf

                    <x-form.input name="name" type="name" class="mb-4" />
                    <x-form.input name="email" type="email" class="mb-4" />
                    <x-form.textarea name="description" class="mb-4"/>
                    <x-form.input name="password" type="password" autocomplete="new-password" class="mb-4" />
                    <x-form.button class="w-full">Create</x-form.button>
                    <x-form.error name="user"/>
                </form>
            </div>

            @if(Session::has('success'))
                <div class="text-blue-500">
                    {{ Session::get('success') }}
                </div>
            @endif

        </main>
    </section>
</x-layout>
