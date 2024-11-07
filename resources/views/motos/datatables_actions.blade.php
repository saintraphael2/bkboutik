
<div class='btn-group'>

    <a href="javascript:void(0);"  onclick="disponible('{{$id}}')" class='btn btn-default btn-xs' title="Activer/desactiver">
        @if($disponible)
    <i class="fas fa-toggle-off"></i>
    </a>
    @else
    <i class="fas fa-toggle-on"></i>
    </a>
    @endif
    <a href="javascript:void(0);"  onclick="stock('{{$id}}')" class='btn btn-default btn-xs' title="Entrée /Sortie Stock">
        @if($hors_stock)
    <i class="fas fa-toggle-off"></i>
    </a>
    @else
    <i class="fas fa-toggle-on"></i>
    </a>
    @endif
    @if ( Auth::user()->comptable==1  )
                        <a href="javascript:void(0);"  onclick="visualiser_partenaire('{{$id}}','{{$immatriculation}}')" class='btn btn-default btn-xs' title="Partenaire">
                             <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    @endif
    <a href="{{ route('contratsAssurance',['IdMoto'=>$id])  }}" class='btn btn-default btn-xs' title="Assurance">
    <i class="fa-solid fa-file-contract"></i>
    </a>
    <a href="{{ route('motos.edit', $id) }}" class='btn btn-default btn-xs' title="Mise à jour">
        <i class="fa fa-edit"></i>
    </a>
    {!! Form::open(['route' => ['motos.destroy', $id], 'method' => 'delete']) !!}
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => 'return confirm("'.__('Etes- vous sûr?').'")'

    ]) !!}
</div>
{!! Form::close() !!}

<script>
     function disponible(idMoto){
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
           type:'GET',
           url:"{{ route('disponibleMotor') }}",
           data:{id:idMoto},
           success:function(data){
            window.location.href = "{{ route('motos.index')}}";
           }
        });
     }

     function stock(idMoto){
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
           type:'GET',
           url:"{{ route('stockMotor') }}",
           data:{id:idMoto},
           success:function(data){
            window.location.href = "{{ route('motos.index')}}";
           }
        });
     }
    
    </script>

