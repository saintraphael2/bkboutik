<?php

namespace App\DataTables;

use App\Models\Stock;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class StockDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.produitBoutique
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
        ->editColumn('produit_boutique', function ($request) {
            return $request->produitBoutique->code." - ".$request->produitBoutique->libelle;
        })
        ->editColumn('date_stock', function ($request) {
            return ($request->date_stock!=null)?$request->date_stock->format('d-m-Y'):'-';
        })
        ->filterColumn('produit_boutique', function($query, $keyword) {
            $sql = "produit_boutique in (select id from produit_boutique where libelle   like ?)
           
            ";
           
            $query=$query->whereRaw($sql, ["%{$keyword}%"]);
        })
        ->addColumn('action', 'stocks.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Stock $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Stock $model)
    {
        $query= $model->newQuery()->select('stock.*','produit_boutique.stock')
        ->join('produit_boutique','produit_boutique.id','=','stock.produit_boutique');
        return $query;
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
            'produit_boutique',
            'date_stock',
            'quantite',
            'prix',
            'magasinier'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'stocks_datatable_' . time();
    }
}
