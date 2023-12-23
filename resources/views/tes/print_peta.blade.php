
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
                <div id="map2" style="height:2000px;width:100%"></div>
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
  googleSatelite.addTo(map2)

        $(document).ready(function() {
          
  });
</script>