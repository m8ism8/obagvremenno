@extends('voyager::master')

@section('page_header')
    @parent
    <div class="container">
        {{--        {{dd($order)}}--}}
        <h3>Заказ #{{ $cart->id }} оформлен {{$cart->created_at}}</h3>
        <table class="table" style="margin-top:2rem">
            <tr>
                <th>Имя</th>
                <th> {{$cart->name}}</th>
            <tr>
            <tr>
                <th>Номер телефона</th>
                <th>{{$cart->phone}}</th>
            <tr>
            <tr>
                <th>Почта</th>
                <th>{{$cart->email}}</th>
            <tr>
            <tr>
                <th>Адрес</th>
                <th>@if($cart->delivery_type == 'pickup')
                        Самовывоз
                    @else
                        {{$cart->address}}
                    @endif</th>
            <tr>
            <tr>
                <th>Общая сумма</th>
                <th>{{$cart->price}}</th>
            <tr>
            <tr>
                <th>Вид оплаты</th>
                <th>{{$cart->payment_type}}</th>
            <tr>
            <tr>
                <th>Бонусов списано</th>
                <th>{{$cart->bonus_waste}}</th>
            <tr>
            <tr>
                <th>Бонусов начислено</th>
                <th>{{$cart->bonuses_accrued}}</th>
            <tr>

            <tr>
                <th>Статус</th>
                <th>{{$cart->payment_status}}</th>
            <tr>
        </table>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="page-content read container-fluid">
            <div class="row">
                <h3>Товары</h3>
                    <table class="table" style="margin-top:2rem">
                        <tr>
                            <th>Название</th>
                            <th>Код товара</th>
                            <th>Цена</th>
                        <tr>
                        @foreach ($products as $product)
                            <tr>
                                <th>{{$product->title}}</th>
                                <th>{{$product->code}}</th>
                                <th>@if($product->new_price != null)
                                        {{$product->new_price}}
                                    @else
                                        {{$product->price}}
                                    @endif</th>
                            <tr>
                        @endforeach
                    </table>
            </div>
        </div>
    </div>

    {{-- Single delete modal --}}
    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"><i
                            class="voyager-trash"></i> {{ __('voyager::generic.delete_question') }} {{ strtolower($dataType->getTranslatedAttribute('display_name_singular')) }}
                        ?</h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('voyager.'.$dataType->slug.'.index') }}" id="delete_form" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="{{ __('voyager::generic.delete_confirm') }} {{ strtolower($dataType->getTranslatedAttribute('display_name_singular')) }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right"
                            data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @stop
