<?php

namespace App\DataTables;

use App\Models\Versement;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use DB;

class EtatReglementDataTable extends DataTable
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
       
        return $dataTable->editColumn('contrat', function ($request) {
            return $request->contrats->numero;
        })->editColumn('moto', function ($request) {
            return $request->contrats->motos['immatriculation'];
        })->filterColumn('moto', function($query, $keyword) {
            $sql = "contrat in (select id from contrat where moto in (select id from moto where immatriculation  like ?))";
            if($this->comptable==null){
                $query=$query->whereRaw($sql, ["%{$keyword}%"])->where('date','>=',Carbon::now()->addDays(-15));
            }
            $query=$query->whereRaw($sql, ["%{$keyword}%"]);
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
		$query = $model->select('versement.contrat', DB::raw('SUM(versement.montant) as montant'))->newQuery()->with([
            'contrats'
        ])->groupby(['contrat']);
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
            
            'contrat',
            'moto',
            'montant'=> ['title' => 'Montant Payé','name'=>'montant'],
           
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
