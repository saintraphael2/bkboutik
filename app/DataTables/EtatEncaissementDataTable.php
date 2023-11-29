<?php

namespace App\DataTables;

use App\Models\Versement;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class EtatEncaissementDataTable extends DataTable
{

    public int $idContrat;

    public $caissier;
    public $fromDate;
    public $toDate;
	public $comptable;


    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
		
        
        //return $dataTable->addColumn('action', 'versements.datatables_actions')
        return $dataTable->editColumn('contrat', function ($request) {
            return $request->contrats->numero;
        })
        
        ->editColumn('caissier', function ($request) {
            return ($request->myCaissier) ? $request->myCaissier->name : "---";
        })
		 ->editColumn('moto', function ($request) {
            return $request->contrats->motos['immatriculation'];
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
        ->editColumn('created_at', function ($request) {
            return $request->created_at->format('d-m-Y H:i:s');
        })->filterColumn('moto', function($query, $keyword) {
            $sql = "contrat in (select id from contrat where moto in (select id from moto where immatriculation  like ?))";
            if($this->comptable==null){
                $query=$query->whereRaw($sql, ["%{$keyword}%"])->where('date','>=',Carbon::now()->addDays(-15));
            }
            $query=$query->whereRaw($sql, ["%{$keyword}%"]);
        })
        ->withQuery('total', function($filteredQuery) {
            return $filteredQuery->sum('montant');
        })
        ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Versement $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Versement $model)
    {
        
        /*return $model->newQuery()->where('contrat',$this->idContrat)->with([
            'contrats'
        ]);*/
        $query = $model->newQuery()->with([
            'contrats'
        ]);

        if($this->caissier){
            $query->where('caissier', $this->caissier);
        }
       

        if($this->fromDate && $this->toDate){
            /*if(Carbon::parse($this->fromDate).equalTo(Carbon::parse($this->toDate))){
                $query->where('created_at', $this->fromDate);
            } else {
                $query->whereBetween('created_at', [$this->fromDate, $this->toDate]);
            }*/
            $query->whereBetween('date', [$this->fromDate, $this->toDate]);
			
			if($this->comptable==null){
				$query->where('date','>=',Carbon::now()->addDays(-15));
			}
        }else{
			if($this->comptable==null){
				$query->where('date',Carbon::today());
			}
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
            ->addColumnDef(["className"=>"text-right", "targets"=> [ 4, 5 ] ]) // addColumnDef
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
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                   ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
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
            'moto',
            'created_at'=> ['title' => 'Date','name'=>'created_at'],
            'caissier',
            'montant',
            //'arriere'=> ['title' => 'Arriérés','name'=>'arriere'],
            //'reste_payer'=> ['title' => 'Reste à payer','name'=>'reste_payer']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'etat_encaissements_datatable_' . time();
    }
}
