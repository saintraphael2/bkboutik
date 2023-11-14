<!-- Photo Field -->
<div class="form-group col-sm-4">
    <input id="fichier_photo" name="fichier_photo" type="file" class="file" data-preview-file-type="any" >
</div>

<div class="form-group col-sm-8">
    <div class="row">
        <!-- Type Piece Field -->
        <div class="form-group col-sm-6">
            <?php echo Form::label('type_piece', 'Type Piece:'); ?>

            <!-- <?php echo Form::number('type_piece', null, ['class' => 'form-control', 'required']); ?> -->
            <select class="select2 form-control" name="type_piece" id="type_piece", required=required>
                <?php $__currentLoopData = $typepieces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typepiece): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($typepiece->id); ?>"><?php echo e($typepiece->libelle); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        

        <!-- Numero Piece Field -->
        <div class="form-group col-sm-6">
            <?php echo Form::label('numero_piece', 'Numero Piece:'); ?>

            <?php echo Form::text('numero_piece', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]); ?>

        </div>

        <!-- Nom Field -->
        <div class="form-group col-sm-6">
            <?php echo Form::label('nom', 'Nom :'); ?>

            <?php echo Form::text('nom', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]); ?>

        </div>

        <!-- Prenom Field -->
        <div class="form-group col-sm-6">
            <?php echo Form::label('prenom', 'Prenom:'); ?>

            <?php echo Form::text('prenom', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]); ?>

        </div>

        <!-- Telephone Field -->
        <div class="form-group col-sm-6">
            <?php echo Form::label('telephone', 'Telephone:'); ?>

            <?php echo Form::number('telephone', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]); ?>

        </div>

        <!-- Quartier Field -->
        <div class="form-group col-sm-6">
            <?php echo Form::label('quartier', 'Quartier:'); ?>

            <?php echo Form::text('quartier', null, ['class' => 'form-control', 'required', 'maxlength' => 200, 'maxlength' => 200]); ?>

        </div>

        <!-- Date Naissance Field -->
        <div class="form-group col-sm-6">
            <?php echo Form::label('date_naissance', 'Date Naissance:'); ?>

            <?php echo Form::text('date_naissance', null, ['class' => 'form-control','id'=>'date_naissance']); ?>

        </div>

    </div>
</div>









<!-- Photo Field -->
<!-- <div class="form-group col-sm-6">
    <?php echo Form::label('photo', 'Photo:'); ?>

    <?php echo Form::text('photo', null, ['class' => 'form-control', 'maxlength' => 200, 'maxlength' => 200]); ?>

</div> -->

<!-- Caution Field -->
<!-- <div class="form-group col-sm-6">
    <?php echo Form::label('caution', 'Caution:'); ?>

    <?php echo Form::number('caution', null, ['class' => 'form-control', 'required']); ?>

</div> -->



<?php $__env->startPush('page_scripts'); ?>
<script>
    $('#date_naissance').datepicker()
    console.log("let's start here")
    console.log(<?php echo json_encode($view, 15, 512) ?>)

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
        
        if(<?php echo json_encode($view, 15, 512) ?> == "edit" && <?php echo json_encode($conducteur->photo, 15, 512) ?>){
            //console.log("<?php echo e(asset($conducteur->photo)); ?>")
            return [
                //"<img src='http://localhost:8000/storage/photos/BKZ_Photo_18.png' class='file-preview-image' alt='Desert' title='Desert'>"
                "<img src='<?php echo e(asset($conducteur->photo)); ?>' class='file-preview-image' alt='Desert' title='Desert'>"
            ]
        } else {
            return []
        }
    }

</script>
<?php $__env->stopPush(); ?><?php /**PATH C:\inetpub\wwwroot\bkzed\resources\views/conducteurs/fields.blade.php ENDPATH**/ ?>