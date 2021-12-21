<style>
#customers {
  font-family: Verdana, Geneva, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
  font-size:10px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4bbbce;
  color: white;
}
</style>

<div class="col-lg-12">
    <div class="card m-b-30">
        <div class="card-body">
            <p>PT.Kudhi Piranti<br>Cetak pada Tgl : <?php echo date('Y-m-d')?></p>
            <table id="customers" class="table table-bordered " style="border-collapse: collapse; border-spacing: 0; width: 100%;font-size:12px;">
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
            
        </div>
    </div>
</div> <!-- end col -->
