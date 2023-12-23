
<div class="modal" id="modal_print" tabindex="-1">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title">Print Peta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <label class="control-label col-form-label" for="">Pilih Blok</label>
                </div>
                <div class="col-md-4">
                        <select class="form-select form-select-solid form-select-sm" data-control="select2" id="print_blok" data-hide-search="true" onchange="">
                        </select>
                </div>
                <div class="col-md-4">
                    <button id="btn_cari_peta" onclick="print_peta($('#print_blok').val())" class="btn btn-success btn-sm">Cari</button>
                </div>
            </div>

            <div>
                <div id="map2" style="height:100vh;width:100%"></div>
            </div>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
//======================= tematik ====================


     printNop = L.geoJson(null, {
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
    printBlok = L.geoJson(null, {
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
     printBg = L.geoJson(null, {
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
    //====

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
          
  });
</script>

wadmkc
wadmkk
wadmpr
kdpkab
kdppum
lokasi
pemohon
namprh
alamat_perusahaan
rcnkeg
nib
kdkbli
kbli
jptp
noptp
tglptp
luas_ha
luas_m2
thndata
geom
hsl_ptp
wadmkd
created_by
created_at
updated_by
updated_at