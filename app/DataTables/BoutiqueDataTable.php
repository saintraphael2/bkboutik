<?php

namespace App\DataTables;

use App\Models\Boutique;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BoutiqueDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public $comptable;

    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
        ->editColumn('caissier', function ($request) {
            return $request->caissiers->name;
        })
        ->editColumn('created_at', function ($request) {
            return $request->created_at->format('d-m-Y');
        })
        ->addColumn('action', 'boutiques.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Boutique $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Boutique $model)
    {
        $query=$model->newQuery();

        if($this->comptable==null){
            $query->whereDate('created_at',Carbon::today());
        }
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
            'code',
            'client',
            'ttc',
            
            
            'montant_verse',
            'relicat',
            'caissier',
            'created_at'=>['title'=>'Date Opération'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'boutiques_datatable_' . time();
    }
}
