<?php

namespace App\DataTables;

use App\Models\Conducteur;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ConducteurDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'conducteurs.datatables_actions')
        ->editColumn('type_piece', function ($request) {
            return $request->typePiece->libelle;
        })
        ->editColumn('date_naissance', function ($request) {
            return $request->date_naissance->format('d-m-Y');
        })
        ->editColumn('moto', function ($request) {
            return $request->contrats[0]->motos->immatriculation;
        })->filterColumn('moto', function($query, $keyword) {
            $sql = "moto in (select id from moto where immatriculation  like ?)";
            if($this->comptable==null){
                $query=$query->whereRaw($sql, ["%{$keyword}%"])->where('date','>=',Carbon::now()->addDays(-15));
            }
            $query=$query->whereRaw($sql, ["%{$keyword}%"]);
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Conducteur $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Conducteur $model)
    {
        return $model->newQuery()->join('contrat', 'contrat.conducteur', '=', 'conducteur.id')
        ->where('contrat.actif', 1)->select('conducteur.id', 'nom',
            'prenom',
            'telephone',
            'quartier',
            'date_naissance',
            'photo',
            'caution',
            'type_piece',
            'numero_piece','contrat.moto')->with([
               'contrats',
                'contrats.motos',
            ]);
        
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
            'quartier',
            'date_naissance',
            //'photo',
            'moto'=> ['title' => 'Moto','name'=>'created_at'],
            'type_piece',
            'numero_piece'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'conducteurs_datatable_' . time();
    }
}
