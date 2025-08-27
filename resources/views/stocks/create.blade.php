@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                    Nouveau Stock
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'stocks.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('stocks.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary','id'=>'create_stock']) !!}
                <a href="{{ route('stocks.index') }}" class="btn btn-default"> Ennuler </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
    <script>
   
   $(document).ready(function () {
    
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
           url: "{{ route('autoProduitBoutique') }}", 
           data: { produit: request.term },
           success: function (data) {
               console.log("DATA" , data);
               response(data.map(function (item) {
                   return {
                    label: item.code+ " - " + item.libelle,
                    value: item.id,
                    libelle: item.libelle,
                       
                   };
               }));
           }
       });
   },
   select: function (event, ui) {
      
       $('#produitBoutique').val(ui.item.label);
       $('#produit_boutique').val(ui.item.value);
     
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
