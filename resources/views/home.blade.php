@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tableau de board</h1>
                </div>
                <div class="col-sm-6"></div>
            </div>
        </div>
    </section>

    <br><br>
    <div class="content px-3">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-gradient-info">
                    <div class="inner">
                        
                        @if ( Auth::user()->comptable==1  )
                        <h3> "---" </h3>
                    @else
                    <h3>--</h3>
                    @endif
                        <p>Produits</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    @if ( Auth::user()->comptable==1  )
                        <a href="#" class="small-box-footer">
                            Voir plus <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    @else
                    <a href="#" class="small-box-footer">
                            Voir plus <i class="fas fa-arrow-circle-right"></i>
                        </a>
                        @endif
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-gradient-success">
                    <div class="inner">
                    @if ( Auth::user()->comptable==1  )
                        <h3> "---" </h3>
                    @else
                    <h3>--</h3>
                    @endif
                        <p>Stock</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-motorcycle"></i>
                    </div>
                    @if ( Auth::user()->comptable==1  )
                        <a href="#" class="small-box-footer">
                            Voir plus <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    @else
                    <a href="#" class="small-box-footer">
                            Voir plus <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    @endif
                    
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-gradient-warning">
                    <div class="inner">
                   
                    @if ( Auth::user()->comptable==1  )
                    <h3> "---" </h3>
                    @else
                    <h3>--</h3>
                    @endif
                        
                        
                        <p>Caisse</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file-signature"></i>
                    </div>
                    @if ( Auth::user()->comptable==1  )
                    <a href="#" class="small-box-footer">
                        Voir plus <i class="fas fa-arrow-circle-right"></i>
                    </a>
                    @else
                    <a href="#" class="small-box-footer">
                            Voir plus <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    @endif
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-gradient-danger">
                    <div class="inner">
                    <h3> "---" </h3>
                        <p>Livraison</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-list-check"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Voir plus <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Produits à faible quantité :</h5>
                    </div>
                    <div class="card-body px-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Code</th>
                                    <th>libelle</th>
                                    <th>quantites</th>  
                                </tr>
                            </thead>
                            <tbody  style="font-size:small">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
            <div class="card">
                    <div class="card-header">
                        <h5>Top des produits vendus :</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Code</th>
                                    <th>libelle</th>
                                    <th>quantites</th>  
                                </tr>
                            </thead>
                            <tbody style="font-size:small">
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
