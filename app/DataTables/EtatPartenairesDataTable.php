<?php

namespace App\DataTables;

use App\Models\Partenaires;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class EtatPartenairesDataTable extends DataTable
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
        return  $dataTable->addColumn('action', 'etats.partenaires_datatables_actions');
        //return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Partenaires $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Partenaires $model)
    {
        return $model->newQuery()->select('partenaires.id','nom',
        'prenom',
        'telephone')
        ->selectRaw('( SELECT count(*) FROM moto WHERE partenaire=partenaires.id ) as total_moto ')
        ->selectRaw('( SELECT count(*) FROM moto WHERE partenaire=partenaires.id and disponible=1) as total_disponible ')
        //->selectRaw('( SELECT count(distinct c.id) FROM contrat c inner join moto m on c.moto=m.id WHERE m.partenaire=partenaires.id and c.actif=1) as total_contrat ');
        ->selectRaw('( SELECT count(distinct m.id) FROM moto m  inner join contrat c on c.moto=m.id WHERE m.partenaire=partenaires.id and actif=1 ) as total_contrat ');
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
            'nom',
            'prenom',
            'telephone',
            'total_moto',
            'total_disponible',
            'total_contrat'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'partenaires_datatable_' . time();
    }
}
