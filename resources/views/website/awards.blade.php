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
            30 bebês serão escolhidos e vão para a etapa de votação popular. Desses, 10 para a categoria foto e 10 para a categoria vídeo.
            Os 3 bebês mais votados na plataforma do Instagram em cada categoria receberão, cada um, um dos prêmios na seguinte ordem:
            <br />
            <br />
        </p>
        @foreach($awards as $key =>$award)
        <div class="awards @if($key == 2){{ 'margin-right-0 no-after' }}@endif">
            <p>{{ $award->awardsId }}º Lugar</p>
            <img src="{{ asset('assets/images/_upload/premios/'.$award->image) }}" alt="{{ $award->title }}" />
            <strong>{{ $award->title }}</strong>
            <em>{!! nl2br(e($award->warning)) !!}</em>
        </div>
        @endforeach
        <div>
            <br /><br />
            Todas as imagens são meramente ilustrativas.
        </div>
    </div>
</div>
@stop