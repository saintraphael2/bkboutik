<?php

namespace App\DataTables;

use App\Models\Contrat;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class EtatArriereDataTable extends DataTable
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

        $dataTable->addColumn('action', 'etats.arrieres_datatables_actions');
        $dataTable->editColumn('montant_total', function ($request) {
            return number_format($request->montant_total, 0," ", " ");
        })
        ->editColumn('solde', function ($request) {
            return number_format($request->solde, 0," ", " ");
        })
        ->editColumn('arrieres', function ($request) {
            return number_format($request->arrieres, 0," ", " ");
        })
        ->editColumn('retard', function ($request) {
            return number_format($request->retard, 0," ", " ");
        })
        
       ->editColumn('motif_arriere', function ($row) {
            return ($row->motifArriere!=null )?$row->motifArriere['libelle']:'-';
        })
        /* ->editColumn('date_fin', function ($request) {
            return $request->date_fin->format('d-m-Y');
        })*/
        ->editColumn('journalier', function ($request) {
            return ($request->journalier)?"JOURNALIER":"HEBDOMADAIRE";
        })
        ->editColumn('moto', function ($row) {
            return $row->motos['immatriculation'];
        })
        ->editColumn('conducteur', function ($row) {
            return $row->conducteurs['nom'];
        })
        ->editColumn('tel_contact', function ($row) {
            return $row->conducteurs['telephone'];
        })->filterColumn('moto', function($query, $keyword) {
            $sql = "contrat in (select id from contrat where moto in (select id from moto where immatriculation  like ?))";
            if($this->comptable==null){
                $query=$query->whereRaw($sql, ["%{$keyword}%"])->where('date','>=',Carbon::now()->addDays(-15));
            }
            $query=$query->whereRaw($sql, ["%{$keyword}%"]);
        });
        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Contrat $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Contrat $model)
    {
        $query = $model->newQuery()->where('actif',1)->with([
            'typecontrats',
            'motos',
            'conducteurs'
        ]);

        $query->join('tableau_armortissement', 'contrat.id', '=', 'tableau_armortissement.contrat')
        ->where([
            ['contrat.solde', '>', 0],
            ['tableau_armortissement.etat', 'NON PAYE'],
            ['tableau_armortissement.datprev','<', Carbon::now()]
        ])
        ->select(
            'contrat.id',  
            'contrat.conducteur',
            'contrat.moto',
            DB::raw($this->comptable.' as comptable'),
            DB::raw('SUM(tableau_armortissement.montant) as arrieres'),
            DB::raw('DATE_FORMAT(MIN(tableau_armortissement.datprev) , "%d/%m/%Y") as datprev'),
            DB::raw('COUNT(etat) as retard')
        )
        ->groupBy('contrat.id','contrat.conducteur', 'contrat.moto');

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
            ->addColumnDef(["className"=>"text-right", "targets"=> [ 4, 5, 6, 7 ] ]) // addColumnDef
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
            'numero'=> ['title' => 'Contrat','name'=>'numero'],
            'moto',
            /*'moto' => new \Yajra\DataTables\Html\Column([
                'title' => 'Moto', 
                'data' => 'motos.immatriculation', //chassis
                'name' => 'moto'
            ]),*/
            'conducteur',
            'tel_contact'=> ['title' => 'Contact','name'=>'conducteur'],
            'datprev'=> ['title' => '1ere écheance non payée','name'=>'conducteur'],
            'journalier'=> new \Yajra\DataTables\Html\Column([
                'title' => 'Mode de Paiement', 
                'data' => 'journalier',
                //'data' => 'conducteur.get_full_name',
                'name' => 'journalier'
            ]),
            'montant_total',
            'solde',
            'motif_arriere'=> ['title' => 'Motif Arriérés','name'=>'motif_arriere'],
            'arrieres'=> ['title' => 'Arriérés','name'=>'conducteur'],
            'retard'=> ['title' => 'Retards (jrs)','name'=>'conducteur']
        ];
    }



    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'etat_arrieres_datatable_' . time();
    }
}
