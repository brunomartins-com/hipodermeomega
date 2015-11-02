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
        <div class="col-lg-4 col-lg-offset-5 welcome">
            @if(Auth::check() and Auth::getUser()->type == 1)
            <strong>Bem Vindo(a)</strong>
            <br />
            {{ Auth::getUser()->name }}
            @endif
        </div>
        <div class="col-lg-2 sponsor">
            <span class="text-pink">Oferecimento</span>
        </div>
    </div>
    <div class="top">
        <div class="container">
            <div class="col-lg-6 col-lg-offset-5">
                @if(Auth::check() and Auth::getUser()->type == 1)
                <a href="#" class="btn-logged btn-edit" title="Editar meus dados">Editar meus dados</a>
                <a href="#" class="btn-logged btn-upload" title="Upload foto/vídeo">Upload foto/vídeo</a>
                <a href="{{ url('sair') }}" class="btn-logged btn-logout" title="Sair">Sair</a>
                @else
                <a href="#" class="bg-white btn-login" data-toggle="modal" data-target="#loginModal">
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
        <div class="col-lg-6 col-lg-offset-5">
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
        <div class="col-lg-5 col-lg-offset-6">
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
    <div class="col-lg-10 col-lg-offset-1">
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
    <div class="col-lg-5 @if($key == 0){{ 'col-lg-offset-1' }}@endif calls">
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
        <div class="col-lg-4 col-lg-offset-2">{!! nl2br(e($websiteSettings['certificate'])) !!}</div>
        <div class="col-lg-4">
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
        <div class="col-lg-8 col-lg-offset-2 separate"><hr /></div>
        <div class="col-lg-2 col-lg-offset-2">
            Acompanhe as novidades
            <br />
            do Laboratório Teuto através
            <br />
            das redes sociais.
        </div>
        <div class="col-lg-5 social-network">
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
        <div class="col-lg-1">
            <a href="http://www.teuto.com.br" target="_blank" class="teuto" title="Teuto/Pfizer">Teuto/Pfizer</a>
        </div>
    </div>
</footer>
@if(!Auth::check() or Auth::getUser()->type == 0)
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
                    <div class="col-lg-5 pull-left" style="height: 200px;">
                        <h5 class="font-size-24 font-chewy text-pink normal">Recuperação de senha</h5>
                        <p class="text-pink font-size-16 strong">
                            Informe o e-mail utilizado por você para acessar a página do concurso.
                            <br /><br />
                            Uma mensagem será enviada para o seu e-mail alternativo cadastrado com as instruções para a criação de uma nova senha.
                        </p>
                    </div>
                    <div class="col-lg-6 pull-right margin-top-20">
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
@yield('javascript')
</body>
</html>