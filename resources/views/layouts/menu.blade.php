<!-- need to remove -->
<li class="nav-item" style="display:{{ visible ( 'home',$listeUrl ) }}">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-gauge"></i>
        <p>Tableau de Bord</p>
    </a>
</li>

<li class="nav-item" style="display:{{ visible ( 'typepieces',$listeUrl ) }}">
    <a href="{{ route('typepieces.index') }}" class="nav-link {{ Request::is('typepieces*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-address-card"></i>
        <p>Type de pièces</p>
    </a>
</li>

<li class="nav-item" style="display:{{ visible ( 'versement',$listeUrl ) }}">
    <a href="{{ route('versements.index') }}" class="nav-link {{ Request::is('versements*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-file-invoice-dollar"></i>
        <p>Facturation</p>
    </a>
</li>

<!-- <li class="nav-item">
    <a href="{{ route('vidanges.index') }}" class="nav-link {{ Request::is('vidanges*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Vidanges</p>
    </a>
</li> -->

<!--li class="nav-item">
    <a href="{{ route('cautions.index') }}" class="nav-link {{ Request::is('cautions*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Cautions</p>
    </a>
</li-->

<li class="nav-item" style="display:{{ visible ( 'compagnieassurances',$listeUrl ) }}">
    <a href="{{ route('compagnieassurances.index') }}" class="nav-link {{ Request::is('compagnieassurances*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-building"></i>
        <p>Compagnie d'assurances</p>
    </a>
</li>

<li class="nav-item" style="display:{{ visible ( 'conducteurs',$listeUrl ) }}">
    <a href="{{ route('conducteurs.index') }}" class="nav-link {{ Request::is('conducteurs*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-person-biking"></i>
        <p>Conducteurs</p>
    </a>
</li>

<li class="nav-item" style="display:{{ visible ( 'contrat',$listeUrl ) }}">
    <a href="{{ route('contrats.index') }}" class="nav-link {{ Request::is('contrats*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-file-signature"></i>
        <p>Contrats</p>
    </a>
</li>

<!--li class="nav-item">
    <a href="{{ route('contratAssurances.index') }}" class="nav-link {{ Request::is('contratAssurances*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Contrat Assurances</p>
    </a>
</li-->

<li class="nav-item" style="display:{{ visible ( 'motos',$listeUrl ) }}">
    <a href="{{ route('motos.index') }}" class="nav-link {{ Request::is('motos*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-motorcycle"></i>
        <p>Motos</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('partenaires.index') }}" class="nav-link {{ Request::is('partenaires*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Partenaires</p>
    </a>
</li>
<li class="nav-item" style="display:{{ visible ( 'typeContrats',$listeUrl ) }}">
    <a href="{{ route('typeContrats.index') }}" class="nav-link {{ Request::is('typeContrats*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-copy"></i>
        <p>Type de contrats</p>
    </a>
</li>

<li class="nav-item" style="display:{{ visible ( 'motif_arrieres',$listeUrl ) }}">
    <a href="{{ route('motif_arrieres.index') }}" class="nav-link {{ Request::is('motif_arrieres*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Motif Arrieres</p>
    </a>
</li>


<!-- <li class="nav-item">
    <a href="{{ route('tableau_armortissements.index') }}" class="nav-link {{ Request::is('tableau_armortissements*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Tableau Armortissements</p>
    </a>
</li> -->

<li class="nav-item" style="display:{{ visible ( 'users',$listeUrl ) }}">
    <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Utilisateurs</p>
    </a>
</li>

<li class="nav-item" style="display:{{ visible ( 'liens',$listeUrl ) }}">
    <a href="{{ route('liens.index') }}" class="nav-link {{ Request::is('liens*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-link"></i>
        <p>Liens</p>
    </a>
</li>

<!--li class="nav-item">
    <a href="{{ route('user_liens.index') }}" class="nav-link {{ Request::is('userLiens*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Utilisateurs</p>
    </a>
</li-->

<li class="nav-item" style="display:{{ visible ( 'etats',$listeUrl ) }}">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p>
            Etats
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('etats.arrieres') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Arriérés</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('etats.encaissements') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Encaissements</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('etats.reglements') }}" style="display:{{ visible ( 'etat_reglement',$listeUrl ) }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Règlements</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('etats.partenaires') }}" style="display:{{ visible ( 'etat_partenaire',$listeUrl ) }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Partenaires</p>
            </a>
        </li>
    </ul>
</li>


