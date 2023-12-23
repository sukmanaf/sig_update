<style>
    .INF_OP{
        font-size: 8pt!important;
    }
</style>

{{-- modal info op --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div id="modal_detail" class="modal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Bangunan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <div class="container" style="margin-top: 10px;"> --}}
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link " id="detail_op_tab" data-bs-toggle="tab" href="#detailOP">Objek Pajak</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#detailBG">Bangunan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#detailUsulan">Usulan</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane container active" id="detailOP">
                                <div class="row" id="detail_tanah">
                                    <div class="card-body border-top p-9">
                                        <div class="row ">
                                            <label class="col-lg-2 col-form-label ">Pilih Tahun Pajak</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                            <select name="INF_TAHUN_PAJAK" id="INF_TAHUN_PAJAK" aria-label="Select a Country" onchange="infTahunChange($(this).val())" data-control="select2" data-placeholder="" class="INF_OP form-select form-select-solid form-select-lg fw-bold">
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <label class="col-lg-2 col-form-label ">Wajib Pajak</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                <input type="text" name="INF_WAJIB_PAJAK" id="INF_WAJIB_PAJAK" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                            <label class="col-lg-2 col-form-label ">Status</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                <input type="text" name="INF_STATUS" id="INF_STATUS"  readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                        </div>
                                        <div class="row ">
                                            <label class="col-lg-2 col-form-label ">Pekerjaan</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                <input type="text" name="INF_PEKERJAAN" id="INF_PEKERJAAN"  readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                            <label class="col-lg-2 col-form-label ">ALamat</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                <textarea type="text" name="INF_ALAMAT" id="INF_ALAMAT"  style="height: 100px!important" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder=""> </textarea>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <label class="col-lg-2 col-form-label ">NOP</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                <input type="text" name="INF_NOP" id="INF_NOP"  readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                            <label class="col-lg-2 col-form-label ">Letak OP</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                <textarea type="text" name="INF_LETAK_OP" id="INF_LETAK_OP"  style="height: 100px!important" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="row ">
                                            <label class="col-lg-2 col-form-label ">Luas Tanah</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                <input type="text" name="INF_LUAS_TANAH" id="INF_LUAS_TANAH"  readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                            <label class="col-lg-2 col-form-label ">Kode ZNT</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                <input type="text" name="INF_KODE_ZNT" id="INF_KODE_ZNT"  readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                        </div>
                                        <div class="row ">
                                            <label class="col-lg-2 col-form-label ">Jenis Tanah</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                <input type="text" name="INF_JENIS_TANAH" id="INF_JENIS_TANAH"  readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                            <label class="col-lg-2 col-form-label ">Jumlah Bangunan</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                <input type="text" name="INF_JUMLAH_BANGUNAN" id="INF_JUMLAH_BANGUNAN"  readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                        </div>
                                        <div class="row ">
                                            <label class="col-lg-2 col-form-label ">NJOP Bumi</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                <input type="text" name="INF_NJOP_BUMI" id="INF_NJOP_BUMI"  readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                            <label class="col-lg-2 col-form-label ">NJOP Bangunan</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                <input type="text" name="INF_NJOP_BANGUNAN" id="INF_NJOP_BANGUNAN"  readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                        </div>
                                        <div class="row ">
                                            <label class="col-lg-2 col-form-label ">PBB</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                <input type="text" name="INF_PBB" id="INF_PBB"  readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="tab-pane container fade" id="detailBG">
                                <div class="row " id="detail_bangunan">
                                    
                                    <div class="card-body border-top p-9">
                                        <div class="row ">
                                            <label class="col-lg-2 col-form-label ">Pilih Bangunan</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                <select name="INF_BANGUNAN" id="INF_BANGUNAN" onchange="infBgChange($(this).val())" aria-label="Select a Country" data-control="select2" data-placeholder="2022" class="form-select form-select-solid form-select-lg fw-bold">
                                                </select>
                                            </div>
                                            
                                            <label class="col-lg-2 col-form-label ">NOP</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                <input type="text" name="INF_NOPB" id="INF_NOPB" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                        </div>
                                        
                                        <div class="row ">
                                            <label class="col-lg-2 col-form-label ">Jumlah Bangunan</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                <input type="text" name="INF_JUMLAH_BANGUNANB" id="INF_JUMLAH_BANGUNANB" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                            <label class="col-lg-2 col-form-label ">Bangunan Ke</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                <input type="text" name="INF_BANGUNAN_KE" id="INF_BANGUNAN_KE" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                        </div>
                                        <div class="row ">
                                            <label class="col-lg-2 col-form-label ">Penggunaan Bangunan</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                <input type="text" name="INF_PENGGUNAAN_BANGUNAN" id="INF_PENGGUNAAN_BANGUNAN" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                            <label class="col-lg-2 col-form-label ">Luas Bangunan</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                <input type="text" name="INF_LUAS_BANGUNAN" id="INF_LUAS_BANGUNAN" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                        </div>
                                        <div class="row ">
                                            <label class="col-lg-2 col-form-label ">Jumlah Lantai</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                <input type="text" name="INF_JUMLAH_LANTAI" id="INF_JUMLAH_LANTAI" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                            <label class="col-lg-2 col-form-label ">Tahun Dibangun</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                <input type="text" name="INF_TAHUN_DIBANGUN" id="INF_TAHUN_DIBANGUN" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                        </div>
                                        <div class="row ">
                                            <label class="col-lg-2 col-form-label ">Tahun DI Renovasi</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                <input type="text" name="INF_TAHUN_RENOVASI" id="INF_TAHUN_RENOVASI" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                            <label class="col-lg-2 col-form-label ">Konstruksi</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                <input type="text" name="INF_KONTRUKSI" id="INF_KONTRUKSI" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                        </div>
                                        <div class="row ">
                                            <label class="col-lg-2 col-form-label ">Atap</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                <input type="text" name="INF_ATAP" id="INF_ATAP" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                            <label class="col-lg-2 col-form-label ">Dinding</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                <input type="text" name="INF_DINDING" id="INF_DINDING" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                        </div>
                                        <div class="row ">
                                            <label class="col-lg-2 col-form-label ">Lantai</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                <input type="text" name="INF_LANTAI" id="INF_LANTAI" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                            <label class="col-lg-2 col-form-label ">Langit-langit</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                <input type="text" name="INF_LANGIT_LANGIT" id="INF_LANGIT_LANGIT" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                        </div>
                                        <div class="row ">
                                            <label class="col-lg-2 col-form-label ">Kondisi</label>
                                            <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                <input type="text" name="INF_KONDISI" id="INF_KONDISI" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                        </div>
                                        <div class="row mb-12">
                                            <label class="col-lg-2 col-form-label ">Foto</label>
                                            <div id="carouselExample" class="carousel slide">
                                                <div class="carousel-inner" >
                                                    
                                                    
                                                </div>
                                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane container fade" id="detailUsulan">
                                <div class="row " id="detail_bangunan">
                                    <div class="card-body border-top p-9">
                                        <div class="row mb-12">
                                                <form method="POST" enctype="multipart/form-data" id="usulanForm"> @csrf
                                                    <input type="hidden" id="usulanNop">
                                                    <label class="col-lg-2 col-form-label ">Usulan</label>
                                                    <textarea name="usulanText" class="form-control" style="width:100%" id="usulanText" cols="30" rows="10"></textarea>
                                                    </br>
                                                    <button type="button" onclick="saveUsulan()" class="btn btn-primary">Simpan</button>
                                                </form>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    {{-- </div> --}}
                    
                
                <div class="modal-footer">
                    <!-- <button type="button" onclick="show_op()" id="btn_op" class="btn btn-primary ">Detail Objek Pajak</button>
                    <button type="button" onclick="show_bng()" id="btn_bng" class="btn btn-primary ">Detail Bangunan</button> -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script>

function infTahunChange(tahun) {
        console.log(tahun)
        console.log(modal_detail_op)
        $.each(modal_detail_op, function( i,v ){
            if(i == tahun){
                $.each(v, function( ii,vv ){
                    if(ii != 'TAHUN_PAJAK' && ii != 'NPWP'){
                        if (ii == 'PBB' || ii == 'NJOP_BUMI' || ii == 'NJOP_BANGUNAN'  ) {
                            $('#INF_'+ii).val(formatRupiah(parseInt(vv)))
                        }else{
                        

                            $('#INF_'+ii).val(vv)
                        }
                    }
                })
            }
        })
    }
    function infBgChange(tahun) {
    //    console.log(tahun)
        $.each(modal_detail_bg, function( i,v ){
            if(i == tahun){
                $.each(v, function( ii,vv ){
                    // if(ii != 'BANGUNAN_KE'){
                    if (ii == 'NOP' || ii == 'JUMLAH_BANGUNAN') {
                        $('#INF_'+ii+'B').val(vv)
                    }
                    $('#INF_'+ii).val(vv)
                    // }
                })  
            }
        })
    }

   

    </script>