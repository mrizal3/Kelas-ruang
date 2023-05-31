<form id="form-store">
    <div class="modal fade" id="modal-store" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Tambah Dosen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id" name="id">
                <div class="form-group" id="prodi">
                    <label>Prodi</label>
                    <select name="prodi" class="form-control">
                        @foreach ($prodi as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" id="nama">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama">
                </div>
                <div class="form-group" id="nidn">
                    <label>NIDN</label>
                    <input type="text" class="form-control" name="nidn">
                </div>
                <div class="form-group" id="no_hp">
                    <label>No Hp</label>
                    <input type="text" class="form-control" name="no_hp">
                </div>
                <div class="form-group" id="alamat">
                    <label>Alamat</label>
                    <textarea name="alamat" cols="30" rows="10" class="form-control"></textarea>
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