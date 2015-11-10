@extends('template.website')

@section('title', $pages->title.' | ')

@section('head')
<!-- meta tags -->
<meta name="description" content="{{ $pages->description }}" />
<meta name="keywords" content="{{ $pages->keywords }}" />
<!-- Tags Facebook -->
<meta property="og:description" content="{{ $pages->description }}" />
@stop

@section('content')
<div class="container">
    <div class="col-xs-10 col-xs-offset-1 text-pink font-size-16 strong">
        <p>
            Confira aqui os produtos participantes da promoção:
        </p>
        @foreach($products as $key => $product)
        <div class="products @if($key == 1){{ 'margin-right-0 no-after' }}@endif">
            <img src="{{ asset('assets/images/_upload/produtos/'.$product->image) }}" alt="{{ $product->title }}" />
            <strong>{{ $product->title }}</strong>
            <em>{{ $product->description }}</em>
            <a href="{{ $product->urlBuy }}" target="_blank" title="Compre aqui" class="btn-buyHere">Compre aqui</a>
        </div>
        @endforeach
    </div>
</div>
@stop