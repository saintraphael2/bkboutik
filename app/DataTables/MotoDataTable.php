<?php

namespace App\DataTables;

use App\Models\Moto;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class MotoDataTable extends DataTable
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
        
        return $dataTable->addColumn('action', 'motos.datatables_actions') 
        ->addColumn('disponible', function($row)  {
           $disponible = ($row->disponible==true)?'OUI':'NON';
           return $disponible;
        })
        ->addColumn('hors_stock', function($row)  {
            $hors_stock = ($row->hors_stock==true)?'OUI':'NON';
            return $hors_stock;
         })
        ->addColumn('partenaire', function($row)  {
            
            return ($row->partenaire)?$row->partenaires['nom']." ".$row->partenaires['prenom']:'';
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
            $query= $model->select('id', 'immatriculation', 'chassis', 'mise_circulation', 'disponible', 'prochaine_vidange', 'date_enregistrement', 'partenaire', 'hors_stock')->newQuery()->orderby('id','desc');
       // }else
			if($this->comptable==null){
			$query= $model->newQuery()->where("disponible",1);
           // $query= $query->offset(0)->limit(10);
            //$query= $model->newQuery()->skip(10)->take(10);
			
		}
        $query ->selectRaw('( SELECT CONCAT( numero, \'[\', case when actif=1 then \'Actif\' else \'Désactivé\' end,\']\')  
FROM contrat WHERE contrat.moto=moto.id  ORDER BY contrat.id DESC LIMIT 1) as contrat');
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
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
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
            'hors_stock',
            'contrat'
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
