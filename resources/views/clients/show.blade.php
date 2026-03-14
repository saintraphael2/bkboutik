@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                   Situation du client ( du {{ $from }} au {{ $to }})
                    </h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('clients.index') }}">
                                                   Liste des clients
                                            </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('clients.show_fields')
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
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
            </div>
            
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                   <table style="width:100%" class="table table-striped table-bordered dataTable no-footer">
                        <tr>
                            <td>Date</td>
                            <td>Réference</td>

                            <td>Achat </td>
                            <td>Dépôt</td>
                        </tr>
                        <?php 
                            $total_achat=0;
                            $total_depot=0;
                        ?>
                        @foreach($results as $result)
                        <?php 
                            $total_achat+=$result->achat;
                            $total_depot+=$result->depot;
                        ?>
                        <tr>
                            <td>{{$result->date}}</td>
                            <td>{{$result->reference}}</td>
                            <td>{{ strrev(wordwrap(strrev($result->achat), 3, ' ', true))}}</td>
                            <td>{{ strrev(wordwrap(strrev($result->depot), 3, ' ', true)) }}</td>
                        </tr>
                            
                        @endforeach
                        <tr>
                            <td colspan="2">Totaux</td>
                            <td>{{strrev(wordwrap(strrev($total_achat), 3, ' ', true)) }}</td>
                            <td>{{strrev(wordwrap(strrev($total_depot), 3, ' ', true)) }}</td>
                        </tr>
                   </table>
                </div>
            </div>
            
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
           let id={{Request::segment(2)  }}
            let redirect_url = "{{ route('clientSituation') }}"

          

            if(fromDate != '' &&  toDate != ''){
               
                redirect_url += "?id="+id+"&fromDate="+fromDate+"&toDate="+toDate
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

      

</script>
@endpush
