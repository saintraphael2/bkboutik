@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Etat des partenaires</h1>
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

        

        <div class="clearfix"></div>

       <!-- <div class="info-box bg-gradient-warning">
            <span class="info-box-icon"><i class="fa fa-sack-dollar"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Montant de la caisse</span>
                <span class="info-box-number">{{ $caisse ?? "---"}} XOF</span>
            </div>
        </div>-->
        <div class="card" style="overflow-x: auto; white-space: nowrap;">
            @include('etats.partenaires_table')
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
            let redirect_url = "{{ route('etats.reglements') }}"

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

            let redirect_url = "{{ route('etats.reglements') }}"
            console.log("redirect Url : ", redirect_url)
            showSuccess(redirect_url, null, null)
        });

       
</script>
@endpush