<script type="text/javascript">
	 function cari() {
        var cari = $('#searching').val();
        $.getJSON('{{url("getSearchNop")}}/' + cari, function(data) {
            data = JSON.parse(data[0]['geom'])['coordinates']
            var arr = []
            var pointZoom = []
            $.each(data[0], function(key, value) {
                // console.log(value[0])
                arr.push([value[1], value[0]])
                pointZoom = [value[1], value[0]]
            });
            if(editableLayers) {
                map.removeLayer(editableLayers);
                console.log()
            }
            editableLayers.clearLayers()

            var polygon = L.polygon(arr, {
                title: 'test',
                fillColor: 'red',
                fillOpacity: 0.5,
                weight: 5,
                color: 'red',
                opacity: 0.5,
                fill: true
            }).addTo(editableLayers);
            // ORI.addTo(map)
            map.addLayer(editableLayers);
            map.setView(pointZoom);
            map.setZoom(17);
        
        });
        var arr = [];
    }

    function cari_by_nop(nop) {
        // console.log(nop)s
        nop = nop.replace(/\./g,'').replace(/\-/g,'')
        console.log(nop)
        $.getJSON('{{url("getSearchNop")}}/' + nop, function(data) {
            if (data.length == 0) {
              toastr.warning("Warning", "Data Tidak ditemukan")
                
            } else {
                
                data = JSON.parse(data[0]['geom'])['coordinates']
                var arr = []
                var pointZoom = []
                $.each(data[0], function(key, value) {
                    // console.log(value[0])
                    arr.push([value[1], value[0]])
                    pointZoom = [value[1], value[0]]
                });
                if(editableLayers) {
                    map.removeLayer(editableLayers);
                    console.log()
                    editableLayers.clearLayers()
                }
                var polygon = L.polygon(arr, {
                    title: 'test',
                    fillColor: 'red',
                    fillOpacity: 0.5,
                    weight: 5,
                    color: 'red',
                    opacity: 0.5,
                    fill: true
                }).addTo(editableLayers);
                // ORI.addTo(map)
                var kec = nop.substring(0, 7) 
                var desa = nop.substring(0, 10)
                console.log(kec) 
                console.log(desa) 
                $.getJSON('{{url("getNop")}}/'+kec+'/'+desa, function(data) {
                    ORI.clearLayers()
                    datas = JSON.parse(data.data)
                    ORI.addData(datas);
                    map.fitBounds(ORI.getBounds());
                    ORI.addTo(map)
                    map.addLayer(editableLayers);
                    ORI.bringToFront();
                    map.fitBounds(polygon.getBounds());

                });
                map.setZoom(20);
                setTimeout(function() {
                    map.setView(pointZoom);
                }, 1000);
                $("#closeModalSearch").click();
                
                if($('#daftarDesa').is(':checked')) {
                    $('#tmbl_layer_wilayah').click()
                }
            }
            
        });
    }

    function get_nop_after_edit(nop) {
        nop = nop.replace(/\./g,'').replace(/\-/g,'')
        $.getJSON('{{url("getSearchNop")}}/' + nop, function(data) {
            if (data.length == 0) {
            } else {
                
                data = JSON.parse(data[0]['geom'])['coordinates']
                var arr = []
                var pointZoom = []
                $.each(data[0], function(key, value) {
                    // console.log(value[0])
                    arr.push([value[1], value[0]])
                    pointZoom = [value[1], value[0]]
                });
                
                map.setZoom(18);
                setTimeout(function() {
                    map.setView(pointZoom);
                }, 1000);
                
            }
            
        });
    }
    
    function cari_nop(cari) {
        var nop = $('#cari_nop').val()
        var jns = $('input[name="jns_cari"]').val()
        console.log(nop)
        console.log(jns)
        if($('#search_nop').is(':checked')) {
            cari_by_nop(nop)
        }else if($('#search_nama').is(':checked')) {
                const requestData = {
                    nama: nop,
                    };
                    $('#bodySearch').html('')

            $.ajax({
                url: 'https://sismiop.bapenda.padang.go.id/sismiop/sig_api/GetsPublicData/pencarianOp',
                type: 'POST',
                data: requestData,
                success: function(response) {
                    var str =''
                    console.log('iki str'+str)
                    $(response.data).each(function(i, v) {
                        str += '<tr><td>'+v.NOP+'</td>'+
                                '<td>'+v.NAMA+'</td>'+
                                '<td>'+v.ALAMAT+'</td>'+
                                '<td>'+
                                    '<button type="button" onclick="cari_by_nop(\''+v.NOP+'\')" class="btn btn-sm btn-primary">Pilih</button>'+
                                '</td>'+
                            '</tr>'
                    });
                    console.log('str ngisor'+str)
                    if ( $.fn.DataTable.isDataTable('#kt_profile_overview_table') ) {
                        $('#kt_profile_overview_table').DataTable().clear();
                        $('#kt_profile_overview_table').DataTable().destroy();
                    }
                    $('#bodySearch').append(str)
                    $('#kt_profile_overview_table').DataTable()
                    $('#divTableSearch').removeClass('hd')
                    
                    
                },
                error: function(xhr, status, error) {
                    console.error('Request failed:', error);
                }
            });
        }else{
            const requestData = {
                    alamat: nop,
                    };
                    $('#bodySearch').html('')

            $.ajax({
                url: 'https://sismiop.bapenda.padang.go.id/sismiop/sig_api/GetsPublicData/pencarianOp',
                type: 'POST',
                data: requestData,
                success: function(response) {
                    var str =''
                    console.log('iki str'+str)
                    $(response.data).each(function(i, v) {
                        str += '<tr><td>'+v.NOP+'</td>'+
                                '<td>'+v.NAMA+'</td>'+
                                '<td>'+v.ALAMAT+'</td>'+
                                '<td>'+
                                    '<button type="button" onclick="cari_by_nop(\''+v.NOP+'\')" class="btn btn-sm btn-primary">Pilih</button>'+
                                '</td>'+
                            '</tr>'
                    });
                    console.log('str ngisor'+str)
                    if ( $.fn.DataTable.isDataTable('#kt_profile_overview_table') ) {
                        $('#kt_profile_overview_table').DataTable().clear();
                        $('#kt_profile_overview_table').DataTable().destroy();
                    }
                    $('#bodySearch').append(str)
                    $('#kt_profile_overview_table').DataTable()
                    $('#divTableSearch').removeClass('hd')
                    
                    
                },
                error: function(xhr, status, error) {
                    console.error('Request failed:', error);
                }
            });
        }
        var arr = [];
        $('#kt_modal_users_search_handler').modal('hide')
    }
</script>