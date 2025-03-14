<?php

namespace App\DataTables;

use App\Models\UserModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     *	Build the DataTable class.
     *
     *	@param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($row) {
                return '<a href="/user/edit/' . $row->user_id . '" class="btn btn-sm btn-primary">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="/user/destroy/' . $row->user_id . '" class="btn btn-sm btn-danger"
                   onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\');">
                    <i class="fas fa-trash"></i> Hapus
                </a>';
            })
            ->rawColumns(['action']) // Agar tombol bisa dirender sebagai HTML
            ->setRowId('id');
    }

    /**
     *	Get the query source of dataTable.
     */
    public function query(UserModel $model): QueryBuilder
    {
        return $model->with('level')->newQuery();
    }

    /**
     *	Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('user-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([


                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     *	Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('user_id'),
            Column::make('username'),
            Column::make('nama'),
            Column::make('level.level_nama'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(300)
                ->addClass('text-center')
                ->title('Aksi'),
        ];
    }

    /**
     *	Get the filename for export.
     */
    protected function filename(): string
    {
        return 'use_' . date('YmdHis');
    }
}
