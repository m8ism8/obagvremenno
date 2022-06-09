@extends('voyager::master')

{{dd($cart, $products)}}
@section('page_header')
    @parent
    <div class="container">
        {{--        {{dd($order)}}--}}
        <h3>Заказ #{{ $cart->id }} оформлен {{$cart->created_at}}</h3>
        <table class="table" style="margin-top:2rem">
            <tr>
                <th>Обслуживающие магазины</th>
                <th> {{$shopsTitle}}</th>
            <tr>
            <tr>
                <th>Адрес</th>
                <th>Страна {{$order->country}}, Город {{$order->city}}, Индекс {{$order->index}},
                    Адрес {{$order->address}}</th>
            <tr>
            <tr>
                <th>Общая сумма</th>
                <th>{{$order->total_sum}}</th>
            <tr>
            <tr>
                <th>Вес</th>
                <th>{{$order->weight}}</th>
            <tr>
            <tr>
                <th>Цена доставки</th>
                <th>{{$order->delivery_price}}</th>
            <tr>
            <tr>
                <th>Статус</th>
                <th>{{$order->status}}</th>
            <tr>
        </table>
    </div>
@stop


{{--@section('content')--}}
{{--    <div class="container">--}}
{{--        <div class="page-content read container-fluid">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-12">--}}
{{--                    <div style="display: flex; justify-content: space-between;">--}}
{{--                        <div>--}}
{{--                            <p>Товар</p>--}}
{{--                        </div>--}}
{{--                        <div style="width: 355px;">--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <p>Цена за единицу</p>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <p>Кол-во</p>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <p>Сумма</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @foreach ($products as $product)--}}
{{--                        <div class="panel panel-bordered" style="padding-bottom:5px;">--}}
{{--                            <div class="panel-heading"--}}
{{--                                 style="border-bottom:0; margin-left:10px; padding:20px; display: flex; justify-content: space-between;">--}}
{{--                                <a href="{{$product->link}}">--}}
{{--                                    <div style="display: flex;">--}}
{{--                                        <img src="{{ $product->image }}" alt="">--}}
{{--                                        <div style="margin-left: 25px; color: black">--}}
{{--                                            <h4>Товар: {{ $product->title }}</h4>--}}
{{--                                            <p>Цвет: {{ $product->color }}</p>--}}
{{--                                            <p>Размер: {{ $product->size }}</p>--}}
{{--                                            <p>Комментарий: {{ $product->comment }}</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                                <div>--}}
{{--                                    <h4>{{$product->price}}</h4>--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <h4>{{$product->quantity}}</h4>--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <h4>{{$product->price * $product->quantity}}</h4>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

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
