<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Личный кабинет') }}
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
                        {{ Auth::user()->name }}
                    </div>
                    <a class="to_auto" href="/dashboard/vehicles">Мои автомобили</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
