<!-- Lien Field -->
<div class="col-sm-12">
    {!! Form::label('lien', 'Lien:') !!}
    <p>{{ $userLiens->lien }}</p>
</div>

<!-- User Field -->
<div class="col-sm-12">
    {!! Form::label('user', 'User:') !!}
    <p>{{ $userLiens->user }}</p>
</div>

<!-- Update At Field -->
<div class="col-sm-12">
    {!! Form::label('update_at', 'Update At:') !!}
    <p>{{ $userLiens->update_at }}</p>
</div>

