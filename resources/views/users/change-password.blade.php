<x-layout>
    <x-form.go-home-button/>
    <section class="flex items-center justify-center h-screen">
        <main>
            <div class="max-w-md mx-auto px-6 py-8 bg-white shadow-md rounded-md">
                <h1 class="text-2xl font-bold mb-6">Log in!</h1>

                <form method="POST" action="{{ route('changePasswordSave') }}">
                    @csrf

                    <x-form.input name="current password" type="current_password" class="mb-4" />
                    <x-form.input name="new password" type="new_password" class="mb-4" />
                    <x-form.input name="new password confirmation" type="new_password_confirmation" class="mb-4" />

                    <x-form.button class="w-full">Submit</x-form.button>
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
