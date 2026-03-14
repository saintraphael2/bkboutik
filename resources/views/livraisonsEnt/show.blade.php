@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                   DETAIL DE LA LIVRAISON
                    </h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('livraisons.index') }}">
                                                    Etat livraison
                                            </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('livraisons.show_fields')
                </div>
            </div>
        </div>
    </div>
    <div class="content px-3">
    <div class="card">
   
            <div class="card-body">
                <h2>Les articles facturés</h2>
                <div class="row">
                    <table class="table table-striped table-bordered dataTable no-footer" style="border-collapse: collapse; width: 100%;">
                        <tr>
                            <th class="form-group col-sm-1" style="border: 1px solid black;">#</td>
                            <th class="form-group col-sm-3" style="border: 1px solid black;">Code Produit</td>
                            <th class="form-group col-sm-3" style="border: 1px solid black;">Produit</td>
                            <th class="form-group col-sm-3" style="border: 1px solid black;">Quantité Payée</td>
                            <th class="form-group col-sm-3" style="border: 1px solid black;">Livré?</td>
                        </tr>
                   
                    <?php $compteur=1; ?>
                    @foreach($detailBoutiques as $detailBoutique)
                        <tr>
                            <td style="border: 1px solid black;"> {{$compteur++;}} </td>
                            <td style="border: 1px solid black;">{{ $detailBoutique->produitBoutique->code}}</td>
                            <td style="border: 1px solid black;">{{$detailBoutique->produitBoutique->libelle}}</td>
                            <td style="border: 1px solid black; text-align:right" >{{$detailBoutique->quantite}}</td>
                            <td style="border: 1px solid black;"> 
                            <input type="hidden" name="detailBoutique[]"  class="form-control">
                                <input type="checkbox" name="livraison[]" value="{{$detailBoutique->id}}" class="form-control"></td>
                        </tr>
                        <br>
                    @endforeach
                    </table>
                </div>
            </div>
           

            {!! Form::close() !!}    
        </div>
    </div>
@endsection
