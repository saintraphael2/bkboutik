@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                    Facture à apurer
                    </h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('sortieMagasin.index') }}">
                                                   Sortie Magasin
                                            </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('sortie_magasin.show_fields')
                </div>
            </div>
        </div>
    </div>
    <div class="content px-3">
    <div class="card">
    {!! Form::open(['route' => 'livraisons.store']) !!}
    <input type="hidden" name="boutique" value="{{$boutique->id}}">
            <div class="card-body">
                <h2>Les articles à sortir</h2>
                <div class="row">
                    <table class="table table-striped table-bordered dataTable no-footer" style="border-collapse: collapse; width: 100%;">
                        <tr>
                            <th class="form-group col-sm-1" style="border: 1px solid black;">#</td>
                            <th class="form-group col-sm-3" style="border: 1px solid black;">Code Produit</td>
                            <th class="form-group col-sm-3" style="border: 1px solid black;">Produit</td>
                            <th class="form-group col-sm-3" style="border: 1px solid black;">Quantité Payée</td>
                            
                        </tr>
                   
                    <?php $compteur=1; ?>
                    @foreach($detailsBoutique as $detailBoutique)
                        <tr>
                            <td style="border: 1px solid black;"> {{$compteur++;}} </td>
                            <td style="border: 1px solid black;">{{ $detailBoutique->produitBoutique->code}}</td>
                            <td style="border: 1px solid black;">{{$detailBoutique->produitBoutique->libelle}}</td>
                            <td style="border: 1px solid black; text-align:right" >{{$detailBoutique->quantite}}</td>
                           
                          </tr>
                        <br>
                    @endforeach
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary',
                    'onclick' => 'return confirm("Merci de confimer les chiffres avant de valider!")'
                    ]) !!}
                <a href="{{ route('sortieMagasin.index') }}" class="btn btn-default"> Annuler </a>
            </div>

            {!! Form::close() !!}    
        </div>
    </div>
@endsection
