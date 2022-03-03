<h2>Благодарим за покупку, {{ $cart->name }}!</h2>
<p>Ваш заказ был принят.</p>
<p>Сумма заказа: {{ $cart->price }}</p>
<p>Товары:</p>
@foreach ($cart->elements as $element)
    <p>{{ $element->title }} - {{ $element->price }} гривен</p>
@endforeach
<p>Благодарим за использование нашего сайта.</p>