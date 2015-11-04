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
            Confira aqui os fofos e lindos vencedores do 12º Concurso Bebê Hipodereme de 2015.
            <br />
            <br />
        </p>
        <div class="titleWinners photo">
            <span>Vencedores categoria foto</span>
        </div>
        <div class="clear"></div>
        @foreach($winnersPhotos as $key => $winnerPhoto)
        <div class="winners @if($key == 2){{ 'margin-right-0 no-after' }}@endif">
            <p>{{ $key+1 }}º Lugar</p>
            <img src="{{ asset('assets/images/_upload/fotos/'.$winnerPhoto->usersId.'/thumb_'.$winnerPhoto->photo) }}" alt="{{ $winnerPhoto->babyName }}" />
            <strong>{{ $winnerPhoto->babyName }}</strong>
            <b>{{ $winnerPhoto->city." - ".$winnerPhoto->state }}</b>
            <em>{{ $winnerPhoto->quantityVotes }} votos</em>
        </div>
        @endforeach
        <div class="clear"></div>

        <div class="titleWinners video">
            <span>Vencedores categoria vídeo</span>
        </div>
        <div class="clear"></div>
        @foreach($winnersVideos as $key => $winnerVideo)
            <div class="winners @if($key == 2){{ 'margin-right-0 no-after' }}@endif">
                <p>{{ $key+1 }}º Lugar</p>
                <img src="{{ $winnerVideo->image }}" alt="{{ $winnerVideo->babyName }}" />
                <strong>{{ $winnerVideo->babyName }}</strong>
                <b>{{ $winnerVideo->city." - ".$winnerVideo->state }}</b>
                <em>{{ $winnerVideo->quantityVotes }} votos</em>
            </div>
        @endforeach
    </div>
</div>
@stop