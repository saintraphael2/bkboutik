<?php

namespace App\DataTables;

use App\Models\Vidange;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class VidangeDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public int $idMoto;
    /*public function __construct($idMoto){
        
            $this->idMoto=$idMoto;
        
        
    }*/
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'vidanges.datatables_actions')
        ->addColumn('date', function($row)
        {
           $date = date("d-m-Y", strtotime($row->date));
           return $date;
        })
        ->addColumn('prochaine', function($row)
        {
           $prochaine = date("d-m-Y", strtotime($row->prochaine));
           return $prochaine;
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Vidange $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Vidange $model)
    {
        return $model->newQuery()->where('moto',$this->idMoto)->orderby('id','desc')->with([
            'motos'
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
                 //  ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
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
            
            'date'=> ['title' => 'Effectuée le ','name'=>'date'],
            'kilometrage'=> ['title' => 'Kilométrage','name'=>'kilometrage'],
            'prochaine'=> ['title' => 'Prochaine vidange estimée le ','name'=>'prochaine']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'vidanges_datatable_' . time();
    }
}
