<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Оплата') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="users_name">
                        Баланс:<br>
                        {{ Auth::user()->acc_balance }} руб.
                    </div><br>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="users_name">
                        История операций
                    </div><br>
                    @if(count($payments)==0)
                        В данный момент ваша история финансовых операций пуста!
                    @endif
                    @foreach($payments as $p)
                        <div class="auto_list"><br>
                            @if($p->status=='sent')
                                <img src="{{asset('images/arrows/sent.svg')}}"
                                     alt="arrow"
                                     class="center_user">
                            @elseif($p->status=='received')
                                <img src="{{asset('images/arrows/received.svg')}}"
                                     alt="arrow"
                                     class="center_user">
                            @else
                                <img src="{{asset('images/arrows/returned.svg')}}"
                                     alt="arrow"
                                     class="center_user">
                            @endif
                            <h3><b>Сумма платежа: {{$p->amount}} ₽</b></h3>
                            Время исполнения транзакции: {{$p->timestamp}}<br>
                            Идентификационный номер заказа: № {{$p->id_freight}}<br>
                            Контрагент:<br>
                            <div>
                                <img src="{{asset('images/passenger-m-02.svg')}}"
                                     alt="Фотография пользователя в публичном профиле"
                                     class="center_user">
                                @if(Auth::user()->id==$p->id_driver)
                                    {{$p->client_name}}<br>
                                @else
                                    {{$p->driver_name}}<br>
                                @endif
                            </div>
                            @if($p->status=='sent')
                            <div class="flex-end">
                                <span class="status sent">
                                    <h3><b>Статус транзакции: платеж отправлен заказчиком</b></h3>
                                </span>
                            </div>
                            @elseif($p->status=='received')
                            <div class="flex-end">
                                <span class="status received">
                                    <h3><b>Статус транзакции: платеж получен исполнителем</b></h3>
                                </span>
                            </div>
                            @else
                            <div class="flex-end">
                                <span class="status returned">
                                    <h3><b>Статус транзакции: денежные средства возвращены заказчику</b></h3>
                                </span>
                            </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
