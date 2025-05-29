<?php

namespace App\DataTables;

use App\Models\Souscription;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class SouscriptionDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.produits
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable 
        ->editColumn('produit', function ($request) {
            return $request->produits->typeProduit->libelle."  ". $request->produits->modele;
        })
        ->editColumn('date_souscription', function ($request) {
            return $request->date_souscription->format('d-m-Y');
        })
        ->editColumn('client', function ($request) {
            return $request->clients->conducteurs->nom." ".$request->clients->motos->immatriculation;
        })
        ->addColumn('action', 'souscriptions.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Souscription $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Souscription $model)
    {
        return $model->newQuery();
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
            'produit',
            'date_souscription'=>['title'=>'Prochain Payement'],
            'client',
            'identification',
            'autre_info',
            'montant_initial',
            'solde',
            //'souscripteur'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'souscriptions_datatable_' . time();
    }
}
