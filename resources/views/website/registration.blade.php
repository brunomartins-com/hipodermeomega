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
    <div class="col-xs-9 col-xs-offset-1 text-pink font-size-16 strong">
        <p class="col-xs-12">
            <br />
            <br />
        </p>
        {!! Form::open([
            'id' => 'form-registration',
            'method' => 'post',
            'class' => 'form-registration',
            'enctype' => 'multipart/form-data',
            'url' => url('inscricao')
            ])
        !!}
        {!! Form::hidden('type', 1) !!}
        <h3 class="col-xs-12 font-chewy text-pink font-size-35">Informações do bebê</h3>
        <div class="col-xs-6">{!! Form::text('babyName', '', ['placeholder' => 'Nome:', 'id' => 'babyName', 'maxlength' => '100']) !!}</div>
        <div class="col-xs-3">{!! Form::text('babyBirthdate', '', ['placeholder' => 'Data de Nascimento:', 'id' => 'babyBirthdate', 'maxlength' => '10', 'data-mask' => '00/00/0000']) !!}</div>
        <div class="col-xs-3 margin-top-7">
            <span class="pull-left margin-right-10">Sexo:</span>
            <label class="pull-left margin-right-10 normal">
                Mas.
                {!! Form::radio('babyGender', 'Masculino', false) !!}
            </label>
            <label class="pull-left normal">
                Fem.
                {!! Form::radio('babyGender', 'Feminino', false) !!}
            </label>
        </div>

        <div class="clear margin-bottom-55"></div>

        <h3 class="col-xs-12 font-chewy text-pink font-size-35">Informações do responsável</h3>
        <div class="col-xs-6">{!! Form::text('name', '', ['placeholder' => 'Nome do responsável:', 'id' => 'name', 'maxlength' => '100']) !!}</div>
        <div class="col-xs-3">{!! Form::text('rg', '', ['placeholder' => 'RG:', 'id' => 'rg', 'maxlength' => '25']) !!}</div>
        <div class="col-xs-3">{!! Form::text('cpf', '', ['placeholder' => 'CPF:', 'id' => 'cpf', 'maxlength' => '14', 'data-mask' => '000.000.000-00']) !!}</div>

        <div class="col-xs-9">{!! Form::text('address', '', ['placeholder' => 'Endereço:', 'id' => 'address', 'maxlength' => '150']) !!}</div>
        <div class="col-xs-3 margin-top-7">
            <span class="pull-left margin-right-10">Sexo:</span>
            <label class="pull-left margin-right-10 normal">
                Mas.
                {!! Form::radio('gender', 'Masculino', false) !!}
            </label>
            <label class="pull-left normal">
                Fem.
                {!! Form::radio('gender', 'Feminino', false) !!}
            </label>
        </div>

        <div class="clear"></div>

        <div class="col-xs-3">{!! Form::text('number', '', ['placeholder' => 'Número:', 'id' => 'number', 'maxlength' => '10']) !!}</div>
        <div class="col-xs-6">{!! Form::text('complement', '', ['placeholder' => 'Complemento:', 'id' => 'complement', 'maxlength' => '50']) !!}</div>
        <div class="col-xs-3">{!! Form::text('district', '', ['placeholder' => 'Bairro:', 'id' => 'district', 'maxlength' => '50']) !!}</div>

        <div class="col-xs-2">{!! Form::select('state', $states) !!}</div>
        <div class="col-xs-4">{!! Form::select('city', [''=>'Escolha o Estado primeiro']) !!}</div>
        <div class="col-xs-3">{!! Form::text('phone', '', ['placeholder' => 'Tel. fixo:', 'id' => 'phone', 'maxlength' => '14', 'data-mask' => '(00) 0000-0000']) !!}</div>
        <div class="col-xs-3">{!! Form::text('mobile', '', ['placeholder' => 'Cel:', 'id' => 'mobile', 'maxlength' => '15', 'data-mask' => '(00) 0000-00009']) !!}</div>

        <div class="col-xs-6">{!! Form::email('email', '', ['placeholder' => 'E-mail:', 'id' => 'email', 'maxlength' => '40']) !!}</div>
        <div class="col-xs-5">
            <label class="normal">
                {!! Form::checkbox('terms', 1, false) !!}
                <span>Li e concordo com os termos e condições do regulamento</span>
            </label>
        </div>

        <div class="clear"></div>

        <div class="col-xs-3"><input name="password" id="password" type="password" placeholder="Senha:" maxlength="12" /></div>
        <div class="col-xs-3"><input name="password_confirmation" id="password_confirmation" type="password" placeholder="Redigite a senha:" maxlength="12" /></div>
        <div class="col-xs-2 text-right">{!! Form::submit('Enviar') !!}</div>

        {!! Form::close() !!}
    </div>
</div>
@stop