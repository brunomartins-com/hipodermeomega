@if($websiteSettings['websiteOk'] == 0 and !Auth::check())
{!! view('website.teaser')->with(compact('page', 'websiteSettings')) !!}
{{ die }}
@endif
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="format-detection" content="telephone=no" />
    <meta name="author" content="Bruno Martins">
    <title>@yield('title'){{ $websiteSettings['title'] }}</title>
    <link href="{!! asset('assets/images/dados-do-site/'.$websiteSettings['favicon']) !!}" rel="shortcut icon" />
    <link href="{{ asset('assets/images/dados-do-site/'.$websiteSettings['appleTouchIcon']) }}" rel="apple-touch-icon" />
    <link href="{!! asset('assets/css/main.css') !!}" rel="stylesheet" type="text/css" />
    {!! $websiteSettings['googleAnalytics'] !!}
    <!-- Meta Tags -->
    <meta name="title" content="@yield('title'){{ $websiteSettings['title'] }}" />
    <!-- Tags Facebook -->
    <meta property="og:title" content="@yield('title'){{ $websiteSettings['title'] }}" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="pt_BR" />
    <meta property="og:url" content="{{ \URL::current() }}" />
    <meta property="og:image" content="{{ asset('assets/images/dados-do-site/'.$websiteSettings['avatar']) }}" />
    <meta property="og:site_name" content="@yield('title'){{ $websiteSettings['title'] }}" />

    @yield('head')

</head>
<body class="{{ $page }}">
<header class="header">
    <div class="vectors"></div>
    <div class="container">
        <div class="col-xs-4 col-xs-offset-5 welcome">
            @if(Auth::check() and Auth::getUser()->type == 1)
            <strong>Bem Vindo(a)</strong>
            <br />
            {{ Auth::getUser()->name }}
            @endif
        </div>
        <div class="col-xs-2 sponsor">
            <span class="text-pink">Oferecimento</span>
        </div>
    </div>
    <div class="top">
        <div class="container">
            <div class="col-xs-6 col-xs-offset-5">
                @if(Auth::check() and Auth::getUser()->type == 1 and $websiteSettings['registerOk'] == 1)
                <a href="#" class="btn-logged btn-edit" data-toggle="modal" data-target="#profileModal" title="Editar meus dados">Editar meus dados</a>
                <a href="#" class="btn-logged btn-upload" data-toggle="modal" data-target="#warningModal" title="Upload foto/vídeo">Upload foto/vídeo</a>
                <a href="{{ url('sair') }}" class="btn-logged btn-logout" title="Sair">Sair</a>
                @else
                <a href="#" class="bg-white btn-login" @if($websiteSettings['registerOk'] == 1) data-toggle="modal" data-target="#loginModal"@else onclick="alert('Período de participação encerrado!')"@endif title="Fazer login">
                    <span>Fazer login</span>
                </a>
                @endif
                <div class="bg-white facebook-like">
                    <div><iframe src="http://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FLaboratorioTeuto&amp;send=false&amp;layout=button_count&amp;width=110&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=like&amp;height=21&amp;appId=440036269420265" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:110px; height:20px;" allowtransparency="true"></iframe></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="col-xs-6 col-xs-offset-5">
            <nav class="navigation">
                <ul>
                    <li><a href="{{ url('/') }}" class="home" title="Home">Home</a></li>
                    <li><a href="{{ url('o-concurso') }}" class="the-competition" title="O Concurso">O Concurso</a></li>
                    <li><a href="{{ url('regulamento') }}" class="regulation" title="Regulamento">Regulamento</a></li>
                    <li><a href="{{ url('premios') }}" class="awards" title="Prêmios">Prêmios</a></li>
                    <li><a href="{{ url('ganhadores-2014') }}" class="winners-2014" title="Ganhadores 2014">Ganhadores 2014</a></li>
                    <li><a href="{{ url('contato') }}" class="contact" title="Contato">Contato</a></li>
                </ul>
            </nav>
        </div>
        <div class="col-xs-5 col-xs-offset-6">
            <div id="carousel-example-generic" class="carousel slide video-home" data-ride="carousel" data-interval="10000" data-pause="hover">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    @for($i=0; $i < count($advertising); $i++)
                    <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}"@if($i == 0) class="active"@endif></li>
                    @endfor
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    @foreach($advertising as $key => $ad)
                    <div class="item @if($key == 0){{ 'active' }}@endif">
                        <a href="#" data-url="{{ $ad->url }}" title="{{ $ad->title }}">
                            <span class="play"></span>
                            <img src="{{ $ad->image }}" alt="{{ $ad->title }}" />
                            <span class="carousel-caption">{{ $ad->title }}</span>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <h1 class="logo">{{ $websiteSettings['title'] }}</h1>
    </div><!-- END .container -->
</header>

@if($page != 'home')
<div class="page-title">
    <div class="container">
        <h2>{{ $pages->title }}</h2>
        <a href="{{ $websiteSettings['buttonUrl'] }}" class="btn btn-pink" title="{{ $websiteSettings['buttonText'] }}">{{ $websiteSettings['buttonText'] }}</a>
    </div>
    <div class="table"></div>
</div>
@endif

@yield('content')

@if($page != 'home')
<div class="container">
    <div class="col-xs-10 col-xs-offset-1">
        <div class="buttons">
            <a href="{{ url('/') }}" title="Home">Home</a>
            <a href="#" title="Topo" class="topo">Topo</a>
            @if($page != 'produtos')
            <a href="{{ url('produtos-participantes') }}" title="Produtos participantes">Produtos participantes</a>
            @else
            <a href="{{ $websiteSettings['buttonUrl'] }}" title="{{ $websiteSettings['buttonText'] }}">{{ $websiteSettings['buttonText'] }}</a>
            @endif
        </div>
    </div>
    @foreach($calls as $key => $call)
    <div class="col-xs-5 @if($key == 0){{ 'col-xs-offset-1' }}@endif calls">
        @if($call->url != "")<a href="{{ $call->url }}" target="{{ $call->target }}" title="{{ $call->title }}">@endif
            <img src="{{ asset('assets/images/_upload/chamadas/'.$call->image) }}" alt="{{ $call->title }}" />
            <span>
                <strong>{{ $call->title }}</strong>
                <em>{{ $call->text }}</em>
                @if($call->warning != "")<i>{{ $call->warning }}</i>@endif
            </span>
        @if($call->url != "")</a>@endif
    </div>
    @endforeach
</div>
@endif

<footer class="container">
    <div class="row">
        <div class="col-xs-4 col-xs-offset-2">{!! nl2br(e($websiteSettings['certificate'])) !!}</div>
        <div class="col-xs-4">
            {!! Form::open([
                    'id' => 'form-newsletter',
                    'method' => 'post',
                    'class' => 'form-newsletter',
                    'enctype' => 'multipart/form-data',
                    'url' => url('newsletter')
                    ])
            !!}
            {!! Form::label('email', 'Newsletter') !!}
            {!! Form::email('email', '', ['placeholder' => 'Digite seu email e receba novidades.', 'id' => 'email', 'maxlength' => '40']) !!}
            {!! Form::submit('Ok') !!}
            {!! Form::close() !!}
        </div>
        <div class="col-xs-8 col-xs-offset-2 separate"><hr /></div>
        <div class="col-xs-2 col-xs-offset-2">
            Acompanhe as novidades
            <br />
            do Laboratório Teuto através
            <br />
            das redes sociais.
        </div>
        <div class="col-xs-5 social-network">
            <ul>
                @if($websiteSettings['facebook'] != "")
                <li>
                    <a href="{{ "http://www.facebook.com/".$websiteSettings['facebook'] }}" target="_blank" class="facebook">{{ "/".$websiteSettings['facebook'] }}</a>
                </li>
                @endif
                @if($websiteSettings['instagram'] != "")
                <li>
                    <a href="{{ "http://www.instagram.com/".$websiteSettings['instagram'] }}" target="_blank" class="instagram">{{ "@".$websiteSettings['instagram'] }}</a>
                </li>
                @endif
                @if($websiteSettings['twitter'] != "")
                <li>
                    <a href="{{ "http://www.twitter.com".$websiteSettings['twitter'] }}" target="_blank" class="twitter">{{ "@".$websiteSettings['twitter'] }}</a>
                </li>
                @endif
                @if($websiteSettings['youtube'] != "")
                <li>
                    <a href="{{ "http://www.youtube.com/".$websiteSettings['youtube'] }}" target="_blank" class="youtube">{{ "/".$websiteSettings['youtube'] }}</a>
                </li>
                @endif
            </ul>
        </div>
        <div class="col-xs-1">
            <a href="http://www.teuto.com.br" target="_blank" class="teuto" title="Teuto/Pfizer">Teuto/Pfizer</a>
        </div>
    </div>
</footer>
@if(!Auth::check() or Auth::getUser()->type == 0 and $websiteSettings['registerOk'] == 1)
<div id="loginModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Fazer login</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {!! Form::open([
                    'id' => 'form-login',
                    'method' => 'post',
                    'class' => 'form-login',
                    'enctype' => 'multipart/form-data',
                    'url' => url('login')
                    ])
                !!}
                    {!! Form::hidden('type', 1) !!}
                    {!! Form::email('email', '', ['placeholder' => 'E-mail:', 'id' => 'email', 'maxlength' => '40']) !!}
                    <input name="password" id="password" type="password" placeholder="Senha:" maxlength="12" />
                    {!! Form::submit('Entrar') !!}
                    <a href="#" class="forgot-password" title="Esqueci minha senha" data-dismiss="modal" aria-hidden="true" data-toggle="modal" data-target="#recoveryPasswordModal">Esqueci minha senha</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div id="recoveryPasswordModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Lembrar Senha</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">
                {!! Form::open([
                    'id' => 'form-recovery-password',
                    'method' => 'post',
                    'class' => 'form-recovery-password',
                    'enctype' => 'multipart/form-data',
                    'url' => url('recuperar-senha')
                    ])
                !!}
                    <div class="col-xs-5 pull-left" style="height: 200px;">
                        <h5 class="font-size-24 font-chewy text-pink normal">Recuperação de senha</h5>
                        <p class="text-pink font-size-16 strong">
                            Informe o e-mail utilizado por você para acessar a página do concurso.
                            <br /><br />
                            Uma mensagem será enviada para o seu e-mail alternativo cadastrado com as instruções para a criação de uma nova senha.
                        </p>
                    </div>
                    <div class="col-xs-6 pull-right margin-top-20">
                        {!! Form::email('email', '', ['placeholder' => 'E-mail:', 'id' => 'email', 'maxlength' => '40']) !!}
                        {!! Form::submit('Enviar') !!}
                        <p class="text-pink font-size-11 normal">Exemplo: andre@hotmail.com</p>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endif
@if(Auth::check() and Auth::getUser()->type == 1 and $websiteSettings['registerOk'] == 1)
<div id="profileModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar meus dados</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#babyAndResponsableInformation" aria-controls="babyAndResponsableInformation" role="tab" data-toggle="tab">Informações do bebê e responsável</a></li>
                    <li role="presentation"><a href="#addressAndPhonesInformation" aria-controls="addressAndPhonesInformation" role="tab" data-toggle="tab">Informações de endereço e telefones</a></li>
                </ul>
                {!! Form::open(['class' => 'form-profile']) !!}
                {!! Form::hidden('userId', Auth::user()->id) !!}
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="babyAndResponsableInformation">
                        <label class="col-xs-4" for="babyName">
                            <strong>Informações do Bebê:</strong>
                            <p id="babyName">{{ Auth::getUser()->babyName }}</p>
                            {!! Form::text('babyName', Auth::getUser()->babyName, ['id' => 'babyName', 'placeholder' => 'Nome do Bebê', 'maxlength' => '100', 'required' => 'required']) !!}
                        </label>
                        <label class="col-xs-3" for="babyBirthdate">
                            <strong>Data de nasc:</strong>
                            <p id="babyBirthdate">{{ \Carbon\Carbon::createFromFormat('Y-m-d', Auth::getUser()->babyBirthdate)->format('d/m/Y') }}</p>
                            {!! Form::text('babyBirthdate', \Carbon\Carbon::createFromFormat('Y-m-d', Auth::getUser()->babyBirthdate)->format('d/m/Y'), ['id' => 'babyBirthdate', 'placeholder' => 'dd/mm/aaaa', 'maxlength' => '10', 'data-mask' => '00/00/0000', 'required' => 'required']) !!}
                        </label>
                        <label class="col-xs-3" for="babyGender">
                            <strong>Sexo:</strong>
                            <p id="babyGender">{{ Auth::user()->babyGender }}</p>
                            <select name="babyGender" id="babyGender" required="required">
                                <option value="Feminino" @if(Auth::user()->babyGender == 'Feminino'){{ 'selected' }}@endif>Feminino</option>
                                <option value="Masculino" @if(Auth::user()->babyGender == 'Masculino'){{ 'selected' }}@endif>Masculino</option>
                            </select>
                        </label>
                        <div class="clear"></div>
                        <label class="col-xs-4" for="name">
                            <strong>Informações do Responsável:</strong>
                            <p id="name">{{ Auth::getUser()->name }}</p>
                            {!! Form::text('name', Auth::getUser()->name, ['id' => 'name', 'placeholder' => 'Nome do Responsável', 'maxlength' => '100', 'required' => 'required']) !!}
                        </label>
                        <label class="col-xs-3" for="rg">
                            <strong>RG:</strong>
                            <p id="rg">{{ Auth::user()->rg }}</p>
                            {!! Form::text('rg', Auth::user()->rg, ['id' => 'rg', 'maxlength' => '25', 'required' => 'required']) !!}
                        </label>
                        <label class="col-xs-3" for="cpf">
                            <strong>CPF:</strong>
                            <p id="cpf">{{ Auth::user()->cpf }}</p>
                            {!! Form::text('cpf', Auth::user()->cpf, ['placeholder' => 'CPF:', 'id' => 'cpf', 'maxlength' => '14', 'data-mask' => '000.000.000-00', 'required' => 'required']) !!}
                        </label>
                        <div class="clear"></div>
                        <label class="col-xs-4" for="email">
                            <strong>E-mail:</strong>
                            <p id="email">{{ Auth::user()->email }}</p>
                            {!! Form::text('email', Auth::user()->email, ['id' => 'email', 'maxlength' => '40', 'required' => 'required']) !!}
                        </label>
                        <label class="col-xs-3" for="gender">
                            <strong>Sexo:</strong>
                            <p id="gender">{{ Auth::user()->gender }}</p>
                            <select name="gender" id="gender" required="required">
                                <option value="Feminino" @if(Auth::user()->gender == 'Feminino'){{ 'selected' }}@endif>Feminino</option>
                                <option value="Masculino" @if(Auth::user()->gender == 'Masculino'){{ 'selected' }}@endif>Masculino</option>
                            </select>
                        </label>
                        <small class="col-xs-2 col-xs-offset-3">
                            Para editar alguma informação, basta clicar sobre o campo desejado
                            e depois pressionar enter.
                        </small>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="addressAndPhonesInformation">
                        <label class="col-xs-10" for="address">
                            <strong>Endereço:</strong>
                            <p id="address">{{ Auth::user()->address }}</p>
                            {!! Form::text('address', Auth::user()->address, ['id' => 'address', 'placeholder' => 'Rua, Avenida, Rodovia, etc..', 'maxlength' => '150', 'required' => 'required']) !!}
                        </label>
                        <div class="clear"></div>
                        <label class="col-xs-1" for="number">
                            <strong>Nº:</strong>
                            <p id="number">{{ Auth::user()->number }}</p>
                            {!! Form::text('number', Auth::user()->number, ['id' => 'number', 'maxlength' => '10', 'required' => 'required']) !!}
                        </label>
                        <label class="col-xs-4" for="complement">
                            <strong>Complemento:</strong>
                            <p id="complement">
                                @if(empty(Auth::user()->complement))
                                {{ '- - -' }}
                                @else
                                {{ Auth::user()->complement }}
                                @endif
                            </p>
                            {!! Form::text('complement', Auth::user()->complement, ['id' => 'complement', 'maxlength' => '50']) !!}
                        </label>
                        <label class="col-xs-5" for="district">
                            <strong>Bairro:</strong>
                            <p id="district">{{ Auth::user()->district }}</p>
                            {!! Form::text('district', Auth::user()->district, ['id' => 'district', 'maxlength' => '50', 'required' => 'required']) !!}
                        </label>
                        <div class="clear"></div>
                        <label class="col-xs-1" for="state">
                            <strong>UF:</strong>
                            <p id="state">{{ Auth::user()->state }}</p>
                            <?php
                                //STATES
                                $statesConsult = \App\Exceptions\Handler::readFile("states.json");
                                foreach($statesConsult as $state):
                                    $states[$state['uf']] = $state['uf'];
                                endforeach;
                            ?>
                            {!! Form::select('state', $states, Auth::user()->state) !!}
                        </label>
                        <label class="col-xs-4" for="city">
                            <strong>Cidade:</strong>
                            <p id="city">{{ Auth::user()->city }}</p>
                            {!! Form::text('city', Auth::user()->city, ['id' => 'city', 'maxlength' => '100', 'required' => 'required']) !!}
                        </label>
                        <label class="col-xs-5 remove-padding" for="phone">
                            <label class="col-xs-6" for="phone">
                                <strong>Tel. fixo:</strong>
                                <p id="phone">
                                    @if(empty(Auth::user()->phone))
                                    {{ '- - -' }}
                                    @else
                                    {{ Auth::user()->phone }}
                                    @endif
                                </p>
                                {!! Form::text('phone', Auth::user()->phone, ['id' => 'phone', 'maxlength' => '14', 'data-mask' => '(00) 0000-0000', 'required' => 'required']) !!}
                            </label>
                            <label class="col-xs-6" for="mobile">
                                <strong>Celular:</strong>
                                <p id="mobile">
                                    @if(empty(Auth::user()->mobile))
                                    {{ '- - -' }}
                                    @else
                                    {{ Auth::user()->mobile }}
                                    @endif
                                </p>
                                {!! Form::text('mobile', Auth::user()->mobile, ['id' => 'mobile', 'maxlength' => '15', 'data-mask' => '(00) 0000-00009', 'required' => 'required']) !!}
                            </label>
                        </label>
                        <small class="col-xs-2">
                            Para editar alguma informação, basta clicar sobre o campo desejado
                            e depois pressionar enter.
                        </small>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div id="warningModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Importante</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">
                <div class="col-xs-7 photo"></div>
                <div class="col-xs-4 warning">
                    <h5>Lembrete:</h5>
                    <p>Só serão aceitos no concurso, as fotos e vídeos onde apareça o bebê junto aos produtos participantes da promoção.</p>
                    <a href="#" data-dismiss="modal" aria-hidden="true" data-toggle="modal" data-target="#uploadModal">Ok, entendi.</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="uploadModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">
                @if(\App\Photos::quantityPhotosByUser(Auth::user()->id) < 5 or \App\Videos::quantityVideosByUser(Auth::user()->id) == 0)
                {!! Form::open([
                    'id' => 'form-upload',
                    'method' => 'post',
                    'class' => 'col-xs-12 form-upload',
                    'enctype' => 'multipart/form-data',
                    'url' => url('upload')
                    ])
                !!}
                @else
                {!! Form::open([
                    'id' => 'form-upload',
                    'class' => 'col-xs-12 form-upload',
                    ])
                !!}
                @endif
                {!! Form::hidden('userId', Auth::user()->id) !!}
                <div class="warning">
                    Você tem o limite de 5 fotos e 1 vídeo de EXATOS 15 segundos. Para o envio  do vídeo você deverá fazer o upload do mesmo no Youtube ou Instagram e em seguinda copiar o link no campo abaixo.
                    <br />
                    <strong>Atenção, selecione bem as fotos e o vídeo antes de enviar, pois não há como alterar depois de enviado.</strong>
                </div>
                <label>
                    Fazer upload da imagem:
                    @if(\App\Photos::quantityPhotosByUser(Auth::user()->id) == 5)
                    {!! Form::file('photo[]', ['id' => 'photo', 'disabled' => 'disabled', 'class' => 'multi', 'accept' => 'gif|jpg|jpeg|png', 'maxfiles' => 5-\App\Photos::quantityPhotosByUser(Auth::user()->id)]) !!}
                    @else
                    {!! Form::file('photo[]', ['id' => 'photo', 'class' => 'multi', 'accept' => 'gif|jpg|jpeg|png', 'maxfiles' => 5-\App\Photos::quantityPhotosByUser(Auth::user()->id)]) !!}
                    @endif
                </label>
                <label>
                    Link do Instagram ou Youtube para vídeo
                    {!! Form::text('url', '', ['id' => 'url', 'placeholder' => 'http://', 'maxlength' => 255]) !!}
                </label>
                @if(\App\Photos::quantityPhotosByUser(Auth::user()->id) == 5 and \App\Videos::quantityVideosByUser(Auth::user()->id) == 1)
                {!! Form::button('Salvar', ['class' => 'btn-save', 'onclick' => 'alert(\'Você já enviou todas as fotos e vídeos!\')']) !!}
                @else
                {!! Form::submit('Salvar') !!}
                @endif
                {!! Form::close() !!}
                <div class="clear"></div>
                <div class="photosList pull-left margin-left-25">
                    <div class="photo photo1"></div>
                    <div class="photo photo2"></div>
                    <div class="photo photo3"></div>
                    <div class="photo photo4"></div>
                    <div class="photo photo5"></div>
                </div>
                <div class="video video1"></div>
                <div class="clear"></div>
                @if(\App\Photos::quantityPhotosByUser(Auth::user()->id) < 5 or \App\Videos::quantityVideosByUser(Auth::user()->id) == 0)
                {!! Form::open([
                    'id' => 'form-receipts',
                    'method' => 'post',
                    'class' => 'col-xs-12 form-upload',
                    'enctype' => 'multipart/form-data',
                    'url' => url('upload-cupons')
                    ])
                !!}
                @else
                    {!! Form::open([
                        'id' => 'form-receipts',
                        'class' => 'col-xs-12 form-upload',
                        ])
                    !!}
                @endif
                <div class="warning margin-top-20">
                    Para concluir o cadastro das fotos e/ou vídeo, faça o upload da imagem do cupom fiscal.
                    Atenção: cada produto equivale a participação de 1 categoria.
                </div>
                <label class="pull-left">
                    Fazer upload da imagem:
                    @if(\App\UsersReceipts::quantityReceiptsByUser(Auth::user()->id) == 2)
                    {!! Form::file('receipts[]', ['id' => 'receipts', 'disabled' => 'disabled', 'class' => 'multi', 'accept' => 'gif|jpg|jpeg|png', 'maxfiles' => 2-\App\UsersReceipts::quantityReceiptsByUser(Auth::user()->id)]) !!}
                    @else
                    {!! Form::file('receipts[]', ['id' => 'receipts', 'class' => 'multi', 'accept' => 'gif|jpg|jpeg|png', 'maxfiles' => 2-\App\UsersReceipts::quantityReceiptsByUser(Auth::user()->id)]) !!}
                    @endif
                </label>
                @if(\App\UsersReceipts::quantityReceiptsByUser(Auth::user()->id) == 2)
                {!! Form::button('Salvar', ['class' => 'btn-save pull-left margin-top-40', 'onclick' => 'alert(\'Você já enviou todos os cupons!\')']) !!}
                @else
                {!! Form::submit('Salvar', ['class' => 'pull-left margin-top-40']) !!}
                @endif
                <div class="receiptsList pull-left margin-left-25 margin-top-15">
                    <div class="receipt receipt1"><span>Cupom</span></div>
                    <div class="receipt receipt2"><span>Cupom</span></div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endif
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Vídeo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <iframe width="100%" height="480" frameborder="0" allowfullscreen=""></iframe>
            </div>
        </div>
    </div>
</div>
<script src="{!! asset('assets/js/jquery.js') !!}"></script>
<script src="{!! asset('assets/js/main.js') !!}"></script>
@if(Session::has('message'))
<script>
alert('{!! Session::get('message') !!}');
</script>
@endif
@if(Auth::check() and Auth::getUser()->type == 1 and $websiteSettings['registerOk'] == 1)
<script src="{!! asset('assets/js/jquery.MultiFile.min.js')  !!}"></script>
<script>
$(function () {
    $("#form-upload").validate({
        rules: {
            'url': {
                url:true
            }
        },
        messages: {
            url:{ url:"O endereço do vídeo não é válido!" }
        }
    });
});
</script>
@endif
@yield('javascript')
</body>
</html>