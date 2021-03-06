@extends('admin.sidebar-template')

@section('title', 'Adicionar Chamada | ')

@section('page-content')
@parent
        <!-- Main Container -->
<main id="main-container">
    <!-- Page Header -->
    <div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-7">
                <h1 class="page-heading">
                    Propagandas <small></small>
                </h1>
            </div>
            <div class="col-sm-5 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li><a href="{{ route('advertising') }}" class="text-primary" title="Propagandas">Propagandas</a></li>
                    <li>Adicionar</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END Page Header -->

    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header bg-primary-darker text-white">
                <ul class="block-options">
                    <li>
                        <button type="button" class="btn-back" data-url="{{ route('calls') }}"><i class="si si-action-undo"></i></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"><i class="si si-size-fullscreen"></i></button>
                    </li>
                </ul>
                <h3 class="block-title">Adicionar</h3>
            </div>
            <div class="block-content">
                @if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif
                            <!-- .block-content -->
                    <div class="block-content block-content-full">
                        {!! Form::open([
                            'id' => 'advertising',
                            'method' => 'post',
                            'class' => 'form-horizontal push-20-t',
                            'enctype' => 'multipart/form-data',
                            'url' => route('advertisingAdd')
                            ])
                        !!}
                        <div class="form-group">
                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                                <div class="form-input">
                                    {!! Form::label('title', 'Título *') !!}
                                    {!! Form::text('title', '', ['class'=>'form-control', 'id'=>'title', 'maxlength'=>100]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                                <div class="form-input">
                                    {!! Form::label('url', 'URL *') !!}
                                    {!! Form::text('url', '', ['class'=>'form-control', 'id'=>'url', 'placeholder' => 'http://', 'maxlength'=>255]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 push-30-t">
                                {!! Form::submit('Gravar', ['class'=>'btn btn-primary pull-left']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
@stop

@section('javascript')
    @parent
    <script type="application/javascript">
        $(function(){
            $('.form-horizontal').validate({
                errorClass: 'help-block text-right animated fadeInDown',
                errorElement: 'div',
                errorPlacement: function(error, e) {
                    jQuery(e).parents('.form-group .form-input').append(error);
                },
                highlight: function(e) {
                    jQuery(e).closest('.form-group').removeClass('has-error').addClass('has-error');
                    jQuery(e).closest('.help-block').remove();
                },
                success: function(e) {
                    jQuery(e).closest('.form-group').removeClass('has-error');
                    jQuery(e).closest('.help-block').remove();
                },
                ignore: [],
                rules: {
                    'title': {
                        required: true
                    },
                    'url': {
                        required: true,
                        url: true
                    }
                },
                messages: {
                    'title': {
                        required: 'Informe o título da propaganda'
                    },
                    'url': {
                        required: 'Informe a URL da propaganda',
                        url: 'A URL informada é inválida'
                    }
                }
            });
        });
    </script>
@stop
