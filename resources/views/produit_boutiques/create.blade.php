@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                    Nouveau Produit Boutiques
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'produitBoutiques.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('produit_boutiques.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('produitBoutiques.index') }}" class="btn btn-default"> Ennuler</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
