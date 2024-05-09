@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Motos</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('motos.create') }}">
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
            @include('motos.table')
        </div>
    </div>
    <div id="dialog_partenaire" style="display: none;">
        <div>
           

           
            <table class="table">
            <tr>
                    <td>Moto</td>
                    <td id='p_moto' style='font-weight:bold'>
                    
                        
                    </td>
                </tr>
                <tr>
                    <td width="200px">Partenaire</td>
                    <td id='p_commercial' style='font-weight:bold'> 
                    
                    <select name="partenaire" id="partenaire" class="select2 form-control">
                       
                        @foreach($partenaires as $partenaire)
                            <option value="{{$partenaire->id}}">{{$partenaire->nom}} {{$partenaire->prenom}}</option>
                        @endforeach
                    </select>

                    
                    </td>
                </tr>
                
                
            </table>
                
            
        </div>
    </div> 
    <script>
        function visualiser_partenaire(idMoto,moto){
            $("#p_moto").text(moto);
        $("#dialog_partenaire").dialog({
            height: 400,
            width: 1000,
            modal: true,
            title:'Attribution de partenaire',
            position: { my: 'top', at: 'top+150' },
            buttons: [{ 
                text: "Enregistrer", 
                click: function() { 
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    
                    $.ajax({
                        type:'POST',
                        url:"{{ route('majPartenaire') }}",
                        data:{id:idMoto,partenaire:$("#partenaire").val(),
                        success:function(data){
                            url="{{URL::to('motos')}}";
                            //url=url.replace("data", data);
                            console.log(data)
                            window.location.href = url;
                        }
                        }
                    });

                }
            },{ 
                text: "Fermer", 
                click: function() { 
                 $( this ).dialog( "close" ); 
                }
            }
            
        ]
        });
       
    } 
    </script>      
@endsection
