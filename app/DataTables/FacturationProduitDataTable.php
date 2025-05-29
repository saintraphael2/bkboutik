<?php

namespace App\DataTables;

use App\Models\FacturationProduit;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class FacturationProduitDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
        ->editColumn('souscription', function ($request) {
            return $request->souscriptions->clients->conducteurs->nom." ".$request->souscriptions->clients->motos->immatriculation
            ."  ".$request->souscriptions->produits->typeProduit->libelle."  ". $request->souscriptions->produits->modele;;
        })
        ->editColumn('created_at', function ($request) {
            return $request->created_at->format('d-m-Y');
        })
        ->addColumn('action', 'facturation_produits.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\FacturationProduit $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(FacturationProduit $model)
    {
        return $model->newQuery()->with([
            'souscriptions','souscriptions.clients' 
        ]);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'language' => [
                    'url' => url('vendor/datatables/French.json')
                ],
                'buttons'   => [
                    // Enable Buttons as per your need
//                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
//                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'code',
            'souscription',
            'montant_a_payer'=>['title'=>'montant à payer'],
            'montant_paye'=>['title'=>'Montant payé'],
            'reste_paye'=>['title'=>'Reste à payer'],
            'created_at'=>['title'=>'Date Enregistrement']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'facturation_produits_datatable_' . time();
    }
}
