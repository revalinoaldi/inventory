

<div class="col-lg-12">
    <div class="card m-b-30">
        <div class="card-body">
            
            <table id="databarang" class="table table-bordered " style="border-collapse: collapse; border-spacing: 0; width: 100%;font-size:12px;">
                <thead>
                <tr>
                    <th>No</th>
                    <th>KD Barang</th>
                    <th>Nama Barang</th>
                    <th>Satuan</th>
                    <th>Harga Barang</th>
                    <th>Stok Awal</th>
                    <th>Stok</th>
                    <th>Pemakaian</th>
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
                        <td><?php echo $val->stok_awal+$val->pemakaian;?></td>
                        <td><?php echo $val->stok_awal?></td>
                        <td><?php echo "- ".$val->pemakaian?></td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
            <a href="<?php echo base_url()?>C_laporan/cetak_barang" target="_blank" class="btn btn-info btn-md"><i class="fa fa-print"></i> Cetak Laporan</a><br>         
        </div>
    </div>
</div> <!-- end col -->
            
<script>

    
    

</script>