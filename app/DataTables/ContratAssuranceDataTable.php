<?php

namespace App\DataTables;

use App\Models\ContratAssurance;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ContratAssuranceDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public int $idMoto;
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'contrat_assurances.datatables_actions')
        ->addColumn('compagnie_assurance', function($row)
        {
           $compagnie_assurance = $row->compagnieAssurances['designation'];
           return $compagnie_assurance;
        })
        ->addColumn('moto', function($row)
        {
           $moto = $row->motos['immatriculation'];
           return $moto;
        })
        ->addColumn('date_debut', function($row)
        {
           $date_debut = date("d-m-Y", strtotime($row->date_debut));
           return $date_debut;
        })
        ->addColumn('date_fin', function($row)
        {
           $date_fin = date("d-m-Y", strtotime($row->date_fin));
           return $date_fin;
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ContratAssurance $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ContratAssurance $model)
    {
        return $model->newQuery()->where('moto',$this->idMoto)->orderby('id','desc');
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
            'numero_contrat',
            'compagnie_assurance',
            //'moto',
            'date_debut',
            'date_fin'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'contrat_assurances_datatable_' . time();
    }
}
