<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Заказы') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <x-nav-link :href="route('freights_published')" :active="request()->routeIs('freights_published')">
                            {{ __('Опубликованные') }}
                        </x-nav-link>

                        <x-nav-link :href="route('freights_executing')" :active="request()->routeIs('freights_executing')">
                            {{ __('Взятые на исполнение') }}
                        </x-nav-link>
                    </div>
                    <br>
                    <div class="users_name">
                        Актуальные заказы
                    </div>
                    @if (count($actual_freights)==0)
                        Список актуальных заказов в данный момент пуст!<br><br>
                    @endif
                    @foreach($actual_freights as $freight)
                        <div class="auto_list">
                            @if($freight->status=="opened")
                                <br><h3><b>Статус заказа: ОТКРЫТ</b></h3>
                                <img src="{{asset('images/logo_freight/opened.svg')}}"
                                     alt="logo_freight"
                                     class="center_user">
                            @elseif($freight->status=="booked")
                                <br><h3><b>Статус заказа: ЗАБРОНИРОВАН</b></h3>
                                <img src="{{asset('images/logo_freight/booked.svg')}}"
                                     alt="logo_freight"
                                     class="center_user">
                            @elseif($freight->status=="executing")
                                <br><h3><b>Статус заказа: ИСПОЛНЯЕТСЯ</b></h3>
                                <img src="{{asset('images/logo_freight/executing.svg')}}"
                                     alt="logo_freight"
                                     class="center_user">
                            @elseif($freight->status=="confirm_exec")
                                <br><h3><b>ЗАПРОС НА ПОДТВЕРЖДЕНИЕ ИСПОЛНЕНИЯ ЗАКАЗА</b></h3>
                                <img src="{{asset('images/logo_freight/confirm_exec.svg')}}"
                                     alt="logo_freight"
                                     class="center_user">
                            @endif
                            <h3><b>Идентификационный номер заказа: №{{$freight->id}}</b></h3>
                            Плата за грузоперевозку: {{$freight->price}}<br>
                            Время отправления груза: {{substr($freight->dep_time, 0, 5)}}<br>
                            Габариты груза в метрах: {{$freight->dimensions}}<br>
                            Вес груза в килограммах: {{$freight->weight}}<br>
                            Дополнительная информация: {{$freight->add_info}}<br>
                            <br><div class="flex-end">
                                <a href="/freight-card/{{$freight->id}}">Перейти к управлению заказом</a>
                            </div>
                        </div>
                    @endforeach
                    <div class="users_name">
                        Исполненные заказы
                    </div>
                    @if (count($executed_freights)==0)
                        Список исполненных заказов в данный момент пуст!<br><br>
                    @endif
                    @foreach($executed_freights as $freight)
                        <div class="auto_list">
                            <br><h3><b>Статус заказа: ИСПОЛНЕН</b></h3>
                            <img src="{{asset('images/logo_freight/executed.svg')}}"
                                 alt="logo_freight"
                                 class="center_user">
                            <h3><b>Идентификационный номер заказа: №{{$freight->id}}</b></h3>
                            Габариты груза в метрах: {{$freight->dimensions}}<br>
                            Вес груза в килограммах: {{$freight->weight}}<br>
                            Дополнительная информация: {{$freight->add_info}}<br>
                            <br><div class="flex-end">
                                <a href="/freight-card/{{$freight->id}}">Перейти к управлению заказом</a>
                            </div>
                        </div>
                    @endforeach
                    <div class="users_name">
                        Отмененные заказы
                    </div>
                    @if (count($canceled_freights)==0)
                        Список отмененных заказов в данный момент пуст!<br><br>
                    @endif
                    @foreach($canceled_freights as $freight)
                        <div class="auto_list">
                            @if($freight->status=="canceled_by_client")
                                <br><h3><b>Статус заказа: ОТМЕНЕН СО СТОРОНЫ ЗАКАЗЧИКА</b></h3>
                            @elseif($freight->status=="canceled_by_driver")
                                <br><h3><b>Статус заказа: ОТМЕНЕН СО СТОРОНЫ ИСПОЛНИТЕЛЯ</b></h3>
                            @endif
                            <img src="{{asset('images/logo_freight/canceled.svg')}}"
                                 alt="logo_freight"
                                 class="center_user">
                            <h3><b>Идентификационный номер заказа: №{{$freight->id}}</b></h3>
                            Габариты груза в метрах: {{$freight->dimensions}}<br>
                            Вес груза в килограммах: {{$freight->weight}}<br>
                            Дополнительная информация: {{$freight->add_info}}<br>
                            <br><div class="flex-end">
                                <a href="/freight-card/{{$freight->id}}">Перейти к управлению заказом</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
