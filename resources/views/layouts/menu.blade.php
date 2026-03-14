<!-- need to remove -->
<li class="nav-item" style="display:{{ visible ( 'home',$listeUrl ) }}">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-gauge"></i>
        <p>Tableau de Bord</p>
    </a>
</li>

<li class="nav-item" style="display:{{ visible ( 'produitBoutiques',$listeUrl ) }}">
    <a href="{{ route('produitBoutiques.index') }}" class="nav-link {{ Request::is('produitBoutiques*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Produit Boutiques</p>
    </a>
</li>

<li class="nav-item" style="display:{{ visible ( 'listeProduit',$listeUrl ) }}">
    <a href="{{ route('listeProduit') }}" class="nav-link {{ Request::is('listeProduit*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Liste des Produits</p>
    </a>
</li>

<li class="nav-item" style="display:{{ visible ( 'boutiques',$listeUrl ) }}">
    <a href="{{ route('boutiques.index') }}" class="nav-link {{ Request::is('boutiques*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Caisse</p>
    </a>
</li>

<li class="nav-item" style="display:{{ visible ( 'stocks',$listeUrl ) }}">
    <a href="{{ route('stocks.index') }}" class="nav-link {{ Request::is('stocks*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Stocks</p>
    </a>
</li>





<li class="nav-item" style="display:{{ visible ( 'magasin',$listeUrl ) }}">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p>
            Magasin
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item" style="display:{{ visible ( 'sortieMagasin',$listeUrl ) }}">
        <a href="{{ route('sortieMagasin.index') }}" class="nav-link {{ Request::is('sortieMagasin*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>Sortie d'articles</p>
        </a>
        </li>
        <li class="nav-item" style="display:{{ visible ( 'sortieMagasinEnt',$listeUrl ) }}">
        <a href="{{ route('sortieMagasinEnt.index') }}" class="nav-link {{ Request::is('sortieMagasinEnt*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>Sortie d'articles Ent.</p>
        </a>
        </li>
        <li class="nav-item" style="display:{{ visible ( 'livraisons',$listeUrl ) }}">
            <a href="{{ route('livraisons.index') }}" class="nav-link {{ Request::is('livraison*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-home"></i>
                <p>Etat des livraisons</p>
            </a>
        </li>
        <li class="nav-item" style="display:{{ visible ( 'livraisonsEnt',$listeUrl ) }}">
            <a href="{{ route('livraisonsEnt.index') }}" class="nav-link {{ Request::is('livraisonEnt*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-home"></i>
                <p>Etat des livraisons Ent.</p>
            </a>
        </li>
    </ul>
</li>

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
<li class="nav-item" >
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p>
            Etats
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item" style="display:{{ visible ( 'etatBoutique',$listeUrl ) }}">
        <a href="{{ route('etatBoutique.index') }}" class="nav-link {{ Request::is('etatBoutique*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>Caisse</p>
        </a>
        </li>
        
        <li class="nav-item" style="display:{{ visible ( 'etatBDepots',$listeUrl ) }}">
        <a href="{{ route('etatDepots.index') }}" class="nav-link {{ Request::is('etatBDepots*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>Dépôts</p>
        </a>
        </li>
    </ul>
</li>

<li class="nav-item" style="display:{{ visible ( 'clients',$listeUrl ) }}">
    <a href="{{ route('clients.index') }}" class="nav-link {{ Request::is('clients*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Clients</p>
    </a>
</li>

<li class="nav-item" style="display:{{ visible ( 'vente',$listeUrl ) }}">
    <a href="{{ route('ventes.index') }}" class="nav-link {{ Request::is('ventes*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Ventes</p>
    </a>
</li>


<li class="nav-item" style="display:{{ visible ( 'depot',$listeUrl ) }}">
    <a href="{{ route('depots.index') }}" class="nav-link {{ Request::is('depots*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Depots</p>
    </a>
</li>
