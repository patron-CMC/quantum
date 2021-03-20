<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Добавление автомобиля') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('add_car') }}">
                    @csrf
                        <!-- license_plate -->
                        <div>
                            <x-label for="license_plate" :value="__('Регистрационный номер автомобиля')" />

                            <x-input id="license_plate" class="block mt-1 w-full" type="text"
                                     placeholder="А 123 ГД 30" name="license_plate" />
                        </div>

                        <!-- car_brand -->
                        <div class="mt-4">
                            <x-label for="car_brand" :value="__('Производитель и модель автомобиля')" />

                            <x-input id="car_brand" class="block mt-1 w-full"
                                     type="text"
                                     placeholder="ВАЗ 21070"
                                     name="car_brand"/>
                        </div>

                        <!-- release_year -->
                        <div class="mt-4">
                            <x-label for="release_year" :value="__('Год выпуска вашего автомобиля')" />

                            <x-input id="release_year" class="block mt-1 w-full"
                                     type="text"
                                     placeholder="2009"
                                     name="release_year"/>
                        </div>

                        <button type="submit" class="to_auto">Добавить авто</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
