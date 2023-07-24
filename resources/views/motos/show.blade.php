@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                    Vidange
                    </h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('motos.index') }}">
                                                   Listes des motos
                                            </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        
        <div class="card">
            <div class="card-body">
                    
                    
                    @include('motos.show_fields')
                    
               
            </div>
        </div>
        <div class="clearfix"></div>
                
                <div class="card">
                
                    <a class="btn btn-primary float-right"
                       href="{{route('addVidande',['IdMoto'=>$id])   }}">
                        Nouvelle Vidange
                    </a>
                
                    @include('vidanges.table')
                </div>
    </div>
@endsection
