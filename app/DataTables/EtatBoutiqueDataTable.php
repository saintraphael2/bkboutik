<?php

namespace App\DataTables;

use App\Models\Boutique;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class EtatBoutiqueDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public $comptable;
    public $caissier;
    public $fromDate;
    public $toDate;
    
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
        ->editColumn('caissier', function ($request) {
            return $request->caissiers->name;
        })
        ->editColumn('ttc', function ($request) {
            return number_format($request->ttc, 0," ", " ");
        })
        ->editColumn('created_at', function ($request) {
            return $request->created_at->format('d-m-Y');
        })
        ->editColumn('montant_verse', function ($request) {
            return number_format($request->montant, 0," ", " ");
        })
        ->withQuery('total', function($filteredQuery) {
            return $filteredQuery->sum('montant_verse');
        })
        ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Boutique $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Boutique $model)
    {
        $query=$model->newQuery();

        if($this->comptable==null){
            $query->where('created_at',Carbon::today());
        }
        if($this->caissier){
            $query->where('caissier', $this->caissier);
        }
       

        if($this->fromDate && $this->toDate){
            /*if(Carbon::parse($this->fromDate).equalTo(Carbon::parse($this->toDate))){
                $query->where('created_at', $this->fromDate);
            } else {
                $query->whereBetween('created_at', [$this->fromDate, $this->toDate]);
            }*/
            $query->whereBetween('created_at', [$this->fromDate, $this->toDate]);
			
			if($this->comptable==null){
				$query->where('created_at','>=',Carbon::now()->addDays(-15));
			}
        }else{
			if($this->comptable==null){
				$query->where('created_at',Carbon::today());
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
            'code',
            'client',
            'ttc',
            
            
            'montant_verse',
            'relicat',
            'caissier',
            'created_at'=>['title'=>'Date Opération'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'boutiques_datatable_' . time();
    }
}
