<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Профиль пользователя: ') }} {{$user_info[0]->name}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <img src="{{asset('images/passenger-m-02.svg')}}"
                         alt="Фотография пользователя в публичном профиле"
                         class="center_user">
                    <div class="users_name">
                        {{$user_info[0]->name}}
                    </div><br>
                    <p>Адрес электронной почты</p>
                    <div class="users_name">
                        {{$user_info[0]->email}}
                    </div><br>
                    <p>Автомобили пользователя</p>
                    @foreach($user_cars as $car)
                        <div class="auto_list">
                            <h3><b>{{$car->car_brand}}</b></h3>
                            Регистрационный номер: {{$car->license_plate}}<br>
                            Год выпуска: {{$car->release_year}}
                            <div class="flex-end"></div>
                        </div>
                    @endforeach
                    <a class="to_auto"
                       href="{{url()->previous()}}">Вернуться к заказу</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
