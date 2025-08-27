@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                    Nouvel Encaissement
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'boutiques.store']) !!}

            <div class="card-body">

                <div class="row">
                    
                    @include('boutiques.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Enregistrer', [
                    'class' => 'btn btn-primary',
                    'onclick' => 'return confirm("Merci de confimer les chiffres avant de valider!")'
                    ]) !!}
                <a href="{{ route('boutiques.index') }}" class="btn btn-default"> Annuler </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
    <script>
   
   $(document).ready(function () {
    
    $("#montant_verse").on('keyup', function(){
       // if($(this).val().length>0){
        let ttc = parseInt($("#ttc").val()) || 0;
        let montant_verse = parseInt($("#montant_verse").val()) || 0;
        let restePaye = montant_verse - ttc;
       
        $("#relicat").val(restePaye);
       // }
    });

    $("#create_stock").click(function(){
        let message=null;
       if($("#produit_boutique").val().length==0){
            message="Merci de selectionner le produit dans une liste. \n";
       }
     
       if(message==null){
            return true;
       }else{
        alert(message);
        return false;
       }
    });
    
$("#produitBoutique").autocomplete({
       source: function (request, response) {
       console.log("MATRICULE VALUE " , request.term);
       $.ajax({
           url: "{{ route('autoStock') }}", 
           data: { produit: request.term },
           success: function (data) {
               console.log("DATA" , data);
               response(data.map(function (item) {
                   return {
                    label: item.code+ " - "+item.libelle,
                    code:item.code,
                    value: item.id,
                    libelle: item.libelle,
                    prix:item.prix
                       
                   };
               }));
           }
       });
   },
   select: function (event, ui) {
      
       $('#produitBoutique').val(ui.item.code);
       $('#produit_boutique').val(ui.item.value);
       $('#prix').val(ui.item.prix);
       $('#libelle').val(ui.item.libelle);
       $('#adProduit').prop('disabled', false);
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
