<?php

namespace App\DataTables;

use App\Models\Contrat;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\SearchPane;

class ContratDataTable extends DataTable
{
    public int $actif = 1;

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'contrats.datatables_actions')
        ->editColumn('offre', function ($request) {
            if($request->offre){
                return $request->offres->nom;
            }
        })
        ->editColumn('frequence_paiement', function ($request) {
            return ($request->frequence_paiement == 1) ? "JOURNALIER" : (($request->frequence_paiement == 2) ? "HEBDOMADAIRE" : (($request->frequence_paiement == 3) ? "SEMESTRIEL" : ""));
        })
        ->editColumn('montant_total', function ($request) {
            return number_format($request->montant_total, 0," ", " ");
        })
        ->editColumn('solde', function ($request) {
            return number_format($request->solde, 0," ", " ");
        })
        ->editColumn('date_signature', function ($request) {
            return $request->date_signature->format('d-m-Y');
        })
        ->editColumn('date_fin', function ($request) {
            return $request->date_fin->format('d-m-Y');
        })
       /* ->editColumn('conducteur', function ($request) {
            return ($request->conducteur)?$request->conducteurs->nom:'-';
        })*/
        ->editColumn('journalier', function ($request) {
            return ($request->journalier)?"JOURNALIER":"HEBDOMADAIRE";
        })->filterColumn('moto', function($query, $keyword) {
            $sql = "moto in (select id from moto where immatriculation  like ?)";
            $query->whereRaw($sql, ["%{$keyword}%"]);
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Contrat $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Contrat $model)
    {
        return $model->newQuery()->where('actif',$this->actif)->with([
            'typecontrats',
            'motos',
            'conducteurs',
            'offres'
            
        ])->orderby('id','desc');
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
            ->addColumnDef(["className"=>"text-right", "targets"=> [ 4 ] ]) // addColumnDef
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            //->searchPanes(SearchPane::make())
            ->parameters([
                'dom'       => 'PBfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'language' => [
                    'url' => url('vendor/datatables/French.json')
                ],
                'buttons'   => [
                    // Enable Buttons as per your need
//                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
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
            'numero',
            //'typecontrat',
            'type_contrat' => new \Yajra\DataTables\Html\Column([
                'title' => 'Type contrat', 
                'data' => 'typecontrats.libelle',
                'name' => 'typecontrat'
            ]),
            
            //'moto',
            'moto' => new \Yajra\DataTables\Html\Column([
                'title' => 'Moto', 
                'data' => 'motos.immatriculation', //chassis
                'name' => 'moto'
            ]),
           // 'conducteur',
           /* 'conducteur' => new \Yajra\DataTables\Html\Column([
                'title' => 'Conducteur', 
                'data' => 'conducteurs.nom',
                //'data' => 'conducteur.get_full_name',
                'name' => 'conducteur'
            ]),*/
            //'bdeposit',
            //'deposit',
            //'montant',
            'montant_total',
            'solde',
            'offre',
            /*'offre' => new \Yajra\DataTables\Html\Column([
                'title' => 'Offre', 
                'data' => 'offres.nom', //chassis
                'name' => 'offre'
            ]),*/
            'frequence_paiement',
            /*'journalier'=> new \Yajra\DataTables\Html\Column([
                'title' => 'Mode de Paiement', 
                'data' => 'journalier',
                //'data' => 'conducteur.get_full_name',
                'name' => 'journalier'
            ]),*/
            //'montant_total'=>['render'=>'function(){return "<div style="text-align:right;">"+data+"<\div>"}'],
            //'montant_total'=>['render'=>'function(){return "<td class="text-right">"+data+"<\td>";}'],
            //'montant_total'=>['render'=>'function(){return '<td class='text-right'>'.data.'<\td>'; }"],
            'date_signature',
            //'date_debut',
            'date_fin'
            //'datprm',
            //'observation'
        ];
    }



    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'contrats_datatable_' . time();
    }
}
