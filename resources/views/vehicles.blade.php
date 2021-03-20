<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Мои автомобили') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (count($cars)==0)
                        <div class="users_name">
                            Вы пока не добавили ни одного автомобиля!
                        </div>
                    @endif
                        @foreach($cars as $car)
                            <div class="auto_list">
                                <h3><b>{{$car->car_brand}}</b></h3>
                                Регистрационный номер: {{$car->license_plate}}<br>
                                Год выпуска: {{$car->release_year}}
                                <div class="flex-end">
                                    <a href="/dashboard/vehicles/delete/{{$car->id}}">Удалить автомобиль из списка</a>
                                </div>
                            </div>
                        @endforeach
                    <a class="to_auto" href="/dashboard/vehicles/add">Перейти к добавлению автомобиля</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
