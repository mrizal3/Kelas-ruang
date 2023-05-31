<form id="form-store">
    <div class="modal fade" id="modal-store" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Tambah Ruang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id" name="id">
                <div class="form-group" id="kode">
                    <label>Id.Ruangan</label>
                    <input type="text" autocomplete="off" class="form-control validation" name="kode">
                </div>
                <div class="form-group" id="posisi">
                    <label>Posisi</label>
                    <select name="posisi" class="form-control validation">
                        <option value="GD.Belakang">GD.Belakang</option>
                        <option value="GD.Tengah">GD.Tengah</option>
                        <option value="GD.Solihin LT.I">GD.Solihin LT.I</option>
                        <option value="GD.Solihin LT.II">GD.Solihin LT.II</option>
                        <option value="GD.Solihin LT.III">GD.Solihin LT.III</option>
                        <option value="GD.Mashudi LT.I">GD.Mashudi LT.I</option>
                    </select>
                </div>
                <div class="form-group" id="maksimal">
                    <label>Maksimal</label>
                    <input type="number"  autocomplete="off" class="form-control validation" name="maksimal">
                </div>
                <div class="form-group" id="keterangan">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control validation"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </div>
    </div>
</div>
</form>