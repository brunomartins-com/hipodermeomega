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
            Insira seu e-mail e uma nova senha para acesso
            <br />
            <br />
        </p>
        {!! Form::open([
            'id' => 'form-recovery',
            'method' => 'post',
            'class' => 'form-recovery',
            'enctype' => 'multipart/form-data',
            'url' => url('recuperar-senha/nova')
            ])
        !!}
        {!! Form::hidden('token', $token) !!}
        <div class="col-xs-12">{!! Form::email('email', '', ['placeholder' => 'E-mail:', 'id' => 'email', 'maxlength' => '40']) !!}</div>
        <div class="col-xs-12">
            <input type="password" id="password" name="password" maxlength="12" placeholder="Digite a nova senha...">
        </div>
        <div class="col-xs-12">
            <input type="password" id="password_confirmation" name="password_confirmation" maxlength="12" placeholder="..e confirme-a">
        </div>
        <div class="col-xs-12 text-right">{!! Form::submit('Enviar') !!}</div>
        {!! Form::close() !!}
    </div>
</div>
@stop