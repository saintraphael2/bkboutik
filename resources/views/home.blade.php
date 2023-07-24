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
                        <h3>{{ $nbConducteurs ?? "---" }}</h3>
                        <p>Conducteurs</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <a href="{{ route('conducteurs.index') }}" class="small-box-footer">
                        Voir plus <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-gradient-success">
                    <div class="inner">
                        <h3>{{ $nbMotos ?? "---" }}</h3>
                        <p>Motos</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-motorcycle"></i>
                    </div>
                    <a href="{{ route('motos.index') }}" class="small-box-footer">
                        Voir plus <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-gradient-warning">
                    <div class="inner">
                        <h3>{{ $nbContrats ?? "---" }}</h3>
                        <p>Contrats</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file-signature"></i>
                    </div>
                    <a href="{{ route('contrats.index') }}" class="small-box-footer">
                        Voir plus <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-gradient-danger">
                    <div class="inner">
                        <h3>{{ $nbArrieres ?? "---" }}</h3>
                        <p>Nombre d'arriérés</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-list-check"></i>
                    </div>
                    <a href="{{ route('etats.arrieres') }}" class="small-box-footer">
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
                        <h5>Liste des 5 derniers contrats signés :</h5>
                    </div>
                    <div class="card-body px-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Contrat</th>
                                    <th>Moto</th>
                                    <th>Montant</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody  style="font-size:small">
                                @if($contrats)
                                    @foreach($contrats as $key => $contrat)
                                        <tr>
                                            <td>{{ $key+1 }}.</td>
                                            <td>{{ $contrat->numero }}</td>
                                            <td>
                                                {{ $contrat->motos->immatriculation }}
                                            </td>
                                            <td class="text-right">
                                                {{ number_format($contrat->montant_total, 0," ", " ") }}
                                            </td>
                                            <td>{{ $contrat->created_at->format('d-m-Y H:i') }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
            <div class="card">
                    <div class="card-header">
                        <h5>Liste des 5 derniers arriérés :</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Conducteur</th>
                                    <th>Moto</th>
                                    <th>Mode</th>
                                    <th>Arriérés</th>
                                    <th>Retards</th>
                                </tr>
                            </thead>
                            <tbody style="font-size:small">
                                @if($arrieres)
                                    @foreach($arrieres as $key => $arriere)
                                        <tr>
                                            <td>{{ $key+1 }}.</td>
                                            <td>
                                                {{ $arriere->conducteurs->nom }} {{ $arriere->conducteurs->prenom }}
                                            </td>
                                            <td>
                                                {{ $arriere->motos->immatriculation }}
                                            </td>
                                            <td>
                                                {{ ($arriere->journalier) ? "JOURNALIER" : "HEBDOMADAIRE" }}
                                            </td>
                                            <td class="text-right">
                                                {{ number_format($arriere->arrieres, 0," ", " ") }}
                                            </td>
                                            <td class="text-right">{{ $arriere->retard }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
