@extends('layouts.master')

@section('title')
    Ana Sayfa
@endsection


@section('content')
    <div class="row">
        <div class="col-md-4">
            {!! Form::open(['route'=>'sec', 'method'=>'post']) !!}


            <div class="form-group">
                {!! Form::label('musteri','Müşteriler') !!}
                {!! Form::select('musteri',[''=>'Seçin...']+$liste,'',['class'=>'select','required']) !!}
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fa fa-check-square-o"></i> Müşteriyi Seç.
                </button>
            </div>
            {!! Form::close() !!}
            @include('errors.list')
        </div>
    </div>

@endsection

@section('scripts')

@endsection