<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Поиск заказа') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="post" action="{{ route('search_freight') }}">
                    @csrf
                        <!-- departure -->
                        <div>
                            <x-label for="departure" :value="__('Укажите адрес отправления груза')" />

                            <x-input id="departure" class="block mt-1 w-full" type="text"
                                     placeholder="например, Москва, Нижний Сусальный переулок, д. 5"
                                     name="departure" />
                        </div>

                        <!-- destination -->
                        <div class="mt-4">
                            <x-label for="destination" :value="__('Укажите адрес, по которому необходимо доставить Ваш груз')" />

                            <x-input id="destination" class="block mt-1 w-full"
                                     type="text"
                                     placeholder="Санкт-Петербург, Дворцовая наб., 32"
                                     name="destination"/>
                        </div>

                        <!-- dep_date -->
                        <div class="mt-4">
                            <x-label for="dep_date" :value="__('Дата отправки груза')" />

                            <x-input id="dep_date" class="block mt-1 w-full"
                                     type="text"
                                     placeholder="31.12.2021"
                                     name="dep_date"/>
                        </div>

                        <button type="submit" class="to_auto">Поиск</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
