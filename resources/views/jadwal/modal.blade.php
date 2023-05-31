<form id="form-store">
    <div class="modal fade" id="modal-store" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Tambah Jadwal Mata Kuliah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" id="prodi">
                                <label>Prodi</label>
                                <select name="prodi" class="form-control validation prodi">
                                    <option value="">--- Prodi ---</option>
                                    @foreach ($prodi as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="kelas">
                                <label>Kelas</label>
                                <select name="kelas" class="form-control validation kelas"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="matkul">
                                <label>Mata Kuliah</label>
                                <select name="matkul" class="form-control validation matkul">
                                    <option value="">--- Mata Kuliah ---</option>
                                    @foreach ($matkul as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="dosen">
                                <label>Dosen</label>
                                <select name="dosen" class="form-control validation dosen">
                                    <option value="">--- Dosen ---</option>
                                    @foreach ($dosen as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="ruang">
                                <label>Ruang</label>
                                <select name="ruang" class="form-control validation">
                                    <option value="">--- Ruang ---</option>
                                    @foreach ($ruang as $item)
                                    <option value="{{ $item->id }}">{{ $item->kode }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="semester">
                                <label>Semester</label>
                                
                                <input type="text" class="form-control validation" readonly name="semester">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="sks">
                                <label>SKS</label>
                                <input type="text" class="form-control validation" readonly name="sks">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="hari">
                                <label>Hari</label>
                                <select name="hari" class="form-control validation">
                                    <option value="">--- Hari ---</option>
                                    @foreach ($hari as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['nama'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="jam_mulai">
                                <label>Jam Mulai</label>
                                <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control" name="jam_mulai" autocomplete="off">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="jam_selesai">
                                <label>Jam Selesai</label>
                                <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control" name="jam_selesai" autocomplete="off">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="tahun_ajaran">
                                <label >Tahun Ajaran</label>
                                <select name="tahun_ajaran" class="form-control validation">
                                    <option >Tahun Ajaran</option>
                                    @for ($i = -5; $i < 5; $i++)
                                        <option value="{{ date('Y')+$i }}/{{ date('Y')+$i+1 }}" >{{ date('Y')+$i }} / {{ date('Y')+$i+1 }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="angkatan">
                                <label >Angkatan</label>
                                <select name="angkatan" class="form-control validation">
                                    <option >Angkatan</option>
                                    @for ($i = -5; $i < 5; $i++)
                                        <option value="{{ date('Y')+$i }}" >{{ date('Y')+$i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" id="keterangan">
                                <label >Keterangan</label>
                                <textarea name="keterangan" rows="8" class="form-control validation"></textarea>
                            </div>
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
    </div>
</form>