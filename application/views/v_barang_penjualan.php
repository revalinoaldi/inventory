<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="col-lg-12">
    <div class="card m-b-30">
        <div class="card-body">
            <h4 class="mt-0 header-title" id="title"></h4>
            <?php echo $this->session->flashdata('msg');?>
            <form class="" action="<?php echo base_url()?>C_barang/save_penjualan" method="post" id="frm_data_barang">
                <div class="row">                
                    <input type="hidden" name="status" id="s" value="baru">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>KD Transaksi</label>
                            <input type="text" class="form-control" required placeholder="" id="id_tr_k" name="id_tr_k" value="<?php echo $auto?>" readonly/>
                        </div>
                        <div class="form-group">
                            <label>Nama Penginput</label>
                            <input type="text" class="form-control" value="<?php echo $this->session->userdata('nama');?>" disabled>
                            <input type="hidden" class="form-control" required placeholder="Ex : nama" id="id_login" name="id_login" value="<?php echo $this->session->userdata('id_login');?>"/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group">
                            <label>Customer</label>
                            <select name="id_customer" id="" class="form-control">
                                <option value="">-- Pilih --</option>
                                <?php foreach ($get_customer as $cus) { ?>
                                    <option value="<?php echo $cus->id_customer; ?>"><?php echo $cus->kode_customer." - ".$cus->nama_customer;?></option>    
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Ket</label>
                            <input type="text" class="form-control" required placeholder="" id="ket_tr_k" name="ket_tr_k"/>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div>
                                <button type="button" class="btn btn-primary waves-effect waves-light" id="btn-tambah">
                                    <span id="txt-proses">Tambah</span>
                                </button>
                                <button type="reset" class="btn btn-secondary waves-effect m-l-5" id="btn-reset">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
               
                <input type="hidden" id="rows" value="0">
                <table id="data-barang" class="table table-bordered">
                    <tr>
                        <td>KD BARANG</td>
                        <td>SATUAN</td>
                        <td>HARGA (Rp.)</td>
                        <td>STOK</td>
                        <td>QTY</td>
                        <td>TOTAL HARGA (Rp.)</td>
                        <td>Aksi</td>
                    </tr>
                </table>
                <button class="btn btn-info btn-simpan" type="submit">
                        Simpan <span class="badge badge-primary"></span>
                </button>
            </form>
            
            
            <!-- <button id="tombol-edit">Klik</button>
            <button id="tombol-balikin">Balikin</button> -->
            

        </div>
    </div>
</div> <!-- end col -->


            
<script>
    (function($) {
          $.fn.inputFilter = function(inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
          if (inputFilter(this.value)) {
            this.oldValue = this.value;
            this.oldSelectionStart = this.selectionStart;
            this.oldSelectionEnd = this.selectionEnd;
          } else if (this.hasOwnProperty("oldValue")) {
            this.value = this.oldValue;
            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
          } else {
            this.value = "";
          }
        });
      };
    }(jQuery));

    $("#btn-tambah").click(function(){
    var count = parseInt($("#rows").val());
    var count_next = count + 1;

    $("#data-barang").append(
      "<tr>"+
        "<td>"+
        "<input type='text' class='form-control' id='kd_barang_label_"+count_next+"'> <small><i>Masukan Nama Barang</i></small>"+
        "<input type='hidden' name='kd_barang[]' class='form-control' id='kd_barang_"+count_next+"'>"+
        // "<select name='kd_barang[]' class='form-control' id='kd_barang_"+count_next+"' onchange='test(this)'>"+
        //     "<option value=''>--Silahkan Pilih--</option>"+
        //     <?php foreach($get_barang as $val) { ?>
        //       "<option value='<?php echo $val->kd_barang?>' data-satuan='<?php echo $val->satuan?>' data-stoks='<?php echo $val->stok_awal?>' data-harga='<?php echo $val->harga_barang; ?>' data-count='"+count_next+"'><?php echo $val->kd_barang." - ".$val->nama_barang;?></option>"+
        //     <?php } ?>
        //   "</select>"+
        "</td>"+
        "<td><input type='text' name='satuan[]' id='satuan_"+count_next+"' class='form-control' readonly></td>"+
        "<td><input type='text' name='' id='harga_"+count_next+"' class='form-control' readonly ></td>"+
        "<td><input type='text' name='stoks[]' id='stoks_"+count_next+"' class='form-control' readonly></td>"+
        "<td><input type='text' name='jumlah_masuk[]' id='jumlah_masuk_"+count_next+"' class='form-control' required></td>"+
        "<td><input type='text' name='' id='total_"+count_next+"' class='form-control' readonly></td>"+
        "<input type='hidden' id='harga1_"+count_next+"' name='harga[]'>"+
        "<input type='hidden' id='total1_"+count_next+"' name='total[]'>"+
        "<td><button type='button' class='btn btn-sm btn-danger del'>Del</button></td>"+
      "</tr>"  
    );
    $("#jumlah_masuk_"+count_next).inputFilter(function(value) {
            return /^-?\d*$/.test(value); });
    $(document).on('keyup','#jumlah_masuk_'+count_next,function(){
        if(parseInt($('#jumlah_masuk_'+count_next).val()) > parseInt($('#stoks_'+count_next).val())){
            alert("Qty Melebihi Stok");
            $('.btn-simpan').attr('disabled',true);
        }else{
            $('.btn-simpan').attr('disabled',false);
        }
    });
    $("#rows").val(count_next);
    $('#kd_barang_label_'+count_next).autocomplete({
    source: function( request, response ) {
                  // Fetch data
                  $.ajax({
                    url: "<?=base_url()?>C_barang/get_auto_kd/",
                    type: 'post',
                    dataType: "json",
                    data: {
                      search: request.term
                    },
                    success: function( data ) {
                        console.log(data);
                      response( data );
                    }
                  });
                },
                select: function (event, ui) {
                  
                    if (ui.item) {
                        console.log("ui.item.value: " + ui.item);
                    } else {
                        console.log("ui.item.value is null");
                    }
                    console.log("this.value: " + this.value);
                    //Set selection
                     $('#kd_barang_'+count_next).val(ui.item.value);
                     $('#kd_barang_label_'+count_next).val(ui.item.label);
                     $('#satuan_'+count_next).val(ui.item.satuan).attr('readonly',true); 
                     $('#harga_'+count_next).val(addCommas(ui.item.harga_barang)).attr('readonly',true); 
                     $("#harga1_"+count_next).val(ui.item.harga_barang);
                     $("#stoks_"+count_next).val(ui.item.stok_awal).attr('readonly',true);
                     $('#jumlah_masuk_'+count_next+', #harga_'+count_next).on('input',function() {
                            var qty = parseInt($('#jumlah_masuk_'+count_next).val());
                            var price = parseFloat($('#harga1_'+count_next).val());
                            var total = addCommas(qty * price ? qty * price : 0);
                            var total1 = qty * price ? qty * price : 0;
                            $('#total_'+count_next).val(total).attr('readonly',true);
                            $('#total1_'+count_next).val(total1);
                        });
                  return false;
                }
    });
  });

  $("#data-barang").on('click','.del',function(){
      $(this).parent().parent().remove();
  });

  function test(sel){
    var satuan = $(sel).find(':selected').data('satuan');
    var harga = $(sel).find(':selected').data('harga');
    var stok = $(sel).find(':selected').data('stoks');
    var count = $(sel).find(':selected').data('count');
    $("#satuan_"+count).val(satuan).attr('readonly',true);
    $("#harga_"+count).val(addCommas(harga)).attr('readonly',true);
    $("#harga1_"+count).val(harga);
    $("#stoks_"+count).val(stok).attr('readonly',true);
    $('#jumlah_masuk_'+count+', #harga_'+count).on('input',function() {
        var qty = parseInt($('#jumlah_masuk_'+count).val());
        var price = parseFloat($('#harga1_'+count).val());
        var total = addCommas(qty * price ? qty * price : 0);
        var total1 = qty * price ? qty * price : 0;
        $('#total_'+count).val(total).attr('readonly',true);
        $('#total1_'+count).val(total1);
    });
   
  }

  function addCommas(nStr) {
    nStr += '';
    var x = nStr.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}

function formata(num) {
    return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}

$(document).ready(() => {
    $('#id_customer').select2();
})
</script>