<h2>Приветсвуем!</h2>
<p>на сайте O Bag новая акция:</p>
<h3>{{ $sale->title }}</h3>
<p>{{ $sale->text }}</p>
<a href="http://bag.a-lux.dev/sales/{{ $sale->id }}">Успейте заказать товары по выгодной цене!</a>
@if ($sale->products)
    <p>Акционные продукты:</p>
    @foreach ($sale->products as $product)
        <p>{{ $product->title }}</p>
        <a href="http://bag.a-lux.dev/product/{{ $product->id }}">Ссылка на товар</a>
    @endforeach
@endif