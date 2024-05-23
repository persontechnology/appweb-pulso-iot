<?php

namespace App\DataTables;

use App\Models\Tenant;
use App\Models\TenantUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TenantUserDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($tu){
                return view('tenant.clientes.action',['tu'=>$tu])->render();
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(TenantUser $model): QueryBuilder
    {
        return $model->where('tenant_id',$this->tenantId)->with('user');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('tenantuser-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->ajax(['data' => 'function(d) { d.table = "tenantUserDatatable"; }'])
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
                  ->addClass('text-center'),
            Column::make('user.email')->title('Email'),
            Column::make('user.apellidos')->title('Apellidos'),
            Column::make('user.nombres')->title('Nombres'),
            Column::make('user.identificacion')->title('Identificación'),
            Column::make('user.is_active')->title('Activo'),
            Column::make('is_admin')->title('Admin')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'TenantUser_' . date('YmdHis');
    }
}
