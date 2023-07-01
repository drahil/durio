<form method="POST" action="/users" enctype="multipart/form-data">
    @csrf

    <x-form.input name="name"/>
    <x-form.input name="email"/>
    <x-form.input name="password"/>


    <x-form.error name="user"/>
    <x-form.button>Publish</x-form.button>
</form>
