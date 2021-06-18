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

    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8"><input class="form-control" id="keyword" type="text" placeholder="Pencarian ID transaksi"></div>
                        <div lass="col-md-2"><a class="btn btn-success" onclick="pencarian()">Search</a></div>
                    </div>
                </div>
            </div>    
        </div>
    </div>    
    
    <!-- Sales stats -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h6 class="panel-title">Daftar Transaksi</h6>
            <div class="heading-elements">
                
            </div>
        </div>

        <div class="container-fluid">
            <div class="row text-center">
                <table class="table datatable-basic" style="width: 50%">
                    <thead>
                        <tr>
                            <th>Transaksi</th>
                            <th>Tanggal Transaksi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="table_body">
                        <?php
                            if(!empty($list)){
                                $html = '';
                                foreach ($list as $value) {
                                    $html .= '<tr>';
                                    $html  .= '<td>'.$value->id_transaksi.'</td>';
                                    $html  .= '<td>'.$value->created_at.'</td>';
                                    $html  .= '<td><a href="'.base_url('u/transaksi/detail/'.$value->id_transaksi).'" class="btn btn-primary btn-sm"> Detail </a></td>';
                                    $html .= '</tr>';
                                }
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

    <script>
        function pencarian(){
            var keyword = $('#keyword').val();
            $.ajax({
                url: '<?=base_url('u/transaksi/search')?>',
                dataType: 'json',
                data :{
                    keyword: keyword
                }, 
                success: function (data) {
                    $('#table_body').empty();
                    if(data.length > 0){
                       var html = ''; 
                       for(var i=0;i<data.length;i++){
                            var url = '<?=base_url('u/transaksi/detail/')?>'+data[i].id_transaksi;
                            html += '<tr>';
                            html += '<td>'+data[i].id_transaksi+'</td>';
                            html += '<td>'+data[i].created_at+'</td>';
                            html += '<td><a href="'+url+'" class="btn btn-primary btn-sm"> Detail </a></td>';
                            html += '</tr>';
                       }

                       $('#table_body').append(html);     
                    }
                }
            });
        }
    </script>
    <!-- /sales stats -->