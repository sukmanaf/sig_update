@extends('layouts.app')

@section('content')
<div class="card" style="padding: 20px;">
    <div class="row">
    <button type="button" class="btn btn-primary btn-sm" style="width: 100px;" data-bs-toggle="modal" data-bs-target="#addModal">Tambah</button> <!-- div.col -->
        <table id="users-table" class="table table-striped table-sm table-hover ">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>


<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Tambah Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data" id="addForm"> @csrf
            <div class="modal-body">
                <div class="fv-row mb-8 fv-plugins-icon-container">
                    <label class="required fs-6 fw-bold ">Role</label>
                    <select name="role" class="form-select form-select-solid select2-hidden-accessible" data-control="select2" onchange="roleChange($(this).val())" >
                        <option value="1">Admin</option>
                        <option value="2">Bapenda</option>
                        <option value="3">Kelurahan</option>

                    </select> 
                </div>
                <div class="fv-row mb-8 fv-plugins-icon-container select-wil hd1">
                    <label class="required fs-6 fw-bold ">Kecamatan</label>
                    <select name="kode_kecamatan"  id="kode_kecamatan" class="form-select form-select-solid select2-hidden-accessible" onchange="kecamatanChange($(this).val())" data-control="select2" >
                            <option value="00">Pilih Kecamatan</option>
                            @if(!empty($kecamatan))
                                @foreach ($kecamatan as $kec)
                                <option value="{{$kec->d_kd_kec}}">{{$kec->d_nm_kec}}</option>
                                @endforeach
                            @endif
                    </select> 
                </div>
                <div class="fv-row mb-8 fv-plugins-icon-container select-wil hd1">
                    <label class="required fs-6 fw-bold ">Kelurahan</label>
                    <select name="kode_desa" id="kode_desa" class="form-select form-select-solid select2-hidden-accessible hd"  data-control="select2" >
                            <option value="00">Pilih Kelurahan</option>
                           
                    </select> 
                </div>
                
                <div class="fv-row mb-12 fv-plugins-icon-container">
                    <label class="required fs-6 fw-bold mb-2">Username</label>
                    <input type="text" class="form-control form-control-solid" placeholder="" name="email" value="">
                </div>
                <div class="fv-row mb-12 fv-plugins-icon-container">
                    <label class="required fs-6 fw-bold mb-2">Password</label>
                    <input type="text" class="form-control form-control-solid" placeholder="" name="password" value="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button"  class="btn btn-secondary btn-close-modal" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Edit Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form  enctype="multipart/form-data" id="editForm"> @csrf
            <div class="modal-body">
                <input type="hidden" name="xid" id="xid" value="122">
                <input type="hidden" name="_method" value="put" />
                <div class="fv-row mb-8 fv-plugins-icon-container">
                    <label class="required fs-6 fw-bold ">Role</label>
                    <select id="xrole" name="xrole" class="form-select form-select-solid select2-hidden-accessible" onchange="xroleChange($(this).val())" data-control="select2" >
                        <option value="1">Admin</option>
                        <option value="2">Kota</option>
                        <option value="3">Kelurahan</option>
                    </select> 
                </div>
                <div class="fv-row mb-8 fv-plugins-icon-container select-wil hd1">
                    <label class="required fs-6 fw-bold ">Kecamatan</label>
                    <select name="xkode_kecamatan"  id="xkode_kecamatan" class="form-select form-select-solid select2-hidden-accessible" onchange="xkecamatanChange($(this).val())" data-control="select2" >
                            <option value="00">Pilih Kecamatan</option>
                            @if(!empty($kecamatan))
                                @foreach ($kecamatan as $kec)
                                <option value="{{$kec->d_kd_kec}}">{{$kec->d_nm_kec}}</option>
                                @endforeach
                            @endif
                    </select> 
                </div>
                <div class="fv-row mb-8 fv-plugins-icon-container select-wil hd1">
                    <label class="required fs-6 fw-bold ">Kelurahan</label>
                    <select name="xkode_desa" id="xkode_desa" class="form-select form-select-solid select2-hidden-accessible hd"  data-control="select2" >
                            <option value="00">Pilih Kelurahan</option>
                    </select> 
                </div>
                <div class="fv-row mb-12 fv-plugins-icon-container">
                    <label class="required fs-6 fw-bold mb-2">Username</label>
                    <input type="text" class="form-control form-control-solid" placeholder="" id="xemail" name="xemail" value="">
                </div>
                <div class="fv-row mb-12 fv-plugins-icon-container">
                    <label class="required fs-6 fw-bold mb-2">Password</label>
                    <input type="text" class="form-control form-control-solid" placeholder="" id="xpassword" name="xpassword" value="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button"  class="btn btn-secondary btn-close-modal" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                searchable: true,
                dom: 'lrt',
                ajax: '{{route("getUsers")}}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    {
                        data:null,
                        render: function (data, type, row) {
                            return '<button class="btn btn-primary btn-sm" onclick="edits(' + data.id + ')">Edit</button>'+
                                '<button class="btn btn-danger btn-sm" onclick="deletes(' + data.id + ')">Hapus</button>'
                            ;
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
                        $('#users-table').DataTable().ajax.reload();

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
                            $('#users-table').DataTable().ajax.reload();

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
            var table = $('#users-table').DataTable()
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

        function deletes(id) {
            // var itemId = $(this).data('id');
            console.log('del')
             var url = "{{route('muser.destroy','xxx')}}"
                url = url.replace('xxx',id)
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: 'DELETE',
                    success: function(response) {
                        toastr.success(response.message, 'Success');
                        $('#users-table').DataTable().ajax.reload();

                        // You can also update the UI as needed after successful deletion
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON.message, 'Error');
                    }
                });
        }

        function kecamatanChange(v) {
            console.log(v)
            $.getJSON('{{url("getDesa")}}/'+v, function(data) {
                var str = '<option value="00">Pilih Kelurahan</option>';
                $.each(data, function(index, item) {
                    str += '<option value="' + item.d_kd_kel + '">' + item.d_nm_kel + '</option>';
                });
                $('#kode_desa').html(str);
            });
        }
        function xkecamatanChange(v) {
            $.getJSON('{{url("getDesa")}}/'+v, function(data) {
                var str = '<option value="00">Pilih Kelurahan</option>';
                $.each(data, function(index, item) {
                    str += '<option value="' + item.d_kd_kel + '">' + item.d_nm_kel + '</option>';
                });
                $('#xkode_desa').html(str);
            });
        }
        function desaSelect(kec,desa) {
            $.getJSON('{{url("getDesa")}}/'+kec, function(data) {
                var str = '<option value="00">Pilih Kelurahan</option>';
                $.each(data,
                 function(index, item) {
                    if (item.d_kd_kel == desa) {
                        str += '<option selected value="' + item.d_kd_kel + '">' + item.d_nm_kel + '</option>';
                    } else {
                        str += '<option value="' + item.d_kd_kel + '">' + item.d_nm_kel + '</option>';
                    }
                });
                $('#xkode_desa').html(str);
            });
        }



        function xroleChange(v) {
            if (v=='3') {
                $('.select-wil').removeClass('hd1')
            } else {
                $('.select-wil').addClass('hd1')
                $('#kode_kecamatan').val('00').trigger('change')
                var str = '<option value="00">Pilih Kelurahan</option>';
                $('#kode_desa').val('00').trigger('change')
                
            }
        }
        function roleChange(v) {
            if (v=='3') {
                $('.select-wil').removeClass('hd1')
            } else {
                $('.select-wil').addClass('hd1')
                $('#kode_kecamatan').val('00').trigger('change')
                var str = '<option value="00">Pilih Kelurahan</option>';
                $('#kode_desa').val('00').trigger('change')
                
            }
        }

    </script>
@endpush
