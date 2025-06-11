    @extends('layouts.template')
@section('title', 'Edit Kriteria 2 - PPEPP')
@section('content')
@php use Illuminate\Support\Str; @endphp

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h4>{{ $page->title }}</h4>
                </div>
                <form id="formPPEPP" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_kriteria" value="{{ $detail->id_kriteria }}">

                    <div class="form-group">
                        <select name="id_kriteria_select" class="form-control" disabled>
                            @foreach ($kriteria as $l)
                                <option value="{{ $l->id_kriteria }}" {{ $l->id_kriteria == $detail->id_kriteria ? 'selected' : '' }}>
                                    {{ $l->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    @php
                        $sections = [
                            'penetapan' => 'Penetapan',
                            'pelaksanaan' => 'Pelaksanaan',
                            'evaluasi' => 'Evaluasi',
                            'pengendalian' => 'Pengendalian',
                            'peningkatan' => 'Peningkatan'
                        ];
                    @endphp

                   @foreach ($sections as $key => $label)
    <div class="row mx-1 mt-3 border-bottom pb-3">
        <div class="col-md-9">
            <h6 class="font-weight-bold">{{ $loop->iteration }}. {{ $label }}</h6>
            <textarea id="editor-{{ $key }}" name="desk_{{ $key }}" class="form-control">{{ $detail[$key]->deskripsi ?? '' }}</textarea>
            
            {{-- Definisi $previewSrc untuk setiap section --}}
            @php
                $previewSrc = Str::startsWith($detail[$key]->pendukung ?? '', 'data:image')
                    ? $detail[$key]->pendukung
                    : ($detail[$key]->pendukung
                        ? asset('storage/' . $detail[$key]->pendukung)
                        : 'https://via.placeholder.com/150');
            @endphp

            {{-- Preview Image dengan kondisi display --}}
            <img id="preview-editor-{{ $key }}"
                src="{{ $previewSrc }}"
                alt="Preview {{ $label }}"
                class="img-fluid mt-2"
                style="max-height: 200px; display: {{ ($detail[$key]->pendukung ?? '') ? 'block' : 'none' }};">
        </div>
        
        <div class="col-md-3 d-flex align-items-start justify-content-end pt-4">
            <div class="card">
                <div class="card-body text-center">
                    <label class="btn btn-outline-primary btn-sm mb-2" for="input-{{ $key }}">
                        <i class="fas fa-upload"></i> Upload Gambar
                    </label>
                    <input type="hidden" name="{{ $key }}_file_lama" value="{{ $detail[$key]->pendukung }}">
                    <input type="file" id="input-{{ $key }}" name="{{ $key }}_file"
                        class="form-control mt-2 d-none" accept="image/*"
                        onchange="previewAndInsertImage(this, 'editor-{{ $key }}', '{{ $key }}')">
                </div>
            </div>
        </div>
    </div>
@endforeach 

                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <button type="reset" class="btn btn-outline-secondary me-2" onclick="resetForm()">
                                    <i class="fas fa-undo-alt me-1"></i> Reset Form
                                </button>
                                <a href="{{ url('kriteria2/') }}" class="btn btn-outline-danger">
                                    <i class="fas fa-times me-1"></i> Cancel
                                </a>
                            </div>
                            <div>
                                <input type="hidden" name="status" id="statusInput" value="">
                                <button type="button" class="btn btn-outline-primary me-2" onclick="submitForm('save')">
                                    <i class="fas fa-save me-1"></i> Save Draft
                                </button>
                                <button type="button" class="btn btn-primary" onclick="submitForm('submit')">
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

            @push('js')
        <script src="https://cdn.jsdelivr.net/npm/tinymce@6.7.0/tinymce.min.js" referrerpolicy="origin"></script>

        <script>
        window.addEventListener('load', function () {
            const sections = ['penetapan', 'pelaksanaan', 'evaluasi', 'pengendalian', 'peningkatan'];

            sections.forEach(section => {
                tinymce.init({
                    selector: `#editor-${section}`,
                    height: 400,
                    plugins: 'link image',
                    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | link image',
                    branding: false,
                    setup: function (editor) {
                        editor.on('change', function () {
                            editor.save();
                        });
                    }
                });
            });
        });
function previewAndInsertImage(input, targetId, section) {
    console.log('=== DEBUG START ===');
    console.log('Input:', input);
    console.log('Target ID:', targetId);
    console.log('Section:', section);
    
    if (input.files && input.files[0]) {
        const file = input.files[0];
        console.log('File selected:', file.name, file.type, file.size);
        
        // Validasi file
        if (!file.type.startsWith('image/')) {
            Swal.fire('Error', 'File harus berupa gambar!', 'error');
            return;
        }
        
        // Preview menggunakan URL.createObjectURL
        try {
            const previewUrl = URL.createObjectURL(file);
            const previewElementId = `preview-${targetId}`;
            const previewElement = document.getElementById(previewElementId);
            
            console.log('Preview URL created:', previewUrl);
            console.log('Looking for element ID:', previewElementId);
            console.log('Preview Element found:', previewElement);
            
            if (previewElement) {
                // Revoke URL lama jika ada
                if (previewElement.src && previewElement.src.startsWith('blob:')) {
                    URL.revokeObjectURL(previewElement.src);
                }
                
                previewElement.src = previewUrl;
                previewElement.style.display = 'block';
                
                previewElement.onload = function() {
                    console.log('✅ Preview loaded successfully for', section);
                };
                
                previewElement.onerror = function(e) {
                    console.error('❌ Preview failed to load:', e);
                };
                
            } else {
                console.error('❌ Preview element not found! ID:', previewElementId);
                // Debug: cek semua element img di halaman
                const allImages = document.querySelectorAll('img[id^="preview-"]');
                console.log('All preview images found:', allImages);
            }
        } catch (error) {
            console.error('❌ Error creating preview:', error);
        }

        // Upload ke server
        uploadToServer(file, section, targetId);
    } else {
        console.log('❌ No file selected');
    }
    console.log('=== DEBUG END ===');
}

function uploadToServer(file, section, targetId) {
    const formData = new FormData();
    formData.append('image', file);
    formData.append('section', section);

    console.log('🚀 Starting upload for section:', section);

    fetch("{{ url('kriteria2/upload') }}", {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}",
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(res => {
        console.log('📡 Server response status:', res.status);
        return res.json();
    })
    .then(data => {
        console.log('📦 Server response data:', data);
        if (data.status) {
            const url = data.url;
            const editor = tinymce.get(targetId);
            if (editor) {
                editor.insertContent(`<img src="${url}" style="max-width:100%;" />`);
                console.log('✅ Image inserted to editor');
            }
            
            // UPDATE preview dengan server URL
            const previewElement = document.getElementById(`preview-${targetId}`);
            if (previewElement) {
                // Revoke blob URL lama
                if (previewElement.dataset.blobUrl) {
                    URL.revokeObjectURL(previewElement.dataset.blobUrl);
                    delete previewElement.dataset.blobUrl;
                }
                
                // Set server URL
                previewElement.src = url;
                console.log('🔄 Preview updated with server URL:', url);
                
                previewElement.onload = function() {
                    console.log('✅ Server preview loaded successfully');
                };
                
                previewElement.onerror = function(e) {
                    console.error('❌ Server preview failed to load:', e);
                    console.log('Failing URL:', url);
                };
            }
            
        } else {
            console.error('❌ Upload failed:', data.message);
            Swal.fire('Upload Gagal', data.message || 'Upload gagal.', 'error');
        }
    })
    .catch(err => {
        console.error('❌ Upload error:', err);
        Swal.fire('Error', 'Terjadi kesalahan saat upload gambar.', 'error');
    });
}
        function submitForm(action) {
            const statusMap = {
                'save': 'save',
                'submit': 'submitted'
            };
            const statusValue = statusMap[action] || action;

            ['penetapan', 'pelaksanaan', 'evaluasi', 'pengendalian', 'peningkatan'].forEach(sec => {
                const ed = tinymce.get(`editor-${sec}`);
                if (ed) ed.save();
            });

            const form = document.getElementById('formPPEPP');
            const formData = new FormData(form);
            formData.set('status', statusValue);
            document.getElementById('statusInput').value = statusValue;
            formData.append('_method', 'PUT');

            fetch("{{ url('kriteria2/' . $detail->id_detail_kriteria . '/update') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
        .then(async res => {
            if (!res.ok) {
                const errorText = await res.text();
                throw new Error(errorText || `HTTP ${res.status}`);
            }
            return res.json();
        })
        .then(data => {
            if (data.status) {
                Swal.fire('Berhasil', data.message, 'success').then(() => {
                    window.location.href = "{{ url('kriteria2/index') }}";
                });
            } else {
                Swal.fire('Gagal', data.message, 'error');
            }
        })
        .catch(err => {
            console.error('Fetch error:', err);
            Swal.fire('Error', err.message || 'Terjadi kesalahan tak terduga.', 'error');
        });

        }

        function resetForm() {
            document.getElementById('formPPEPP').reset();

            ['penetapan', 'pelaksanaan', 'evaluasi', 'pengendalian', 'peningkatan'].forEach(sec => {
                const ed = tinymce.get(`editor-${sec}`);
                if (ed) ed.setContent('');
                const img = document.getElementById(`preview-editor-${sec}`);
                if (img) {
                    img.src = '';
                    img.style.display = 'none';
                }
            });
        }
        </script>
        @endpush
