<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Transaksi</span></h4>
            </div>

            <div class="heading-elements">
                <div class="heading-btn-group">
                    <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                    <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                    <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
                </div>
            </div>
        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?=base_url("transaksi")?>"><i class="icon-home2 position-left"></i> Transaksi</a></li>
            </ul>

            <ul class="breadcrumb-elements">
                <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-gear position-left"></i>
                        Settings
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                        <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                        <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- /page header -->

    <!-- Bordered panel body table -->
    <div class="panel panel-flat">
        <!-- <div class="panel-heading">
            <h5 class="panel-title">Framed bordered</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div> -->

        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-framed datatable-basic" id="cart">
                    <thead>
                        <tr>
                            <th width="1">Barcode</th>
                            <th>Produk</th>
                            <th width="1">Jumlah</th>
                            <th width="1">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $d) :?>
                        <tr>
                            <td><?=$d->barcode?></td>
                            <td><?=$d->nama?></td>
                            <td><?=$d->harga?></td>
                            <td><?=$d->stok?></td>
                        </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /bordered panel body table -->
    <script>
        function get_produk(e){
            // alert(e.value);
            $.ajax({
                url: '<?=base_url('u/transaksi/get_data/')?>'+e.value,
                dataType: "JSON",
                success: function (data) {
                    $('#cart').find('tbody').append( "<tr><td></td><td></td><td></td><td></td></tr>" );
                    var $row = $('#cart').find('tbody tr:last-child');
                    $row.find('td').eq(0).text(data.barcode);
                    $row.find('td').eq(1).text(data.nama);
                    $row.find('td').eq(2).text(1);
                    $row.find('td').eq(3).text(data.harga);
                }
            });
        }
        // Basic datatable
        $('.datatable-basic').DataTable();
    </script>