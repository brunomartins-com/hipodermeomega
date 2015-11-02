@extends('template.website')

@section('head')
<!-- meta tags -->
<meta name="description" content="{{ $pages->description }}" />
<meta name="keywords" content="{{ $pages->keywords }}" />
<!-- Tags Facebook -->
<meta property="og:description" content="{{ $pages->description }}" />
@if (count($errors) > 0)
<script>
    @foreach ($errors->all() as $error)
    var complementError = '{{ $error }}\n';
    @endforeach
    alert('Ops! Não foi possível autenticar o acesso com os dados fornecidos\n'+complementError);
</script>
@endif
@if (Session::has('success'))
<script>
    alert('{!! Session::get('success') !!}');
</script>
@endif
@stop

@section('content')
<div class="banners">
    <div class="container">
        <section id="banners" class="carousel slide" data-ride="carousel" data-interval="7000">
            <div class="carousel-inner" role="listbox">
                @foreach($banners as $key => $banner)
                <div class="item @if($key == 0){{ 'active' }}@endif">
                    <img src="{{ asset('assets/images/_upload/banners/'.$banner->image) }}" alt="{{ $banner->title }}" />
                </div>
                @endforeach
            </div>
            <!-- Controls -->
            <a class="prev banners-buttons" href="#banners" role="button" data-slide="prev"></a>
            <a class="next banners-buttons" href="#banners" role="button" data-slide="next"></a>
        </section>
        <div class="phrase"></div>
    </div>
    <div class="table"></div>
</div>
<div class="container">
    <div class="col-lg-4 col-lg-offset-1">
        <h2 class="font-size-35 text-pink font-chewy">
            {!! nl2br(e($websiteSettings['callText'])) !!}
        </h2>
        <a href="{{ $websiteSettings['buttonUrl'] }}" class="btn btn-pink" title="{{ $websiteSettings['buttonText'] }}">{{ $websiteSettings['buttonText'] }}</a>
    </div>
    @foreach($calls as $call)
    <div class="col-lg-3 calls">
        @if($call->url != "")<a href="{{ $call->url }}" target="{{ $call->target }}" title="{{ $call->title }}">@endif
            <img src="{{ asset('assets/images/_upload/chamadas/'.$call->image) }}" alt="{{ $call->title }}" />
            <strong>{{ $call->title }}</strong>
            <em>{{ $call->text }}</em>
            @if($call->warning != "")<i>{{ $call->warning }}</i>@endif
        @if($call->url != "")</a>@endif
    </div>
    @endforeach
</div>
@stop