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
    <div class="col-xs-4 col-xs-offset-1">
        <img src="{{ asset('assets/images/_upload/o-concurso/'.$theCompetition->image) }}" alt="{{ $pages->title }}" />
    </div>
    <div class="col-xs-6 text-pink font-size-16 strong">
        {!! $theCompetition->text !!}
    </div>
</div>
@stop