<!-- need to remove -->
<li class="nav-item" style="display:<?php echo e(visible ( 'home',$listeUrl )); ?>">
    <a href="<?php echo e(route('home')); ?>" class="nav-link <?php echo e(Request::is('home') ? 'active' : ''); ?>">
        <i class="nav-icon fas fa-gauge"></i>
        <p>Tableau de Bord</p>
    </a>
</li>

<li class="nav-item" style="display:<?php echo e(visible ( 'type_piece',$listeUrl )); ?>">
    <a href="<?php echo e(route('typepieces.index')); ?>" class="nav-link <?php echo e(Request::is('typepieces*') ? 'active' : ''); ?>">
        <i class="nav-icon fas fa-address-card"></i>
        <p>Type de pièces</p>
    </a>
</li>

<li class="nav-item" style="display:<?php echo e(visible ( 'versement',$listeUrl )); ?>">
    <a href="<?php echo e(route('versements.index')); ?>" class="nav-link <?php echo e(Request::is('versements*') ? 'active' : ''); ?>">
        <i class="nav-icon fas fa-file-invoice-dollar"></i>
        <p>Facturation</p>
    </a>
</li>

<!-- <li class="nav-item">
    <a href="<?php echo e(route('vidanges.index')); ?>" class="nav-link <?php echo e(Request::is('vidanges*') ? 'active' : ''); ?>">
        <i class="nav-icon fas fa-home"></i>
        <p>Vidanges</p>
    </a>
</li> -->

<!--li class="nav-item">
    <a href="<?php echo e(route('cautions.index')); ?>" class="nav-link <?php echo e(Request::is('cautions*') ? 'active' : ''); ?>">
        <i class="nav-icon fas fa-home"></i>
        <p>Cautions</p>
    </a>
</li-->

<li class="nav-item" style="display:<?php echo e(visible ( 'compagnieassurances',$listeUrl )); ?>">
    <a href="<?php echo e(route('compagnieassurances.index')); ?>" class="nav-link <?php echo e(Request::is('compagnieassurances*') ? 'active' : ''); ?>">
        <i class="nav-icon fas fa-building"></i>
        <p>Compagnie d'assurances</p>
    </a>
</li>

<li class="nav-item" style="display:<?php echo e(visible ( 'conducteurs',$listeUrl )); ?>">
    <a href="<?php echo e(route('conducteurs.index')); ?>" class="nav-link <?php echo e(Request::is('conducteurs*') ? 'active' : ''); ?>">
        <i class="nav-icon fas fa-person-biking"></i>
        <p>Conducteurs</p>
    </a>
</li>

<li class="nav-item" style="display:<?php echo e(visible ( 'contrat',$listeUrl )); ?>">
    <a href="<?php echo e(route('contrats.index')); ?>" class="nav-link <?php echo e(Request::is('contrats*') ? 'active' : ''); ?>">
        <i class="nav-icon fas fa-file-signature"></i>
        <p>Contrats</p>
    </a>
</li>

<!--li class="nav-item">
    <a href="<?php echo e(route('contratAssurances.index')); ?>" class="nav-link <?php echo e(Request::is('contratAssurances*') ? 'active' : ''); ?>">
        <i class="nav-icon fas fa-home"></i>
        <p>Contrat Assurances</p>
    </a>
</li-->

<li class="nav-item" style="display:<?php echo e(visible ( 'motos',$listeUrl )); ?>">
    <a href="<?php echo e(route('motos.index')); ?>" class="nav-link <?php echo e(Request::is('motos*') ? 'active' : ''); ?>">
        <i class="nav-icon fas fa-motorcycle"></i>
        <p>Motos</p>
    </a>
</li>

<li class="nav-item" style="display:<?php echo e(visible ( 'typeContrats',$listeUrl )); ?>">
    <a href="<?php echo e(route('typeContrats.index')); ?>" class="nav-link <?php echo e(Request::is('typeContrats*') ? 'active' : ''); ?>">
        <i class="nav-icon fas fa-copy"></i>
        <p>Type de contrats</p>
    </a>
</li>



<!-- <li class="nav-item">
    <a href="<?php echo e(route('tableau_armortissements.index')); ?>" class="nav-link <?php echo e(Request::is('tableau_armortissements*') ? 'active' : ''); ?>">
        <i class="nav-icon fas fa-home"></i>
        <p>Tableau Armortissements</p>
    </a>
</li> -->

<li class="nav-item" style="display:<?php echo e(visible ( 'users',$listeUrl )); ?>">
    <a href="<?php echo e(route('users.index')); ?>" class="nav-link <?php echo e(Request::is('users*') ? 'active' : ''); ?>">
        <i class="nav-icon fas fa-users"></i>
        <p>Utilisateurs</p>
    </a>
</li>

<li class="nav-item" style="display:<?php echo e(visible ( 'liens',$listeUrl )); ?>">
    <a href="<?php echo e(route('liens.index')); ?>" class="nav-link <?php echo e(Request::is('liens*') ? 'active' : ''); ?>">
        <i class="nav-icon fas fa-link"></i>
        <p>Liens</p>
    </a>
</li>

<!--li class="nav-item">
    <a href="<?php echo e(route('user_liens.index')); ?>" class="nav-link <?php echo e(Request::is('userLiens*') ? 'active' : ''); ?>">
        <i class="nav-icon fas fa-home"></i>
        <p>Utilisateurs</p>
    </a>
</li-->

<li class="nav-item" style="display:<?php echo e(visible ( 'etats',$listeUrl )); ?>">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p>
            Etats
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?php echo e(route('etats.arrieres')); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Arriérés</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('etats.encaissements')); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Encaissements</p>
            </a>
        </li>
    </ul>
</li><?php /**PATH D:\SIMON\LARAVEL\bkzed\bkzed\resources\views/layouts/menu.blade.php ENDPATH**/ ?>