<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Найденные заказы') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (count($freights)==0)
                        <div class="users_name">
                            К сожалению, заказов по заданным параметрам не обнаружено!
                        </div>
                    @endif
                    @foreach($freights as $freight)
                        <div class="auto_list">
                            <h3><b>Идентификационный номер заказа: № {{$freight->id}}</b></h3>
                            Плата за грузоперевозку: {{$freight->price}}<br>
                            Время отправления груза: {{substr($freight->dep_time, 0, 5)}}<br>
                            Габариты груза в метрах: {{$freight->dimensions}}<br>
                            Вес груза в килограммах: {{$freight->weight}}<br>
                            Дополнительная информация: {{$freight->add_info}}<br><br>
                            <div>
                                <img src="{{asset('images/passenger-m-02.svg')}}"
                                     alt="Фотография пользователя в публичном профиле"
                                     class="center_user">
                                {{$freight->name}}<br>
                                Адрес электронной почты:<br>
                                <b>{{$freight->email}}</b><br>
                            </div>
                            <div class="flex-end">
                                <a href="/book-freight/{{$freight->id}}/{{ Auth::user()->id}}">Откликнуться на заказ</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
