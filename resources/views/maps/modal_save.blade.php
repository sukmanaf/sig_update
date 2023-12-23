<div id="mod_add" class="modal fade"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nop</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" enctype="multipart/form-data" id="nop_addForm"> @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Nop</label>
                        <input type="text" class="form-control" name="nop" id="nop_add">
                        <input type="hidden" class="form-control" name="geom" id="nop_add_geom"> 
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Jenis</label>
                        </br>
                        <select name="jenis" class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true" onchange="jenis_change($(this).val())">
                            <option value="1">Nop</option>
                            <option value="2">Blok</option>
                            <option value="3">Bangunan</option>
                        </select>
                    </div>
                    <div class="mb-3" id="img_nop">
                        <label for="message-text" class="col-form-label">Gambar</label>
                        </br>
                        <div id="img_nop_file" >
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="mod_edit" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit NOP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="nop_editForm" class="from-prevent-multiple-submits" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Nop</label>
                        <input type="text" class="form-control" name="xnop" id="nop_edit">
                        <input type="hidden" class="form-control" name="xnop_old" id="nop_edit_old">
                        <input type="hidden" class="form-control" name="xgeom" id="nop_edit_geom"> 
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Jenis</label>
                        </br>
                        <select name="xjenis" id="xjenis" class="form-select form-select-solid form-select-sm" data-control="select2" data-hide-search="true" onchange="xjenis_change($(this).val())">
                            <option value="2">Blok</option>
                            <option value="1">Nop</option>
                            <option value="3">Bangunan</option>
                        </select>
                    </div>
                    <div class="mb-3" id="ximg_nop">
                        <label for="message-text" class="col-form-label">Gambar</label>
                        </br>
                        <input type="file" name="xfile" id="xfile"> </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" >Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>