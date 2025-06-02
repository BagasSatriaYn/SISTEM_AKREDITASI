@extends('layouts.template')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h4>{{ $page->title }}</h4>
                    </div>
                    <form id="formPPEPP" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_kriteria" id="id_kriteria_input" value="">
                        <div class="form-group">
                            <select name="id_kriteria_select" id="id_kriteria" class="form-control" required
                                onchange="updateKriteria()">
                                <option value="">- Pilih Kriteria -</option>
                                @foreach ($kriteria as $l)
                                    <option value="{{ $l->id_kriteria }}">{{ $l->nama }}</option>
                                @endforeach
                            </select>
                            <small id="error-id_kriteria" class="error-text form-text text-danger"></small>
                        </div>
                        <!-- 1. Penetapan -->
                        <div class="row mx-1 mt-3 border-bottom pb-3">
                            <div class="col-md-9">
                                <h6 class="font-weight-bold">1. Penetapan</h6>
                                <textarea id="editor-penetapan" name="desk_penetapan" class="form-control"></textarea>
                                <img id="preview-penetapan" src="" alt="Preview" class="img-fluid mt-2"
                                    style="max-height: 200px; display: none;">

                            </div>
                            <div class="col-md-3 d-flex align-items-start justify-content-end pt-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                         <div id="preview-penetapan" class="mb-2 d-flex flex-wrap justify-content-center gap-2 position-relative"></div>
                                        <button type="button" class="btn btn-sm btn-outline-primary mb-2">
                                            <i class="fas fa-upload"></i> Upload Gambar
                                        </button>
                                        <!-- Upload Gambar (Penetapan) -->
                                        <input type="file" name="penetapan_file" class="form-control mt-2"
                                            accept="image/*" onchange="previewAndInsertImage(this, 'editor-penetapan')">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Pelaksanaan -->
                        <div class="row mx-1 mt-3 border-bottom pb-3">
                            <div class="col-md-9">
                                <h6 class="font-weight-bold">2. Pelaksanaan</h6>
                                <textarea id="editor-pelaksanaan" name="desk_pelaksanaan" class="form-control"></textarea>
                                <img id="preview-pelaksanaan" src="" alt="Preview" class="img-fluid mt-2"
                                    style="max-height: 200px; display: none;">

                            </div>
                            <div class="col-md-3 d-flex align-items-start justify-content-end pt-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <button type="button" class="btn btn-sm btn-outline-primary mb-2">
                                            <i class="fas fa-upload"></i> Upload Gambar
                                        </button>
                                        <!-- Upload Gambar (Penetapan) -->
                                        <input type="file" name="pelaksanaan_file" class="form-control mt-2"
                                            accept="image/*" onchange="previewAndInsertImage(this, 'editor-pelaksanaan')">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Evaluasi -->
                        <div class="row mx-1 mt-3 border-bottom pb-3">
                            <div class="col-md-9">
                                <h6 class="font-weight-bold">3. Evaluasi</h6>
                                <textarea id="editor-evaluasi" name="desk_evaluasi" class="form-control"></textarea>
                                <img id="preview-evaluasi" src="" alt="Preview" class="img-fluid mt-2"
                                    style="max-height: 200px; display: none;">

                            </div>
                            <div class="col-md-3 d-flex align-items-start justify-content-end pt-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <button type="button" class="btn btn-sm btn-outline-primary mb-2">
                                            <i class="fas fa-upload"></i> Upload Gambar
                                        </button>
                                        <!-- Upload Gambar (Penetapan) -->
                                        <input type="file" name="evaluasi_file" class="form-control mt-2"
                                            accept="image/*" onchange="previewAndInsertImage(this, 'editor-evaluasi')">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 4. Pengendalian -->
                        <div class="row mx-1 mt-3 border-bottom pb-3">
                            <div class="col-md-9">
                                <h6 class="font-weight-bold">4. Pengendalian</h6>
                                <textarea id="editor-pengendalian" name="desk_pengendalian" class="form-control"></textarea>
                                <img id="preview-pengendalian" src="" alt="Preview" class="img-fluid mt-2"
                                    style="max-height: 200px; display: none;">

                            </div>
                            <div class="col-md-3 d-flex align-items-start justify-content-end pt-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <button type="button" class="btn btn-sm btn-outline-primary mb-2">
                                            <i class="fas fa-upload"></i> Upload Gambar
                                        </button>
                                        <!-- Upload Gambar (Penetapan) -->
                                        <input type="file" name="pengendalian_file" class="form-control mt-2"
                                            accept="image/*"
                                            onchange="previewAndInsertImage(this, 'editor-pengendalian')">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 5. Peningkatan -->
                        <div class="row mx-1 mt-3 pb-3">
                            <div class="col-md-9">
                                <h6 class="font-weight-bold">5. Peningkatan</h6>
                                <textarea id="editor-peningkatan" name="desk_peningkatan" class="form-control"></textarea>
                                <img id="preview-peningkatan" src="" alt="Preview" class="img-fluid mt-2"
                                    style="max-height: 200px; display: none;">

                            </div>
                            <div class="col-md-3 d-flex align-items-start justify-content-end pt-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <button type="button" class="btn btn-sm btn-outline-primary mb-2">
                                            <i class="fas fa-upload"></i> Upload Gambar
                                        </button>
                                        <!-- Upload Gambar (Penetapan) -->
                                        <input type="file" name="peningkatan_file" class="form-control mt-2"
                                            accept="image/*" onchange="previewAndInsertImage(this, 'editor-peningkatan')">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <!-- Left side buttons -->
                                <div>
                                    <button type="reset" class="btn btn-outline-secondary me-2" onclick="resetForm()">
                                        <i class="fas fa-undo-alt me-1"></i> Reset Form
                                    </button>
                                    <a href="{{ url('kriteria9/') }}" class="btn btn-outline-danger">
                                        <i class="fas fa-times me-1"></i> Cancel
                                    </a>
                                </div>

                                <!-- Right side buttons -->
                                <div>
                                    <input type="hidden" name="status" id="statusInput" value="">

                                    <button type="button" class="btn btn-outline-primary me-2"
                                        onclick="submitForm('save')">
                                        <i class="fas fa-save me-1"></i> Save Draft
                                    </button>

                                    <button type="button" class="btn btn-primary" id="submitBtn"
                                        onclick="submitForm('submit')">
                                        <i class="fas fa-paper-plane me-1"></i> Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .tox-tinymce {
            border-radius: 8px !important;
            border: 1px solid #d2d6da !important;
        }

        .border-bottom {
            border-bottom: 1px solid #dee2e6 !important;
        }
    </style>
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.6.1/tinymce.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.6.1/icons/default/icons.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>    

    <script type='text/javascript'>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof tinymce !== 'undefined') {
                // Inisialisasi untuk semua section
                ['penetapan', 'pelaksanaan', 'evaluasi', 'pengendalian', 'peningkatan'].forEach(section => {
                    tinymce.init({
                        selector: `#editor-${section}`,
                        license_key: 'gpl',
                        height: 400,
                        plugins: 'link',
                        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | link',
                        skin_url: 'https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.6.1/skins/ui/oxide',
                        content_css: 'https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.6.1/skins/content/default/content.min.css',
                        setup: function(editor) {
                            editor.on('change', function() {
                                editor.save();
                            });
                        }
                    });
                });
            } else {
                console.error('TinyMCE tidak terdefinisi!');
                // Fallback ke textarea biasa untuk semua editor
                ['penetapan', 'pelaksanaan', 'evaluasi', 'pengendalian', 'peningkatan'].forEach(section => {
                    const editor = document.getElementById(`editor-${section}`);
                    if (editor) {
                        editor.style.display = 'block';
                        editor.style.minHeight = '200px';
                    }
                });
            }
        });

function submitForm(action) {
    // Map the action to the correct enum value
    const statusMap = {
        'save': 'save',
        'submit': 'submitted' // Note the double 'm' if that's what your enum expects
    };
    
    const statusValue = statusMap[action] || action;
    document.getElementById('statusInput').value = statusValue;
    
    const form = document.getElementById('formPPEPP');
    const formData = new FormData(form);
    formData.set('status', statusValue);

            fetch("{{ url('kriteria9/store') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: formData
                })
                .then(async res => {
                    const ct = res.headers.get('content-type') || '';
                    // jika status bukan 2xx
                    if (!res.ok) {
                        const text = await res.text();
                        console.error('Server returned HTTP', res.status, text);
                        throw new Error(`Server error ${res.status}`);
                    }
                    // jika bukan JSON
                    if (!ct.includes('application/json')) {
                        const text = await res.text();
                        console.error('Expected JSON, got:', text);
                        throw new Error('Invalid JSON response');
                    }
                    return res.json();
                })
                .then(data => {
                    if (data.status) {
                        Swal.fire({
                            title: 'Sukses!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = "{{ url('kriteria9/index') }}";
                        });
                    } else {
                        Swal.fire('Gagal', data.message, 'error');
                    }
                })
                .catch(err => {
                    console.error('Fetch error:', err);
                    Swal.fire('Error', err.message, 'error');
                });
        }
    </script>
    <script>
        function updateKriteria() {
            const selectedKriteria = document.getElementById('id_kriteria').value;
            document.getElementById('id_kriteria_input').value = selectedKriteria;
        }

        function previewAndInsertImage(input, editorId) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e)  {
                    const editor = tinymce.get(editorId);
                    if (editor) {
                        // Sisipkan gambar langsung ke dalam editor
                        editor.insertContent(`<img src="${e.target.result}" alt="Gambar" style="max-width:100%;" />`);
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush