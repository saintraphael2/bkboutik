@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        Mise à jour Vidange
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('motos.show_fields')
                </div>
                
            </div>
        </div>

        <div class="card">

            {!! Form::model($vidange, ['route' => ['vidanges.update', $vidange->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('vidanges.fields')
                </div>
            </div>

            <div class="card-footer text-right">
                {!! Form::submit('Enregister', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('motos.show', $id) }}" class="btn btn-default"> Annuler </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
