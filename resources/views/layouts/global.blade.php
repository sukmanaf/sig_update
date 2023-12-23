<div class="modal fade " data-bs-backdrop="static" id="modalLoading" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="background-color: transparent;">
        <div class="modal-body" style="">
        <div class="outer">
          <div class="inner">
          <button class="btn btn-primary" type="button" disabled>
              <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
              Loading...
              </button>
          </div>
         </div>
      </div>
      </div>
    </div>
  </div>
<script>

    function formatRupiah(number) {
        if (typeof number !== 'number') {
            return 'Invalid input';
        }
        
        const formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });
        
        return formatter.format(number);
    }

    function showLoading() {
        $('#modalLoading').modal('show')
    }
    function hideLoading() {
        $('#modalLoading').modal('hide')
    }

</script>