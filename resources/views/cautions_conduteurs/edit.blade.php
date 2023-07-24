@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        Mise à jour Cautions Conduteur
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($cautionsConduteur, ['route' => ['cautionsConduteurs.update', $cautionsConduteur->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('cautions_conduteurs.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Enregister', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('cautionsConduteurs.index') }}" class="btn btn-default"> Annuler </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
