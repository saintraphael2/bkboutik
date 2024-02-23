
<div class='btn-group'>

    <a href="javascript:void(0);"  onclick="disponible('{{$id}}')" class='btn btn-default btn-xs' title="Activer/desactiver">
        @if($disponible)
    <i class="fas fa-toggle-off"></i>
    </a>
    @else
    <i class="fas fa-toggle-on"></i>
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
    
    </script>

