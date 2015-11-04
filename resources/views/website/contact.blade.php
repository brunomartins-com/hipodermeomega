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
    <div class="col-xs-12">
        @if (Session::has('success'))
        <br />
        <div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {!! Session::get('success') !!}
        </div>
        @endif
        @if (count($errors) > 0)
        <br />
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif
    </div>
    <div class="col-xs-7 col-xs-offset-1 text-pink font-size-16 strong">
        <p class="col-xs-12">
            Você pode entrar em contato conosco pelo formulário abaixo para sanar todas as suas dúvidas relacionadas ao concurso.
            <br />
            <br />
        </p>
        {!! Form::open([
            'id' => 'form-contact',
            'method' => 'post',
            'class' => 'form-contact',
            'enctype' => 'multipart/form-data',
            'url' => url('contato')
            ])
        !!}
        <div class="col-xs-12">{!! Form::text('name', '', ['placeholder' => 'Nome:', 'id' => 'name', 'maxlength' => '100']) !!}</div>
        <div class="col-xs-12">{!! Form::email('email', '', ['placeholder' => 'E-mail:', 'id' => 'email', 'maxlength' => '40']) !!}</div>
        <div class="col-xs-3">
            {!! Form::select('state', $states) !!}
        </div>
        <div class="col-xs-7">
            {!! Form::select('city', [''=>'Escolha o Estado primeiro']) !!}
        </div>
        <div class="col-xs-10">{!! Form::textarea('message', '', ['placeholder' => 'Mensagem:', 'id' => 'message', 'rows' => '10']) !!}</div>
        <div class="col-xs-2 text-right">{!! Form::submit('Enviar') !!}</div>
        {!! Form::close() !!}
    </div>
</div>
@stop