<?php

namespace App\DataTables;

use App\Models\Moto;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Support\Carbon;

class MotoPartenairesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public $comptable;
    public $partenaire;
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        
        return $dataTable 
        ->addColumn('disponible', function($row)  {
           $disponible = ($row->disponible==true)?'OUI':'NON';
           return $disponible;
        })
        ->addColumn('partenaire', function($row)  {
            
            return ($row->partenaire)?$row->partenaires['nom']." ".$row->partenaires['prenom']:'';
         })
         ->addColumn('montant_total', function($row)  {
            
            return number_format($row->montant_total, 0," ", " ");
         })
         ->addColumn('total_paye', function($row)  {
            
            return number_format($row->total_paye, 0," ", " ");
         })
         ->addColumn('nombre_impayes', function($row)  {
            
            return number_format($row->nombre_impayes, 0," ", " ");
         })
        ->addColumn('date_enregistrement', function($row)
        {
           $date_enregistrement = date("d-m-Y", strtotime($row->date_enregistrement));
           return $date_enregistrement;
        })->filterColumn('contrat', function($query, $keyword) {
            $sql = "id in (select moto from contrat where numero  like ?)";
          
            $query=$query->whereRaw($sql, ["%{$keyword}%"]);
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Moto $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Moto $model)
    {
		//var_dump($this->comptable);exit;
        //if($this->comptable==1){
           // $query= $model->select('moto.*')->newQuery()->orderby('id','desc');
       // }else
			
			$query= $model->select('moto.*')->newQuery()->orderby('id','desc')->newQuery()->where("partenaire",$this->partenaire);
           // $query= $query->offset(0)->limit(10);
            //$query= $model->newQuery()->skip(10)->take(10);
			
		
        $query ->selectRaw('( SELECT CONCAT( numero, \'[\', case when actif=1 then \'Actif\' else \'Désactivé\' end,\']\')  
FROM contrat WHERE contrat.moto=moto.id  ORDER BY contrat.id DESC LIMIT 1) as contrat')
->selectRaw('( SELECT montant_total FROM contrat WHERE contrat.moto=moto.id  ORDER BY contrat.id DESC LIMIT 1) as montant_total')
->selectRaw('( SELECT (select libelle from motif_arriere where id=contrat.motif_arriere) FROM contrat WHERE contrat.moto=moto.id  ORDER BY contrat.id DESC LIMIT 1) as motif_arriere')
->selectRaw('( SELECT SUM(t.montant) total_paye FROM tableau_armortissement t, contrat c WHERE t.contrat=c.id and t.etat="PAYE" and c.moto=moto.id  ORDER BY c.id DESC LIMIT 1) as total_paye')
->selectRaw('( SELECT count(t.id) nb_impaye FROM tableau_armortissement t, contrat c WHERE t.contrat=c.id and t.etat="NON PAYE" and c.moto=moto.id  and t.datprev<"'. Carbon::now().'" ORDER BY c.id DESC LIMIT 1) as nombre_impayes');
            //$query= $model->newQuery()->where("disponible",1);
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
                    //['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    //['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    //['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
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
            'immatriculation',
            'chassis',
           
            'mise_circulation',
            'date_enregistrement',
            'disponible',
            'contrat',
            'montant_total','total_paye','nombre_impayes','motif_arriere'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'motos_datatable_' . time();
    }
}
