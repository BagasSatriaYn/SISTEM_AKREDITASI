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
                                <img id="preview-editor-{{ $key }}"
                                     src="{{ $detail[$key]->pendukung ? asset('storage/' . $detail[$key]->pendukung) : '' }}"
                                     alt="Preview"
                                     class="img-fluid mt-2"
                                     style="max-height: 200px; {{ $detail[$key]->pendukung ? '' : 'display: none;' }}">
                            </div>
                            <div class="col-md-3 d-flex align-items-start justify-content-end pt-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <label class="btn btn-outline-primary btn-sm mb-2" for="input-{{ $key }}">
                                            <i class="fas fa-upload"></i> Upload Gambar
                                        </label>
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
    if (input.files && input.files[0]) {
        const formData = new FormData();
        formData.append('image', input.files[0]);
        formData.append('section', section);

        fetch("{{ url('kriteria2/upload') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.status) {
                const url = data.url;
                const editor = tinymce.get(targetId);
                if (editor) editor.insertContent(`<img src="${url}" style="max-width:100%;" />`);

                const preview = document.getElementById(`preview-${targetId}`);
                if (preview) {
                    preview.src = url;
                    preview.style.display = 'block';
                }
            } else {
                Swal.fire('Upload Gagal', data.message || 'Upload gagal.', 'error');
            }
        })
        .catch(err => {
            console.error(err);
            Swal.fire('Error', 'Terjadi kesalahan saat upload gambar.', 'error');
        });
    }
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
