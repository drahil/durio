<x-layout>
    <x-form.go-home-button/>
    <section class="flex items-center justify-center h-screen">
        <main>
            <div class="max-w-md mx-auto px-6 py-8 bg-white shadow-md rounded-md">
                <h1 class="text-2xl font-bold mb-6">Edit the idea</h1>

                <form method="POST" action="/reservations/{{$reservation}}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <x-form.input name="date" type="date" class="mb-4"/>

                    <x-form.input name="time" type="time" class="mb-4"/>

                    <x-form.label name="Service" type="service" class="mb-4"/>
                    <select name="service_id" id="service_id">
                        @foreach (\App\Models\Service::all() as $service)
                            <option
                                value="{{ $service->id }}"
                                {{ old('service_id') == $service->id ? 'selected' : '' }}
                            >{{ ucwords($service->type) }}</option>
                        @endforeach
                    </select>
                    <x-form.error name="service"/>

                    <x-form.label name="Worker" type="worker" class="mb-4"/>
                    <select name="worker_id" id="worker_id">
                        @foreach (\App\Models\User::where('role', '=', 'worker')->get() as $worker)
                            <option
                                value="{{ $worker->id }}"
                                {{ old('worker_id') == $worker->id ? 'selected' : '' }}
                            >{{ ucwords($worker->name) }}</option>
                        @endforeach
                    </select>
                    <x-form.error name="reservation"/>
                    <x-form.button class="w-full">Edit</x-form.button>
                </form>
            </div>
        </main>
    </section>
</x-layout>
