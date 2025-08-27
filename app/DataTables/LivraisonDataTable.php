<?php

namespace App\DataTables;

use App\Models\Livraison;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class LivraisonDataTable extends DataTable
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
        ->editColumn('boutique', function ($request) {
            return $request->boutiques->code;
        })
        ->editColumn('date_facture', function ($request) {
            return $request->boutiques->created_at->format('d-m-Y');
        })
        ->editColumn('created_at', function ($request) {
            return $request->created_at->format('d-m-Y');
        })
        ->editColumn('magasinier', function ($request) {
            return $request->magasiniers->name;
        })
        ->addColumn('action', 'livraisons.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Livraison $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Livraison $model)
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
            'created_at'=>['title'=>'DATE LIVRAISON'],
            'boutique'=>['title'=>'FACTURE'],
            'date_facture'=>['title'=>'DATE ACHAT', 'name'=>'boutique'],
           
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
        return 'livraisons_datatable_' . time();
    }
}
