<div class="main-card">
    
    <div class="card-header-row">
        <div class="header-title">
            <i class="fas fa-tasks"></i>
            <h2>{{ $title ?? 'Form Progres' }}</h2>
        </div>
        
        {{-- Tombol Kembali Abu-abu --}}
        <a href="{{ url()->previous() }}" class="btn-header-back">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card-body">
        
        {{-- SECTION 1: PESANAN --}}
        <div class="form-section-item">
            <h4 class="section-title"><i class="fas fa-clipboard-list"></i> Informasi Pesanan</h4>
            <div class="form-group">
                <label for="pesanan_id" class="form-label">Pilih Pesanan</label>
                <div class="input-group">
                    <i class="fas fa-search input-icon"></i>
                    <select name="pesanan_id" id="pesanan_id" class="form-select" required>
                        @isset($pesanan)
                            <option value="{{ $pesanan->id }}" selected>
                                {{ $pesanan->nama_pesanan }} ({{ $pesanan->kode_pesanan }})
                            </option>
                        @endisset

                        @if(isset($progres))
                            <option value="{{ $progres->pesanan->id }}" selected>
                                {{ $progres->pesanan->nama_pesanan }} ({{ $progres->pesanan->kode_pesanan }})
                            </option>
                        @endif
                    </select>
                </div>
            </div>
        </div>

        <div class="divider"></div>

        {{-- SECTION 2: STATUS & TANGGAL --}}
        <div class="form-section-item">
            <h4 class="section-title"><i class="fas fa-chart-line"></i> Detail Progres</h4>
            <div class="grid-2-col">
                {{-- Tahap Status --}}
                <div class="form-group">
                    <label for="tahap_status" class="form-label">Tahap Status</label>
                    <div class="input-group">
                        <i class="fas fa-flag input-icon"></i>
                        <select name="tahap_status" id="tahap_status" class="form-select" required>
                            <option value="">Pilih Tahapan</option>
                            <option value="Perancangan" {{ (isset($progres) && $progres->tahap_status == 'Perancangan') ? 'selected' : '' }}>Perancangan</option>
                            <option value="Pengerjaan Komponen" {{ (isset($progres) && $progres->tahap_status == 'Pengerjaan Komponen') ? 'selected' : '' }}>Pengerjaan Komponen</option>
                            <option value="Perakitan" {{ (isset($progres) && $progres->tahap_status == 'Perakitan') ? 'selected' : '' }}>Perakitan</option>
                            <option value="Uji Coba" {{ (isset($progres) && $progres->tahap_status == 'Uji Coba') ? 'selected' : '' }}>Uji Coba</option>
                            <option value="Finishing" {{ (isset($progres) && $progres->tahap_status == 'Finishing') ? 'selected' : '' }}>Finishing</option>
                        </select>
                    </div>
                </div>

                {{-- Tanggal --}}
                <div class="form-group">
                    <label for="tanggal_progres" class="form-label">Waktu Pencatatan</label>
                    <div class="input-group">
                        <i class="fas fa-calendar-alt input-icon"></i>
                        <input type="datetime-local"
                               name="tanggal_progres"
                               id="tanggal_progres"
                               class="form-input"
                               value="{{ isset($progres) ? date('Y-m-d\TH:i', strtotime($progres->tanggal_progres)) : (old('tanggal_progres') ?? date('Y-m-d\TH:i')) }}"
                               required>
                    </div>
                </div>
            </div>
        </div>

        <div class="divider"></div>

        {{-- SECTION 3: CATATAN --}}
        <div class="form-section-item">
            <h4 class="section-title"><i class="fas fa-sticky-note"></i> Catatan</h4>
            <div class="form-group">
                <textarea name="catatan" 
                          id="catatan" 
                          class="form-textarea" 
                          rows="4"
                          placeholder="Deskripsi pengerjaan..."
                          required>{{ $progres->catatan ?? old('catatan') }}</textarea>
            </div>
        </div>

        <div class="divider"></div>

        {{-- SECTION 4: FOTO --}}
        <div class="form-section-item">
            <h4 class="section-title"><i class="fas fa-camera"></i> Dokumentasi</h4>
            <div class="form-group">
                <div class="file-upload">
                    <input type="file" name="foto" id="foto" class="file-input" accept="image/*">
                    <label for="foto" class="file-label">
                        <div class="upload-icon-wrapper">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <div class="upload-text">
                            <span class="main-text">Klik untuk pilih foto</span>
                            <span class="sub-text">Format: JPG, PNG (Maks. 2MB)</span>
                        </div>
                    </label>
                </div>

                @isset($progres->foto)
                <div class="current-photo">
                    <div class="photo-preview-card">
                        <img src="{{ asset('storage/progres/'.$progres->foto) }}" alt="Foto">
                        <div class="photo-actions">
                            <span class="photo-name">Foto Terlampir</span>
                            <button type="button" class="btn-remove-photo" onclick="removePhoto()">Hapus</button>
                        </div>
                    </div>
                    <input type="hidden" name="remove_photo" id="remove_photo" value="0">
                </div>
                @endif
            </div>
        </div>

        {{-- FOOTER --}}
        <div class="card-footer">
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Simpan Data
            </button>
        </div>

    </div>
</div>

<style>
    /* Layout */
    .main-card {
        background: white; border-radius: 8px; border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05); overflow: hidden; max-width: 900px; margin: 30px auto;
    }

    /* Header */
    .card-header-row {
        background: #f8fafc; padding: 20px 25px; border-bottom: 1px solid #e2e8f0;
        display: flex; justify-content: space-between; align-items: center;
    }
    .header-title { display: flex; align-items: center; gap: 12px; }
    .header-title i { font-size: 1.2rem; color: #4f46e5; }
    .header-title h2 { font-size: 1.3rem; color: #1f2937; margin: 0; font-weight: 600; }

    /* Tombol Kembali Abu-abu */
    .btn-header-back {
        background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;
        padding: 8px 16px; border-radius: 6px; text-decoration: none;
        font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 8px;
        transition: all 0.2s;
    }
    .btn-header-back:hover { background: #e2e8f0; color: #1e293b; }

    /* Body */
    .card-body { padding: 25px; }
    .section-title {
        font-size: 1rem; color: #374151; font-weight: 600; margin-bottom: 15px;
        display: flex; align-items: center; gap: 8px;
    }
    .section-title i { color: #6b7280; font-size: 0.9rem; }
    .divider { height: 1px; background: #f1f5f9; margin: 25px 0; }
    .grid-2-col { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

    /* Inputs */
    .form-group { margin-bottom: 5px; }
    .form-label { display: block; margin-bottom: 6px; font-weight: 500; color: #4b5563; font-size: 0.9rem; }
    .input-group { position: relative; }
    .input-icon {
        position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
        color: #9ca3af; font-size: 0.9rem; pointer-events: none;
    }
    .form-select, .form-input, .form-textarea {
        width: 100%; padding: 10px 12px 10px 35px; border: 1px solid #cbd5e1;
        border-radius: 6px; font-size: 0.95rem; color: #1f2937; background: #fff;
    }
    .form-textarea { padding-left: 12px; resize: vertical; min-height: 100px; }
    
    .form-select:focus, .form-input:focus, .form-textarea:focus {
        outline: none; border-color: #4f46e5;
    }

    /* File Upload */
    .file-input { display: none; }
    .file-label {
        border: 2px dashed #cbd5e1; border-radius: 8px; padding: 20px;
        display: flex; flex-direction: column; align-items: center;
        cursor: pointer; background: #f8fafc; transition: all 0.2s;
    }
    .file-label:hover { border-color: #4f46e5; background: #f0f9ff; }
    .upload-icon-wrapper { font-size: 2rem; color: #9ca3af; margin-bottom: 10px; }
    .upload-text { text-align: center; }
    .main-text { font-weight: 500; color: #374151; font-size: 0.9rem; }
    .sub-text { font-size: 0.8rem; color: #9ca3af; display: block; margin-top: 2px; }

    /* Preview */
    .photo-preview-card {
        margin-top: 15px; background: #f8fafc; padding: 10px; border: 1px solid #e2e8f0;
        border-radius: 6px; display: flex; align-items: center; gap: 15px;
    }
    .photo-preview-card img {
        width: 60px; height: 60px; object-fit: cover; border-radius: 4px; border: 1px solid #cbd5e1;
    }
    .photo-actions { flex: 1; display: flex; justify-content: space-between; align-items: center; }
    .photo-name { font-size: 0.9rem; font-weight: 500; color: #334155; }
    .btn-remove-photo {
        background: #fee2e2; color: #dc2626; border: none; padding: 4px 10px;
        border-radius: 4px; font-size: 0.8rem; font-weight: 600; cursor: pointer;
    }

    /* Footer */
    .card-footer {
        padding: 20px 25px; border-top: 1px solid #e2e8f0; background: #f8fafc;
    }
    .btn-submit {
        width: 100%; background: linear-gradient(135deg, #4f46e5, #7c3aed);
        color: white; border: none; padding: 12px; border-radius: 6px;
        font-size: 1rem; font-weight: 600; cursor: pointer;
        display: flex; align-items: center; justify-content: center; gap: 8px;
    }
    .btn-submit:hover { opacity: 0.9; }

    @media (max-width: 768px) {
        .grid-2-col { grid-template-columns: 1fr; }
        .card-header-row { flex-direction: column; align-items: flex-start; gap: 15px; }
        .btn-header-back { width: 100%; justify-content: center; }
    }
</style>

<script>
    document.getElementById('foto')?.addEventListener('change', function() {
        const text = document.querySelector('.main-text');
        if(this.files[0]) text.innerText = 'File: ' + this.files[0].name;
    });

    function removePhoto() {
        if(confirm('Hapus foto?')) {
            document.getElementById('remove_photo').value = '1';
            document.querySelector('.photo-preview-card').style.display = 'none';
        }
    }
</script>