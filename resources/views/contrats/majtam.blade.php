@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                   Mise à jour du tableau d'amortissement
                    </h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('etats.arrieres') }}">
                                                    Arriérés
                                            </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('contrats.show_fields_second')
                </div>
                <br>
                <div class="row">
                
                    <fieldset style="border:navy solid 1px; padding:10px; width:100%">
                    <legend>Mise à jour écheance</legend>
                    {!! Form::model($contrat, ['route' => ['edittam', $contrat->id], 'method' => 'post']) !!}
                       
                        <div class="row">
                        <div class="col-sm-2">
            {!! Form::label('datprev', '1ere écheance non payée:') !!}
            <p> {{($dateprevnonpaye[0]->datprev!=null)?$dateprevnonpaye[0]->datprev->format('d-m-Y'):'-'}}</p>
        </div>
        <div class="col-sm-2">
            {!! Form::label('montant', 'Total non payé:') !!}
            <p>{{$montantarriere[0]->arrieres}}</p>
        </div>
        <div class="col-sm-2">
            {!! Form::label('nbrejts', 'Nombre de jours non payés:') !!}
            <p>{{$retards[0]->retard}}</p>
        </div>
      
        <div class="col-sm-2">
            {!! Form::label('newdate', 'Nouvelle date:') !!}
            {!! Form::text('newdate', null, ['class' => 'form-control','id'=>'newdate']) !!}
        </div>

@push('page_scripts')
    <script type="text/javascript">
        $('#newdate').datepicker()
    </script>
@endpush
<div class="col-sm-4">
                {!! Form::submit('Enregister', ['class' => 'btn btn-primary']) !!}
               
            </div>

           
        </div>         
                        
                        
                    </fieldset>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
