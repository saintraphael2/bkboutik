<?php

namespace App\DataTables;

use App\Models\ProduitBoutique;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ProduitBoutiqueDataTable extends DataTable
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
        ->editColumn('stock', function ($request) {
            return ($request->stock!=null && $request->stocks->date_stock!=null)?$request->stocks->date_stock->format('d-m-Y'):'';
        })
        ->editColumn('quantites', function ($request) {
            return ($request->stock!=null)?$request->stocks->quantite:'0';
        })
        ->editColumn('quantites_init', function ($request) {
            return ($request->stock!=null)?$request->stocks->qte_init:'0';
        })
        ->editColumn('prixs', function ($request) {
            return ($request->stock!=null)?$request->stocks->prix:'0';
        })
        ->addColumn('action', 'produit_boutiques.datatables_actions');
    }

    /**
     * Get query source of dataTable.  quantites
     *
     * @param \App\Models\ProduitBoutique $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ProduitBoutique $model)
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
            'code',
            'libelle',
            'quantites_init'=>['title'=>'Quantité initiale','name'=>'stock'],
            'quantites'=>['title'=>'Quantité','name'=>'stock'],
            'prixs'=>['title'=>'Prix','name'=>'stock'],
            'stock'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'produit_boutiques_datatable_' . time();
    }
}
