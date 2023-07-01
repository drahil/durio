<form method="POST" action="/reservations" enctype="multipart/form-data">
    @csrf

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
        <select name="worker_id" id="worker_id">
            @foreach (\App\Models\User::where('role', '=', 'worker')->get() as $worker)
                <option
                        value="{{ $worker->id }}"
                        {{ old('worker_id') == $worker->id ? 'selected' : '' }}
                >{{ ucwords($worker->name) }}</option>
            @endforeach
        </select>
    <x-form.error name="user"/>
    <x-form.button>Publish</x-form.button>
</form>
