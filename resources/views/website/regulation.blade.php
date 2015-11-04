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
        <div class="col-xs-12 text-center">
            <span class="sub-title">Leia atentamente o regulamento e entenda como funciona. Depois é só participar. Boa sorte!</span>
            <br />
            <br />
        </div>
        <div class="clear">
            {!! $regulation->text !!}
        </div>
    </div>
</div>
@stop