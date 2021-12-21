<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            font-size:11px;
        }
        .spasing{
            height:50px;
        }
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
</head>
<body>
    <?php foreach ($get_header as $val) { ?>
    <table width="100%">
        <tr>
            <td colspan="2"><h2>PT.Kudhi Piranti</h2></td>
            <td rowspan="2" width="200" valign="top">
                <table width="100%">
                    <tr>
                        <td>No Penjualan</td>
                        <td>: <?php echo $val->id_tr_k;?></td>
                    </tr>
                    <tr>
                        <td>Tgl Penjualan</td>
                        <td>: <?php echo $val->tgl_tr_k;?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <br>
                <br>
                <b>Bill To :</b><br>
                <?php echo $val->nama_customer;?><br>
                <?php echo $val->alamat_customer;?><br>
                <?php echo $val->no_hp;?><br>
                <?php echo $val->email;?><br>
            </td>
            <td>
                <br>
                <br>
                <b>Ship To :</b><br>
                <?php echo $val->nama_customer;?><br>
                <?php echo $val->alamat_customer;?><br>
                <?php echo $val->no_hp;?><br>
                <?php echo $val->email;?><br>
            </td>    
        </tr>
    </table>
    <?php } ?>
    <div class="spasing">
        
    </div>
    <p>Rincian Pembelian</p>
    <table id="customers">
        <tr>
            <th>#</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Qty Dibeli</th>
            <th>Harga Satuan (Rp.)</th>
            <th>Harga Total (Rp.)</th>
        </tr>
        <?php $no = 1;  $total = 0;$sum=0; foreach ($get_detail as $val_detail) {?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $val_detail->kd_barang; ?></td>
            <td><?php echo $val_detail->nama_barang; ?></td>
            <td><?php echo $val_detail->jumlah_beli; ?></td>
            <td><?php foreach ($get_detail_id as $valu) {
               if($val_detail->id_tr_k == $valu->id_tr_k AND $val_detail->kd_barang == $valu->kd_barang){
                   $harga = $valu->harga;
                   echo number_format($harga,0,",",".");
               }
           }?></td>
            <td><?php 
             foreach ($get_detail_id as $valu) {
               
                if($val_detail->id_tr_k == $valu->id_tr_k AND $val_detail->kd_barang == $valu->kd_barang){
                    $harga = $valu->harga;
                    $total = $valu->harga * $val_detail->jumlah_beli;
                    $sum += $total;
                }
            }
            echo number_format($total,0,",",".");?></td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="5">Sub Total Harga</td>
            <td><?php 
                    echo number_format($sum,0,",",".");        
                ?>
            </td>
        </tr>
    </table>
</body>
</html>