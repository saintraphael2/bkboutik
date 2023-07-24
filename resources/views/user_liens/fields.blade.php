<!-- Lien Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lien', 'Lien:') !!}
    {!! Form::number('lien', null, ['class' => 'form-control']) !!}
</div>

<!-- User Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user', 'User:') !!}
    {!! Form::number('user', null, ['class' => 'form-control']) !!}
</div>

<!-- Update At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('update_at', 'Update At:') !!}
    {!! Form::text('update_at', null, ['class' => 'form-control','id'=>'update_at']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#update_at').datepicker()
    </script>
@endpush