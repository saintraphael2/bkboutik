<?php

namespace App\DataTables;

use App\Models\Tableau_armortissement;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class Tableau_armortissementDataTable extends DataTable
{
    public int $idContrat;
    public bool $payment = false;

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        if($this->payment){
            //return $dataTable->addColumn('action', 'tableau_armortissements.datatables_actions');
            $dataTable->addColumn('action', 'tableau_armortissements.datatables_actions');
        }
    
        return $dataTable
        ->editColumn('datprev', function ($request) {
            return $request->datprev->format('d-m-Y');
        })
        ->editColumn('montant', function ($request) {
            return number_format($request->montant, 0," ", " ");
        })
        ->editColumn('cummul', function ($request) {
            return number_format($request->cummul, 0," ", " ");
        })
        ->editColumn('solde', function ($request) {
            return number_format($request->solde, 0," ", " ");
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Tableau_armortissement $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Tableau_armortissement $model)
    {
        $parameters['contrat'] = $this->idContrat;
        if($this->payment){
            $parameters['etat'] = "NON PAYE";
        }

        return $model->newQuery()->where($parameters);
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
            ->addColumnDef(["className"=>"text-right", "targets"=> [1,2,3] ]) // addColumnDef
            /*->addRowDef(function ($item) {
                return 'alert-warning';
                //return $item->id % 2 == 0 ? 'alert-success' : 'alert-warning';
            })
            ->setRowAttr([
                'color' => function($item) {
                    return $item->color;
                },
            ])
            ->setRowAttr([
                'style' => function($item){
                    return 'background-color: #ff0000;';
                    //return $item->disabled ? 'background-color: #ff0000;' : 'background-color: #00ff00;';
                }
            ])*/
            ->minifiedAjax()
            //->addAction(['width' => '120px', 'printable' => false])
            ->addAction([
                    'width' => '120px', 
                    'printable' => false
                ])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'asc']],
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
            'datprev'=> ['title' => 'Date prévisionnelle','name'=>'datprev'],
            'montant',
            'cummul',
            'solde',
            //'contrat',
            'etat'
           // 'datreglement',
           // 'versement'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'tableau_armortissements_datatable_' . time();
    }
}
