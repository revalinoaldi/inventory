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
            <form class="" action="#" id="frm_data_customer">
                <input type="hidden" name="status" id="s" value="baru">
                <div class="form-group">
                    <label>KD Customer</label>
                    <input type="text" class="form-control" required placeholder="CUS-xxx" id="kode_customer" disabled/>
                    <input type="hidden" class="form-control" id="kode_customer_1" name="kode_customer"/>
                </div>
                <div class="form-group">
                    <label>Nama Customer</label>
                    <input type="text" class="form-control" required placeholder="Ex : nama" id="nama_customer" name="nama_customer"/>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat_customer" id="alamat_customer" class="form-control"></textarea>
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

            <h4 class="mt-0 header-title">Data Customer</h4>

            <table id="datatable" class="table table-bordered " style="border-collapse: collapse; border-spacing: 0; width: 100%;font-size:12px;">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Customer</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Hp</th>
                    <th>Email</th>
                    <th>Aksi</th>
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
                        <td>
                            <button type="button" class="btn-edit btn btn-info btn-sm" data-id="<?php echo $val->kode_customer ?>" >Edit</button>
                            <a href="<?php echo base_url()?>C_barang/hapus/<?php echo $val->kode_customer?>" class="btn btn-danger btn-sm" onClick="return confirm('Apakah Anda Ingin Menghapusnya ?')">Hapus</a>
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
                
    $('#title').text('Tambah Customer');
    
    var status,url;
    status = "";
    //var status_text = $('#status').val('baru');
    function clear_form() {
        get_auto_number();
        $('#s').val('baru');
        $('#nama_customer').val('');
        $('#alamat_customer').val('');
        $('#no_hp').val('');
        $('#email').val('');
        $('#txt-proses').text('Tambah');
        $('#title').text('Tambah Customer');
    }

    

    $('#btn-reset').on('click',function() {
       clear_form(); 
    });

    $('#btn-simpan').on('click',function(){
        var form_data = $('#frm_data_customer').serialize();
        if($('#s').val() == "baru"){
            proses("baru",form_data);
            //console.log('status : baru => '+form_data);
        }else if($('#s').val() == "update"){
            proses("update",form_data);
            //console.log('status : update => '+form_data);
        }
    });

    $('.btn-edit').on('click',function () {
       var kode_customer = $(this).attr("data-id");
       //alert(kode_customer);
       $('#title').text('Edit Customer');
       $('#s').val('update');
       $('#txt-proses').text('Rubah');
       $('#kode_customer').attr('readonly',true);
       //console.log(kode_customer);
       $.ajax({
            type: 'GET',
            url: "<?php echo base_url()?>C_customer/get_data/"+kode_customer,
            dataType : "JSON",
            beforeSend: function() {
                // setting a timeout
               
            },
            success: function(data) {
                //var hasil = JSON.parse(data);
                
                $.each(data,function(kode_customer, nama_customer, alamat_customer, no_hp, email){
                    $('#kode_customer').val(data.kode_customer);
                    $('#kode_customer_1').val(data.kode_customer);
                    $('#nama_customer').val(data.nama_customer);
                    $('#alamat_customer').val(data.alamat_customer);
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
            url = "<?php echo base_url()?>C_customer/simpan";
            console.log(url+" ads"+form_data);
        }else if(status == "update"){
            url = "<?php echo base_url()?>C_customer/rubah";
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
            url: "<?php echo base_url()?>C_customer/get_auto",
            dataType : "JSON",
            beforeSend: function() {
                // setting a timeout
               
            },
            success: function(data) {
                //var hasil = JSON.parse(data);
                $('#kode_customer').val(data).attr('readonly',false);
                $('#kode_customer_1').val(data).attr('readonly',false);
            },
            error: function(xhr) { // if error occured
               
            },
            complete: function() {
                
            }
        });
    }

    

</script>