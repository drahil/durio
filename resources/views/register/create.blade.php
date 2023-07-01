<section>
    <main>
        <div>
            <h1>Register!</h1>

            <form method="POST" action="/register">
                @csrf

                <x-form.input name="name" type="name" />
                <x-form.input name="email" type="email" />
                <x-form.input name="password" type="password" autocomplete="new-password" />
                <x-form.button>Register</x-form.button>
            </form>
        </div>
    </main>
</section>
