<form method="POST" action="/reservations" enctype="multipart/form-data">
    @csrf

    <x-form.input name="name"/>
    <x-form.input name="email"/>
    <x-form.input name="date"/>

    <x-form.label name="Service"/>
        <select name="service_id" id="service_id">
            @foreach (\App\Models\Service::all() as $service)
                <option
                        value="{{ $service->id }}"
                        {{ old('service_id') == $service->id ? 'selected' : '' }}
                >{{ ucwords($service->name) }}</option>
            @endforeach
        </select>
    <x-form.error name="service"/>

    <x-form.label name="Worker"/>
        <select name="user_id" id="user_id">
            @foreach (\App\Models\User::all() as $user)
                <option
                        value="{{ $user->id }}"
                        {{ old('user_id') == $user->id ? 'selected' : '' }}
                >{{ ucwords($user->name) }}</option>
            @endforeach
        </select>
    <x-form.error name="user"/>
    <x-form.button>Publish</x-form.button>
</form>
