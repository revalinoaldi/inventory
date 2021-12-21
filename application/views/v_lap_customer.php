<div class="col-lg-12">
    <div class="card m-b-30">
        <div class="card-body">
        
            <table id="datatable" class="table table-bordered " style="border-collapse: collapse; border-spacing: 0; width: 100%;font-size:12px;">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Customer</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Hp</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                <?php $no = 1; foreach ($get_customer as $val) { ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $val->kode_customer ?></td>
                        <td><?php echo $val->nama_customer ?></td>
                        <td><?php echo $val->alamat_customer ?></td>
                        <td><?php echo $val->no_hp;?></td>
                        <td><?php echo $val->email;?></td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
            <a href="<?php echo base_url()?>C_laporan/cetak_customer" target="_blank" class="btn btn-info btn-md"><i class="fa fa-print"></i> Cetak Laporan</a><br>         
        </div>
    </div>
</div> <!-- end col -->
