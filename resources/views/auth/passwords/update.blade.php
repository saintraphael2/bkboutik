@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ Auth::user()->name }}</h1>
                </div>
                <div class="col-sm-6"></div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')
        @include('adminlte-templates::common.errors')

        <div class="clearfix"></div>

        <div class="card">
        {!! Form::open(['route' => 'password.my_update']) !!}

        <div class="card-header">
            Mise à jour du mot de passe :
        </div>
        <div class="card-body">

            <div class="row">
                <!-- password Field -->
                <div class="form-group col-sm-4">
                    {!! Form::label('password', 'Mot de passe actuel:') !!}
                    {!! Form::password('password', ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
                </div>

                <!-- password Field -->
                <div class="form-group col-sm-4">
                    {!! Form::label('new_password', 'Nouveau mot de passe:') !!}
                    {!! Form::password('new_password', ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
                </div>
            </div>

        </div>

        <div class="card-footer text-right">
            {!! Form::submit('Enregister', ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('users.index') }}" class="btn btn-default"> Annuler </a>
        </div>

        {!! Form::close() !!}
        </div>
    </div>

@endsection
