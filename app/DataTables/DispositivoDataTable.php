<?php

namespace App\DataTables;

use App\Models\Dispositivo;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DispositivoDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($dis){
                // return $dis->user;
                return view('dispositivos.action',['dis'=>$dis])->render();
            })
            
            ->setRowId('name');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Dispositivo $model): QueryBuilder
    {
        
        return $model->newQuery()
        ->whereHas('application', function ($query) {
            $query->whereHas('tenant', function ($query) {
                $query->where('id', Auth::user()->tenant_id);
            });
        })
        ->selectRaw("encode(dev_eui, 'hex') as dev_eui_hex, *")
        ->with('user');
        // ->with('application');

    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('dispositivo-table')
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
            Column::make('dev_eui'),      
            Column::make('name')->title('Nombre'),
            Column::make('join_eui'),
            // Column::make('battery_level')->title('%Batería'),
            // Column::make('is_disabled')->title('Deshabilitado'),
            Column::make('description')->title('Descripción'),
            Column::make('user.email')->title('Email'),
            Column::make('user.apellidos')->title('Apellidos'),
            Column::make('user.apellidos')->title('Nombres'),
            Column::make('user.apellidos')->title('Identificación'),
            
            
            
            
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Dispositivo_' . date('YmdHis');
    }
}
