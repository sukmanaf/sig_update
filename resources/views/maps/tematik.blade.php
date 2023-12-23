
<div id="div_tematik" class="card div_detail" style="">
    <div class="row" id="">
        <div class="col-md-10 ">
            <h5  class="header_detail" style=""></h5>
        </div>
    </div>
    <div id="div_tematik_body" class="div_detail_body">
    </div>
</div>

<div class="modal fade" id="modTahunTematik" tabindex="-1" aria-labelledby="modTahunTematikLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content modal-sm ">
        <div class="modal-header">
          <h5 class="modal-title" id="modTahunTematikLabel">sds</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding-top:5px;padding-bottom:5px">
          <input type="hidden" id="urlTematik">
          <div class="row">
            <div class="col-md-5">
                <label for="inputPassword6" class="col-form-label " style="float:right">Tahun Pajak</label>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-5">
                <select class="form-select form-select-solid form-select-sm" id="tahunTematik" onchange="" data-control="select2" data-hide-search="true">
                    @for($i = date('Y'); $i >= 1990; $i--)
                    <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select> 
            </div>
          </div>
                 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-sm btn-primary" onclick="tematikYear($('#tahunTematik').val(),$('#urlTematik').val())">Cari</button>
        </div>
      </div>
    </div>
  </div>
<script>

var LTematik = L.geoJson(null, {
        onEachFeature: function(feature, layer) {
            var xnop = feature.properties.d_nop.substring(13, 17);
                var centroid = turf.centroid(feature.geometry);
                
                var customMarker = L.divIcon({
                    className: 'custom-marker',
                    html: '<div style="text-align:center">' + xnop + '</div>',
                    iconSize: [150, 30]
                });
                var latlng = centroid.geometry.coordinates
                var marker = L.marker(L.latLng(latlng[1], latlng[0]), { icon: customMarker });

                // Bind a popup (optional)

                // Add the marker to the map
                var sts = 0;
                map.on('zoomend', function() {
                    if (map.getZoom() > 15) {
                        // layer.bindTooltip(label);
                        if(sts == 0){
                            sts = 1
                            // marker.addTo(map);
                        }
                    }else{
                        map.removeLayer(marker);
                        sts = 0;
                    }
                });

                layer.on("click", function() {
                
                    $('#usulanNop').val(feature.properties.d_nop)
                    $('#usulanText').html('')

                    var nops = feature.properties.d_nop
                    var nops = nops.substring(0, 2)+'.'+nops.substring(2, 4)+'.'+nops.substring(4, 7)+'.'+nops.substring(7, 10)+'.'+nops.substring(10, 13)+'.'+nops.substring(13, 17)+'.'+nops.substring(17, 18)
                    const requestData = {
                    NOP: nops,
                    };

                    // Make a POST request using jQuery AJAX
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{url("informasiOP")}}',
                        type: 'POST',
                        data: requestData,
                        success: function(response) {
                            response = JSON.parse(response)
                            console.log(response.status)
                            if (response.status) {
                                $('.inp-inf').val('')
                                $('.INF_OP').val('')
                                $('#INF_BANGUNAN').html('')
                                $('#INF_TAHUN_PAJAK').html('')
                                var modal_detail_tahun=[]
                                var op = response.data.INFORMASI_RINCI_OBJEK_PAJAK
                                var optTahun = '';
                                $.each(op, function( i,v ){
                                    
                                    modal_detail_op[v.TAHUN_PAJAK] = v
                                    modal_detail_tahun.push(parseInt(v.TAHUN_PAJAK))
                                    optTahun += '<option>'+v.TAHUN_PAJAK+'</option>'

                                    
                                })
                     
                                var bg = response.data.INFORMASI_BANGUNAN
                                var bgNo = ''
                                if (bg.length > 0) {
                                    
                                    $.each(bg, function( i,v ){
                                        modal_detail_bg[v.BANGUNAN_KE] = v
                                        modal_detail_bgNo.push(parseInt(v.BANGUNAN_KE))
                                        bgNo += '<option>'+v.BANGUNAN_KE+'</option>'
                                    })
                                    $('#INF_BANGUNAN').html(bgNo)
                                    const minBg = Math.min.apply(null, modal_detail_bgNo);
                                    $('#INF_BANGUNAN').val(minBg).trigger('change')
                                }

                                if (isNaN(modal_detail_tahun[0])) {
                                    $.each(op[0], function( ii,vv ){
                                        if(ii != 'TAHUN_PAJAK' && ii != 'NPWP'){
                                            if (ii == 'PBB' || ii == 'NJOP_BUMI' || ii == 'NJOP_BANGUNAN'  ) {
                                                if(vv != null){
                                                    $('#INF_'+ii).val(formatRupiah(parseInt(vv)))
                                                }else{
                                                    $('#INF_'+ii).val('Rp.0')

                                                }
                                            }else{
                                                
                                                
                                                $('#INF_'+ii).val(vv)
                                            }
                                        }
                                    })
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
                                    
                                    
                                }else{

                                    
                                    $('#INF_TAHUN_PAJAK').html(optTahun)
                                    const maxtahun = Math.max.apply(null, modal_detail_tahun);
                                    $('#INF_TAHUN_PAJAK').val(maxtahun).trigger('change')
                                }
                                $('#modal_detail').modal('show')

                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Request failed:', error);
                        }
                    });

                    
                   
                    $('#lbl_nop').html(feature.properties.D_NOP)
                    // $('#lbl_luas').html(feature.properties.D_LUAS)
                    // show_op()
                
              
            })
                
        },
        style: function(feature) {
            if(feature.properties.color){
                var colour = feature.properties.color
            }else{
                var colour = 'transparent';
            }
            if(activeBasemap == 'OSM' ){
                var linecolor = 'black'
            }else if(activeBasemap == 'Google Hybrid' ){
                var linecolor = 'black'
            }else{
                var linecolor = 'white';
            }
            return {
                // fillColor: "transparent",
                // fillOpacity: 0.5,
                // color: "white",
                // dashArray: '3',
                // weight: 0.5,
                title: 'nop',
                opacity: 1,
                fillColor: colour,
                weight: 1.2,
                lineJoin: "miter",
                color: linecolor,
            }
        }
    });
    function tematik(url) {
        
        var header = {
            'jenisTanah' : 'Jenis Tanah',
            'jenisPenggunaanBangunan' : 'Jenis Bangunan',
            'nilaiIndividu' : 'Nilai Individu',
            'nik' : 'NIK',
        }

        // console.log(header.url)
        var desa = select_kel
        if(desa == 00){
            toastr.warning("Warning", "Pilih Kelurahan Terlebih Dahulu")
            removeTematik()
            return false
        }
        if(map.hasLayer(LTematik)) {
            LTematik.bringToFront();
        };
        const requestData = {
            KD_PROPINSI: desa.substring(0, 2),
            KD_DATI2: desa.substring(2, 4),
            KD_KECAMATAN: desa.substring(4, 7),
            KD_KELURAHAN: desa.substring(7, 10),
            url:url
        };
        showLoading()
        remove_overlay()
        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            url: "{{route('getTematik')}}",
            type: 'POST',
            data: requestData,
            success: function(response) {
                removeDesa()
                removeNop()
                $('.div_detail').css('display','none')
                LTematik.clearLayers()
                var data = JSON.parse(response)
                if (data.sts == 'fail') {
                    hideLoading()
                    toastr.warning("Warning", "Ambil Data Gagal, Silahkan Coba Lagi!")
                } else {
                    var datas = JSON.parse(data.data)
                    console.log(datas)
                    LTematik.addData(datas);
                    map.fitBounds(LTematik.getBounds());
                    LTematik.addTo(map)
                    response = JSON.parse(response)
                    $('#div_tematik_body').html(response.detail)
                    $('.header_detail').html(header[url])
                    $('#div_tematik').css('display','block')
                    hideLoading()
                    
                    $('.modal').modal('hide')
                    editableLayers.clearLayers()
                }
            },
            error: function(xhr, status, error) {
                hideLoading()
                    toastr.warning("Warning", "Ambil Data Gagal, Silahkan Coba Lagi!")
                console.error('Request failed:', error);
            }
        });

    }

    function tematikYear(tahun,url) {
            var header = {
                'zonaNilaiTanah' : 'Zona Nilai Tanah ',
                'statusPembayaran' : 'Status Pembayaran ',
                'kelasBangunan' : 'Kelas Bangunan ',
                'kelasTanah' : 'Status Tanah ',
                'ketetapanPerBuku' : 'Ketetapan Perbuku ',
            }

            if (url == 'ketetapanPerBuku') {
                var title = 'Ketetapan Perbuku '+tahun
            }else if (url == 'zonaNilaiTanah') {
                var title = 'Zona Nilai Tanah '+tahun
            }else if (url == 'statusPembayaran') {
                var title = 'Status Pembayaran '+tahun
            }else if (url == 'kelasBangunan') {
                var title = 'Kelas Bangunan '+tahun
            }else if (url == 'kelasTanah') {
                var title = 'Kelas Tanah '+tahun
            } 
            $('#breadcumb').html(title)
            if(map.hasLayer(LTematik)) {
                LTematik.bringToFront();
            };
            var desa = select_kel
            if(desa == 00){
                toastr.warning("Warning", "Pilih Kelurahan Terlebih Dahulu")
                removeTematik()
            return false
            }
            const requestData = {
                KD_PROPINSI: desa.substring(0, 2),
                KD_DATI2: desa.substring(2, 4),
                KD_KECAMATAN: desa.substring(4, 7),
                KD_KELURAHAN: desa.substring(7, 10),
                THN_PAJAK_SPPT:tahun,
                url:url
            };
            $('#modTahunTematik').modal('hide')
            showLoading()
            remove_overlay()
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                url: "{{route('getTematik')}}",
                type: 'POST',
                data: requestData,
                success: function(response) {
                    removeDesa()
                    removeNop()
                    $('.div_detail').css('display','none')
                    LTematik.clearLayers()
                    var data = JSON.parse(response)
                    if (data.sts == 'fail') {
                        hideLoading()
                        toastr.warning("Warning", "Ambil Data Gagal, Silahkan Coba Lagi!")
                    } else {
                        var datas = JSON.parse(data.data)
                        LTematik.addData(datas);
                        map.fitBounds(LTematik.getBounds());
                        LTematik.addTo(map)
                        response = JSON.parse(response)
                        $('#div_tematik_body').html(response.detail)
                        $('.header_detail').html(header[url])
                        $('#div_tematik').css('display','block')
                        hideLoading()
                        
                        $('.modal').modal('hide')
                        editableLayers.clearLayers()
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Request failed:', error);
                }
            });
      

    }

    function removeTematik() {
        if ($('#jnsTanah').prop('checked')) {
            $('#tmbl_layer_jnsTanah').click()
        }
    }


    
    function modalTematik(url) {

        var header = {
            'zonaNilaiTanah' : 'Zona Nilai Tanah ',
            'statusPembayaran' : 'Status Pembayaran ',
            'kelasBangunan' : 'Kelas Bangunan ',
            'kelasTanah' : 'Status Tanah ',
            'ketetapanPerBuku' : 'Ketetapan Perbuku ',
        }
        $('#urlTematik').val(url)
        $('#modTahunTematik').modal('show')
        $('.modal-title').html(header[url])
    }
</script>