<fieldset style="border:navy solid 1px; padding:10px; width:100%"><legend style="color:navy;width:120px ">Info Moto</legend>
                <div class="row">
<!-- Immatriculation Field -->
<div class="col-sm-2">
   <h6>Immatriculation:</h6> 
    {{ $moto->immatriculation }}
</div>

<!-- Chassis Field -->
<div class="col-sm-2">
<h6>Chassis:</h6>
    {{ $moto->chassis }}
</div>

<!-- Mise Circulation Field -->
<div class="col-sm-2">
<h6>Mise Circulation:</h6>
    {{ $moto->mise_circulation }}
</div>

<!-- Disponible Field -->
<div class="col-sm-2">
<h6>Disponible:</h6>
    {{ ($moto->disponible==true)?'OUI':'NON' }}
</div>

<div class="col-sm-2">
<h6>Prochaine Vidange:</h6>
    {{ date("d-m-Y", strtotime($moto->prochaine_vidange)) }}
</div>

</div>
                </fieldset>