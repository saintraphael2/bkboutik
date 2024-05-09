@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                    Situation du partenaire
                    </h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('etats.partenaires') }}">
                                                   Etat des partenaires
                                            </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('partenaires.show_fields')
                </div>
            </div>
        </div>
        <div class="clearfix">
            
            </div>
    
    <div class="card" style="overflow-x: auto; white-space: nowrap;">
        @include('motos.table')
    </div>
    </div>
@endsection
