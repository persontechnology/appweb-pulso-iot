<?php

namespace App\DataTables;

use App\Models\Lectura;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LecturaDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($lec){
                return view('lecturas.action',['lectura'=>$lec])->render();
            })
            ->editColumn('created_at',function($lec){
                return $lec->created_at;
            })
            ->editColumn('name',function($lec){
                $dev_eui= $lec->xId($lec->id)->dev_eui;
                return $lec->buscarDispositivoDevEui($dev_eui)->name;
            })
            ->editColumn('join_eui',function($lec){
                $dev_eui= $lec->xId($lec->id)->dev_eui;
                return $lec->buscarDispositivoDevEui($dev_eui)->join_eui;
            })
            ->editColumn('email',function($lec){
                $dev_eui= $lec->xId($lec->id)->dev_eui;
                return $lec->buscarDispositivoDevEui($dev_eui)->user->email??'';
            })
            ->editColumn('apellidos',function($lec){
                $dev_eui= $lec->xId($lec->id)->dev_eui;
                return $lec->buscarDispositivoDevEui($dev_eui)->user->apellidos??'';
            })
            ->editColumn('nombres',function($lec){
                $dev_eui= $lec->xId($lec->id)->dev_eui;
                return $lec->buscarDispositivoDevEui($dev_eui)->user->nombres??'';
            })
            ->editColumn('identificacion',function($lec){
                $dev_eui= $lec->xId($lec->id)->dev_eui;
                return $lec->buscarDispositivoDevEui($dev_eui)->user->identificacion??'';
            })

            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Lectura $model): QueryBuilder
    {
        // return $model->selectRaw("encode(dev_eui, 'hex') as dev_eui_hex,data,created_at")->latest();
        return $model->newQuery()
        
        ->latest();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('lectura-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->title('Acción')
                  ->addClass('text-center'),
            Column::make('created_at')->title('Fecha'),
            Column::make('dev_eui'),
            Column::computed('name')->title('Nombre'),
            Column::computed('join_eui')->title('Join Eui'),
            Column::make('data'),
            Column::make('email'),
            Column::make('apellidos'),
            Column::make('nombres'),
            Column::make('identificacion'),
            Column::make('estado'),
            
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Lectura_' . date('YmdHis');
    }
}
