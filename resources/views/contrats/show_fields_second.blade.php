<fieldset style="border:navy solid 1px; padding:10px; width:100%">
    <legend style="color:navy;width:120px ">Info Contrat</legend>
                
    <div class="row">


        <!-- Numero Field -->
        <div class="col-sm-2">
            {!! Form::label('numero', 'Numero:') !!}
            <p>{{ $contrat->numero }}</p>
        </div>

        <!-- Typecontrat Field -->
        <div class="col-sm-2">
            {!! Form::label('typecontrat', 'Type contrat:') !!}
            <p>{{ $contrat->typecontrats['libelle'] }}</p>
        </div>

        <!-- Moto Field -->
        <div class="col-sm-2">
            {!! Form::label('moto', 'Moto:') !!}
            <p>{{ $contrat->motos['immatriculation'] }}</p>
        </div>

        <!-- Conducteur Field -->
        <div class="col-sm-2">
            {!! Form::label('conducteur', 'Conducteur:') !!}
            <p>{{ $contrat->conducteurs['nom']}}    {{$contrat->conducteurs['prenom'] }}</p>
        </div>

        <!-- Conducteur Field -->
        <div class="col-sm-4">
            {!! Form::label('offre', 'Offre:') !!}
            <p> {{ ($contrat->offre) ? $contrat->offres->nom : "---" }} </p>
        </div>


        <!-- Bdeposit Field -->
        <!-- <div class="col-sm-2">
            {!! Form::label('bdeposit', 'Bdeposit:') !!}
            <p>{{ $contrat->bdeposit }}</p>
        </div> -->

        <!-- Deposit Field -->
        <div class="col-sm-2">
            {!! Form::label('deposit', 'Frais de dossier:') !!}
            <p>{{ ($contrat->deposit) ? number_format($contrat->deposit, 0," ", " ") : "---" }}</p>
        </div>

        <!-- Montant Total Field -->
        <div class="col-sm-2">
            {!! Form::label('montant_total', 'Montant Total:') !!}
            <p>{{ number_format($contrat->montant_total, 0," ", " ") }}</p>
        </div>
            <!-- Montant Total Field -->
        <div class="col-sm-2">
            {!! Form::label('solde', 'Reste à Payer:') !!}
            <p>{{ number_format($contrat->solde, 0," ", " ") }}</p>
        </div>

        <!-- Montant Total Field 
        <div class="col-sm-2">
            {!! Form::label('journalier', 'Mode de Paiement:') !!}
            <p>{{ ($contrat->journalier)?"JOURNALIER":"HEBDOMADAIRE" }}</p>
        </div> -->
        <div class="col-sm-6">
            {!! Form::label('frequence_paiement', 'Fréquence de Paiement:') !!}
            <p>{{ ($contrat->frequence_paiement == 1 ) ? "Journalier" : (($contrat->frequence_paiement == 2 ) ? "Hebdomadaire" : (($contrat->frequence_paiement == 3 ) ? "Semestrielle" : "---")) }}</p>
        </div>
        <!-- Date Signature Field -->
        <div class="col-sm-2">
            {!! Form::label('date_signature', 'Date Signature:') !!}
            <p>{{ $contrat->date_signature->format('d-m-Y') }}</p>
        </div>

        <!-- Date Debut Field -->
        <div class="col-sm-2">
            {!! Form::label('date_debut', 'Date Debut:') !!}
            <p>{{ $contrat->date_debut->format('d-m-Y') }}</p>
        </div>

        <!-- Date Fin Field -->
        <div class="col-sm-2">
            {!! Form::label('date_fin', 'Date Fin:') !!}
            <p>{{ $contrat->date_fin->format('d-m-Y') }}</p>
        </div>

        <!-- Datprm Field -->
        <div class="col-sm-2">
            {!! Form::label('datprm', 'Date Premier Paiement:') !!}
            <p>{{ ($contrat->datprm) ? $contrat->datprm->format('d-m-Y') : "---" }}</p>
        </div>


    </div>
</fieldset>