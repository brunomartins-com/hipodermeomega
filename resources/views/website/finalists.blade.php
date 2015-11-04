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
        <div class="col-xs-7 padding-left-0">
            Reta final de muita fofura. Confira aqui os lindos e lindas que estão selecionados para a fase final do concurso. Os autores das 3 imagens e 3 vídeos mais votados escolhidas pelo público pela plataforma Instagram®, serão os ganhadores.
            <br />
            <br />
        </div>
        <div class="col-xs-5 padding-right-0 padding-left-20 normal">
            <span class="instagramIcon"></span>
            Imagens disponíveis para votação na conta do Laboratório Teuto.
            <strong class="font-size-20">instagram.com/{{ $websiteSettings['instagram'] }}</strong>
        </div>
        <div class="clear"></div>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="tabPhotos active"><a href="#fotos" aria-controls="fotos" role="tab" data-toggle="tab">Finalistas Categoria Fotos</a></li>
            <li role="presentation" class="tabVideos"><a href="#videos" aria-controls="videos" role="tab" data-toggle="tab">Finalistas Categoria Vídeos</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="fotos">
                @foreach($finalistsPhotos as $key => $winnerPhoto)
                <div class="winners @if($key == 2 or $key == 5 or $key == 8){{ 'margin-right-0 no-after' }}@endif">
                    <img src="{{ asset('assets/images/_upload/fotos/'.$winnerPhoto->usersId.'/thumb_'.$winnerPhoto->photo) }}" alt="{{ $winnerPhoto->babyName }}" />
                    <strong>{{ $winnerPhoto->babyName }}</strong>
                    <b>{{ $winnerPhoto->city." - ".$winnerPhoto->state }}</b>
                </div>
                @endforeach
                <div class="warning-finalists">
                    <strong>Listagem das fotos:</strong>
                    As fotos e vídeos dos finalistas aqui listados, aparecem de forma aleatória, ou seja, cade vez que a página é aberta, essa ordem é mostrada de forma diferente.
                </div>
            </div>
            <div class="clear"></div>

            <div role="tabpanel" class="tab-pane" id="videos">
                @foreach($finalistsVideos as $key => $winnerVideo)
                <div class="winners @if($key == 2 or $key == 5 or $key == 8){{ 'margin-right-0 no-after' }}@endif">
                    <img src="{{ $winnerVideo->image }}" alt="{{ $winnerVideo->babyName }}" />
                    <strong>{{ $winnerVideo->babyName }}</strong>
                    <b>{{ $winnerVideo->city." - ".$winnerVideo->state }}</b>
                    <em>{{ $winnerVideo->quantityVotes }} votos</em>
                </div>
                @endforeach
                <div class="warning-finalists">
                    <strong>Listagem dos vídeos:</strong>
                    As fotos e vídeos dos finalistas aqui listados, aparecem de forma aleatória, ou seja, cade vez que a página é aberta, essa ordem é mostrada de forma diferente.
                </div>
            </div>
        </div>
    </div>
</div>
@stop