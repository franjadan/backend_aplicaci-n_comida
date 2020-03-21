<?php
    namespace App\DataTables;

    use App\Order;
    use Yajra\DataTables\Services\DataTable;
    
    class OrdersDataTable extends DataTable
    {
        //...some default stubs deleted for simplicity.
    
        public function html()
        {
            return $this->builder()
                        ->columns($this->getColumns())
                        ->parameters([
                            'buttons' => ['excel'],
                        ]);
        }
    }
?>