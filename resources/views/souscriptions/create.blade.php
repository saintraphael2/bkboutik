@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                    Nouvelle Souscription
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'souscriptions.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('souscriptions.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('souscriptions.index') }}" class="btn btn-default"> Annuler </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
    <script>
   
   $(document).ready(function () {
    

    
$("#modeleProduit").autocomplete({
       source: function (request, response) {
       console.log("MATRICULE VALUE " , request.term);
       $.ajax({
           url: "{{ route('modeleProduit') }}", 
           data: { modele: request.term },
           success: function (data) {
               console.log("DATA" , data);
               response(data.map(function (item) {
                   return {
                    label: item.modele,
                    value: item.id,
                    nom: item.montant,
                       
                   };
               }));
           }
       });
   },
   select: function (event, ui) {
      
       $('#modeleProduit').val(ui.item.label);
       $('#produit').val(ui.item.value);
       $('#montant').val(ui.item.nom);
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


$("#clientContrat").autocomplete({
       source: function (request, response) {
       console.log("MATRICULE VALUE " , request.term);
       $.ajax({
           url: "{{ route('autocompContrat') }}", 
           data: { immatriculation: request.term },
           success: function (data) {
               console.log("DATA" , data);
               response(data.map(function (item) {
                   return {
                    label: item.immatriculation+ " - " + item.nom,
                    value: item.id,
                    nom: item.immatriculation,
                       
                   };
               }));
           }
       });
   },
   select: function (event, ui) {
      
       $('#clientContrat').val(ui.item.nom);
       $('#client').val(ui.item.value);
       $('#conducteur').val(ui.item.label);
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
