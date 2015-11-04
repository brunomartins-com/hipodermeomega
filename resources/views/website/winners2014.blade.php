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
            Confira aqui os fofos e lindos vencedores do 11º Concurso Bebê Hipodereme de 2014.
            <br />
            <br />
        </p>
        <div class="titleWinners photo">
            <span>Vencedores categoria foto</span>
        </div>
        @foreach($winners as $key => $winner)
        @if($key == 3)
        <div class="titleWinners video">
            <span>Vencedores categoria vídeo</span>
        </div>
        <div class="clear"></div>
        @endif
        <div class="winners @if($key == 2 or $key == 5){{ 'margin-right-0 no-after' }}@endif">
            <p>{{ $winner->position }}º Lugar</p>
            <img src="{{ asset('assets/images/_upload/ganhadores-2014/'.$winner->photo) }}" alt="{{ $winner->name }}" />
            <strong>{{ $winner->name }}</strong>
            <b>{{ $winner->city." - ".$winner->state }}</b>
            <em>{{ $winner->quantityVotes }} votos</em>
        </div>
        @endforeach
    </div>
</div>
@stop