    <link href="{{asset('custom\toastr\toastr.scss')}}" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .my-label{
            background-color: transparent;
            border: transparent;
            color: white;
             box-shadow: none;

        }

        .color_transparent{
            color: transparent;
        }
    </style>
<script type="text/javascript">
    //======================= Ori ===========================
    var kec = $('#select_kec').val()
    var desa = $('#select_desa').val()
    var polygon_op
    var wilayah = L.geoJson(null, {
        onEachFeature: function(feature, layer) {
            layer.on("click", function() {
                    // alert(selected_draw)
                    console.log(feature.properties)
                    
                })
            layer.unbindTooltip();
            var label = L.tooltip({
                permanent: true,
                direction: 'center',
                className: 'my-label',
                offset: [0, 0]
            }).setContent('<label class="text-tooltip ">'+feature.properties.d_nm_kel+'</label>');
            layer.bindTooltip(label);

             map.on('zoomend', function() {
                if (map.getZoom() < 13) {
                    console.log('if')
                   $('.text-tooltip').addClass('color_transparent');
                } else {
                    console.log('else')
                   $('.text-tooltip').removeClass('color_transparent');
                    
                }
             console.log(map.getZoom())
            });

            

        },
        style: function(feature) {
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
                color: "white",
            }
        }
    });

    $.getJSON('http://localhost:8000/getWilayah', function(data) {
        wilayah.addData(data);
        map.fitBounds(wilayah.getBounds());
        // wilayah.addTo(map)

        // $('#modal_detail').modal('show')
    });
    var ORI = L.geoJson(null, {
        onEachFeature: function(feature, layer) {
            layer.on("click", function() {
                // alert(selected_draw)
                console.log(feature.properties.d_nop)
                console.log($('#select_drawing').val())
                if ($('#select_drawing').val() == 1) {
                    $('#inp_delete_nop').val(feature.properties.d_nop)
                    $('#div_delete_nop').removeClass('hd')
                }

                if(selected_draw == 0) {
                    $('#lbl_nop').html(feature.properties.D_NOP)
                    $('#lbl_luas').html(feature.properties.D_LUAS)
                    $('#modal_detail').modal('show')
                    show_op()
                } else {
                    var f = feature.geometry.coordinates
                        console.log('iki f')
                        // console.log(feature.properties.D_NOP)
                        // console.log(feature.properties.d_nop)
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
            var label = L.tooltip({
                permanent: true,
                direction: 'center',
                className: 'my-label',
                offset: [0, 0]
            }).setContent('<label class="text-tooltip ">'+feature.properties.d_nm_kel+'</label>');
            layer.bindTooltip(label);

             map.on('zoomend', function() {
                if (map.getZoom() < 13) {
                    console.log('if')
                   $('.text-tooltip').addClass('color_transparent');
                } else {
                    console.log('else')
                   $('.text-tooltip').removeClass('color_transparent');
                    
                }
             console.log(map.getZoom())
            });

        },
        style: function(feature) {
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
                color: "white",
            }
        }
    });
    
    //======================= Backgraund ================= 
    var BG = L.geoJson(null, {
         onEachFeature: function(feature, layer) {
            layer.on("click", function() {
                    
                    if(selected_draw == 0) {
                       
                    } else {
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
                fillColor: "green",
                fillOpacity: 0.5,
                color: "green",
                dashArray: '3',
                weight: 2,
                opacity: 0.7,
            }
        }
    });
    $.getJSON('http://localhost:8000/getAllNop', function(data) {
       
        
    });
    //============================= BL =========================
    var BL = L.geoJson(null, {
        onEachFeature: function(feature, layer) {
            layer.on("click", function() {
                    
                    if(selected_draw == 0) {
                       
                    } else {
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
                // layer.bindTooltip('Hi there', {permanent: true}).openTooltip(); 
                // layer.bindTooltip(feature.properties.d_nop, { 'permanent': true});
                // feature.properties.D_NOP
        },
        style: function(feature) {
            // kec = feature.properties.OBJECTID;
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
    $.getJSON('http://localhost:8000/getAllNop', function(data) {
       
    });
    
    //======================= search ====================
    //======================= Layer control ====================
    
    var layer1 = ORI;
    var layer2 = BG;
    var layer3 = BL;
   
    var layers = [layer1, layer2, layer3];
    var selId = null;

    function processCheck(checkbox) {
        map.removeLayer(wilayah);
        var checkId = checkbox.id;
        hide_tematik()
        if(checkId == 5) {
            $('#div_jenis_tanah').css('display', 'block')
        } else {
            $('#div_jenis_tanah').css('display', 'none')
        }
        if(checkId == 6) {
            $('#div_jenis_bangunan').css('display', 'block')
            if(!map.hasLayer(ORI) && $('#6').is(':checked')) {
                $('#tmbl_layer_ori').click()
            };
            if($('#6').is(':checked')) {} else {
                // $('#tmbl_layer_ori').click()
                // $('#tmbl_layer_ori').click()
                $('#div_jenis_bangunan').css('display', 'none')
            }
        } else {}
        if(checkId == 7) {
            $('#div_buku').css('display', 'block')
        } else {
            $('#div_buku').css('display', 'none')
        }
        if(checkId == 8) {
            $('#div_npwp').css('display', 'block')
        } else {
            $('#div_npwp').css('display', 'none')
        }
        if(checkId == 9) {
            $('#div_status_pembayaran').css('display', 'block')
        } else {
            $('#div_status_pembayaran').css('display', 'none')
        }
        if(checkId == 10) {
            $('#div_individu').css('display', 'block')
        } else {
            $('#div_individu').css('display', 'none')
        }
        if(checkbox.checked) {
            // if (selId != null) {
            //   map.removeLayer(layers[selId - 1]);
            //   document.getElementById(selId).checked = false;
            // }
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
            // generate_op()
            // console.log('generate')
            // console.log(layers[checkId - 1])
        } else {
            console.log('deleted')
            console.log(layers[checkId - 1])
            map.removeLayer(layers[checkId - 1]);
            selId = null;
            $('#div_jenis_tanah').css('display', 'none')
            $('#div_buku').css('display', 'none')
            $('#div_npwp').css('display', 'none')
            $('#div_status_pembayaran').css('display', 'none')
            $('#div_individu').css('display', 'none')
                // $('#div_jenis_bangunan').css('display','none')
                // if (checkId == 6) {
                //     $('#tmbl_layer_ori').click()
                // }
        }
        if(map.hasLayer(ORI)) {
            ORI.bringToFront();
            console.log('ada ori')
        };
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


    function generate_nop() {
        var kec = $('#select_kec').val()
        var desa = $('#select_desa').val()
        ORI.clearLayers()
        $.getJSON('http://localhost:8000/getNop/'+kec+'/'+desa, function(data) {
            if (data.msg == 'Data Kosong') {
              toastr.warning("Warning", "Data Kosong")
            }else{
                datas = JSON.parse(data.data)
                 ORI.addData(datas);
                map.fitBounds(ORI.getBounds());
                ORI.addTo(map)
                // // console.log(data.data[0])
                // datas = data.data
                // datas.forEach(function(v) {
                //   // console.log(JSON.parse(v));
                //       // setTimeout(function() {
                //         ORI.addData(JSON.parse(v));
                //         map.fitBounds(ORI.getBounds());
                //         ORI.addTo(map)
                //     // }, 10000);
                // });
            }
        });
    }

    function generate_blok() {
        var kec = $('#select_kec').val()
        var desa = $('#select_desa').val()
        BL.clearLayers()
        $.getJSON('http://localhost:8000/getBlok/'+kec+'/'+desa, function(data) {
            if (data.msg == 'Data Kosong') {
              toastr.warning("Warning", "Data Kosong")
            }else{
                datas = JSON.parse(data.data)
                BL.addData(datas);
                map.fitBounds(BL.getBounds());
                BL.addTo(map)
            }
        });
    }
    function generate_bangunan() {
        var kec = $('#select_kec').val()
        var desa = $('#select_desa').val()
        BG.clearLayers()
        console.log('getbng')
        $.getJSON('http://localhost:8000/getBng/'+kec+'/'+desa, function(data) {
            if (data.msg == 'Data Kosong') {
              toastr.warning("Warning", "Data Kosong")
            }else{
                datas = JSON.parse(data.data)
                BG.addData(datas);
                map.fitBounds(BG.getBounds());
                BG.addTo(map)
            }
        });
    }


</script>
