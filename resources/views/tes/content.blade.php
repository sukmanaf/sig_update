
</head>
@extends('layouts.app')
@section('content')
   
            <div class="card" id="card_map">
                <div id="map" class="map_part" style=""></div>
                <div id="div_save" class="hd"> 
                    <button id="" onclick="save_draw()" class="btn btn-sm btn-primary">Simpan</button>
                    <button id="" onclick="cancel_draw()" class="btn btn-sm btn-danger">Buang</button>
                </div>
                <div id="div_delete_nop" class=" hd"  style="background-color: white;border-radius: 10px">
                    <input type="text" class="form-control" name="inp_delete_nop" id="inp_delete_nop" readonly="">
                    <br>
                    <button id="" onclick="delete_nop()" class="btn btn-sm btn-primary">Hapus NOP</button>
                    <button id="" onclick="cancel_edit_nop()" class="btn btn-sm btn-danger">Kembali</button>
                    <button id="" onclick="copy_polygon_nop()" class="btn btn-sm btn-warning">Copy</button>
                    <button id="btn_save_edit_nop" onclick="edit_draw()" class="btn btn-sm btn-success hd">Simpan</button>
                </div>

                <div id="div_delete_blok" class="hd"  style="background-color: white;border-radius: 10px">
                    <input type="text" class="form-control" name="inp_delete_blok" id="inp_delete_blok" readonly="">
                    <br>
                    <button id="" onclick="delete_blok()" class="btn btn-sm btn-primary">Hapus BLOK</button>
                    <button id="" onclick="cancel_edit_blok()" class="btn btn-sm btn-danger">Kembali</button>
                    <button id="" onclick="copy_polygon_blok()" class="btn btn-sm btn-warning">Copy</button>
                    <button id="btn_save_edit_blok" onclick="edit_draw()" class="btn btn-sm btn-success hd">Simpan</button>
                </div>

                <div id="div_delete_bangunan" class="hd"  style="background-color: white;border-radius: 10px">
                    <input type="text" class="form-control" name="inp_delete_bangunan" id="inp_delete_bangunan" readonly="">
                    <br>
                    <button id="" onclick="delete_bng()" class="btn btn-sm btn-primary">Hapus Bangunan</button>
                    <button id="" onclick="cancel_edit_bg()" class="btn btn-sm btn-danger">Kembali</button>
                    <button id="" onclick="copy_polygon_bg()" class="btn btn-sm btn-warning">Copy</button>
                    <button id="btn_save_edit_bg" onclick="edit_draw()" class="btn btn-sm btn-success hd">Simpan</button>
                </div>

                


                <button id="btn_save" class="btn btn-primary div_detail">Simpan</button>
                <div id="div_jenis_tanah" class="card  div_detail">
                    <div class="row" id="">
                        <div class="col-md-10 header_detail">
                                <!-- <h5><center>Jenis Penggunaan Tanah</center></h5>  -->
                        </div>
                        <div class="col-md-2">
                            <div class="btn btn-sm btn-icon btn-active-light-primary" id="" onclick="$('.btn_jenis_tanah').click()"> 
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="div_jenis_tanah_body" class="div_detail_body"></div>
                    
                    <!--end::Card body-->
                </div>
                <div id="div_jenis_bangunan" class="card div_detail text-right" style="">
                        <div class="row" id="">
                            <div class="col-md-10 header_detail">
                                    <!-- <h5><center>Jenis Penggunaan Bangunan</center></h5>  -->
                            </div>
                            <div class="col-md-2">
                                <div class="btn btn-sm btn-icon btn-active-light-primary" id="" onclick="$('.btn_jenis_bangunan').click()"> 
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div id="div_jenis_bangunan_body" class="div_detail_body"></div>
                </div>
                
                <div id="div_buku" class="card div_detail" style="">
                    <div class="row" id="">
                        <div class="col-md-10 header_detail">
                                <!-- <h5><center>Buku<center></h5> -->
                        </div>
                        <div class="col-md-2">
                            <div class="btn btn-sm btn-icon btn-active-light-primary" id="" onclick="$('.btn_buku').click()"> 
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 5px">
                        <div class="col-md-2">
                            <div class="" style="background-color: red;height: 25px;width: 25px"></div>
                        </div>
                        <div class="col-md-7"><span style="font-size: 12px">Buku I</span></div>
                        <div class="col-md-3"><span style="font-size: 12px">[923]</span></div>
                    </div>
                    <div class="row" style="margin-top: 5px">
                        <div class="col-md-2">
                            <div class="" style="background-color: blue;height: 25px;width: 25px"></div>
                        </div>
                        <div class="col-md-7"><span style="font-size: 12px">Buku II</span></div>
                        <div class="col-md-3"><span style="font-size: 12px">[825]</span></div>
                    </div>
                    <div class="row" style="margin-top: 5px">
                        <div class="col-md-2">
                            <div class="" style="background-color: purple;height: 25px;width: 25px"></div>
                        </div>
                        <div class="col-md-7"><span style="font-size: 12px">BUKU III</span></div>
                        <div class="col-md-3"><span style="font-size: 12px">[727]</span></div>
                    </div>
                    <div class="row" style="margin-top: 5px">
                        <div class="col-md-2">
                            <div class="" style="background-color: orange;height: 25px;width: 25px"></div>
                        </div>
                        <div class="col-md-7"><span style="font-size: 12px">BUKU IV</span></div>
                        <div class="col-md-3"><span style="font-size: 12px">[90]</span></div>
                    </div>
                    <div class="row" style="margin-top: 5px">
                        <div class="col-md-2">
                            <div class="" style="background-color: aqua;height: 25px;width: 25px"></div>
                        </div>
                        <div class="col-md-7"><span style="font-size: 12px">BUKU V</span></div>
                        <div class="col-md-3"><span style="font-size: 12px">[89]</span></div>
                    </div>
                    <div class="row" style="margin-top: 5px">
                        <div class="col-md-2">
                            <div class="" style="background-color: white;height: 25px;width: 25px"></div>
                        </div>
                        <div class="col-md-7"><span style="font-size: 12px">Ketetapan Nol </span></div>
                        <div class="col-md-3"><span style="font-size: 12px">[10]</span></div>
                    </div>
                </div>
                <div id="div_npwp" class="card div_detail" style="">
                    <div class="row" id="">
                        <div class="col-md-10 header_detail">
                            <h5 style="color:white"><center>Objek Pajak</center> </h5>
                            <h5  style="color:white"><center>Yang Mempunyai NIK</center></h5>
                        </div>
                        <div class="col-md-2">
                            <div class="btn btn-sm btn-icon btn-active-light-primary" id="" onclick="$('.btn_npwp').click()"> 
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="div_npwp_body" class="div_detail_body"></div>

                </div>
                <div id="div_status_pembayaran" class="card div_detail" style="">
                    <div class="row" id="">
                        <div class="col-md-10 header_detail">
                            <!-- <h5>Status Pembayaran PBB</h5> -->
                        </div>
                        <div class="col-md-2">
                            <div class="btn btn-sm btn-icon btn-active-light-primary" id="" onclick="$('.btn_status_bayar').click()"> 
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 5px">
                        <div class="col-md-2">
                            <div class="" style="background-color: purple;height: 25px;width: 25px"></div>
                        </div>
                        <div class="col-md-7"><span style="font-size: 12px">Tidak Ada SPPT</span></div>
                        <div class="col-md-3"><span style="font-size: 12px">[23]</span></div>
                    </div>
                    <div class="row" style="margin-top: 5px">
                        <div class="col-md-2">
                            <div class="" style="background-color: aqua;height: 25px;width: 25px"></div>
                        </div>
                        <div class="col-md-7"><span style="font-size: 12px">Sudah Bayar</span></div>
                        <div class="col-md-3"><span style="font-size: 12px">[299]</span></div>
                    </div>
                    <div class="row" style="margin-top: 5px">
                        <div class="col-md-2">
                            <div class="" style="background-color: white;height: 25px;width: 25px"></div>
                        </div>
                        <div class="col-md-7"><span style="font-size: 12px">Belum Bayar</span></div>
                        <div class="col-md-3"><span style="font-size: 12px">[89]</span></div>
                    </div>
                </div>
                <div id="div_individu" class="card div_detail" style="">
                        <div class="row" id="">
                        <div class="col-md-10 header_detail">
                            <h5 style="color:white">Peta OP Dengan Nilai Individu</h5>
                        </div>
                        <div class="col-md-2">
                            <div class="btn btn-sm btn-icon btn-active-light-primary" id="" onclick="$('.btn_znt').click()"> 
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="div_individu_body" class="div_detail_body"></div>
                </div>
                
                
                <div id="div_tematik" class="card div_detail" style="">
                        <div class="row" id="">
                        <div class="col-md-10 ">
                            <h5  class="header_detail" style="color:white">Peta OP Dengan Nilai Individu</h5>
                        </div>
                        <div class="col-md-2">
                            <div class="btn btn-sm btn-icon btn-active-light-primary" id="" onclick="$('.btn_znt').click()"> 
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="div_tematik_body" class="div_detail_body"></div>
                </div>
                
                

                <!-- =========== Modal Detail ============ -->
                <meta name="csrf-token" content="{{ csrf_token() }}" />
                <div id="modal_detail" class="modal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Bangunan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container" style="margin-top: 10px;">
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
                                                    <div class="row mb-6">
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">Pilih Tahun Pajak</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                        <select name="INF_TAHUN_PAJAK" id="INF_TAHUN_PAJAK" aria-label="Select a Country" onchange="infTahunChange($(this).val())" data-control="select2" data-placeholder="" class="form-select form-select-solid form-select-lg fw-bold">
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-6">
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">Wajib Pajak</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                            <input type="text" name="INF_WAJIB_PAJAK" id="INF_WAJIB_PAJAK" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">Status</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                            <input type="text" name="INF_STATUS" id="INF_STATUS"  readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                                    </div>
                                                    <div class="row mb-6">
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">Pekerjaan</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                            <input type="text" name="INF_PEKERJAAN" id="INF_PEKERJAAN"  readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">ALamat</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                            <textarea type="text" name="INF_ALAMAT" id="INF_ALAMAT"  style="height: 100px!important" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder=""> </textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-6">
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">NOP</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                            <input type="text" name="INF_NOP" id="INF_NOP"  readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">Letak OP</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                            <textarea type="text" name="INF_LETAK_OP" id="INF_LETAK_OP"  style="height: 100px!important" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""></textarea>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row mb-6">
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">Luas Tanah</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                            <input type="text" name="INF_LUAS_TANAH" id="INF_LUAS_TANAH"  readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">Kode ZNT</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                            <input type="text" name="INF_KODE_ZNT" id="INF_KODE_ZNT"  readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                                    </div>
                                                    <div class="row mb-6">
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">Jenis Tanah</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                            <input type="text" name="INF_JENIS_TANAH" id="INF_JENIS_TANAH"  readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">Jumlah Bangunan</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                            <input type="text" name="INF_JUMLAH_BANGUNAN" id="INF_JUMLAH_BANGUNAN"  readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                                    </div>
                                                    <div class="row mb-6">
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">NJOP Bumi</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                            <input type="text" name="INF_NJOP_BUMI" id="INF_NJOP_BUMI"  readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">NJOP Bangunan</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                            <input type="text" name="INF_NJOP_BANGUNAN" id="INF_NJOP_BANGUNAN"  readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                                    </div>
                                                    <div class="row mb-6">
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">PBB</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                            <input type="text" name="INF_PBB" id="INF_PBB"  readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="tab-pane container fade" id="detailBG">
                                            <div class="row " id="detail_bangunan">
                                                
                                                <div class="card-body border-top p-9">
                                                    <div class="row mb-6">
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">Pilih Bangunan</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                            <select name="INF_BANGUNAN" id="INF_BANGUNAN" onchange="infBgChange($(this).val())" aria-label="Select a Country" data-control="select2" data-placeholder="2022" class="form-select form-select-solid form-select-lg fw-bold">
                                                            </select>
                                                        </div>
                                                        
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">NOP</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                            <input type="text" name="INF_NOPB" id="INF_NOPB" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                                    </div>
                                                    
                                                    <div class="row mb-6">
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">Jumlah Bangunan</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                            <input type="text" name="INF_JUMLAH_BANGUNANB" id="INF_JUMLAH_BANGUNANB" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">Bangunan Ke</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                            <input type="text" name="INF_BANGUNAN_KE" id="INF_BANGUNAN_KE" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                                    </div>
                                                    <div class="row mb-6">
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">Penggunaan Bangunan</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                            <input type="text" name="INF_PENGGUNAAN_BANGUNAN" id="INF_PENGGUNAAN_BANGUNAN" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">Luas Bangunan</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                            <input type="text" name="INF_LUAS_BANGUNAN" id="INF_LUAS_BANGUNAN" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                                    </div>
                                                    <div class="row mb-6">
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">Jumlah Lantai</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                            <input type="text" name="INF_JUMLAH_LANTAI" id="INF_JUMLAH_LANTAI" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">Tahun Dibangun</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                            <input type="text" name="INF_TAHUN_DIBANGUN" id="INF_TAHUN_DIBANGUN" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                                    </div>
                                                    <div class="row mb-6">
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">Tahun DI Renovasi</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                            <input type="text" name="INF_TAHUN_RENOVASI" id="INF_TAHUN_RENOVASI" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">Konstruksi</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                            <input type="text" name="INF_KONTRUKSI" id="INF_KONTRUKSI" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                                    </div>
                                                    <div class="row mb-6">
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">Atap</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                            <input type="text" name="INF_ATAP" id="INF_ATAP" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">Dinding</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                            <input type="text" name="INF_DINDING" id="INF_DINDING" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                                    </div>
                                                    <div class="row mb-6">
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">Lantai</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                            <input type="text" name="INF_LANTAI" id="INF_LANTAI" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">Langit-langit</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                            <input type="text" name="INF_LANGIT_LANGIT" id="INF_LANGIT_LANGIT" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                                    </div>
                                                    <div class="row mb-6">
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">Kondisi</label>
                                                        <div class="col-lg-4 fv-row fv-plugins-icon-container">
                                                            <input type="text" name="INF_KONDISI" id="INF_KONDISI" readonly class="INF_OP form-control form-control-lg form-control-solid inp-inf" placeholder="" value=""> </div>
                                                    </div>
                                                    <div class="row mb-12">
                                                        <label class="col-lg-2 col-form-label fw-bold fs-6">Foto</label>
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
                                                                <label class="col-lg-2 col-form-label fw-bold fs-6">Usulan</label>
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
                                </div>
                               
                            
                            <div class="modal-footer">
                                <!-- <button type="button" onclick="show_op()" id="btn_op" class="btn btn-primary ">Detail Objek Pajak</button>
                                <button type="button" onclick="show_bng()" id="btn_bng" class="btn btn-primary ">Detail Bangunan</button> -->
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============ end modal detail ============= -->
            <!-- ============  modal search ============= -->
            
            <!-- ============ end modal search ============= -->
            <!-- Vertically centered modal -->
            <!-- Vertically centered modal -->
            <div id="mod_add" class="modal fade"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nop</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" enctype="multipart/form-data" id="nop_addForm"> @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Nop</label>
                                    <input type="text" class="form-control" name="nop" id="nop_add">
                                    <input type="hidden" class="form-control" name="geom" id="nop_add_geom"> 
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Jenis</label>
                                    </br>
                                    <select name="jenis" class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true" onchange="jenis_change($(this).val())">
                                        <option value="1">Nop</option>
                                        <option value="2">Blok</option>
                                        <option value="3">Bangunan</option>
                                    </select>
                                </div>
                                <div class="mb-3" id="img_nop">
                                    <label for="message-text" class="col-form-label">Gambar</label>
                                    </br>
                                    <div id="img_nop_file" >
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="mod_edit" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit NOP</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="nop_editForm" class="from-prevent-multiple-submits" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Nop</label>
                                    <input type="text" class="form-control" name="xnop" id="nop_edit">
                                    <input type="hidden" class="form-control" name="xnop_old" id="nop_edit_old">
                                    <input type="hidden" class="form-control" name="xgeom" id="nop_edit_geom"> 
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Jenis</label>
                                    </br>
                                    <select name="xjenis" id="xjenis" class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true" onchange="xjenis_change($(this).val())">
                                        <option value="2">Blok</option>
                                        <option value="1">Nop</option>
                                        <option value="3">Bangunan</option>
                                    </select>
                                </div>
                                <div class="mb-3" id="ximg_nop">
                                    <label for="message-text" class="col-form-label">Gambar</label>
                                    </br>
                                    <input type="file" name="xfile" id="xfile"> </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" >Simpan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <div id="kt_drawer_chat" class="bg-body w-md-300px" data-kt-drawer="true" data-kt-drawer-name="chat" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_drawer_chat_toggle" data-kt-drawer-close="#kt_drawer_chat_close">
        <!--begin::Messenger-->
      
        <!--end::Messenger-->
    </div>

    <!--begin::Items-->
   
    <!--end::Items-->

    <div class="modal fade" id="kt_modal_users_search" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered  modal-lg">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" id="closeModalSearch" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                    <!--begin::Content-->
                    <div class="text-center mb-13">
                        <h1 class="mb-3">Pencarian</h1>
                        <div class="text-muted fw-bold fs-5"></div>
                    </div>
                    <!--end::Content-->
                    <!--begin::Search-->
                    <div id="kt_modal_users_search_handler" data-kt-search-keypress="true" data-kt-search-min-length="2" data-kt-search-enter="enter" data-kt-search-layout="inline" class="">
                        <!--begin::Form-->
                        <form action="#" id="cariNop" data-kt-search-element="form" class="w-300 position-relative mb-5" autocomplete="off">
                            <!--begin::Hidden input(Added to disable form autocomplete)-->
                            
                            <div class="input-group rounded">
                                <input type="search" class="form-control rounded" onkeypress="javascript:void(0)" placeholder="Search" aria-label="Search" aria-describedby="search-addon" id="cari_nop" value="" />
                                <span class="input-group-text border-0" onclick="cari_nop()" id="search-addon">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                            <!--end::Input-->
                            <!--begin::Spinner-->
                            <span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5" data-kt-search-element="spinner">
                                <span class="spinner-border h-15px w-15px align-middle text-muted"></span>
                            </span>
                            <!--end::Spinner-->
                            <!--begin::Reset-->
                            <span class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 me-5 d-none" data-kt-search-element="clear">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                <span class="svg-icon svg-icon-2 svg-icon-lg-1 me-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                                <div class="d-flex mt-2 mb-2">
                                <!--begin::Radio-->
                                <div class="form-check form-check-custom form-check-solid pe-4">
                                    <input class="form-check-input" type="radio" value="1" name="jns_cari" id="search_nop" checked="checked">
                                    <label class="form-check-label" for="search_nop">NOP</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid pe-4">
                                    <input class="form-check-input" type="radio" value="2" name="jns_cari" id="search_nama">
                                    <label class="form-check-label" for="search_nama">Nama</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid pe-4">
                                    <input class="form-check-input" type="radio" value="3" name="jns_cari" id="search_alamat">
                                    <label class="form-check-label" for="search_alamat">Alamat</label>
                                </div>
                                <!--end::Radio-->
                            </div>
                            <div id="divTableSearch" class="card-body pt-0 hd" >
                                <hr>
                                <!--begin::Table container-->
                                    <!--begin::Table-->
                                    <table id="kt_profile_overview_table" class="table table-row-bordered table-row-dashed align-middle fw-bolder">
                                        <!--begin::Head-->
                                        <thead class="fs-7 text-gray-400 text-uppercase">
                                            <tr>
                                                <th class="" style="width: 30%;">NOP</th>
                                                <th class="" style="width: 25%;">Nama</th>
                                                <th class="" style="width: 40%;">Alamat</th>
                                                <th class="" style="width: 5%;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <!--end::Head-->
                                        <!--begin::Body-->
                                        <tbody class="fs-6" id="bodySearch">
                                            
                                            
                                        </tbody>
                                        <!--end::Body-->
                                    </table>
                                    <!--end::Table-->
                                <!--end::Table container-->
                            </div>
                            <!--end::Reset-->
                        </form>
                        <!--end::Form-->
                        <!--begin::Wrapper-->
                        
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Search-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>

     <!--begin::Items-->
    
    <!--begin::Items-->
    <div id="search_div" class="scroll-y  mh-lg-350px">
        <!-- <a href="javascript:void(0)" class="d-flex text-dark text-hover-primary align-items-center mb-5">
            <div class="d-flex flex-column justify-content-start fw-bold"> <span class="fs-6 fw-bold">Karina Clark</span> <span class="fs-7 fw-bold text-muted">31.74.298.390.767.3333.0</span> <span class="fs-7 fw-bold text-muted">Jalan Raya No 99</span> </div>
        </a>
        <a href="javascript:void(0)" class="d-flex text-dark text-hover-primary align-items-center mb-5">
            <div class="d-flex flex-column justify-content-start fw-bold"> <span class="fs-6 fw-bold">Wawan Hendrawan</span> <span class="fs-7 fw-bold text-muted">31.74.4348.767.2323.0</span> <span class="fs-7 fw-bold text-muted">Jalan Jalan DI No 77</span> </div>
        </a> -->
    </div>
    <!--end::Items-->
<div class="modal fade" id="modTahunTematik" tabindex="-1" aria-labelledby="modTahunTematikLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modTahunTematikLabel">Tematik</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="urlTematik">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3">Tahun Pajak</div>
            <div class="col-md-3">

                <select class="form-select form-select-solid form-select-sm" id="tahunTematik" onchange="" data-control="select2" data-hide-search="true">
                    @for($i = date('Y'); $i >= 1990; $i--)
                    <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-3"></div>
        </div>
               
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="tematikYear($('#tahunTematik').val(),$('#urlTematik').val())">Cari</button>
      </div>
    </div>
  </div>
</div>

    
<!-- Modal -->
<div class="modal fade " data-bs-backdrop="static" id="modalLoading" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="background-color: transparent;">
      <div class="modal-body" style="">
      <div class="outer">
        <div class="inner">
        <button class="btn btn-primary" type="button" disabled>
            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
            Loading...
            </button>
        </div>
       </div>
    </div>
    </div>
  </div>
</div>


    
    <!--end::Items-->

        @include('tes/ready')
        @include('tes/layer')
        @include('tes/drawing')
        @include('tes/search')
        @include('tes/print_peta')

    <script>
        $(document).ready(function() {
            map.on('zoomend', function() {
                console.log(map.getZoom())
                if (map.getZoom() == 1) {
                    if(map.hasLayer(ORI) ) {
                        console.log(ORI.getBounds())
                        map.fitBounds(ORI.getBounds());

                    }else if(map.hasLayer(BL) ) {
                        map.fitBounds(BL.getBounds());

                    }else if(map.hasLayer(BG) ) {
                        map.fitBounds(BG.getBounds());
                    }else if(map.hasLayer(LTematik) ) {
                        map.fitBounds(LTematik.getBounds());
                    }
                }
            });

            
        })
    var n = 1;
    var html = $('#search_div').html()

   
    var nopSearch = L.geoJson(null, {
        style: function(feature) {
            // kec = feature.properties.OBJECTID;
            return {
                fillColor: "red",
                fillOpacity: 0.5,
                color: "red",
                dashArray: '3',
                weight: 0.5,
                opacity: 0.7
            }
        }
    });

    function show_bng() {
        $('#btn_op').removeClass('hd')
        $('#btn_bng').addClass('hd')
        $('#detail_bangunan').removeClass('hd')
        $('#detail_tanah').addClass('hd')
    }

    function show_op() {
        $('#btn_bng').removeClass('hd')
        $('#btn_op').addClass('hd')
        $('#detail_tanah').removeClass('hd')
        $('#detail_bangunan').addClass('hd')
    }

    var googleDefault =  L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
      maxZoom: 19,
      subdomains:['mt0']
  })
    var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        osm = L.tileLayer(osmUrl, {
            maxZoom: 20,
            zoom: 13,
            attribution: osmAttrib
        }),
        map = new L.Map('map', {
            renderer: L.canvas(),
            center: new L.LatLng(-7.6357943324575, 112.88264323166)
        }),
        // map = new L.Map('map', {center: new L.LatLng(-7.6357943324575, 112.88264323166), zoom: 13,maxZoom:25,position: 'topright'}),
        drawnItems = L.featureGroup().addTo(map);
        var map2 = L.map('map2').setView([-7.6357943324575, 112.88264323166], 16);
        
        L.Control.Button = L.Control.extend({
            options: {
                position: 'topleft'
            },
            onAdd: function (map2) {
                
                var container = L.DomUtil.create('div', 'leaflet-bar leaflet-delete-div');
                var button = L.DomUtil.create('a', 'leaflet-delete-button', container);
                button.innerHTML = '<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Devices/Printer.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M16,17 L16,21 C16,21.5522847 15.5522847,22 15,22 L9,22 C8.44771525,22 8,21.5522847 8,21 L8,17 L5,17 C3.8954305,17 3,16.1045695 3,15 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,15 C21,16.1045695 20.1045695,17 19,17 L16,17 Z M17.5,11 C18.3284271,11 19,10.3284271 19,9.5 C19,8.67157288 18.3284271,8 17.5,8 C16.6715729,8 16,8.67157288 16,9.5 C16,10.3284271 16.6715729,11 17.5,11 Z M10,14 L10,20 L14,20 L14,14 L10,14 Z" fill="#000000"/><rect fill="#000000" opacity="0.3" x="8" y="2" width="8" height="2" rx="1"/></g></svg><!--end::Svg Icon--></span>'
                L.DomEvent.disableClickPropagation(button);

                L.DomEvent.on(button, 'click', function(){
                    toastr.success("Warning", "Silahkan Tungggu, Gambar Segera Terunduh!")

                    var scale = 4;
                    var image= document.getElementById('map2')
                    
                    const options = {
                        width: image.clientWidth * scale,
                                height: image.clientHeight * scale,
                                style: {
                                transform: 'scale('+scale+')',
                                transformOrigin: 'top left'
                                }
                    };
                    domtoimage.toPng(image,options)
                        .then(function (dataUrl) {
                            const link = document.createElement('a');
                            link.href = dataUrl;
                            link.download = kel_name+' BLOK '+$('#print_blok').val().slice(-3)+'.png';

                            // Trigger a click event on the anchor element to initiate the download
                            link.click();

                        })
                        .catch(function (error) {
                            console.error("Error capturing map:", error);
                        });
                });
                button.title = "Refresh Tematik";
                return container;
            },
            onRemove: function(map2) {},
        });
        var control = new L.Control.Button()
        control.addTo(map2);
    googleHybrid = L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 30,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        attribution: '&copy; Google'
    });
    googleSatelite = L.tileLayer('http://{s}.google.com/vt?lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 30,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        attribution: '&copy; Google'
    });
    googleSatelite2 = L.tileLayer('http://{s}.google.com/vt?lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 30,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        attribution: '&copy; Google'
    });
    googleSatelite2.addTo(map2)

    L.control.layers({
        "OSM": osm,
        "Google Hybrid": googleHybrid,
        "Google Satelit": googleSatelite.addTo(map)
    }, {
        'drawlayer': drawnItems,
    }, {
        position: 'topright',
        collapsed: false
    }).addTo(map);
    
    //======================= Layer control ====================
     var str = '<div class="">' +
                 '<div style="" class="form-check"><input type="checkbox" checked class="gaucher form-check-input" id="daftarDesa" name="gaucher[]" onchange="getDesa()"><label id="tmbl_layer_wilayah" for="daftarDesa">Daftar Desa</label></div>' +  
                 '<div style="" class="form-check"><input type="checkbox" class="gaucher form-check-input" id="1" name="gaucher[]" onchange="processCheck(this)"><label id="tmbl_layer_ori" for="1"> Objek Pajak</label></div>' + 
                 '<div style="" class="form-check"><input type="checkbox" class="gaucher  form-check-input" id="2" name="gaucher[]" onchange="processCheck(this)"><label id="tmbl_layer_bangunan" for="2"> Bangunan</label></div>' + 
                 '<div style="" class="form-check"><input type="checkbox" class="gaucher  form-check-input" id="3" name="gaucher[]" onchange="processCheck(this)"><label id="tmbl_layer_blok" for="3"> Blok</label></div>' +
                //  '<div class="form-check"><input type="checkbox" class="gaucher  form-check-input" id="jnsTanah" name="gaucher[]" onchange="jenisTanah()"><label id="tmbl_layer_jnsTanah" for="jnsTanah"> Jenis tanah</label></div>' +
                //  '<div class="form-check"><input type="checkbox" class="gaucher  form-check-input" id="jnsPenggunaanBangunan" name="gaucher[]" onchange="jenisPenggunaanBangunan()"><label id="tmbl_layer_jnsPenggunaanBangunan" for="jnsPenggunaanBangunan"> Jenis Pengginaan Bangunan</label></div>' +
                //  '<div class="form-check"><input type="checkbox" class="gaucher  form-check-input" id="nilaiIndividu" name="gaucher[]" onchange="TnilaiIndividu()"><label id="tmbl_layer_nilaiIndividu" for="nilaiIndividu"> Nilai Individu</label></div>' +
                //  '<div class="form-check"><input type="checkbox" class="gaucher  form-check-input" id="npwp" name="gaucher[]" onchange="Tnpwp()"><label id="tmbl_layer_npwp" for="npwp"> NPWP</label></div>' +
                  '</div>';
    $('.leaflet-control-layers-list').append(str)
    L.Control.Button = L.Control.extend({
                options: {
                    position: 'topleft'
                },
                onAdd: function (map) {
                    
                    var container = L.DomUtil.create('div', 'leaflet-bar leaflet-delete-div');
                    var button = L.DomUtil.create('a', 'leaflet-delete-button', container);
                    button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M13.5 2c-5.621 0-10.211 4.443-10.475 10h-3.025l5 6.625 5-6.625h-2.975c.257-3.351 3.06-6 6.475-6 3.584 0 6.5 2.916 6.5 6.5s-2.916 6.5-6.5 6.5c-1.863 0-3.542-.793-4.728-2.053l-2.427 3.216c1.877 1.754 4.389 2.837 7.155 2.837 5.79 0 10.5-4.71 10.5-10.5s-4.71-10.5-10.5-10.5z"/></svg>'
                    L.DomEvent.disableClickPropagation(button);

                    L.DomEvent.on(button, 'click', function(){
                        editableLayers.clearLayers()
                        LTematik.clearLayers()
                        $('.div_detail').css('display','none')
                    });
                    button.title = "Refresh Tematik";
                    return container;
                },
                onRemove: function(map) {},
            });
            var control = new L.Control.Button()
            control.addTo(map);

            L.Control.Button = L.Control.extend({
                options: {
                    position: 'topleft'
                },
                onAdd: function (map) {
                    
                    var container = L.DomUtil.create('div', 'leaflet-bar leaflet-delete-div');
                    var button = L.DomUtil.create('a', 'leaflet-print-button', container);
                    button.innerHTML = '<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Devices/Printer.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M16,17 L16,21 C16,21.5522847 15.5522847,22 15,22 L9,22 C8.44771525,22 8,21.5522847 8,21 L8,17 L5,17 C3.8954305,17 3,16.1045695 3,15 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,15 C21,16.1045695 20.1045695,17 19,17 L16,17 Z M17.5,11 C18.3284271,11 19,10.3284271 19,9.5 C19,8.67157288 18.3284271,8 17.5,8 C16.6715729,8 16,8.67157288 16,9.5 C16,10.3284271 16.6715729,11 17.5,11 Z M10,14 L10,20 L14,20 L14,14 L10,14 Z" fill="#000000"/><rect fill="#000000" opacity="0.3" x="8" y="2" width="8" height="2" rx="1"/></g></svg><!--end::Svg Icon--></span>'
                    L.DomEvent.disableClickPropagation(button);

                    L.DomEvent.on(button, 'click', function(){
                        $('#modal_print').modal('show')
                        $('#btn_cari_peta').click()
                        printNop.clearLayers()
                        printBlok.clearLayers()
                        printBg.clearLayers()
                        setTimeout(function() {
                            map2.invalidateSize();
                        }, 10);
                    });
                    
                    button.title = "Print Blok";
                    button.style = "display:none";

                    return container;
                },
                onRemove: function(map) {},
            });
            var control = new L.Control.Button()
            control.addTo(map);

    //======================= button lihat ====================
    //======================= position zoom  ====================
    map.removeControl(map.zoomControl);
    L.control.zoom({
        position: 'topleft'
    }).addTo(map);

    function getDesa() {
        removeTematik()
        if ($('#daftarDesa').prop('checked')) {
            generate_wilayah()
            if ($('#1').prop('checked')) {
                $('#tmbl_layer_ori').click()
            }
            if ($('#2').prop('checked')) {
                $('#tmbl_layer_bangunan').click()
            }
            if ($('#3').prop('checked')) {
                $('#tmbl_layer_blok').click()
            } 
            if(map.hasLayer(ORI) ) {
                ORI.clearLayers()
            }
            if(map.hasLayer(BL) ) {
                BL.clearLayers()
            }
            if(map.hasLayer(BG) ) {
                BG.clearLayers()
            }
            


        } else {
            map.removeLayer(wilayah)
        }

        
    }


    function removeDesa() {
        if ($('#daftarDesa').prop('checked')) {
            $('#tmbl_layer_wilayah').click()
        }
    }
   
   
    //====================== End Button =================
    var activeBasemap=osm
    map.on('baselayerchange', function (e) {
    // Update the active basemap when the user changes it
            // if (map.hasLayer(marker)) {
            //             marker.clearLayers()
            // };

        activeBasemap = e.name;
        console.log('Active basemap changed to: ' + e.name);
        reload_layer()
    });

    console.log('Initial active basemap: ' + activeBasemap);

    //======================== End Drawing ====================
   

    function show_sidebar() {
        hide_tematik()
        $('#sidebar').css('display', 'block')
        $('#sidebar').css('animation', '3s slide-right')
    }

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

@endsection

</body>