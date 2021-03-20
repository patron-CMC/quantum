<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Опубликование заказа') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('publish_freight') }}">
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

                        <!-- dep_time -->
                        <div class="mt-4">
                            <x-label for="dep_time" :value="__('Время отправки груза')" />

                            <x-input id="dep_time" class="block mt-1 w-full"
                                     type="text"
                                     placeholder="04:20"
                                     name="dep_time"/>
                        </div>

                        <!-- dimensions -->
                        <div class="mt-4">
                            <x-label for="dimensions" :value="__('Укажите габариты груза в метрах (длина Х ширина Х высота)')" />

                            <x-input id="dimensions" class="block mt-1 w-full"
                                     type="text"
                                     placeholder="7Х3Х4"
                                     name="dimensions"/>
                        </div>

                        <!-- weight -->
                        <div class="mt-4">
                            <x-label for="weight" :value="__('Укажите вес груза в килограммах')" />

                            <x-input id="weight" class="block mt-1 w-full"
                                     type="text"
                                     placeholder="1296"
                                     name="weight"/>
                        </div>

                        <!-- add_info -->
                        <div class="mt-4">
                            <x-label for="add_info" :value="__('Укажите дополнительную информацию')" />

                            <x-input id="add_info" class="block mt-1 w-full"
                                     type="text"
                                     placeholder="Вы можете указать дополнительные предпочтения, относящиеся к грузоперевозке и т.п."
                                     name="add_info"/>
                        </div>

                        <!-- price -->
                        <div class="mt-4">
                            <x-label for="price" :value="__('Укажите цену за исполнение перевозки груза в рублях')" />

                            <x-input id="price" class="block mt-1 w-full"
                                     type="text"
                                     placeholder="24670"
                                     name="price"/>
                        </div>

                        <button type="submit" class="to_auto">Опубликовать заказ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
