<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><!-- <i class="icon-arrow-left52 position-left"></i> --> <span class="text-semibold">Transaksi</span></h4>
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
                <li><a href="<?=base_url("transaksi")?>"><i class="icon-home2 position-left"></i> Produk</a></li>
            </ul> -->

            <!-- <ul class="breadcrumb-elements">
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

    <!-- Horizontal form -->
    <div class="panel panel-flat">
        <div class="panel-body">
            <div style="margin-bottom: 2%"><button class="btn btn-sm btn-primary" onclick="tambahProduk()">Tambah Produk</button></div>
            <form id="form_trx">
                <div id="tambah_produk">
                <div class="row" id="row_0" style="margin-bottom: 1%">
                    <div class="col-md-5">
                        <select class="form-control select" name="id_produk[]" onchange="displayHarga(this.value, 0)">
                            <option></option>
                            <?php
                               $html = '';
                               $input = '';
                               foreach ($products as $value) {
                                   $html .= '<option value="'.$value->id_produk.'">'.$value->barcode.' - '.$value->nama.'</option>';
                                   $input .='<input type="hidden" id="harga_'.$value->id_produk.'" value="'.$value->nominal.'">';
                               }

                               echo $html;
                            ?>
                        </select>
                    </div>
                    <div class="col-md-1"><input class="form-control" id="input_harga_0" type="text"></div>
                    <div class="col-md-1"><input class="form-control" name="total[]" type="text"></div>
                    <div class="col-md-1"><a onclick="hapusProduk(0)" class="btn btn-danger">Hapus</a></div>
                </div>
                <?php echo $input ?>
            </div> 
            <div class="row" style="margin-top: 5%">
                <div class="col-md-6" style="text-align: right">Total</div>
                <div class="col-md-1"><input class="form-control" type="text" id="total_harga" value="0" readonly=""></div>
            </div>
            <div class="row" style="margin-top: 3%">
                <div class="col-md-6"></div>
                <div class="col-md-2"><a class="btn btn-primary" onclick="cekTotal()">Cek Total</a></div>
                <div class="col-md-2" style="margin-left: -3%"><a class="btn btn-success" onclick="tambah_transaksi()">Create Transaksi</a></div>
            </div>
            </form>
        </div>
    </div>
    <!-- /horizotal form -->

    <script>
        $(document).ready(function () {
            $('.select').select2({
                placeholder: 'Search'
            });
        });    

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

        var i=1;
        function tambahProduk(){
            var produk = '<?php echo json_encode($products)?>';
            produk = jQuery.parseJSON(produk);
            var html = '';
            html += '<div class="row" id="row_'+i+'" style="margin-bottom: 1%">';
            html += '<div class="col-md-5">';
            html += '<select class="form-control select" name="id_produk[]" onchange="displayHarga(this.value, '+i+')">';
            html += '<option></option>';
            for(var y=0;y<produk.length;y++){
                html += '<option value="'+produk[y]['id_produk']+'">'+produk[y]['barcode']+' - '+ produk[y]['nama'] +'</option>';
            }
            html += '</select>';
            html += '</div>';
            html += '<div class="col-md-1"><input class="form-control" id="input_harga_'+i+'" type="text"></div>';
            html += '<div class="col-md-1"><input class="form-control" name="total[]" type="text"></div>';html += '<div class="col-md-1"><a onclick="hapusProduk('+i+')" class="btn btn-danger">Hapus</a></div>';
            html += '</div>';

            $('#tambah_produk').append(html);
            $('.select').select2({
                placeholder: 'Search'
            });
        }

        function hapusProduk(id){
            $('#row_'+id).remove();
        }

        function cekTotal(){

            var data_id_produk = $('.select').select2();
            var id_produk = [];
            for (var i = 0; i <= data_id_produk.length-1; i++) {
                id_produk.push(data_id_produk[i].value);

            }
            var total = $('input[name^=total]').map(function(idx, elem) {
                return $(elem).val();
              }).get();

            $.ajax({
                url: '<?=base_url('u/transaksi/cek_total')?>',
                dataType: 'json',
                data :{
                    id_produk: id_produk,
                    total : total
                }, 
                success: function (data) {
                    $('#total_harga').val(data);
                }
            });
        }

        function tambah_transaksi() {
            var data_id_produk = $('.select').select2();
            var id_produk = [];
            for (var i = 0; i <= data_id_produk.length-1; i++) {
                id_produk.push(data_id_produk[i].value);

            }
            var total = $('input[name^=total]').map(function(idx, elem) {
                return $(elem).val();
              }).get();

            $.ajax({
                url: '<?=base_url('u/transaksi/tambah_transaksi')?>',
                dataType: 'json',
                data :{
                    id_produk: id_produk,
                    total : total
                }, 
                success: function (data) {
                    if(data.status == 'success'){
                        swal("Success", "Berhasil tambah transaksi", "success");
                        location.href = '<?=base_url('u/transaksi')?>';
                    }else{
                        swal("Fail", "Gagal menambah transaksi", "error");
                    }
                }
            });
        }

        function displayHarga(id, id_div){
            var harga = $('#harga_'+id).val();
            $('#input_harga_'+id_div).val(harga);
        }
    </script>