<form id="form-store">
    <div class="modal fade" id="modal-store" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Tambah Mata Kuliah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id" name="id">
                <div class="form-group" id="nama">
                    <label>Nama</label>
                    <input type="text" autocomplete="off" class="form-control validation" name="nama">
                </div>
                <div class="form-group" id="sks">
                    <label>SKS</label>
                    <select name="sks" class="form-control validation">
                        <option value="">--- SKS ---</option>
                        @for ($i = 1; $i < 7; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group" id="semester">
                    <label>Semester</label>
                    <select name="semester" class="form-control validation">
                        <option value="">--- Semester ---</option>
                        @for ($i = 1; $i < 13; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
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