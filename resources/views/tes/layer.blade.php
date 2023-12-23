   
<script type="text/javascript">
    
  
    //======================= Ori ===========================
  
    var select_kec = 00
    var select_kel = 00
    var kel_name =''
    var polygon_op
    var wilayah = L.geoJson(null, {
        onEachFeature: function(feature, layer) {
            layer.on("click", function() {
                    $('#breadcumb_desa').html(' - Kelurahan : '+feature.properties.d_nm_kel)
                    $('#breadcumb').html('Smartmap')
                    // alert(selected_draw)
                    var kd_kel = feature.properties.d_kd_kel
                    var kd_kec = kd_kel.substring(0, 7);
                    select_kec = kd_kec
                    select_kel = kd_kel
                    kel_name = feature.properties.d_nm_kel
                    $('#1').click()
                    
                })
            layer.unbindTooltip();
            if(activeBasemap == 'OSM' ){
                var linecolor = 'black'
            }else if(activeBasemap == 'Google Hybrid' ){
                var linecolor = 'black'
            }else{
                var linecolor = 'white';
            }
            var label = L.tooltip({
                permanent: true,
                direction: 'center',
                className: 'my-label',
                offset: [0, 0]
            }).setContent('<label class="text-tooltip " style="font-size:10px;color:'+linecolor+'">'+feature.properties.d_nm_kel+'</label>');
            layer.bindTooltip(label);

             map.on('zoomend', function() {
                if (map.getZoom() < 13) {
                   $('.text-tooltip').addClass('color_transparent');
                } else {
                   $('.text-tooltip').removeClass('color_transparent');
                }
            });

            

        },
        style: function(feature) {
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
                opacity: 0.9,
                fillColor: 'transparent',
                weight: 0.5,
                lineJoin: "miter",
                color:linecolor,
            }
        }
        
    });
    

        $.getJSON('{{url("getWilayah")}}', function(data) {
            console.log(data)
            wilayah.addData(data);
            map.fitBounds(wilayah.getBounds());
            wilayah.addTo(map)
            
            // $('#modal_detail').modal('show')
        });

    var modal_detail_tahun=[]
    var modal_detail_bgNo=[]
    var modal_detail_op=[]
    var modal_detail_bg=[]
    var polygon_draw
    // var marker = L.marker()
    
    var ORI = L.geoJson(null, {
        onEachFeature: function(feature, layer) {
            layer.on("click", function() {
                // alert(selected_draw)
                console.log(feature.properties.d_nop.length)
                

                if ($('#select_drawing').val() == 1) {
                    $('#inp_delete_nop').val(feature.properties.d_nop)
                    $('#div_delete_nop').removeClass('hd')
                    $('#btn_dave_edit').addClass('hd')
                }

                if(selected_draw == 0) {
                    // Create a FormData object
                    if (feature.properties.d_nop.length != 18) {
                        toastr.warning("Warning", "NOP Tidak Sesuai!!")
                        return false
                        
                    }
                    var jsonData = { 'NOP': '35.75.020.002.002.0125.0' }
                    var formData = new FormData($('#nopForm')[0]);
                    $('#usulanNop').val(feature.properties.d_nop)
                    $('#usulanText').html('')
                    $('.nav-link').removeClass('active')
                    $('#detail_op_tab').addClass('active')

                    var nops = feature.properties.d_nop
                    var nops = nops.substring(0, 2)+'.'+nops.substring(2, 4)+'.'+nops.substring(4, 7)+'.'+nops.substring(7, 10)+'.'+nops.substring(10, 13)+'.'+nops.substring(13, 17)+'.'+nops.substring(17, 18)
                    console.log(nops)
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
                                if (response.img.length > 0) {
                                    var str =''
                                    $.each(response.img, function( i,v ){
                                        var url = '{{asset("storage/")}}/'+v
                                        if (i == 0) {
                                            
                                            str += '<div class="carousel-item active">'+
                                                    '<img src="'+url+'" style="max-height:400px!important;width:100%!important" class="d-block w-100" alt="'+url+'"></div>'
                                        } else {
                                            str += '<div class="carousel-item">'+
                                                    '<img src="'+url+'" style="max-height:400px!important" class="d-block w-100" alt="'+url+'"></div>'
                                            
                                        }
                                    })
                                    $('.carousel-inner').html(str)
                                }else{
                                    $('.carousel-inner').html('')

                                }
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
                                    console.log(op[0])
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
                } else {
                    var f = feature.geometry.coordinates

                    $('#xjenis').val(1).trigger('change')
                    $('#nop_edit').val(feature.properties.d_nop)
                    $('#nop_edit_old').val(feature.properties.d_nop)
                    var arr = [];
                    $.each(f[0], function(key, value) {
                        // console.log(  value[0] );
                        const temp = value[0];
                        value[0] = value[1];
                        value[1] = temp;
                        arr.push(value)
                    });
                    editableLayers.clearLayers()
                    polyCoords = [arr]
                    polygon_op = L.polygon(polyCoords, {
                        title: 'test',
                        fillColor: '#F16E60',
                        fillOpacity: 0.5,
                        weight: 5,
                        color: '#F16E60',
                        opacity: 0.5,
                        fill: true,
                        // draggable: true,
                    }).addTo(editableLayers);
                    map.addLayer(editableLayers);
                    polygon_draw = polyCoords
                   
                      
                }
              
            })
           

            // if (select_kel != 00) {
                var xnop = feature.properties.d_nop.substring(13, 17);
                var centroid = turf.centroid(feature.geometry);
                if(activeBasemap == 'OSM' ){
                    var linecolor = 'black'
                }else if(activeBasemap == 'Google Hybrid' ){
                    var linecolor = 'black'
                }else{
                    var linecolor = 'white';
                }
                var customMarker = L.divIcon({
                    className: 'custom-marker',
                    html: '<div style="color:'+linecolor+';text-align:center">' + xnop + '</div>',
                    iconSize: [150, 30]
                });
                var latlng = centroid.geometry.coordinates
                var marker = L.marker(L.latLng(latlng[1], latlng[0]), { icon: customMarker });

                // Bind a popup (optional)

                // Add the marker to the map
                var sts = 0
                map.on('zoomend', function() {
                    if (map.getZoom() > 18) {
                        // layer.bindTooltip(label);
                        if(sts == 0){
                            sts = 1
                            console.log(map.getZoom())
                            // marker.addTo(map);
                        }
                    }else{
                        map.removeLayer(marker);
                        sts = 0;
                    }
                });

                
                
            // }
            
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
                var linecolor = '#b8c229';
            }

            return {
                // fillColor: "transparent",
                // fillOpacity: 0.5,
                // color: "white",
                // dashArray: '3',
                // weight: 0.5,
                title: 'nop',
                opacity: 0.9,
                fillColor: colour,
                weight: 1.5,
                lineJoin: "miter",
                color: linecolor,
            }
        }
    });
    
    
    //======================= Backgraund ================= 
    var BG = L.geoJson(null, {
         onEachFeature: function(feature, layer) {
            layer.on("click", function() {
                    
                    if(selected_draw == 0) {
                       
                    } else {
                        console.log(feature.properties)
                        $('#xjenis').val(3).trigger('change')
                        $('#inp_delete_bangunan').val(feature.properties.d_nop)
                        $('#div_delete_bangunan').removeClass('hd')
                        var f = feature.geometry.coordinates
                        $('#nop_edit').val(feature.properties.d_nop)
                        $('#nop_edit_old').val(feature.properties.d_nop)
                        var arr = [];
                        $.each(f[0], function(key, value) {
                            // console.log(  value[0] );
                            const temp = value[0];
                            value[0] = value[1];
                            value[1] = temp;
                            arr.push(value)
                        });
                        // console.log('iki clik')
                        // arr = JSON.stringify(arr)
                        editableLayers.clearLayers()
                        polyCoords = [arr]
                        polygon_op = L.polygon(polyCoords, {
                            title: 'test',
                            fillColor: '#F16E60',
                            fillOpacity: 0.5,
                            weight: 5,
                            color: '#F16E60',
                            opacity: 0.5,
                            fill: true
                        }).addTo(editableLayers);
                        map.addLayer(editableLayers);
                    }
                    // or over a feature property layer.bindTooltip(feature.properties.customTitle)
                    // polygon.bindTooltip("My polygon",
                    // {permanent: false, direction:"center"}
                    // ).openTooltip()
                    // arr.push([value[1],value[0]])
                })
                // layer.bindTooltip('Hi there', {permanent: true}).openTooltip(); 
                // layer.bindTooltip(feature.properties.d_nop, { 'permanent': true});
                // feature.properties.D_NOP
        },
        style: function(feature) {
            return {
                fillColor: "red",
                fillOpacity: 0.5,
                color: "red",
                dashArray: '3',
                weight: 2,
                opacity: 0.7,
            }
        }
    });
    
    //============================= BL =========================
    var BL = L.geoJson(null, {
        onEachFeature: function(feature, layer) {
            layer.on("click", function() {
                    
                    if(selected_draw == 0) {
                       
                    } else {
                        $('#xjenis').val(2).trigger('change')
                        $('#inp_delete_blok').val(feature.properties.d_blok)
                        $('#div_delete_blok').removeClass('hd')
                        var f = feature.geometry.coordinates
                        $('#nop_edit').val(feature.properties.d_blok)
                        $('#nop_edit_old').val(feature.properties.d_blok)
                        var arr = [];
                        $.each(f[0], function(key, value) {
                            // console.log(  value[0] );
                            const temp = value[0];
                            value[0] = value[1];
                            value[1] = temp;
                            arr.push(value)
                        });
                        // console.log('iki clik')
                        // arr = JSON.stringify(arr)
                        editableLayers.clearLayers()
                        polyCoords = [arr]
                        polygon_op = L.polygon(polyCoords, {
                            title: 'test',
                            fillColor: '#F16E60',
                            fillOpacity: 0.5,
                            weight: 5,
                            color: '#F16E60',
                            opacity: 0.5,
                            fill: true
                        }).addTo(editableLayers);
                        map.addLayer(editableLayers);
                    }
                    // or over a feature property layer.bindTooltip(feature.properties.customTitle)
                    // polygon.bindTooltip("My polygon",
                    // {permanent: false, direction:"center"}
                    // ).openTooltip()
                    // arr.push([value[1],value[0]])
                })
                var xblok = feature.properties.d_blok.substring(10, 14);
                 var label = L.tooltip({
                    permanent: true,
                    direction: 'center',
                    className: 'my-label',
                    offset: [0, 0]
            }).setContent('<label class="text-blok">'+xblok+'</label>');
                layer.bindTooltip(label);
        },
        style: function(feature) {
            kec = feature.properties.d_block;
            // console.log(feature.properties.d_blok)
            return {
                fillColor: "transparent",
                fillOpacity: 0.5,
                color: "Blue",
                dashArray: '3',
                weight: 2,
                opacity: 0.7
            }
        }
    });
    
    
    //======================= tematik ====================

    var LTematik = L.geoJson(null, {
        onEachFeature: function(feature, layer) {
            var xnop = feature.properties.d_nop.substring(13, 17);
                var centroid = turf.centroid(feature.geometry);
                
                var customMarker = L.divIcon({
                    className: 'custom-marker',
                    html: '<div style="text-align:center">' + xnop + '</div>',
                    iconSize: [150, 30]
                });
                console.log(centroid.geometry.coordinates)
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
                            console.log(map.getZoom())
                            marker.addTo(map);
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
                    console.log(nops)
                    const requestData = {
                    NOP: nops,
                    };
                    console.log(feature.properties.d_nop)

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
                                    console.log(op[0])
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
                color: "black",
            }
        }
    });
    var printNop = L.geoJson(null, {
        onEachFeature: function(feature, layer) {
            var nop = feature.properties.d_nop.slice(-3)
            var label = L.tooltip({
                permanent: true,
                direction: 'center',
                className: 'my-label',
                offset: [0, 0]
            }).setContent('<label class="text-tooltip " style="font-size:10px;color:white">'+nop+'</label>');
            layer.bindTooltip(label);
        },
        style: function(feature) {
            // console.log(feature.properties.d_blok)
            return {
                fillColor: "transparent",
                fillOpacity: 0.5,
                color: "white",
                // dashArray: '3',
                weight: 2,
                opacity: 0.7
            }
        }
    });
    var printBlok = L.geoJson(null, {
        onEachFeature: function(feature, layer) {
            
        },
        style: function(feature) {
            return {
                fillColor: "transparent",
                fillOpacity: 0.5,
                color: "blue",
                dashArray: '3',
                weight: 2,
                opacity: 0.7
            }
        }
    });
    var printBg = L.geoJson(null, {
        onEachFeature: function(feature, layer) {
            
        },
        style: function(feature) {
            return {
                fillColor: "transparent",
                fillOpacity: 0.5,
                color: "red",
                // dashArray: '3',
                weight: 2,
                opacity: 1.2
            }
        }
    });
    //======================= Layer control ====================
    
    var layer1 = ORI;
    var layer2 = BG;
    var layer3 = BL;
   
    var layers = [layer1, layer2, layer3];
    var selId = null;

    function processCheck(checkbox) {
        var checkId = checkbox.id;
        
        if(checkbox.checked) {
           
            if (layers[checkId - 1] == ORI) {
                generate_nop()
            }else if(layers[checkId - 1] == BG){
                generate_bangunan()
            }else if(layers[checkId - 1] == BL){
                generate_blok()
            }else{

                layers[checkId - 1].addTo(map);
            }
            selId = checkId;
            
        } else {
            
            map.removeLayer(layers[checkId - 1]);
            selId = null;
        }
        if(map.hasLayer(ORI)) {
            ORI.bringToFront();
        };

        if ($('#daftarDesa').prop('checked')) {
            $('#daftarDesa').click() 
          
        } 
    }


     function kolor(v) {
        if(v >= 0 && v <= 4) {
            num = 0
        } else if(v >= 5 && v <= 9) {
            num = 1
        } else if(v >= 10 && v <= 14) {
            num = 2
        } else if(v >= 15 && v <= 17) {
            num = 3
        } else {
            num = 4
        }
        var arr = ['red', 'blue', 'purple', 'orange', 'aqua']
            // var num =  Math.floor(Math.random() * 6)
            // alert(num)
        return arr[num]
    }

    function kolor_two(v) {
        if(v >= 0 && v <= 10) {
            num = 0
        } else {
            num = 1
        }
        var arr = ['purple', 'aqua']
            // var num =  Math.floor(Math.random() * 6)
            // alert(num)
        return arr[num]
    }

    function hide_tematik(argument) {
        // if(map.hasLayer(jenis_tanah)) {
        //     $('#tmbl_layer_jenis_tanah').click()
        // };
        // if(map.hasLayer(jenis_bangunan)) {
        //     $('#tmbl_layer_jenis_bangunan').click()
        // };
        // if(map.hasLayer(buku)) {
        //     $('#tmbl_layer_buku').click()
        // };
        // if(map.hasLayer(npwp)) {
        //     $('#tmbl_layer_npwp').click()
        // };
        // if(map.hasLayer(sts_bayar)) {
        //     $('#tmbl_layer_sts_bayar').click()
        // };
        // if(map.hasLayer(individu)) {
        //     $('#tmbl_layer_individu').click()
        // };
        // if(map.hasLayer(znt)) {
        //     $('#tmbl_layer_znt').click()
        // };
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
    function generate_wilayah() {
        $.getJSON('{{url("getWilayah")}}', function(data) {
            console.log(data)
            wilayah.addData(data);
            map.fitBounds(wilayah.getBounds());
            wilayah.addTo(map)
            $('#breadcumb_desa').html('')
            $('#breadcumb').html('Smartmap')
            console.log('getWil')
            editableLayers.clearLayers()
            $('.leaflet-print-button').css('display','none')
        });
    }

    function generate_nop(v) {
        var kec = select_kec
        var desa = select_kel
        if(v != undefined){
            desa = v
        }
        removeDesa()
        ORI.clearLayers()
        $.getJSON('{{url("getNop")}}/'+kec+'/'+desa, function(data) {
            if (data.msg == 'Data Kosong') {
                toastr.warning("Warning", "Data Kosong")
                //   hideLoading()
                editableLayers.clearLayers()
            }else{
                datas = JSON.parse(data.data)
                oriToMap(datas)
                    .then(function (geoJSONLayer) {
                        map.fitBounds(ORI.getBounds());

                    });
                    

                    // hideLoading()
                    editableLayers.clearLayers()
                    if(map.hasLayer(ORI)) {
                        ORI.bringToFront();
                    };
           

                $('.leaflet-print-button').css('display','block')

                $.each(data.blok, function(index, item) {
                    // Code to execute for each item
                    var newOption = $('<option>', {
                        value: item,
                        text: index
                    });
                    
                    // Append the new option to the select element
                    $('#print_blok').append(newOption);
                });
                $('#modal_print').on('show.bs.modal', function() {
                  
                    
                });
                
            }
        });
    }

    function oriToMap(datas) {
        return new Promise(function(resolve, reject) {
            ORI.addData(datas);
                ORI.addTo(map)
            resolve(ORI);
        });
    }

        

    function generate_blok() {
        // showLoading()
        removeTematik()
        var kec = select_kec
        var desa = select_kel
        BL.clearLayers()
        console.log('blok')
        $.getJSON('{{url("getBlok")}}/'+kec+'/'+desa, function(data) {
            if (data.msg == 'Data Kosong') {
              toastr.warning("Warning", "Data Kosong")
              hideLoading()
                editableLayers.clearLayers()
            }else{
                datas = JSON.parse(data.data)
                BL.addData(datas);
                BL.addTo(map)
                map.fitBounds(BL.getBounds());
                editableLayers.clearLayers()
                // hideLoading()
                if(map.hasLayer(ORI)) {
                    ORI.bringToFront();
                };
            }
        });
    }
    function generate_bangunan() {
        // showLoading()
        removeTematik()
        var kec = select_kec
        var desa = select_kel
        BG.clearLayers()
        $.getJSON('{{url("getBng")}}/'+kec+'/'+desa, function(data) {
            if (data.msg == 'Data Kosong') {
              toastr.warning("Warning", "Data Kosong")
                editableLayers.clearLayers()
            }else{
                datas = JSON.parse(data.data)
                BG.addData(datas);
                BG.addTo(map)
                map.fitBounds(BG.getBounds());
                editableLayers.clearLayers()
                if(map.hasLayer(ORI)) {
                    ORI.bringToFront();
                };
            }
            // hideLoading()
        });
    }

    function jenisTanah() {
        
        // if($('#jnsTanah').is(':checked')) {
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
                    };
            showLoading()
            remove_overlay()
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                // url: 'localhost:5151/sismiop/sig_api/jenisTanah',
                url: "{{route('jenis_tanah')}}",
                type: 'POST',
                data: requestData,
                success: function(response) {
                    $('#breadcumb').html('Jenis Tanah')
                    removeDesa()
                    removeNop()
                    LTematik.clearLayers()
                    var data = JSON.parse(response)
                    var datas = JSON.parse(data.data)
                    LTematik.addData(datas);
                    map.fitBounds(LTematik.getBounds());
                    LTematik.addTo(map)
                    response = JSON.parse(response)
                    console.log(response.detail)
                    $('.div_detail').css('display','none')
                    $('#div_jenis_tanah_body').html(response.detail)
                    // $('#header_detail').html()
                    $('#div_jenis_tanah').css('display','block')
                    $('#div_tematik').css('display','none')
                    hideLoading()
                    editableLayers.clearLayers()
                },
                error: function(xhr, status, error) {
                    console.error('Request failed:', error);
                }
            });
        // } else {
        //     LTematik.clearLayers()
        //     $('.div_detail').css('display','none')
        
        // }

    }

    function jenisPenggunaanBangunan() {
        
        // if($('#jnsPenggunaanBangunan').is(':checked')) {
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
            };
            showLoading()
            remove_overlay()
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                // url: 'localhost:5151/sismiop/sig_api/jenisTanah',
                url: "{{route('jenis_penggunaan_bangunan')}}",
                type: 'POST',
                data: requestData,
                success: function(response) {
                    $('#breadcumb').html('Jenis Bangunan')

                    removeDesa()
                    removeNop()
                    $('.div_detail').css('display','none')
                    LTematik.clearLayers()
                    var data = JSON.parse(response)
                    var datas = JSON.parse(data.data)
                    LTematik.addData(datas);
                    map.fitBounds(LTematik.getBounds());
                    LTematik.addTo(map)
                    response = JSON.parse(response)
                    console.log(response.detail)
                    $('#div_jenis_bangunan_body').html(response.detail)
                    $('#div_jenis_bangunan').css('display','block')
                    $('#div_tematik').css('display','none')
                    hideLoading()
                    editableLayers.clearLayers()
                },
                error: function(xhr, status, error) {
                    console.error('Request failed:', error);
                }
            });
        // } else {
        //     LTematik.clearLayers()
        //     $('.div_detail').css('display','none')
        
        // }

    }
    function TnilaiIndividu() {
        
        // if($('#nilaiIndividu').is(':checked')) {
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
            };
            showLoading()
            remove_overlay()
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                // url: 'localhost:5151/sismiop/sig_api/jenisTanah',
                url: "{{route('nilai_individu')}}",
                type: 'POST',
                data: requestData,
                success: function(response) {
                    $('#breadcumb').html('Nilai Individu')
                    removeDesa()
                    removeNop()
                    $('.div_detail').css('display','none')
                    LTematik.clearLayers()
                    var data = JSON.parse(response)
                    var datas = JSON.parse(data.data)
                    LTematik.addData(datas);
                    map.fitBounds(LTematik.getBounds());
                    LTematik.addTo(map)
                    response = JSON.parse(response)
                    console.log(response.detail)
                    $('#div_individu_body').html(response.detail)
                    $('#h5_tematik').html('Nilai Individu')
                    $('#div_individu').css('display','block')
                    $('#div_tematik').css('display','none')
                    hideLoading()
                    editableLayers.clearLayers()
                },
                error: function(xhr, status, error) {
                    console.error('Request failed:', error);
                }
            });
        // } else {
        //     LTematik.clearLayers()
        //     $('.div_detail').css('display','none')
        
        // }

    }
    function Tnpwp() {
        
        // if($('#npwp').is(':checked')) {
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
            };
            showLoading()
            remove_overlay()
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                // url: 'localhost:5151/sismiop/sig_api/jenisTanah',
                url: "{{route('nik')}}",
                type: 'POST',
                data: requestData,
                success: function(response) {
                    $('#breadcumb').html('NPWP')
                    removeDesa()
                    removeNop()
                    $('.div_detail').css('display','none')
                    LTematik.clearLayers()
                    var data = JSON.parse(response)
                    var datas = JSON.parse(data.data)
                    LTematik.addData(datas);
                    map.fitBounds(LTematik.getBounds());
                    LTematik.addTo(map)
                    response = JSON.parse(response)
                    console.log(response.detail)
                    $('#h5_tematik').html('NPWP')
                    $('#div_npwp_body').html(response.detail)
                    $('#div_tematik').css('display','none')
                    $('#div_npwp').css('display','block')
                    hideLoading()
                    editableLayers.clearLayers()
                },
                error: function(xhr, status, error) {
                    console.error('Request failed:', error);
                }
            });
        // } else {
        //     LTematik.clearLayers()
        //     $('.div_detail').css('display','none')
        
        // }

    }
    function kelasTanah() {
        
        // if($('#npwp').is(':checked')) {
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
                THN_PAJAK_SPPT:2023
            };
            showLoading()
            remove_overlay()
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                // url: 'localhost:5151/sismiop/sig_api/jenisTanah',
                url: "{{route('kelas_tanah')}}",
                type: 'POST',
                data: requestData,
                success: function(response) {
                    $('#breadcumb').html('Kelas Tanah')
                    removeDesa()
                    removeNop()
                    $('.div_detail').css('display','none')
                    LTematik.clearLayers()
                    var data = JSON.parse(response)
                    var datas = JSON.parse(data.data)
                    LTematik.addData(datas);
                    map.fitBounds(LTematik.getBounds());
                    LTematik.addTo(map)
                    response = JSON.parse(response)
                    console.log(response.detail)
                    $('#div_tematik_body').html(response.detail)
                    $('#div_tematik').css('display','block')
                    $('#div_npwp').css('display','none')
                    hideLoading()
                    editableLayers.clearLayers()
                },
                error: function(xhr, status, error) {
                    console.error('Request failed:', error);
                }
            });
        // } else {
        //     LTematik.clearLayers()
        //     $('.div_detail').css('display','none')
        
        // }

    }
    function kelasBangunan() {
        
        // if($('#npwp').is(':checked')) {
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
                THN_PAJAK_SPPT:2023
            };
            showLoading()
            remove_overlay()
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                // url: 'localhost:5151/sismiop/sig_api/jenisTanah',
                url: "{{route('kelas_bangunan')}}",
                type: 'POST',
                data: requestData,
                success: function(response) {
                    $('#breadcumb').html('Kelas Bangunan')
                    removeDesa()
                    removeNop()
                    $('.div_detail').css('display','none')
                    LTematik.clearLayers()
                    var data = JSON.parse(response)
                    var datas = JSON.parse(data.data)
                    LTematik.addData(datas);
                    map.fitBounds(LTematik.getBounds());
                    LTematik.addTo(map)
                    response = JSON.parse(response)
                    console.log(response.detail)
                    // $('#h5_tematik').html('Kelas Tanah')
                    $('#div_tematik_body').html(response.detail)
                    $('#div_tematik').css('display','block')
                    hideLoading()
                    editableLayers.clearLayers()
                },
                error: function(xhr, status, error) {
                    console.error('Request failed:', error);
                }
            });
        // } else {
        //     LTematik.clearLayers()
        //     $('.div_detail').css('display','none')
        
        // }

    }
    function znt() {
        
        // if($('#npwp').is(':checked')) {
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
                THN_PAJAK_SPPT:2023
            };
            showLoading()
            remove_overlay()
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                // url: 'localhost:5151/sismiop/sig_api/jenisTanah',
                url: "{{route('znt')}}",
                type: 'POST',
                data: requestData,
                success: function(response) {
                    $('#breadcumb').html('Zona Nilai Tanah')
                    removeDesa()
                    removeNop()
                    $('.div_detail').css('display','none')
                    LTematik.clearLayers()
                    var data = JSON.parse(response)
                    var datas = JSON.parse(data.data)
                    LTematik.addData(datas);
                    map.fitBounds(LTematik.getBounds());
                    LTematik.addTo(map)
                    response = JSON.parse(response)
                    console.log(response.detail)
                    // $('#h5_tematik').html('Kelas Tanah')
                    $('#div_tematik_body').html(response.detail)
                    $('#div_tematik').css('display','block')
                    hideLoading()
                    editableLayers.clearLayers()
                },
                error: function(xhr, status, error) {
                    console.error('Request failed:', error);
                }
            });
        // } else {
        //     LTematik.clearLayers()
        //     $('.div_detail').css('display','none')
        
        // }

    }
    function buku() {
        
        // if($('#npwp').is(':checked')) {
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
                THN_PAJAK_SPPT:2023
            };
            showLoading()
            remove_overlay()
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                // url: 'localhost:5151/sismiop/sig_api/jenisTanah',
                url: "{{route('buku')}}",
                type: 'POST',
                data: requestData,
                success: function(response) {
                    $('#breadcumb').html('Buku')
                    removeDesa()
                    removeNop()
                    $('.div_detail').css('display','none')
                    LTematik.clearLayers()
                    var data = JSON.parse(response)
                    var datas = JSON.parse(data.data)
                    LTematik.addData(datas);
                    map.fitBounds(LTematik.getBounds());
                    LTematik.addTo(map)
                    response = JSON.parse(response)
                    console.log(response.detail)
                    $('#h5_tematik').html('Kelas Tanah')
                    $('#div_tematik_body').html(response.detail)
                    $('#div_tematik').css('display','block')
                    hideLoading()
                    editableLayers.clearLayers()
                },
                error: function(xhr, status, error) {
                    console.error('Request failed:', error);
                }
            });
        // } else {
        //     LTematik.clearLayers()
        //     $('.div_detail').css('display','none')
        
        // }

    }
    function statusPembayaran() {

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
                THN_PAJAK_SPPT:2023
            };
            showLoading()
            remove_overlay()
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                url: "{{route('status_pembayaran')}}",
                type: 'POST',
                data: requestData,
                success: function(response) {
                    $('#breadcumb').html('Status Pembayaran')
                    removeDesa()
                    removeNop()
                    $('.div_detail').css('display','none')
                    LTematik.clearLayers()
                    var data = JSON.parse(response)
                    var datas = JSON.parse(data.data)
                    LTematik.addData(datas);
                    map.fitBounds(LTematik.getBounds());
                    LTematik.addTo(map)
                    response = JSON.parse(response)
                    console.log(response.detail)
                    $('#h5_tematik').html('Status Pembayaran')
                    $('#div_tematik_body').html(response.detail)
                    // $('.header_detail').html('Status Pembayaran '+requestData.THN_PAJAK_SPPT)
                    $('#div_tematik').css('display','block')
                    hideLoading()
                    editableLayers.clearLayers()
                },
                error: function(xhr, status, error) {
                    console.error('Request failed:', error);
                }
            });
      

    }
    function tematikYear(tahun,url) {
            var head = {
                znt : 'Zona Nilai Tanah ',
                statusPembayaran : 'Status Pembayaran ',
                kelasBangunan : 'Kelas Bangunan ',
                kelasTanah : 'Status Tanah ',
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
            // showLoading()
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
                    var datas = JSON.parse(data.data)
                    LTematik.addData(datas);
                    map.fitBounds(LTematik.getBounds());
                    LTematik.addTo(map)
                    response = JSON.parse(response)
                    // $('#h5_tematik').html(title)
                    $('#div_tematik_body').html(response.detail)
                    // $('.header_detail').html(title)
                    $('#div_tematik').css('display','block')
                    hideLoading()
                    editableLayers.clearLayers()
                },
                error: function(xhr, status, error) {
                    console.error('Request failed:', error);
                }
            });
      

    }
    function tematik(url) {
        
            var header = {
                'jenisTanah' : 'Jenis Tanah'
            }

            console.log(header.url)
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
                    var datas = JSON.parse(data.data)
                    LTematik.addData(datas);
                    map.fitBounds(LTematik.getBounds());
                    LTematik.addTo(map)
                    response = JSON.parse(response)
                    // $('#h5_tematik').html('Kelas Tanah')
                    $('#div_tematik_body').html(response.detail)
                    // $('.header_detail').html(header.url)
                    $('#div_tematik').css('display','block')
                    hideLoading()
                    $('.modal').modal('hide')
                    editableLayers.clearLayers()
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
    function removeNop() {
        if ($('#1').prop('checked')) {
            $('#tmbl_layer_ori').click()

        }
    }

    function reload_layer() {
        // getDesa()
        if ($('#daftarDesa').prop('checked')) {
            $('#tmbl_layer_wilayah').click()
            $('#tmbl_layer_wilayah').click()
        }
        if ($('#1').prop('checked')) {
            $('#tmbl_layer_ori').click()
            $('#tmbl_layer_ori').click()
        }
        if ($('#2').prop('checked')) {
            $('#tmbl_layer_bangunan').click()
            $('#tmbl_layer_bangunan').click()
        }
        if ($('#3').prop('checked')) {
            $('#tmbl_layer_blok').click()
            $('#tmbl_layer_blok').click()
        } 
    }

    function remove_overlay() {
        if ($('#1').prop('checked')) {
            $('#tmbl_layer_ori').click()
        }
        if ($('#2').prop('checked')) {
            $('#tmbl_layer_bangunan').click()
        }
        if ($('#3').prop('checked')) {
            $('#tmbl_layer_blok').click()
        } 
    }

    function modalTematik(url) {

        $('#urlTematik').val(url)
        $('#modTahunTematik').modal('show')
    }

    function print_peta(kel) {
        printNop.clearLayers()
        printBlok.clearLayers()
        printBg.clearLayers()
        $.getJSON('{{url("getPrintPeta")}}/'+kel, function(data) {
            if (data.msg == 'Data Kosong') {
              toastr.warning("Warning", "Data Kosong")
            //   hideLoading()
                // editableLayers.clearLayers()
            }else{
                var nop = JSON.parse(data.nop)
                printNop.addData(nop);
                printNop.addTo(map2)
                var focus = nop.features[0].geometry.coordinates[0][0]
                var blok = JSON.parse(data.blok)
                printBlok.addData(blok);
                printBlok.addTo(map2)
                var bg = JSON.parse(data.bg)
                printBg.addData(bg);
                printBg.addTo(map2)
                map2.setView([focus[1],focus[0]], 16);
                
            }
        });
    }

    $(document).ready(function() {
           
            
        })
</script>

