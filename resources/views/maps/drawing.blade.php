<script type="text/javascript">
	 //========================== drawing ======================


    function select_draw(val) {
    	$('#div_delete_nop').addClass('hd')
        selected_draw = val;
        if(val == 0) {
            map.removeControl(drawControl);
            map.removeLayer(editableLayers);
            editableLayers.clearLayers()
            $('#nop_edit').val("")
            $('#nop_edit_old').val("")
        } else {
            editableLayers.clearLayers()
            editableLayers.on("click", function(e) {
                console.log("editableLayers click");
                $('#mod_add').modal('show')
                    //   console.log(e);
            });
            editableLayers.on("touchstart", function(e) {
                console.log("editableLayers touchstart");
                //   console.log(e);
            });
            map.addLayer(editableLayers);
            drawControl = new L.Control.Draw({
                position: "topright",
                draw: {
                    polyline: true,
                    polygon: {
                        allowIntersection: false,
                        drawError: {
                            color: "#e1e100",
                            message: "<strong>Oh snap!<strong> you can't draw that!"
                        },
                        shapeOptions: {
                            color: "blue",
                            clickable: true
                        }
                    },
                    circle: false,
                    circlemarker: false,
                    rectangle: {
                        shapeOptions: {
                            clickable: true
                        }
                    },
                    marker: true
                },
                edit: {
                    featureGroup: editableLayers,
                    remove: true
                }
            });
            map.addControl(drawControl);
           
            map.on('draw:created', function(e) {
        		editableLayers.clearLayers()
                var type = e.layerType
                if(type == 'polygon'){
                	editableLayers.addLayer(e.layer)
                	map.addLayer(editableLayers)
                	arrDraw.push(e.layer.getLatLngs())
                	var geom = e.layer.getLatLngs()
                	var str = 'Polygon(('
	                var last = '';
	                $.each(geom[0], function(index, value) {
	                    if(index == 0) {
	                        last = '' + value['lng'] + ' ' + value['lat'] + ''
	                    }
	                    str += '' + value['lng'] + ' ' + value['lat'] + ',';
	                });
	                str.slice(0, -1)
	                str += last + '))'
	                $('#nop_add_geom').val(str)
	                
	                // $('#mod_add').modal('show')
                }else if(type == 'marker'){
                	editableLayers.addLayer(e.layer)
                	map.addLayer(editableLayers)
                	console.log(e.layer.getLatLng())

                }

                $('#div_save').removeClass('hd')
               
                // e.cancel();
            });
            map.on('draw:editstop', function(e) {
                var geom = editableLayers.getLayers()[0].getLatLngs()
                    // // =======
                var str = 'Polygon(('
                var last = '';
                $.each(geom[0], function(index, value) {
                    if(index == 0) {
                        last = '' + value['lng'] + ' ' + value['lat'] + ''
                    }
                    str += '' + value['lng'] + ' ' + value['lat'] + ',';
                });
                str.slice(0, -1)
                str += last + '))'
                $('#nop_edit_geom').val(str)
                // $('#mod_edit').modal('show')
                $('#btn_save_edit_nop').removeClass('hd')
                $('#btn_save_edit_blok').removeClass('hd')
                $('#btn_save_edit_bg').removeClass('hd')
                
                if($('#auto_save').val() == 1){
                    $('#nop_editForm').submit();                            
                }
                
                // map.removeLayer(editableLayers);
                // editableLayers.removeLayer(e.layer);

            });

           
        }
    }

     function rem(params) {
        map.removeControl(drawControl);
    }

    function cancel_draw(argument) {
        // editableLayers.clearLayers()
		map.removeLayer(editableLayers);
        $('#div_save').addClass('hd')
    }
  	function cancel_edit_nop(argument) {
        // editableLayers.clearLayers()
		map.removeLayer(editableLayers);
        $('#div_delete_nop').addClass('hd')
        $('#btn_save_edit_nop').addClass('hd')
    }
  	function cancel_edit_blok(argument) {
        // editableLayers.clearLayers()
		map.removeLayer(editableLayers);
        $('#div_delete_blok').addClass('hd')
        $('#btn_save_edit_blok').addClass('hd')
    }
  	function cancel_edit_bg(argument) {
        // editableLayers.clearLayers()
		map.removeLayer(editableLayers);
        $('#div_delete_bangunan').addClass('hd')
        $('#btn_save_edit_bg').addClass('hd')
    }



    function save_draw(argument) {
    	var geom = editableLayers.getLayers()[0].getLatLngs()
                    // // =======
        var str = 'Polygon(('
        var last = '';
        $.each(geom[0], function(index, value) {
            if(index == 0) {
                last = '' + value['lng'] + ' ' + value['lat'] + ''
            }
            str += '' + value['lng'] + ' ' + value['lat'] + ',';
        });
        str.slice(0, -1)
        str += last + '))'
        $('#nop_add_geom').val(str)
        $('#img_nop_file').html('<div class="row"><div class="col-md-10"><input type="file" name="img[]" id=""></div>'+
                                '<div class="col-md-2"><button type="button" onclick="addFiles()" style="float:right;width:80px" class="btn btn-sm btn-primary">Tambah</button>'+
                                    '</div> </div>')
    	$('#mod_add').modal('show')
    }
    
    var numFiles = 0
    function addFiles() {
        $('#img_nop_file').append('<div class="row" id="f'+numFiles+'"><div class="col-md-10" ><input type="file" name="img[]" id=""></div>'+
                                    '<div class="col-md-2"><button type="button" onclick="deleteFile(\'f'+numFiles+'\')" style="float:right;width:80px" class="btn btn-sm btn-danger">Hapus</button></div></div>')
    
    }

    function deleteFile(id) {
        $('#'+id).remove()
    }

    function edit_draw(argument) {
    	 var geom = editableLayers.getLayers()[0].getLatLngs()
        var str = 'Polygon(('
        var last = '';
        $.each(geom[0], function(index, value) {
            if(index == 0) {
                last = '' + value['lng'] + ' ' + value['lat'] + ''
            }
            str += '' + value['lng'] + ' ' + value['lat'] + ',';
        });
        str.slice(0, -1)
        str += last + '))'
        $('#nop_edit_geom').val(str)
        // $('#ximg_nop_file').html('<div class="row"><div class="col-md-10"><input type="file" name="ximg[]" id=""></div>'+
        //                 '<div class="col-md-2"><button type="button" onclick="xaddFiles()" style="float:right;width:80px" class="btn btn-sm btn-primary">Tambah</button>'+
        //                     '</div> </div>')
    	$('#mod_edit').modal('show')
    }

    function xaddFiles() {
        $('#ximg_nop_file').append('<div class="row" id="f'+numFiles+'"><div class="col-md-10" ><input type="file" name="img[]" id=""></div>'+
                                    '<div class="col-md-2"><button type="button" onclick="deleteFile(\'f'+numFiles+'\')" style="float:right;width:80px" class="btn btn-sm btn-danger">Hapus</button></div></div>')
    
    }

    function jenis_change(v) {
    	if (v==1) {
    		$('#img_nop').removeClass('hd')
    	}else{
    		$('#img_nop').addClass('hd')
    	}
    }
    function xjenis_change(v) {
    	if (v==1) {
    		$('#ximg_nop').removeClass('hd')
    	}else{
    		$('#ximg_nop').addClass('hd')
    	}
    }
function delete_nop(argument) {
  $.ajax({
     headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
    url: "{{url('deleteNop')}}/" + $('#inp_delete_nop').val(),
    type: 'DELETE',
    dataType: 'json',
    success: function(response) {
        editableLayers.clearLayers()
        map.removeLayer(editableLayers);
        ORI.clearLayers()
	        // map.removeLayer(ORI);
       	generate_nop()
        $('#div_delete_nop').addClass('hd')
    },
    error: function(xhr, status, error) {
      // Handle the error response
      console.error(error);
    }
  });
}
function delete_blok(argument) {
  $.ajax({
     headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
    url: "{{url('deleteBlok')}}/" + $('#inp_delete_blok').val(),
    type: 'DELETE',
    dataType: 'json',
    success: function(response) {
        editableLayers.clearLayers()
        map.removeLayer(editableLayers);
        generate_blok()
        $('#div_delete_blok').addClass('hd')
    },
    error: function(xhr, status, error) {
      // Handle the error response
      console.error(error);
    }
  });
}
function delete_bng(argument) {
  $.ajax({
     headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
    url: "{{url('deleteBangunan')}}/" + $('#inp_delete_bangunan').val(),
    type: 'DELETE',
    dataType: 'json',
    success: function(response) {
        editableLayers.clearLayers()
        map.removeLayer(editableLayers);
        generate_bangunan()
        $('#div_delete_bangunan').addClass('hd')
    },
    error: function(xhr, status, error) {
      // Handle the error response
      console.error(error);
    }
  });
}

function copy_polygon_nop() {
    editableLayers.clearLayers()
    polygon_op = L.polygon(polyCoords, {
        title: 'test',
        fillColor: 'blue',
        fillOpacity: 0.5,
        weight: 5,
        color: 'blue',
        opacity: 0.5,
        fill: true,
        draggable: true,
    }).addTo(editableLayers);
    map.addLayer(editableLayers);
   
    console.log(polygon_draw)
    $('#div_delete_nop').addClass('hd')
    $('#div_save').removeClass('hd')
	
}

function copy_polygon_blok() {
    editableLayers.clearLayers()
    polygon_op = L.polygon(polyCoords, {
        title: 'test',
        fillColor: 'blue',
        fillOpacity: 0.5,
        weight: 5,
        color: 'blue',
        opacity: 0.5,
        fill: true,
        draggable: true,
    }).addTo(editableLayers);
    map.addLayer(editableLayers);
    console.log(polygon_draw)
    $('#div_delete_blok').addClass('hd')
    $('#div_save').removeClass('hd')
	
}

function copy_polygon_bg() {
    editableLayers.clearLayers()
    polygon_op = L.polygon(polyCoords, {
        title: 'test',
        fillColor: 'blue',
        fillOpacity: 0.5,
        weight: 5,
        color: 'blue',
        opacity: 0.5,
        fill: true,
        draggable: true,
    }).addTo(editableLayers);
    map.addLayer(editableLayers);
    console.log(polygon_draw)
    $('#div_delete_bangunan').addClass('hd')
    $('#div_save').removeClass('hd')
	
}


</script>