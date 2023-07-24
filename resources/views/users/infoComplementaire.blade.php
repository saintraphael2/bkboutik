
<div class="form-group col-sm-12">
<fieldset>
<legend>Liste des habilitations</legend>
@foreach ($liens as $lien)

<div class="form-group col-sm-4">
    {!!Form::checkbox("item[]",$lien->id ,checkLien($lien->id,$users->userLiens), [ "class" => "form-group", "id"=>"$lien->id" ])!!}
    {!! Form::label('username', $lien->libelle) !!} 
</div>
@endforeach
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

?>