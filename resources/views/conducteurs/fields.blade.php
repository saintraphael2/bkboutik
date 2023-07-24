<!-- Photo Field -->
<div class="form-group col-sm-4">
    <input id="fichier_photo" name="fichier_photo" type="file" class="file" data-preview-file-type="any" >
</div>

<div class="form-group col-sm-8">
    <div class="row">
        <!-- Type Piece Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('type_piece', 'Type Piece:') !!}
            <!-- {!! Form::number('type_piece', null, ['class' => 'form-control', 'required']) !!} -->
            <select class="select2 form-control" name="type_piece" id="type_piece", required=required>
                @foreach ($typepieces as $typepiece)
                    <option value="{{ $typepiece->id }}">{{ $typepiece->libelle }}</option>
                @endforeach
            </select>
        </div>
        

        <!-- Numero Piece Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('numero_piece', 'Numero Piece:') !!}
            {!! Form::text('numero_piece', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]) !!}
        </div>

        <!-- Nom Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('nom', 'Nom :') !!}
            {!! Form::text('nom', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]) !!}
        </div>

        <!-- Prenom Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('prenom', 'Prenom:') !!}
            {!! Form::text('prenom', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]) !!}
        </div>

        <!-- Telephone Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('telephone', 'Telephone:') !!}
            {!! Form::number('telephone', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]) !!}
        </div>

        <!-- Quartier Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('quartier', 'Quartier:') !!}
            {!! Form::text('quartier', null, ['class' => 'form-control', 'required', 'maxlength' => 200, 'maxlength' => 200]) !!}
        </div>

        <!-- Date Naissance Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('date_naissance', 'Date Naissance:') !!}
            {!! Form::text('date_naissance', null, ['class' => 'form-control','id'=>'date_naissance']) !!}
        </div>

    </div>
</div>









<!-- Photo Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('photo', 'Photo:') !!}
    {!! Form::text('photo', null, ['class' => 'form-control', 'maxlength' => 200, 'maxlength' => 200]) !!}
</div> -->

<!-- Caution Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('caution', 'Caution:') !!}
    {!! Form::number('caution', null, ['class' => 'form-control', 'required']) !!}
</div> -->



@push('page_scripts')
<script>
    $('#date_naissance').datepicker()
    console.log("let's start here")
    console.log(@json($view))

    $("#fichier_photo").fileinput({
        // settings here
        language:'fr',
        // displays the file caption
        //showCaption:true,
        // displays the file browse button
        //showBrowse:true,
        multiple: false,
        initialPreview: initialPreview()
    })

    function initialPreview(){
        
        if(@json($view) == "edit" && @json($conducteur->photo)){
            //console.log("{{asset($conducteur->photo)}}")
            return [
                //"<img src='http://localhost:8000/storage/photos/BKZ_Photo_18.png' class='file-preview-image' alt='Desert' title='Desert'>"
                "<img src='{{asset($conducteur->photo)}}' class='file-preview-image' alt='Desert' title='Desert'>"
            ]
        } else {
            return []
        }
    }

</script>
@endpush