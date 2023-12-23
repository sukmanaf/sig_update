<style>
    #modal_tools{
        right:30px;
    }

    .modal-right {
    transform: translateX(35%);
    margin-top: 20px;
}


</style>
@php

$user = Auth::user();
if ($user == null) {
    return redirect()->route('login');
}
$role = $user->getRoleNames()->first();

@endphp
<div id="modal_tools" class="modal modal modal-right " tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        
        <div class="modal-body">
            <div>
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3"> <a href="javascript:void(0)" class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1">Filter WIlayah</a>
                    </div>
                </div>
                <div class="row">
                    <label class="col-lg-12 fw-bold text-muted">Kecamatan</label>
                    <div class="col-lg-12">
                        <select class="form-select form-select-solid form-select-sm" id="select_kec" onchange="kecamatanChange($(this).val())" data-control="select2" data-hide-search="true">
                            @if($role == 'admin')
                                <option value="00">Semua Kecamatan</option>
                            @endif
                            @if(!empty($kecamatan))
                                @foreach ($kecamatan as $kec)
                                <option value="{{$kec->d_kd_kec}}">{{$kec->d_nm_kec}}</option>
                                @endforeach
                            @endif
                        
                        </select>
                    </div>
                </div>
                <div class="row">
                    <label class="col-lg-12 fw-bold text-muted">Kelurahan</label>
                    <div class="col-lg-12">
                        <select class="form-select form-select-solid form-select-sm" onchange="desaChange($(this).val())" data-control="select2" id="select_desa" data-hide-search="true">
                        @if($role == 'admin')

                            <option value="00">Semua Kelurahan</option>
                        @endif
                        @if(!empty($desa))
                                @foreach ($desa as $kel)
                                <option value="{{$kel->d_kd_kel}}">{{$kel->d_nm_kel}}</option>
                                @endforeach
                            @endif

                        </select>
                    </div>
                </div>
            </div>
            <div style="margin-top: 30px">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3"> <a href="javascript:void(0)" class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1">Alat Gambar</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <select class="form-select form-select-solid form-select-sm" data-control="select2" id="select_drawing" data-hide-search="true" onchange="select_draw($(this).val())">
                            <option value="0">Lihat</option>
                            <option value="1">Edit</option>
                        </select>
                    </div>
                </div>
            </div>
            <div style="margin-top: 30px">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3"> <a href="javascript:void(0)" class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1">Auto Simpan</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <select class="form-select form-select-solid form-select-sm" data-control="select2" id="auto_save" data-hide-search="true" onchange="">
                            <option value="0">Manual </option>
                            <option value="1">Auto </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
       
      </div>
    </div>
  </div>

  <script>

    function kecamatanChange(v) {
        select_kec = v
        select_kel = 00
        $.getJSON('{{url("getDesa")}}/'+v, function(data) {
            var str = '<option value="00">Semua Kelurahan</option>';
            $.each(data, function(index, item) {
                str += '<option value="' + item.d_kd_kel + '">' + item.d_nm_kel + '</option>';
            });
            $('#select_desa').html(str);
            hide_layer()
        });
    }


    function desaChange(v) {
        hide_layer()
        select_kel = v
        $('#tmbl_layer_ori').click()
        
    }

    function hide_layer(argument) {
        if(map.hasLayer(ORI)) {
            $('#tmbl_layer_ori').click()
        };
        if(map.hasLayer(BL)) {
            $('#tmbl_layer_blok').click()
        };
        if(map.hasLayer(BG)) {
            $('#tmbl_layer_bangunan').click()
        };
    }
  </script>