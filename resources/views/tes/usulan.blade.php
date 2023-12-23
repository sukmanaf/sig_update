@extends('layouts.app')

@section('content')
<div class="card" style="padding: 20px;">
    <h2>Usulan Kelurahan</h2>
    <div class="row">
        <table id="usulan-table" class="table table-striped table-sm table-hover ">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NOP</th>
                    <th>Usulan</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>


<!-- Button trigger modal -->


<!-- Modal -->

<!-- Modal -->

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#usulan-table').DataTable({
                processing: true,
                serverSide: true,
                searchable: true,
                dom: 'lrt',
                ajax: '{{route("getUsulan")}}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'nop', name: 'nop' },
                    { data: 'usulan', name: 'usulan' },
                    { data: 'status',
                        render: function (data, type, row) {
                            if(row.status == 1){
                                return '<span class="badge rounded-pill bg-primary">Aktif</span>'
                            }else{
                                return '<span class="badge rounded-pill bg-danger">Selesai</span>'
                            }
                        }
                    },
                    {
                        data:null,
                        render: function (data, type, row) {
                            if(row.status == 1){
                                return '<button title="Selesai" class="btn btn-success btn-sm" onclick="nonaktif(' + data.id + ')"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="10" zoomAndPan="magnify" viewBox="0 0 30 30.000001" height="10" preserveAspectRatio="xMidYMid meet" version="1.0"><defs><clipPath id="id1"><path d="M 2.328125 4.222656 L 27.734375 4.222656 L 27.734375 24.542969 L 2.328125 24.542969 Z M 2.328125 4.222656 " clip-rule="nonzero"/></clipPath></defs><g clip-path="url(#id1)"><path fill="rgb(255, 255, 255)" d="M 27.5 7.53125 L 24.464844 4.542969 C 24.15625 4.238281 23.65625 4.238281 23.347656 4.542969 L 11.035156 16.667969 L 6.824219 12.523438 C 6.527344 12.230469 6 12.230469 5.703125 12.523438 L 2.640625 15.539062 C 2.332031 15.84375 2.332031 16.335938 2.640625 16.640625 L 10.445312 24.324219 C 10.59375 24.472656 10.796875 24.554688 11.007812 24.554688 C 11.214844 24.554688 11.417969 24.472656 11.566406 24.324219 L 27.5 8.632812 C 27.648438 8.488281 27.734375 8.289062 27.734375 8.082031 C 27.734375 7.875 27.648438 7.679688 27.5 7.53125 Z M 27.5 7.53125 " fill-opacity="1" fill-rule="nonzero"/></g></svg></button>';
                            }else{
                                    return ''
                            }
                        }
                    }
                ],
                    rowCallback: function (row, data, index) {
                    // Set the row number as the first column (index + 1)
                    $('td:eq(0)', row).html(index + 1);
                }
            });

            $("#addForm").submit(function(event) {
                event.preventDefault(); //prevent default action 
                var form_data = new FormData(this); //Encode form elements for submission
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{url('muser')}}",
                    type: 'POST',
                    data: form_data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,
                }).done(function(response) {
                    response = JSON.parse(response)
                    console.log(response)
                    if (response.sts == 'success') {
                        console.log('masuk')
                        toastr.success("Success", "Input Data Sukses")
                        $('.btn-close-modal').click();
                        $('#usulan-table').DataTable().ajax.reload();

                    }else{
                        console.log('gak masuk')
                        toastr.warning("Warning", "Inpit Data Gagal")
                    }
                });
            });

            $("#editForm").submit(function(event) {
                event.preventDefault(); //prevent default action 
                var form_data = new FormData(this); //Encode form elements for submission
                form_data.append('_method','PUT')
                console.log(form_data)
                var xid = $('#xid').val()
                var url = "{{route('muser.update','xxx')}}"
                url = url.replace('xxx',xid)
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: 'post',
                    data: form_data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,
                    dataType:"json",
                    success: function(response) {
                        if (response.sts == 'success') {
                            toastr.success("Success", "Input Data Sukses")
                            $('.btn-close-modal').click();
                            $('#usulan-table').DataTable().ajax.reload();

                        }else{
                            toastr.warning("Warning", "Inpit Data Gagal")
                        }

                        // You can also update the UI as needed after successful deletion
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON.message, 'Error');
                    }
                }).done(function(response) {
                    // response = JSON.parse(response)
                    
                });
            });
        });


        function edits(id) {
            var table = $('#usulan-table').DataTable()
            var tableData = table.rows().data().toArray();
            var data
            tableData.forEach(v => {
                if (id == v.id) {
                    $('#xid').val(v.id)
                    $('#xemail').val(v.email)
                    // $('#xkode_desa').val(v.kode_desa).trigger('change')
                    $('#xrole').val(v.roles_id).trigger('change')
                    if (v.roles_id == '3') {
                        $('.select-wil').removeClass('hd1')
                        var kd_kec = v.kode_desa.substring(0, 7); // Extracts "Hello"
                        $('#xkode_kecamatan').val(kd_kec).trigger('change')
                        desaSelect(kd_kec,v.kode_desa)
                        
                    }

                }

            });
            $('#editModal').modal('show')

            // console.log(data)
        }

        

        function nonaktif(id) {
             var url = "{{route('nonaktifkanUsulan','xxx')}}"
                url = url.replace('xxx',id)
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: 'get',
                    success: function(response) {
                        toastr.success('Usulan Sudah ditindaklanjuti!', 'Success');
                        $('#usulan-table').DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON.message, 'Error');
                    }
                });
        }

    </script>
@endpush
