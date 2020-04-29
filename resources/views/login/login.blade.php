@extends('layouts.login')


@section('form')

    {!! Form::open(['route'=>'login', 'method'=>'post']) !!}

    @if(\Illuminate\Support\Facades\Session::has('warning'))
        <div class="alert alert-danger">{{ \Illuminate\Support\Facades\Session::get('warning') }}</div>
    @endif

    <div class="input-group">
        {!! Form::text('kullanici',null,['class'=>'form-control','required','placeholder'=>'kullanıcı adı']) !!}
        <span class="input-group-addon"><i class="fa fa-user"></i></span>
    </div>
    <div class="input-group">
        {!! Form::password('sifre',['class'=>'form-control','required','placeholder'=>"şifre"]) !!}
        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
    </div>
    <p class='text-center'>

        <img src="<?php echo $metin; ?>"/>
    </p>
    <div class="form-group">
        {!! Form::number('gkod',null,['class'=>'form-control','required','placeholder'=>"guvenlik kodu"]) !!}
    </div>
    <button type="submit" class="btn btn-custom-primary btn-lg btn-block btn-login">
        <i class="fa fa-arrow-circle-o-right"></i> Giriş
    </button>

    {!! Form::close() !!}
    @include('errors.list')

@stop