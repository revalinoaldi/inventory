<div class="col-lg-12">
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
            <?php foreach ($get_user as $val) { ?>
                <form class="" action="#" id="frm_data_customer">
                    <input type="hidden" name="status" id="s" value="baru">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" required placeholder="Username" name="username" disabled value="<?php echo $val->username?>" />
                        <input type="hidden" class="form-control" id="id_login" name="id_login" value="<?php echo $this->session->userdata('id_login');?>" />
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password" id="password" name="password"/>
                         <input type="hidden" class="form-control" placeholder="Password" id="password_lama" name="password_lama" value="<?php echo $val->password?>" />
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" required placeholder="Ex : nama" id="nama" name="nama" value="<?php echo $val->nama?>"/>
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" class="form-control" placeholder="" id="foto" name="foto"/>
                        <input type="hidden" class="form-control" placeholder="" id="foto" name="foto_lama" value="<?php echo $val->foto?>" />
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light" id="btn-simpan">
                                <span id="txt-proses">Simpan</span>
                            </button>
                            <button type="reset" class="btn btn-secondary waves-effect m-l-5" id="btn-reset">
                                Cancel
                            </button>
                        </div>
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>
</div> <!-- end col -->

            
<script>
    $( document ).ready(function() {
        get_auto_number();
    });
                
    $('#title').text('Profil');
    
    var status,url;
    status = "";
    //var status_text = $('#status').val('baru');
    function clear_form() {
        // get_auto_number();
        // $('#s').val('baru');
        // $('#nama_customer').val('');
        // $('#alamat_customer').val('');
        // $('#no_hp').val('');
        // $('#email').val('');
        // $('#txt-proses').text('Tambah');
        // $('#title').text('Tambah Customer');
    }

    

    $('#btn-reset').on('click',function() {
       clear_form(); 
    });

    // $('#btn-simpan').on('click',function(){
    //     var form_data = $('#frm_data_customer').serialize();
    //     if($('#s').val() == "baru"){
    //         proses("baru",form_data);
    //         //console.log('status : baru => '+form_data);
    //     }else if($('#s').val() == "update"){
    //         proses("update",form_data);
    //         //console.log('status : update => '+form_data);
    //     }
    // });

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
                    $('#id_login').val(data.kode_customer);
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

    $('#frm_data_customer').submit(function(e){
            e.preventDefault();
            $('#btn-save').prop('disabled',true);
            var form_data = $('#frm_data_customer')[0];
            var data = new FormData(form_data);
            var set_url = "";
            var foto = $('#foto').get(0).files[0];
            data.append('foto', foto);
            

            set_url = "<?php echo base_url('C_customer/update')?>";
            
            $.ajax({
                type: 'POST',
                url: set_url,
                dataType: 'json',
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                success:function(data){
                    //console.log(res);
                    console.log(data);
                    // var hasil = JSON.parse(data);
                    if(data.status == "sukses"){
                        $('#alert-simpan-berhasil').show();
                        clear_form(); 
                        setTimeout(function() {
                            window.location.reload();
                        },0);
                    }else if(data.status == "sukses-update"){
                        $('#alert-update-berhasil').show();
                        clear_form(); 
                        setTimeout(function() {
                            window.location.reload();
                        },0);
                    }else if(data.status == "gagal"){
                        $('#salah').show();
                        clear_form();
                    }
                    
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