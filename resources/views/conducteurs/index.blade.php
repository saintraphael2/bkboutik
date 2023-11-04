@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2"> 
                <div class="col-sm-6">
                    <h1>Conducteurs</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('conducteurs.create') }}">
                        Nouveau
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            @include('conducteurs.table')
        </div>
    </div>
    <div id="dialog" style="display: none;">
        <div>
            <iframe id="frame" width="1000" height="800">

            <div class="row">
                    
                </div>
            </iframe>
        </div>
    </div>
@endsection
<script>
    function visualiser(title,id){
       
        console.log(id);
        chemin="{{ route('conducteurs.show','id') }}";
        chemin=chemin.replace("id", id);
        console.log(chemin);
       
       $("#dialog").dialog({
            height: 800,
         width: 1000,
         modal: true,
         title:title,
       }
          
       );
     
         $("#frame").attr("src",chemin);   
     
           
  }
</script>