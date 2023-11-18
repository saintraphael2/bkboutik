<?php

namespace App\DataTables;

use App\Models\Versement;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class VersementDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public int $idContrat;
	public $comptable;
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
       
        return $dataTable->addColumn('action', 'versements.datatables_actions')
        ->editColumn('contrat', function ($request) {
            return $request->contrats->numero;
        })
        
        ->editColumn('montant', function ($request) {
            return number_format($request->montant, 0," ", " ");
        })
        ->editColumn('arriere', function ($request) {
            return ($request->arriere > 0) ? number_format($request->arriere, 0," ", " ") : "-";
        })
        ->editColumn('reste_payer', function ($request) {
            return number_format($request->reste_payer, 0," ", " ");
        })
        ->editColumn('date', function ($request) {
            return $request->date->format('d-m-Y');
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Versement $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Versement $model)
    {
		$query = $model->newQuery()->where('contrat',$this->idContrat)->with([
            'contrats'
        ]);
        /*if($this->comptable==null){
                $query=$query->offset(0)->limit(10);
            }*/
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
            'numero_recu'=> ['title' => 'Numéro reçu','name'=>'numero_recu'],
            'contrat',
            'date',
            'montant',
            'arriere'=> ['title' => 'Arriérés','name'=>'arriere'],
            'reste_payer'=> ['title' => 'Reste à payer','name'=>'reste_payer']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'versements_datatable_' . time();
    }
}
