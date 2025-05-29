@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                    Payement Autre Produit
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'facturationProduits.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('facturation_produits.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Enregistrement', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('facturationProduits.index') }}" class="btn btn-default"> Annuler </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
    <script>
   
   $(document).ready(function () {
    $("#montant_paye").on('keyup', function(){
       // if($(this).val().length>0){
        let montantAPayer = parseInt($("#montant_a_payer").val()) || 0;
        let montantPayer = parseInt($("#montant_paye").val()) || 0;
        let restePaye = montantAPayer - montantPayer;
        console.log("montantPayer " , montantPayer);
        $("#reste_paye").val(restePaye);
       // }
    });

    
$("#souscriptionInfo").autocomplete({
       source: function (request, response) {
       console.log("MATRICULE VALUE " , request.term);
       $.ajax({
           url: "{{ route('autoSouscription') }}", 
           data: { immatriculation: request.term },
           success: function (data) {
               console.log("DATA" , data);
               response(data.map(function (item) {
                   return {
                    label: item.immatriculation+" ("+ item.libelle+' '+item.modele +")",
                    value: item.id,
                    nom: item.solde,
                    conducteur:item.nom,
                    produit:item.libelle+' '+item.modele   ,
                    immatriculation:item.immatriculation
                   };
               }));
           }
       });
   },
   select: function (event, ui) {
      
       $('#souscriptionInfo').val(ui.item.immatriculation);
       $('#souscription').val(ui.item.value);
       $('#conducteur').val(ui.item.conducteur);
       $('#produit').val(ui.item.produit);
       $('#montant_a_payer').val(ui.item.nom);
       return false;
   },
   minLength: 2,
   open: function() {
        $(this).autocomplete("widget").css({
            "max-height": "200px", // Taille de la boîte
            "overflow-y": "auto"   // Permet le défilement
        });
    }
});

});

</script>
@endsection
