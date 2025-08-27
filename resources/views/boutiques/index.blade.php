@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Caisse</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('boutiques.create') }}">
                       Nouvel Encaissement
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            @include('boutiques.table')
        </div>
    </div>


<div id="dialog" style="display: none;">
        <div>
            <iframe id="framerecu" width="800" height="800"></iframe>
        </div>
    </div>
    @if(Request::segment(2)!=0) 
    
    <script>
       
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
           type:'GET',
           url:"{{ route('cheminFactures') }}",
           data:{versement:{{Request::segment(2)}}},
           success:function(data){
                if($.isEmptyObject(data.error)){
                  
                   url="{{asset('uploads/caisse/$chemin')}}";
                   url=url.replace("$chemin", data.chemin);
                  
                    $("#dialog").dialog({
            height: 800,
         width: 800,
         modal: true,
         title:"RECU",
       }
          
       );
     
         $("#framerecu").attr("src",url);   
                }
           }
        });
    </script>
  

    @endif
@endsection
<script>
    function regenerer(versement){
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
           type:'GET',
           url:"{{ route('regenererFacturesProduit') }}",
           data:{versement:versement},
           success:function(data){
                if($.isEmptyObject(data.error)){
                  
                   url="{{asset('uploads/facturesProduit/$chemin')}}";
                   url=url.replace("$chemin", data.chemin);
                  
                    $("#dialog").dialog({
            height: 800,
         width: 800,
         modal: true,
         title:"RECU",
       }
          
       );
     
         $("#framerecu").attr("src",url);   
                }
           }
        });
    }
    function visualiser(title,code){
        //chemin="/documents/Recus/"+contrat+'/'+versement+'.pdf'
        chemin="{{route('home')}}/uploads/caisse/"+code+'.pdf'
        //chemin="{{ public_path() }}/storage/recus/"+contrat+'/'+versement+'.pdf'
        console.log(chemin);
       
       $("#dialog").dialog({
            height: 800,
         width: 800,
         modal: true,
         title:title,
       }
          
       );
     
         $("#framerecu").attr("src",chemin);   
     
           
  }
</script>
