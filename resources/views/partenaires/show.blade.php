@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                    Situation du partenaire ({{$periode}})
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
            <div class="content px-3">

       

<div class="row input-daterange">
    <!-- Caissier Field -->
   
    <!-- Date Signature Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('date_debut', 'Date début (jj-mm-aaaa) :') !!}
        {!! Form::text('date_debut', null, ['class' => 'form-control','id'=>'date_debut']) !!}
        <span class="text-danger font-size-xsmall error_date_debut"></span>
    </div>

    <!-- Date Debut Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('date_fin', 'Date fin (jj-mm-aaaa) :') !!}
        {!! Form::text('date_fin', null, ['class' => 'form-control','id'=>'date_fin']) !!}
        <span class="text-danger font-size-xsmall error_date_fin"></span>
    </div>

    <div class="form-group col-sm-3" style="margin-top: 2rem;">
        <button type="button" name="filter" id="filter" class="btn btn-primary">Filtrer</button>
       
    </div>
</div>
<br/>
    <div class="card" style="overflow-x: auto; white-space: nowrap;">
        @include('motos.table')
    </div>
    </div>
@endsection
@push('page_scripts')
<script>

    $('#date_debut').datepicker()
    $('#date_fin').datepicker()

        /*$('.input-daterange').datepicker({
            todayBtn:'linked',
            format:'yyyy-mm-dd',
            autoclose:true
        });*/

        $('#filter').click(function(){
            let fromDate = $('#date_debut').val()
            let toDate = $('#date_fin').val()
            let id={{$partenaires->id}}
            console.log("id : ", id)
            let redirect_url = "{{ route('partenaires.show','aid') }}"

            redirect_url=redirect_url.replace('aid',id);
            console.log("redirect Url : ", redirect_url)
            if(fromDate != '' &&  toDate != ''){
                
                redirect_url += "?fromDate="+fromDate+"&toDate="+toDate
            } 
            
            /*
            //alert('Both Date is required')
            let erreur = {
                responseJSON : {message : "Les deux dates sont obligatoires"}
            }
            showError(erreur, "")*/
            
            console.log("redirect Url : ", redirect_url)
            showSuccess(redirect_url, null, null)
        });

        $('#refresh').click(function(){
            //$('#date_debut').val('')
            //$('#date_fin').val('')

            let redirect_url = "{{ route('etats.encaissements') }}"
            console.log("redirect Url : ", redirect_url)
            showSuccess(redirect_url, null, null)
        });

        /*$(function() {
            var table = $('#dataTableBuilder').DataTable();
            var json = table.rows().data();
            $('#dataTableBuilder').on( 'draw.dt', function () {
                console.log(table.ajax.json().total)
                $(".dataTables_info").append('.   Montant Total : <b>' +new Intl.NumberFormat().format(table.ajax.json().total)+ ' CFA </b>');
            } );
        });*/
</script>
@endpush