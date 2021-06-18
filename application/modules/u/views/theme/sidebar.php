<!-- Page container -->
<div class="page-container">

<!-- Page content -->
<div class="page-content">

    <!-- Main sidebar -->
    <div class="sidebar sidebar-main">
        <div class="sidebar-content">

            <!-- User menu -->
            <div class="sidebar-user">
                <div class="category-content">
                    <div class="media">
                        <a href="#" class="media-left"><img src="<?=base_url()?>assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></a>
                        <div class="media-body">
                            <span class="media-heading text-semibold">User</span>
                            <div class="text-size-mini text-muted">
                                <i class="icon-pin text-size-small"></i> &nbsp;Sukarami, Palembang
                            </div>
                        </div>

                        <div class="media-right media-middle">
                            <ul class="icons-list">
                                <li>
                                    <a href="#"><i class="icon-cog3"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /user menu -->


            <!-- Main navigation -->
            <div class="sidebar-category sidebar-category-visible">
                <div class="category-content no-padding">
                    <ul class="navigation navigation-main navigation-accordion">

                        <!-- Main -->
                        <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
                        <li <?=$side=='dashboard'?'class="active"':''?>><a href="<?=base_url("u")?>"><i class="icon-home4"></i> <span>Home</span></a></li>
                        <li <?=$side=='transaksi'?'class="active"':''?>><a href="<?=base_url("u/transaksi")?>"><i class="icon-basket"></i> <span>Transaksi</span></a></li>
                        <li <?=$side=='transaksihistory'?'class="active"':''?>><a href="<?=base_url("u/transaksi/history")?>"><i class="icon-history"></i> <span>Riwayat Transaksi</span></a></li>
                        

                        <!-- Master Data -->
                        <li class="navigation-header"><span>Master Data</span> <i class="icon-menu" title="Main pages"></i></li>
                        <li>
                            <a href="#"><i class="icon-price-tags2"></i> <span>Kategori Produk</span></a>
                            <ul>
                                <li <?=$side=='kategoriproduk'?'class="active"':''?>><a href="<?=base_url("u/kategoriproduk")?>"><i class="icon-database2"></i><span>Semua Data</span></a></li>
                                <li <?=$side=='addkategoriproduk'?'class="active"':''?>><a href="<?=base_url("u/kategoriproduk/tambah")?>"><i class="icon-plus3"></i><span>Tambah</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="icon-stack"></i> <span>Produk</span></a>
                            <ul>
                                <li <?=$side=='produk'?'class="active"':''?>><a href="<?=base_url("u/produk")?>"><i class="icon-database2"></i><span>Semua Data</span></a></li>
                                <li <?=$side=='addproduk'?'class="active"':''?>><a href="<?=base_url("u/produk/tambah")?>"><i class="icon-plus3"></i><span>Tambah</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /main navigation -->

        </div>
    </div>
    <!-- /main sidebar -->
