
<!-- Ttc Field -->
<div class="form-group col-sm-3">
    {!! Form::label('client', 'Client:') !!}
    {!! Form::text('client', null, ['class' => 'form-control', 'required']) !!}
</div>
<div class="form-group col-sm-3">
    {!! Form::label('ttc', 'Ttc:') !!}
    {!! Form::number('ttc', null, ['class' => 'form-control','id'=>'ttc', 'required','readonly']) !!}
</div>
<div class="form-group col-sm-3">
    {!! Form::label('montant_verse', 'Montant Versé:') !!}
    {!! Form::number('montant_verse', null, ['class' => 'form-control','id'=>"montant_verse", 'required']) !!}
</div>
<div class="form-group col-sm-3">
    {!! Form::label('relicat', 'Relicat:') !!}
    {!! Form::number('relicat', null, ['class' => 'form-control', 'required','id'=>"relicat",'readonly']) !!}
</div>

<fieldset class="row form-group col-sm-12">
<legend>Articles</legend>
<div class="form-group col-sm-3">
{!! Form::label('produit_boutique', 'Produit  :') !!}
    {!! Form::hidden('produit_boutique', null, ['class' => 'form-control', 'required','id'=>'produit_boutique']) !!}
    {!! Form::text('produitBoutique', null, [
            'class' => 'form-control',
            'id' => 'produitBoutique',
           
            'maxlength' => 255,
            'autocomplete' => 'off'
            
           
        ]) !!}
</div>
<div class="form-group col-sm-3">
    {!! Form::label('libelle', 'Désignation:') !!}
    {!! Form::text('libelle',  null, ['class' => 'form-control','id'=>'libelle','readonly']) !!}
</div>
<div class="form-group col-sm-2">
    {!! Form::label('prix', 'Prix Unitaire:') !!}
    {!! Form::number('prix',  null, ['class' => 'form-control','id'=>'prix','min'=>'1','readonly']) !!}
</div>
<div class="form-group col-sm-2">
    {!! Form::label('quantite', 'Quantité:') !!}
    {!! Form::number('quantite',  1, ['class' => 'form-control','id'=>'quantite','min'=>'1']) !!}
</div>
<div class="form-group col-sm-2">

                {!! Form::button('Ajouter', ['class' => 'btn btn-primary','id'=>"adProduit",'disabled']) !!}
                
            </div>

           
<div class="table-responsive">
    <table class="table" id="produits">
        <thead>
        <tr>
            <th>Code</th>
            <th>Désignation</th>
        <th>Quantité</th>
        <th>Prix Unitaire</th>
        
        <th>Total</th>
       
        <th>Action</th>
        </tr>
        </thead>
        <tbody>
        
        </tbody>
        <tfoot>
    <tr>
      <td colspan="2">Total</td>
      <td ></td>
      <td ></td>
      <td id="total"> </td>
      
      <td></td>
    </tr>
  </tfoot>
    </table>
</div>
</fieldset>


<script>
  /* $(document).ready(function(){
    zoneMgr();  $('#adProduit').prop('disabled', true);
    
});*/
$("#produitBoutique").keyup(function(){
    //alert($("#produitBoutique").val());
    let longueur=$("#produitBoutique").val().length;
       if(longueur==0){
        $('#produit_boutique').val('');
        $('#prix').val('0');
        $('#adProduit').prop('disabled', true);
    }
});
$("#produit_boutique").change(function(){
   
});
$("#adProduit").click(function(){
    if($("#prix").val()=="0"){
        alert("Veuillez paramétrer le prix du produit, le prix doit être supérieur à 0!");
    } 
    ajouteLigne();
});

function ajouteLigne() {///{assure}/{taux}
    //alert(new Date().getTime())
    var id=new Date().getTime();
    var stockValue=$("#produit_boutique").val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    
       
  // Récupération d'une référence à la table
    var refTable = document.getElementById("produits").getElementsByTagName('tbody')[0];
    

  // Insère une ligne dans la table à l'indice de ligne 0
    var nouvelleLigne = refTable.insertRow(0);
    nouvelleLigne.id=id;

  // Insère une cellule dans la ligne à l'indice 0
    var nouvelleCellule = nouvelleLigne.insertCell(0);
    
  // Ajoute un nœud texte à la cellule
    var nouveauTexte = document.createTextNode($("#produitBoutique").val())


    var nouveauInput = document.createElement('input')
    nouveauInput.type = "hidden";
    nouveauInput.name = "produits[]";
    nouveauInput.value = $("#produit_boutique").val();

    nouvelleCellule.appendChild(nouveauInput );
    nouvelleCellule.appendChild(nouveauTexte);

    var nouvelleCellule = nouvelleLigne.insertCell(1);
    var libelle = $("#libelle").val();
  // Ajoute un nœud texte à la cellule
    var nouveauTexte = document.createTextNode(libelle)

    var nouveauInput = document.createElement('input')
    nouveauInput.type = "hidden";
    nouveauInput.name = "libelles[]";
    nouveauInput.value = libelle;

    nouvelleCellule.appendChild(nouveauInput );
    nouvelleCellule.appendChild(nouveauTexte);

    var nouvelleCellule = nouvelleLigne.insertCell(2);

// Ajoute un nœud texte à la cellule
    var quantite=$("#quantite").val();
    var nouveauTexte = document.createTextNode(quantite)

    var nouveauInput = document.createElement('input')
    nouveauInput.type = "hidden";
    nouveauInput.name = "quantite[]";
    nouveauInput.value = quantite;

    nouvelleCellule.appendChild(nouveauInput );
    nouvelleCellule.appendChild(nouveauTexte);

  


    var nouvelleCellule = nouvelleLigne.insertCell(3);

// Ajoute un nœud texte à la cellule
    var prix=$("#prix").val();
    var nouveauTexte = document.createTextNode(prix)

    var nouveauInput = document.createElement('input')
    nouveauInput.type = "hidden";
    nouveauInput.name = "prix[]";
    nouveauInput.value = prix;

    nouvelleCellule.appendChild(nouveauInput );
    nouvelleCellule.appendChild(nouveauTexte);

    var nouvelleCellule = nouvelleLigne.insertCell(4);
    nouvelleCellule.id="mntdev"+id;

// Ajoute un nœud texte à la cellule
    var apayer=Math.ceil(quantite*prix);
    var nouveauTexte = document.createTextNode(apayer)
    
    nouvelleCellule.appendChild(nouveauTexte);

    var nouvelleCellule = nouvelleLigne.insertCell(5);

// Ajoute un nœud texte à la cellule
  

    var nouveauInput = document.createElement('input')
    nouveauInput.type = "button";
   
    nouveauInput.value = 'Supprimer';
    nouveauInput.onclick = function () {
       //alert(nouvelleLigne.id)
       var row = document.getElementById(nouvelleLigne.id);
        row.parentNode.removeChild(row);
        var total=0;
        refTable = document.getElementById("produits").getElementsByTagName('tbody')[0];

        for(i=0;i<refTable.rows.length;i++){           
            total=total+parseInt($("#mntdev"+refTable.rows[i].id).text());
        }
        //alert(total)

        $("#total").text(total.toLocaleString());
        $("#ttc").val(total);
        let longueur=$("#montant_verse").val().length;
        if(longueur>0){
            let ttc = parseInt($("#ttc").val()) || 0;
            let montant_verse = parseInt($("#montant_verse").val()) || 0;
            let restePaye = montant_verse - ttc;
        
            $("#relicat").val(restePaye); 
        }
    };

    nouvelleCellule.appendChild(nouveauInput );
    //nouvelleCellule.appendChild(nouveauTexte);
    
    var total=0;
   var  refTable = document.getElementById("produits").getElementsByTagName('tbody')[0];
        for(i=0;i<refTable.rows.length;i++){
           // console.log(i+"  "+$("#mnt"+refTable.rows[i].id).text());
            total=total+parseInt($("#mntdev"+refTable.rows[i].id).text());
        }
        $("#total").text(total.toLocaleString());
        $("#ttc").val(total);
        let longueur=$("#montant_verse").val().length;
        if(longueur>0){
            let ttc = parseInt($("#ttc").val()) || 0;
            let montant_verse = parseInt($("#montant_verse").val()) || 0;
            let restePaye = montant_verse - ttc;
        
            $("#relicat").val(restePaye); 
        }

        //reset form

        $('#produit_boutique').val('');
        $('#produitBoutique').val('');
        $('#libelle').val('');
        $('#prix').val('0');
        $('#quantite').val('1');
        $('#adProduit').prop('disabled', true);
}

function suppression(id){
    
       //alert(nouvelleLigne.id)
       var row = document.getElementById(id);
        row.parentNode.removeChild(row);
        var total=0;
        var refTable = document.getElementById("produits").getElementsByTagName('tbody')[0];
    
        for(i=0;i<refTable.rows.length;i++){    
            console.log(i+"  "+parseInt($("#mnt"+refTable.rows[i].id).text()));       
            total=total+parseInt($("#mnt"+refTable.rows[i].id).text());
        }

        $("#total").text(total.toLocaleString());
      //  $("#montant_assurance").val(total);
       // $("#montant_a_payer").val(total);
    
}

</script>