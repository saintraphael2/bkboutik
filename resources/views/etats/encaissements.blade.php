@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Etat des versements</h1>
                </div>
                <div class="col-sm-6"></div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')
        <ul id="form-alert" class="" style="list-style-type: none">
            <!-- <li>The mise circulation field is required.</li> -->
        </ul>

        <div class="row input-daterange">
            <!-- Caissier Field -->
            <div class="form-group col-sm-3">
                {!! Form::label('caissier', 'Caissier :') !!}
                <select class="select2 form-control" name="caissier" id="caissier">
                    <option value="0">Tous les caissiers</option>
                    @foreach ($caissiers as $caissier)
                        <option value="{{ $caissier->id }}">{{ $caissier->name }}</option>
                    @endforeach
                </select>
                <span class="text-danger font-size-xsmall error_caissier"></span>
            </div>

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
                <button type="button" name="refresh" id="refresh" class="btn btn-default">Réinitialiser</button>
            </div>
        </div>
        <br/>

        <div class="clearfix"></div>

       <!-- <div class="info-box bg-gradient-warning">
            <span class="info-box-icon"><i class="fa fa-sack-dollar"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Montant de la caisse</span>
                <span class="info-box-number">{{ $caisse ?? "---"}} XOF</span>
            </div>
        </div>-->
        <div class="card">
            @include('etats.encaissements_table')
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
            let caissier = $('#caissier').val()
            let redirect_url = "{{ route('etats.encaissements') }}"

            if(caissier != 0){
                redirect_url += "?caissier="+caissier
            }

            if(fromDate != '' &&  toDate != ''){
                redirect_url += (caissier != 0) ? "&" : "?"
                redirect_url += "fromDate="+fromDate+"&toDate="+toDate
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

        $(function() {
            var table = $('#dataTableBuilder').DataTable();
            var json = table.rows().data();
            $('#dataTableBuilder').on( 'draw.dt', function () {
                console.log(table.ajax.json().total)
                $(".dataTables_info").append('.   Montant Total : <b>' +new Intl.NumberFormat().format(table.ajax.json().total)+ ' CFA </b>');
            } );
        });
</script>
@endpush