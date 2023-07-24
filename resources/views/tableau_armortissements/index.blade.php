@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tableau Armortissements</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('contrats.index') }}">
                       Liste des contrats
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="card">
            <div class="card-body">
                @include('contrats.show_fields_second')
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="card">
            @include('tableau_armortissements.table')
        </div>
    </div>

@endsection
