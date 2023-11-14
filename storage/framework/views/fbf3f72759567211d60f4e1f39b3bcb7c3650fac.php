
<div class="form-group col-sm-12">
<fieldset>
<legend>Liste des habilitations</legend>
<?php $__currentLoopData = $liens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lien): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<div class="form-group col-sm-4">
    <?php echo Form::checkbox("item[]",$lien->id ,checkLien($lien->id,$users->userLiens), [ "class" => "form-group", "id"=>"$lien->id" ]); ?>

    <?php echo Form::label('username', $lien->libelle); ?> 
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</fieldset>
</div>
<?php 
 function checkLien($lien,$arrayLien){
     
     $result=false;
    foreach($arrayLien as $key=>$value){
             if($lien==$value["lien"]){
            $result=true;
            break;
        }
   
    }
    return $result;
 }
 function userLien($lien,$arrayLien){
    $result=0;
   foreach($arrayLien as $key=>$value){
            if($lien==$value["lien"]){
           $result=$value["id"];
           break;
       }
  
   }
   return $result;
}

?><?php /**PATH C:\inetpub\wwwroot\bkzed\resources\views/users/infoComplementaire.blade.php ENDPATH**/ ?>