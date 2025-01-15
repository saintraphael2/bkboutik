@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Liste des versements</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('versements.index') }}">
                       Liste des contrats  facturés
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="card">
            <div class="card-body">
                @include('contrats.show_fields_second')
            </div>
        </div>
        <div class="clearfix"></div>
       
        <div class="card">
            @include('versements.table')
        </div>
    </div>
    <div id="dialog" style="display: none;">
        <div>
            <iframe id="framerecu" width="800" height="800"></iframe>
        </div>
    </div>
    @if(Request::segment(3)!=0) 
    
    <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
           type:'GET',
           url:"{{ route('cheminVersement') }}",
           data:{versement:{{Request::segment(3)}}},
           success:function(data){
                if($.isEmptyObject(data.error)){
                  
                   url="{{asset('uploads/recus/$chemin')}}";
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
           url:"{{ route('regenererfacture') }}",
           data:{versement:versement},
           success:function(data){
                if($.isEmptyObject(data.error)){
                  
                   url="{{asset('uploads/recus/$chemin')}}";
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
    function visualiser(title,contrat,versement){
        //chemin="/documents/Recus/"+contrat+'/'+versement+'.pdf'
        chemin="{{route('home')}}/uploads/recus/"+contrat+'/'+versement+'.pdf'
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
<?php

?>