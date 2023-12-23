<script type="text/javascript">
	 $(document).ready(function() {
        $('#search_result').on('scroll', function() {
            var scrollPosition = $(this).scrollTop();
            var scrollHeight = $(this).prop('scrollHeight');
            var divHeight = $(this).height();
            // Check if the scroll position is close to the bottom of the div
            if(scrollPosition >= scrollHeight - divHeight - 200) {
                // Load more data
                $('#span_load_data').css('display','block')
                setTimeout(() => {
                    $('#span_load_data').css('display','none')
                    $('#search_result').append(html)
                }, "2000");
            }
        });
        $('#searching').keypress(function(e) {
            if(e.which == 13) {
                var int = $('#searching').val();
                if($.isNumeric(int)) {
                    $.getJSON('{{url("getSearchNop")}}' + int, function(data) {
                        // data = JSON.parse(data[0]['geom'])['coordinates']
                        console.log(data)
                            // var polygon = L.polygon(data, {
                            //         title: 'test',
                            //         fillColor: '#F16E60',
                            //         fillOpacity: 0.5,
                            //         weight:5,
                            //         color: '#F16E60',
                            //         opacity: 0.5,
                            //         fill: true
                            //     }).addTo(editableLayers);      
                            //     map.addLayer(editableLayers);
                            // $('#1').attr('checked','checked');
                            // $("#1").trigger("change")
                    });
                }
            }
        });
        $("#nop_addForm").submit(function(event) {
            event.preventDefault(); //prevent default action 
            var form_data = new FormData(this); //Encode form elements for submission
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{url('save_nop')}}",
                type: 'POST',
                data: form_data,
                processData: false,
                contentType: false,
                cache: false,
                async: false,
            }).done(function(response) {
                response = JSON.parse(response)
                $('#mod_add').modal('hide')
                $("#nop_add").val("")
		        map.removeLayer(editableLayers);
                cancel_draw()
		        if (response.jns=='nop') {
		        	// generate_nop()
                    var poly = JSON.parse(response.new_poly)
                    ORI.addData(poly);
                    // map.fitBounds(ORI.getBounds());
                    // ORI.addTo(map)
                    toastr.success('Tambah NOP Berhasil!', 'Success');
		        }else if (response.jns=='blok') {
		        	generate_blok()
		        }else if (response.jns=='bangunan') {
		        	generate_bangunan()
		        }
		        
            });
        });
        $("#nop_editForm").submit(function(event) {
            event.preventDefault(); //prevent default action 
            var form_data = new FormData(this); //Encode form elements for submission
            console.log('edit post')
            var datas = {
                "nop": $("#nop_edit").val(),
                "nop_old": $("#nop_edit_old").val(),
                "geom": $("#nop_edit_geom").val(),
                "jenis": $("#xjenis").val(),
            }

            const jsonObject = {};
            form_data.forEach((value, key) => {
                jsonObject[key] = value;
            });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{url('maps')}}/" + $('#nop_edit_old').val(),
                type: "PUT",
                cache: false,
                data: datas,
            }).done(function(response) {
                response= JSON.parse(response)
                console.log(response.jns)
                $('#mod_edit').modal('hide')
                console.log('mari edit')
                console.log(response)
                // map.removeLayer(ORI);
                    map.removeLayer(editableLayers);
	                cancel_draw()
			        if (response.jns=='nop') {
                        ORI.eachLayer(function (layer) {
                            if (layer.feature.properties.d_nop === $("#nop_edit").val()) {
                            ORI.removeLayer(layer);
                            var poly = JSON.parse(response.new_poly)
                            ORI.addData(poly);
                            toastr.success('Edit Nop Berhasil!', 'Success');

                            }
                        });
			        	// generate_nop($("#nop_edit").val())
			        }else if (response.jns=='blok') {
			        	generate_blok()
			        }else if (response.jns=='bangunan') {
			        	generate_bangunan()
			        }
        		$('#div_delete_nop').addClass('hd')
        		$('#div_delete_blok').addClass('hd')
        		$('#div_delete_bangunan').addClass('hd')

                // ========
            });
        });
        $("#usulanForm").submit(function(event) {
            event.preventDefault(); //prevent default action 
            var datas = {
                "nop": $("#usulanNop").val(),
                "usulan": $("#usulanText").val()
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{url('save_usulan')}}/",
                type: "post",
                cache: false,
                data: datas,
                success: function(response) {
                    toastr.success(response.message, 'Success');
                    $("#usulanText").val('')
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON.message, 'Error');
                }
            }).done(function(response) {
                

            });
        });

        $("#formInsert").submit(function(event) {
            event.preventDefault(); //prevent default action 
            var form_data = new FormData(this); //Encode form elements for submission
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{url('maps')}}",
                type: 'POST',
                data: form_data,
                processData: false,
                contentType: false,
                cache: false,
                async: false,
            }).done(function(response) {
                response = JSON.parse(response)
                console.log(response)
            });
        });

        
        $( "#kt_modal_users_search_handler" ).on('shown', function(){
            $('#kt_modal_users_search').addClass('hd')
            $('#cari_nop').val('')
            $('#bodySearch').html('')
        });
    });


	
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

function showLoading() {
    $('#modalLoading').modal('show')
}
function hideLoading() {
    $('#modalLoading').modal('hide')
}

function saveUsulan() {
            $('#usulanForm').submit()
        }

</script> 