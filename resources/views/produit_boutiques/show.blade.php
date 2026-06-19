@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                   Situation par produit ( du {{ $from }} au {{ $to }})
                    </h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('stocks.index') }}">
                                                  Retour au Stock
                                            </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('produit_boutiques.show_fields')
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
                            <td>Entrée en Stock</td>
                            <td>Vendue</td>
                        </tr>

                        @foreach($results as $result)
                        <tr>
                            <td>{{$result->date}}</td>
                            <td>{{$result->entre}}</td>
                            <td>{{$result->sortie}}</td>
                        </tr>
                            
                        @endforeach

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
            let redirect_url = "{{ route('produitBoutiqueSituation') }}"

          

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