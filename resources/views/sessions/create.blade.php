<section>
    <main>
        <div>
            <h1>Log in!</h1>

            <form method="POST" action="/login">
                @csrf

                <x-form.input name="email" type="email" />
                <x-form.input name="password" type="password" autocomplete="new-password" />
                <x-form.button>Log in</x-form.button>
            </form>
        </div>
    </main>
</section>
