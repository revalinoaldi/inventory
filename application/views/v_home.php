
<div class="col-xl-3 col-md-6">
    <div class="card bg-primary mini-stat text-white">
        <div class="p-3 mini-stat-desc">
            <div class="clearfix">
                <h6 class="text-uppercase mt-0 float-left text-white-50">Customer</h6>
                
            </div>
            <div>
                 <h4 class="mb-3 mt-0 float-left">
                 <?php 
                    foreach ($count_customer as $val_customer) {
                        echo $val_customer->id_customer;
                    }
                ?>
                </h4>
            </div>
            
        </div>
        <div class="p-3">
            <div class="float-right">
                <a href="#" class="text-white-50"><i class="mdi mdi-cube-outline h5"></i></a>
            </div>
            <!-- <p class="font-14 m-0">Last : 1447</p> -->
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-6">
    <div class="card bg-info mini-stat text-white">
        <div class="p-3 mini-stat-desc">
            <div class="clearfix">
                <h6 class="text-uppercase mt-0 float-left text-white-50">Total Barang</h6>
                
            </div>
            <div>
                <h4 class="mb-3 mt-0 float-left">
                <?php 
                    foreach ($count_barang as $val_brg) {
                        echo $val_brg->kd_barang;
                    }
                ?>
                </h4>
            </div>
        </div>
        <div class="p-3">
            <div class="float-right">
                <a href="#" class="text-white-50"><i class="mdi mdi-buffer h5"></i></a>
            </div>
            <!-- <p class="font-14 m-0">Last : $47,596</p> -->
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-pink mini-stat text-white">
        <div class="p-3 mini-stat-desc">
            <div class="clearfix">
                <h6 class="text-uppercase mt-0 float-left text-white-50">Tr Barang Masuk</h6>
                
            </div>
            <div>
                <h4 class="mb-3 mt-0 float-left">
                <?php 
                    foreach ($count_barang_masuk as $val_brg_masuk) {
                        echo $val_brg_masuk->id_tr_m;
                    }
                ?>
                </h4>
            </div>
        </div>
        <div class="p-3">
            <div class="float-right">
                <a href="#" class="text-white-50"><i class="mdi mdi-tag-text-outline h5"></i></a>
            </div>
            <!-- <p class="font-14 m-0">Last : 15.8</p> -->
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-6">
    <div class="card bg-success mini-stat text-white">
        <div class="p-3 mini-stat-desc">
            <div class="clearfix">
                <h6 class="text-uppercase mt-0 float-left text-white-50">Tr Barang Keluar</h6>
            </div>
            <div>
                <h4 class="mb-3 mt-0 float-left">
                <?php 
                    foreach ($count_barang_keluar as $val_brg_keluar) {
                        echo $val_brg_keluar->id_tr_k;
                    }
                ?>
                </h4>
            </div>
        </div>
        <div class="p-3">
            <div class="float-right">
                <a href="#" class="text-white-50"><i class="mdi mdi-briefcase-check h5"></i></a>
            </div>
            <!-- <p class="font-14 m-0">Last : 1776</p> -->
        </div>
    </div>
</div>

<div class="col-sm-12">
    <div class="card m-b-30 card-body">
        <h3 class="card-title font-16 mt-0">Stok Barang Yang Sudah Mau Habis</h3>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>No</th>
                <th>KD Barang</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Harga Barang</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php $no = 1; foreach ($get_barang as $val) { ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $val->kd_barang ?></td>
                    <td><?php echo $val->nama_barang ?></td>
                    <td><?php echo $val->satuan ?></td>
                    <td><?php echo number_format($val->harga_barang);?></td>
                    <td><?php echo number_format($val->stok_awal,0,',','.')?></td>
                    <td>
                        <a href="<?php echo base_url('barang')?>" class="btn btn-sm btn-info">Tambah Stok Barang</a>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
</div>
