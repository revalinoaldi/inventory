<div class="left side-menu">
    <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
        <i class="mdi mdi-close"></i>
    </button>

    <div class="left-side-logo d-block d-lg-none">
        <div class="text-center">

            <a href="index.html" class="logo"><img src="<?php echo base_url()?>assets/images/logo_dark.png" height="20" alt="logo"></a>
        </div>
    </div>

    <div class="sidebar-inner slimscrollleft">

        <div id="sidebar-menu">
            <ul>

                <li class="menu-title">Main</li>
                <li class="<?php if($this->uri->segment(2) == "home"){echo "active";}?>">
                    <a href="<?php echo base_url('home')?>" class="waves-effect">
                        <i class="dripicons-home"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                <?php if($this->session->userdata('level') == 'Super Admin'){ ?>
                     <li class="has_sub" class="<?php if($this->uri->segment(2) == ("user" || "customer" || "supplier" || "barang")){echo "active nav-active";}?>">
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class="dripicons-document"></i><span> Master Data </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled" style="display: none;">
                                <li><a href="<?php echo base_url('user') ?>" class="<?php if($this->uri->segment(2) == "user"){echo "active";}?>">User</a></li>
                                <li><a href="<?php echo base_url('customer') ?>" class="<?php if($this->uri->segment(2) == "customer"){echo "active";}?>">Customer</a></li>
                                <li><a href="<?php echo base_url('supplier') ?>" class="<?php if($this->uri->segment(2) == "supplier"){echo "active";}?>">Supplier</a></li>
                                <li><a href="<?php echo base_url('barang')?>" class="<?php if($this->uri->segment(2) == "barang"){echo "active";}?>">Barang</a></li>
                            </ul>
                        </li>

                    
                    <li class="<?php if($this->uri->segment(3) == "masuk"){echo "active";}?>">
                        <a href="<?php echo base_url('barang/masuk')?>" class="waves-effect">
                            <i class=" dripicons-arrow-left "></i>
                            <span> Barang Masuk </span>
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(3) == "trmasuk"){echo "active";}?>">
                        <a href="<?php echo base_url('barang/trmasuk')?>" class="waves-effect">
                            <i class=" dripicons-view-thumb "></i>
                            <span> Transaksi Brg Masuk </span>
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(3) == "penjualan"){echo "active";}?>">
                        <a href="<?php echo base_url('barang/penjualan')?>" class="waves-effect">
                            <i class="dripicons-basket "></i>
                            <span> Barang Keluar </span>
                        </a>
                    </li>
                    <li class="<?php if($this->uri->segment(3) == "trpenjualan"){echo "active";}?>">
                        <a href="<?php echo base_url('barang/trpenjualan')?>" class="waves-effect">
                            <i class=" dripicons-view-thumb "></i>
                            <span> Transaksi Barang Keluar </span>
                        </a>
                    </li>

                    <li class="has_sub" class="<?php if($this->uri->segment(2) == "lap"){echo "nav-active";}?>">
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class="dripicons-document"></i><span> Laporan </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="list-unstyled" style="display: none;">
                                <li><a href="<?php echo base_url('lap/customer')?>" class="<?php if($this->uri->segment(2) == "lap" && $this->uri->segment(3) == "customer"){echo "active";}?>">Lap Customer</a></li>
                                <li><a href="<?php echo base_url('lap/barang')?>" class="<?php if($this->uri->segment(2) == "lap" && $this->uri->segment(3) == "barang"){echo "active";}?>">Lap Barang</a></li>
                                <li><a href="<?php echo base_url('lap/trmasuk')?>" class="<?php if($this->uri->segment(2) == "lap" && $this->uri->segment(3) == "trmasuk"){echo "active";}?>">Lap Tr Barang Masuk</a></li>
                                <li><a href="<?php echo base_url('lap/trkeluar')?>" class="<?php if($this->uri->segment(2) == "lap" && $this->uri->segment(3) == "trkeluar"){echo "active";}?>">Lap Tr Barang Keluar</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if($this->session->userdata('level') == 'Admin'){ ?>
                        <li class="<?php if($this->uri->segment(2) == "supplier"){echo "active";}?>">
                            <a href="<?php echo base_url('supplier')?>" class="waves-effect">
                                <i class="dripicons-archive"></i>
                                <span> Master Supplier </span>
                            </a>
                        </li>
                        <li class="<?php if($this->uri->segment(2) == "barang"){echo "active";}?>">
                            <a href="<?php echo base_url('barang')?>" class="waves-effect">
                                <i class="dripicons-archive"></i>
                                <span> Master Barang </span>
                            </a>
                        </li>
                        <li class="<?php if($this->uri->segment(3) == "masuk"){echo "active";}?>">
                            <a href="<?php echo base_url('barang/masuk')?>" class="waves-effect">
                                <i class=" dripicons-arrow-left "></i>
                                <span> Barang Masuk </span>
                            </a>
                        </li>
                        <li class="<?php if($this->uri->segment(3) == "trmasuk"){echo "active";}?>">
                            <a href="<?php echo base_url('barang/trmasuk')?>" class="waves-effect">
                                <i class=" dripicons-view-thumb "></i>
                                <span> Transaksi Brg Masuk </span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if($this->session->userdata('level') == 'Kasir'){ ?>
                        <li class="<?php if($this->uri->segment(2) == "customer"){echo "active";}?>">
                            <a href="<?php echo base_url('customer')?>" class="waves-effect">
                                <i class="dripicons-archive"></i>
                                <span> Master Customer </span>
                            </a>
                        </li>
                        <li class="<?php if($this->uri->segment(3) == "penjualan"){echo "active";}?>">
                            <a href="<?php echo base_url('barang/penjualan')?>" class="waves-effect">
                                <i class="dripicons-basket "></i>
                                <span> Penjualan </span>
                            </a>
                        </li>
                        <li class="<?php if($this->uri->segment(3) == "trpenjualan"){echo "active";}?>">
                            <a href="<?php echo base_url('barang/trpenjualan')?>" class="waves-effect">
                                <i class=" dripicons-view-thumb "></i>
                                <span> Transaksi Brg Penjualan </span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div> <!-- end sidebarinner -->
    </div>