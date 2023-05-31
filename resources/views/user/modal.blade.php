<form id="form-store">
    <div class="modal fade" id="modal-store" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id" name="id">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" id="nama">
                            <label>Nama</label>
                            <input type="text" autocomplete="off" class="form-control validation" name="nama">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="prodi">
                            <label>Prodi</label>
                            <select name="prodi" class="form-control">
                                <option value="">--- Prodi ---</option>
                                @foreach ($prodi as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="no_identitas">
                            <label>No Identitas</label>
                            <input type="text" autocomplete="off" class="form-control validation" name="no_identitas">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="tipe_identitas">
                            <label>Tipe Identitas</label>
                            <select name="tipe_identitas" class="form-control validation">
                                <option value="">--- Tipe Identitas ---</option>
                                <option value="NIM">NIM</option>
                                <option value="NIDN">NIDN</option>
                                <option value="NIDK">NIDK</option>
                                <option value="NIP">NIP</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="jabatan">
                            <label>Jabatan</label>
                            <select name="jabatan" class="form-control validation">
                                <option value="">--- Jabatan ---</option>
                                @foreach ($jabatan as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="no_hp">
                            <label>No Hp</label>
                            <input type="text" autocomplete="off" class="form-control validation" name="no_hp">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="level">
                            <label>Level</label>
                            <select name="level" class="form-control validation">
                                <option value="">--- Level ---</option>
                                <option value="1">Akedemik</option>
                                <option value="2">Peminjam</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="alamat">
                            <label>Alamat</label>
                            <textarea name="alamat"rows="15" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p class="text-warning">Catatan : Password Default adalah secret123</p>
                    </div>
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