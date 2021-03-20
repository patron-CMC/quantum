<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Идентификационный номер заказа: №') }} {{$freight_info->id}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Адрес отправления груза: {{$freight_info->departure}}<br>
                    Адрес назначения: {{$freight_info->destination}}<br>
                    Дата отправки груза: {{$freight_info->dep_date}}<br>
                    Время отправки груза: {{substr($freight_info->dep_time, 0, 5)}}<br>
                    Габариты груза в метрах (длина Х ширина Х высота): {{$freight_info->dimensions}}<br>
                    Вес груза в килограммах: {{$freight_info->weight}}<br>
                    Дополнительная информация: {{$freight_info->add_info}}<br>
                    <h3><b>Стоимость грузоперевозки в рублях: {{$freight_info->price}}</b></h3><br>
                </div>
            </div>
        </div>
    </div>
    <div class="users_name">
        @if($freight_info->status=="opened")
            <img src="{{asset('images/logo_freight/opened.svg')}}"
                 alt="logo_freight"
                 class="center_user">
            <br><h3><b>ОТКРЫТ</b></h3>
        @elseif($freight_info->status=="booked")
            <img src="{{asset('images/logo_freight/booked.svg')}}"
                 alt="logo_freight"
                 class="center_user">
            <br><h3><b>ЗАБРОНИРОВАН</b></h3>
        @elseif($freight_info->status=="executing")
            <img src="{{asset('images/logo_freight/executing.svg')}}"
                 alt="logo_freight"
                 class="center_user">
            <br><h3><b>ИСПОЛНЯЕТСЯ</b></h3>
        @elseif($freight_info->status=="confirm_exec")
            <img src="{{asset('images/logo_freight/confirm_exec.svg')}}"
                 alt="logo_freight"
                 class="center_user">
            <br><h3><b>ПОДТВЕРЖДЕНИЕ ИСПОЛНЕНИЯ</b></h3>
        @elseif($freight_info->status=="executed")
            <img src="{{asset('images/logo_freight/executed.svg')}}"
                 alt="logo_freight"
                 class="center_user">
            <br><h3><b>ИСПОЛНЕН</b></h3>
        @elseif($freight_info->status=="canceled_by_client")
            <img src="{{asset('images/logo_freight/canceled.svg')}}"
                 alt="logo_freight"
                 class="center_user">
            <br><h3><b>ОТМЕНЕН ЗАКАЗЧИКОМ</b></h3>
        @elseif($freight_info->status=="canceled_by_driver")
            <img src="{{asset('images/logo_freight/canceled.svg')}}"
                 alt="logo_freight"
                 class="center_user">
            <br><h3><b>ОТМЕНЕН ИСПОЛНИТЕЛЕМ</b></h3>
        @endif
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($freight_info->status=='opened')
                        <a class="to_auto cancel"
                           href="/freight-card/{{$freight_info->id}}/cancel-by-client">Отменить заказ</a>
                    @elseif($freight_info->status=='canceled_by_client')
                        Данный заказ был отменен со стороны заказчика
                    @else
                        @if(Auth::user()->id==$freight_info->client_id)
                            Исполнитель Вашего заказа<br>
                            <div class="auto_list">
                                <div>
                                    <br><img src="{{asset('images/passenger-m-02.svg')}}"
                                         alt="Фотография пользователя в публичном профиле"
                                         class="center_user">
                                    {{$freight_info->driver_name}}
                                </div>
                                <div class="flex-end">
                                    <a href="/profile/{{$freight_info->driver_id}}">
                                        Перейти в профиль пользователя</a>
                                </div>
                            </div>
                        @else
                            Заказчик<br>
                            <div class="auto_list">
                                <div>
                                    <br><img src="{{asset('images/passenger-m-02.svg')}}"
                                         alt="Фотография пользователя в публичном профиле"
                                         class="center_user">
                                    {{$freight_info->client_name}}
                                </div>
                                <div class="flex-end">
                                    <a href="/profile/{{$freight_info->client_id}}">
                                        Перейти в профиль пользователя</a>
                                </div>
                            </div>
                        @endif
                        @if($freight_info->status=='booked')
                            @if(Auth::user()->id==$freight_info->client_id)
                                Пользователь с именем "{{$freight_info->driver_name}}" забронировал возможность исполнения данного заказа<br>
                                <a class="to_auto"
                                   href="/freight-card/{{$freight_info->id}}/to-executing">Подтвердить</a>
                                <a class="to_auto cancel"
                                   href="/freight-card/{{$freight_info->id}}/to-opened">Отменить</a>
                            @else
                                Ожидайте ответ от заказчика
                            @endif
                        @elseif($freight_info->status=='executing')
                            @if(Auth::user()->id==$freight_info->client_id)
                                Пользователь с именем "{{$freight_info->driver_name}}" в данный момент выполняет Ваш заказ<br>
                            @else
                                Этот заказ в данный момент ИСПОЛНЯЕТСЯ Вами<br>
                                <a class="to_auto"
                                   href="/freight-card/{{$freight_info->id}}/to-confirm">Запросить потверждение выполнения заказа</a>
                                <a class="to_auto cancel"
                                   href="/freight-card/{{$freight_info->id}}/cancel-by-driver">Отменить грузоперевозку</a>
                            @endif
                        @elseif($freight_info->status=='canceled_by_driver')
                            Данный заказ был отменен со стороны исполнителя
                        @elseif($freight_info->status=='confirm_exec')
                            @if(Auth::user()->id==$freight_info->client_id)
                                Пользователь запрашивает подтверждение окончания работ по данному заказу<br>
                                <a class="to_auto"
                                   href="/freight-card/{{$freight_info->id}}/confirm-exec">
                                    Подтвердить исполнение заказа</a>
                            @else
                                Ожидайте ответ от заказчика
                            @endif
                        @elseif($freight_info->status=='executed')
                            Данный заказ исполнен успешно!
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
