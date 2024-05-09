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
    public $fromDate;
    public $toDate;
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
        ->addColumn('debut_contrat', function($row)
        {
           $debut_contrat = date("d-m-Y", strtotime($row->debut_contrat));
           return $debut_contrat;
        })
        ->addColumn('debut_contrat1', function($row)
        {
            $debut_contrat1 = Carbon::parse($row->debut_contrat1);
            $aujourdhui = (!isset($this->toDate))?Carbon::now():$this->toDate;
            return  $debut_contrat1->diffInMonths($aujourdhui)+1;;
        })
        ->addColumn('commission', function($row)
        {
            $debut_contrat1 = Carbon::parse($row->debut_contrat1);
            $aujourdhui = (!isset($this->toDate))?Carbon::now():$this->toDate;
            return  ($debut_contrat1->diffInMonths($aujourdhui)+1)*2200;;
        })
        ->addColumn('date_enregistrement', function($row)
        {
           $date_enregistrement = date("d-m-Y", strtotime($row->date_enregistrement));
           return $date_enregistrement;
        })
        ->filterColumn('contrat', function($query, $keyword) {
            $sql = "id in (select moto from contrat where numero  like ?)";
          
            $query=$query->whereRaw($sql, ["%{$keyword}%"]);
        }) ;
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
			
			$query= $model->select('moto.*')->newQuery()->orderby('id','desc')->where("partenaire",$this->partenaire);
           // $query= $query->offset(0)->limit(10);
            //$query= $model->newQuery()->skip(10)->take(10);
			if($this->fromDate && $this->toDate){
                $query->join('contrat', 'contrat.moto', '=', 'moto.id')->whereBetween('contrat.date_debut', [$this->fromDate, $this->toDate]);
                $query ->selectRaw('( SELECT CONCAT( numero, \'[\', case when actif=1 then \'Actif\' else \'Désactivé\' end,\']\')  
FROM contrat WHERE contrat.moto=moto.id and date_debut between "'.$this->fromDate.'" and "'.$this->toDate.'"  ORDER BY contrat.id DESC LIMIT 1) as contrat')
->selectRaw('( SELECT date_debut  
FROM contrat WHERE contrat.moto=moto.id and date_debut between "'.$this->fromDate.'" and "'.$this->toDate.'"  ORDER BY contrat.id DESC LIMIT 1) as debut_contrat')
->selectRaw('( SELECT 1 
FROM contrat WHERE contrat.moto=moto.id and date_debut between "'.$this->fromDate.'" and "'.$this->toDate.'"  ORDER BY contrat.id DESC LIMIT 1) as commission')
->selectRaw('( SELECT date_debut  
FROM contrat WHERE contrat.moto=moto.id and date_debut between "'.$this->fromDate.'" and "'.$this->toDate.'" ORDER BY contrat.id DESC LIMIT 1) as debut_contrat1')
->selectRaw('( SELECT montant_total FROM contrat WHERE contrat.moto=moto.id and date_debut between "'.$this->fromDate.'" and "'.$this->toDate.'"  ORDER BY contrat.id DESC LIMIT 1) as montant_total')
->selectRaw('( SELECT (select libelle from motif_arriere where id=contrat.motif_arriere) FROM contrat WHERE contrat.moto=moto.id and date_debut between "'.$this->fromDate.'" and "'.$this->toDate.'"  ORDER BY contrat.id DESC LIMIT 1) as motif_arriere')
->selectRaw('( SELECT SUM(t.montant) total_paye FROM tableau_armortissement t, contrat c WHERE t.contrat=c.id and t.etat="PAYE" and c.moto=moto.id and date_debut between "'.$this->fromDate.'" and "'.$this->toDate.'"  ORDER BY c.id DESC LIMIT 1) as total_paye')
->selectRaw('( SELECT count(t.id) nb_impaye FROM tableau_armortissement t, contrat c WHERE t.contrat=c.id and t.etat="NON PAYE" and c.moto=moto.id and date_debut between "'.$this->fromDate.'" and "'.$this->toDate.'"  and t.datprev<"'. Carbon::now().'" ORDER BY c.id DESC LIMIT 1) as nombre_impayes')
//->selectRaw('( SELECT count(t.id) nb_impaye FROM tableau_armortissement t, contrat c WHERE t.contrat=c.id and t.etat="PAYE" and c.moto=moto.id  and t.datprev<"'. Carbon::now().'" ORDER BY c.id DESC LIMIT 1) as nombre_impayes')
;
            }else{
                $query ->selectRaw('( SELECT CONCAT( numero, \'[\', case when actif=1 then \'Actif\' else \'Désactivé\' end,\']\')  
FROM contrat WHERE contrat.moto=moto.id  ORDER BY contrat.id DESC LIMIT 1) as contrat')
->selectRaw('( SELECT date_debut  
FROM contrat WHERE contrat.moto=moto.id  ORDER BY contrat.id DESC LIMIT 1) as debut_contrat')
->selectRaw('( SELECT 1 
FROM contrat WHERE contrat.moto=moto.id  ORDER BY contrat.id DESC LIMIT 1) as commission')
->selectRaw('( SELECT date_debut  
FROM contrat WHERE contrat.moto=moto.id  ORDER BY contrat.id DESC LIMIT 1) as debut_contrat1')
->selectRaw('( SELECT montant_total FROM contrat WHERE contrat.moto=moto.id  ORDER BY contrat.id DESC LIMIT 1) as montant_total')
->selectRaw('( SELECT (select libelle from motif_arriere where id=contrat.motif_arriere) FROM contrat WHERE contrat.moto=moto.id  ORDER BY contrat.id DESC LIMIT 1) as motif_arriere')
->selectRaw('( SELECT SUM(t.montant) total_paye FROM tableau_armortissement t, contrat c WHERE t.contrat=c.id and t.etat="PAYE" and c.moto=moto.id  ORDER BY c.id DESC LIMIT 1) as total_paye')
->selectRaw('( SELECT count(t.id) nb_impaye FROM tableau_armortissement t, contrat c WHERE t.contrat=c.id and t.etat="NON PAYE" and c.moto=moto.id  and t.datprev<"'. Carbon::now().'" ORDER BY c.id DESC LIMIT 1) as nombre_impayes')
//->selectRaw('( SELECT count(t.id) nb_impaye FROM tableau_armortissement t, contrat c WHERE t.contrat=c.id and t.etat="PAYE" and c.moto=moto.id  and t.datprev<"'. Carbon::now().'" ORDER BY c.id DESC LIMIT 1) as nombre_impayes')
;
            }
		
        
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
            'debut_contrat','debut_contrat1'=>['title'=>"Durée Contrat (mois)"],'commission',
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
