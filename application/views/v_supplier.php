<div class="col-lg-3">
    <div class="card m-b-30">
        <div class="card-body">

            <h4 class="mt-0 header-title" id="title"></h4>
            <div class="alert alert-success alert-dismissible fade show mb-0" role="alert" id="alert-simpan-berhasil" style="display:none;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Berhasil !</strong> Data Berhasil Disimpan
            </div>
            <div class="alert alert-success alert-dismissible fade show mb-0" role="alert" id="alert-update-berhasil" style="display:none;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Berhasil !</strong> Data Berhasil Dirubah
            </div>
            <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert" id="salah" style="display:none;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Gagal !</strong> Data Gagal Disimpan
            </div>
            
            <!-- <button id="tombol-edit">Klik</button>
            <button id="tombol-balikin">Balikin</button> -->
            <form class="" action="#" id="frm_data_supplier">
                <input type="hidden" name="status" id="s" value="baru">
                <div class="form-group">
                    <label>KD Supplier</label>
                    <input type="text" class="form-control" required placeholder="CUS-xxx" id="kd_supplier" disabled/>
                    <input type="hidden" class="form-control" id="kd_supplier_1" name="kd_supplier"/>
                </div>
                <div class="form-group">
                    <label>Nama Supplier</label>
                    <input type="text" class="form-control" required placeholder="Ex : nama" id="nama_supplier" name="nama_supplier"/>
                </div>
                <div class="form-group">
                    <label>PIC Supplier</label>
                    <input type="text" class="form-control" required placeholder="Ex : nama" id="pic_supplier" name="pic_supplier"/>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat_supplier" id="alamat_supplier" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>No Hp</label>
                    <input type="text" class="form-control" required placeholder="08960xxxx" id="no_hp" name="no_hp"/>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" required placeholder="xxxx@mail.com" id="email" name="email"/>
                </div>
            
                <div class="form-group">
                    <div>
                        <button type="button" class="btn btn-primary waves-effect waves-light" id="btn-simpan">
                            <span id="txt-proses">Tambah</span>
                        </button>
                        <button type="reset" class="btn btn-secondary waves-effect m-l-5" id="btn-reset">
                            Cancel
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div> <!-- end col -->

<div class="col-lg-9">
    <div class="card m-b-30">
        <div class="card-body">

            <h4 class="mt-0 header-title">Data Supplier</h4>

            <table id="datatable" class="table table-bordered " style="border-collapse: collapse; border-spacing: 0; width: 100%;font-size:12px;">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Supplier</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Hp</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $no = 1; foreach ($get_supplier as $val) { ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $val->kd_supplier ?></td>
                        <td><?php echo $val->nama_supplier ?></td>
                        <td><?php echo $val->alamat_supplier ?></td>
                        <td><?php echo $val->no_hp;?></td>
                        <td><?php echo $val->email;?></td>
                        <td>
                            <button type="button" class="btn-edit btn btn-info btn-sm" data-id="<?php echo $val->kd_supplier ?>" >Edit</button>
                            <a href="<?php echo base_url()?>c_supplier/hapus/<?php echo $val->kd_supplier?>" class="btn btn-danger btn-sm" onClick="return confirm('Apakah Anda Ingin Menghapusnya ?')">Hapus</a>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>

        </div>
    </div>
</div> <!-- end col -->
            
<script>
    $( document ).ready(function() {
        get_auto_number();
    });
                
    $('#title').text('Tambah Supplier');
    
    var status,url;
    status = "";
    //var status_text = $('#status').val('baru');
    function clear_form() {
        get_auto_number();
        $('#s').val('baru');
        $('#nama_supplier').val('');
        $('#alamat_supplier').val('');
        $('#no_hp').val('');
        $('#email').val('');
        $('#pic_supplier').val('');
        $('#txt-proses').text('Tambah');
        $('#title').text('Tambah Supplier');
    }

    

    $('#btn-reset').on('click',function() {
       clear_form(); 
    });

    $('#btn-simpan').on('click',function(){
        var form_data = $('#frm_data_supplier').serialize();
        if($('#s').val() == "baru"){
            proses("baru",form_data);
            //console.log('status : baru => '+form_data);
        }else if($('#s').val() == "update"){
            proses("update",form_data);
            //console.log('status : update => '+form_data);
        }
    });

    $('.btn-edit').on('click',function () {
       var kd_supplier = $(this).attr("data-id");
       //alert(kd_supplier);
       $('#title').text('Edit Supllier');
       $('#s').val('update');
       $('#txt-proses').text('Rubah');
       $('#kd_supplier').attr('readonly',true);
       //console.log(kd_supplier);
       $.ajax({
            type: 'GET',
            url: "<?php echo base_url()?>C_supplier/get_data/"+kd_supplier,
            dataType : "JSON",
            beforeSend: function() {
                // setting a timeout
               
            },
            success: function(data) {
                //var hasil = JSON.parse(data);
                
                $.each(data,function(kd_supplier, nama_supplier, alamat_supplier, no_hp, email){
                    $('#kd_supplier').val(data.kd_supplier);
                    $('#kd_supplier_1').val(data.kd_supplier);
                    $('#nama_supplier').val(data.nama_supplier);
                    $('#alamat_supplier').val(data.alamat_supplier);
                    $('#pic_supplier').val(data.pic_supplier);
                    $('#no_hp').val(data.no_hp);
                    $('#email').val(data.email);
                });
            },
            error: function(xhr) { // if error occured
               
            },
            complete: function() {
                
            }
        });
    });


    function proses(status,form_data) {
    //    alert(form_data);
        if(status == "baru"){
            url = "<?php echo base_url()?>C_supplier/simpan";
            console.log(url+" ads"+form_data);
        }else if(status == "update"){
            url = "<?php echo base_url()?>C_supplier/rubah";
            console.log(url+" ads"+form_data);
        }
        $.ajax({
            type: 'POST',
            url: url,
            data: form_data,
            beforeSend: function() {
                // setting a timeout
               
            },
            success: function(data) {
                console.log(data);
                var hasil = JSON.parse(data);
                if(hasil.status == "sukses"){
                    $('#alert-simpan-berhasil').show();
                    clear_form(); 
                    setTimeout(function() {
                        window.location.reload();
                    },0);
                }else if(hasil.status == "sukses-update"){
                    $('#alert-update-berhasil').show();
                    clear_form(); 
                    setTimeout(function() {
                        window.location.reload();
                    },0);
                }else if(hasil.status == "gagal"){
                    $('#salah').show();
                    clear_form();
                }
            },
            error: function(xhr) { // if error occured
               
            },
            complete: function() {
                
            }
        });
    }

    function get_auto_number(){
        $.ajax({
            type: 'GET',
            url: "<?php echo base_url()?>C_supplier/get_auto",
            dataType : "JSON",
            beforeSend: function() {
                // setting a timeout
               
            },
            success: function(data) {
                //var hasil = JSON.parse(data);
                $('#kd_supplier').val(data).attr('readonly',false);
                $('#kd_supplier_1').val(data).attr('readonly',false);
            },
            error: function(xhr) { // if error occured
               
            },
            complete: function() {
                
            }
        });
    }

    

</script>