<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><!-- <i class="icon-arrow-left52 position-left"> --></i> <span class="text-semibold">Riwayat Transaksi</span></h4>
            </div>

            <!-- <div class="heading-elements">
                <div class="heading-btn-group">
                    <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                    <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                    <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
                </div>
            </div> -->
        </div>

        <div class="breadcrumb-line">
            <!-- <ul class="breadcrumb">
                <li><a href="<?=base_url("transaksi")?>"><i class="icon-home2 position-left"></i> Transaksi</a></li>
                <li class="active">History</li>
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
            </ul> -->
        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content">

    <!-- Sales stats -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h6 class="panel-title">Transaksi Detail</h6>
            <div class="heading-elements">
                
            </div>
        </div>

        <div class="container-fluid">
            <div class="row text-center">
                <table class="table datatable-basic" style="width: 60%">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(!empty($detail)){
                                $html = '';
                                $total_harga_transaksi = 0;
                                foreach ($detail as $value) {
                                    $html .= '<tr>';
                                    $html  .= '<td>'.$value->nama.'</td>';
                                    $html  .= '<td>'.number_format($value->nominal).'</td>';
                                    $html  .= '<td>'.number_format($value->jumlah).'</td>';
                                    $html  .= '<td>'.number_format($value->total).'</td>';
                                    $html .= '</tr>';
                                    $total_harga_transaksi = $total_harga_transaksi+$value->total;
                                }
                                $html .= '<tr>';
                                $html .= '<td colspan="3" style="text_align:right;">Total</td>';
                                $html .= '<td>'.number_format($total_harga_transaksi).'</td>';
                                $html .= '</tr>';
                                echo $html;
                            }
                            else{
                                echo '<tr><td colspan="10">Data tidak tersedia</td></tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="content-group-sm" id="app_sales"></div>
        <div id="monthly-sales-stats"></div>
    </div>
    <!-- /sales stats -->