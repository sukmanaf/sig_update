<style>
.search-input:focus{
  border-color: 1px solid red!important;
}
#searchBox{
  border-color: 1px solid  red!important;
}

</style>
<div class="modal fade" id="modalSearch" tabindex="-1" aria-labelledby="modalSearchLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content ">
        <div class="modal-header">
          <h5 class="modal-title" id="modalSearchLabel">sds</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="padding-top:5px;padding-bottom:5px">
            <form data-kt-search-element="form" class="w-100" autocomplete="off">
                <div class="row">
                    <div class="form-group has-search">
                        <span class="fa fa-search form-control-feedback"></span>
                        <input type="text" class="form-control"  id="cari_nop" placeholder="Search">
                    </div>
                </div>
                <div>
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
                
            </form>
        </div>
        <div class="modal-footer">
            {{-- <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button> --}}
          {{-- <button type="button" class="btn btn-sm btn-primary" onclick="tematikYear($('#tahunTematik').val(),$('#urlTematik').val())">Cari</button> --}}
        </div>
      </div>
    </div>
  </div>

  <script>

var input = document.getElementById("cari_nop");

// Execute a function when the user presses a key on the keyboard
input.addEventListener("keypress", function(event) {
  // If the user presses the "Enter" key on the keyboard
  if (event.key === "Enter") {
    // Cancel the default action, if needed
    event.preventDefault();
    
    cari_nop()
  }
});
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
            hideLoading()
        
        });
        var arr = [];
    }

    function cari_by_nop(nop) {
        // console.log(nop)s
        nop = nop.replace(/\./g,'').replace(/\-/g,'')
        $.getJSON('{{url("getSearchNop")}}/' + nop, function(data) {
            hideLoading()
            if (data.length == 0) {
              toastr.warning("Warning", "Data Tidak ditemukan")
              console.log('iki loooo')
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
                    ORI.addTo(map)
                    map.addLayer(editableLayers);
                    ORI.bringToFront();
                    map.fitBounds(polygon.getBounds());
                    console.log(map.getZoom())
                    $('#modalSearch').modal('hide')
    
                    if($('#daftarDesa').is(':checked')) {
                        $('#tmbl_layer_wilayah').click()
                    }
                });
              
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
                $('#modalSearch').modal('hide')
                hideLoading()
            }
            
        });
    }
    
    function cari_nop(cari) {
        showLoading()
        var nop = $('#cari_nop').val()
        var jns = $('input[name="jns_cari"]').val()

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
                    if ( $.fn.DataTable.isDataTable('#kt_profile_overview_table') ) {
                        $('#kt_profile_overview_table').DataTable().clear();
                        $('#kt_profile_overview_table').DataTable().destroy();
                    }
                    $('#bodySearch').append(str)
                    $('#kt_profile_overview_table').DataTable()
                    $('#divTableSearch').removeClass('hd')
                    hideLoading()
                    
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
                    if ( $.fn.DataTable.isDataTable('#kt_profile_overview_table') ) {
                        $('#kt_profile_overview_table').DataTable().clear();
                        $('#kt_profile_overview_table').DataTable().destroy();
                    }
                    $('#bodySearch').append(str)
                    $('#kt_profile_overview_table').DataTable()
                    $('#divTableSearch').removeClass('hd')
                    hideLoading()
                    
                },
                error: function(xhr, status, error) {
                    console.error('Request failed:', error);
                }
            });
        }
        var arr = [];
    }
  </script>