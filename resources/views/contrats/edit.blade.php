@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        Mise à jour Contrat
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')
        @include('flash::message')

        <div class="card">

            {!! Form::model($contrat, ['route' => ['contrats.update', $contrat->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('contrats.fields')
                </div>
            </div>

            <div class="card-footer text-right">
                {!! Form::submit('Enregister', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('contrats.index') }}" class="btn btn-default"> Annuler </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
