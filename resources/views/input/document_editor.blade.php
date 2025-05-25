<!-- resources/views/document-editor.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AKSIB | Document Editor</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        
        .sidebar {
            background-color: white;
            height: 100vh;
            position: fixed;
            width: 250px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }
        
        .sidebar-header {
            padding: 15px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }
        
        .sidebar-brand {
            font-weight: bold;
            color: #0d6efd;
        }
        
        .sidebar-menu {
            padding: 0;
            list-style: none;
        }
        
        .sidebar-menu li {
            padding: 10px 15px;
            border-bottom: 1px solid #f1f1f1;
        }
        
        .sidebar-menu li:hover {
            background-color: #f8f9fa;
        }
        
        .sidebar-menu li i {
            margin-right: 10px;
            color: #6c757d;
        }
        
        .sidebar-menu li.active {
            background-color: #e9f0ff;
            border-left: 4px solid #0d6efd;
        }
        
        .sidebar-menu li.active i {
            color: #0d6efd;
        }
        
        .content-area {
            margin-left: 250px;
            padding: 20px;
        }
        
        .editor-header {
            padding: 10px 15px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .editor-title {
            font-weight: bold;
            color: #212529;
            margin-bottom: 0;
        }
        
        .editor-toolbar {
            background-color: #f8f9fa;
            padding: 10px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .editor-toolbar button {
            background: transparent;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            color: #6c757d;
        }
        
        .editor-toolbar button:hover {
            background-color: #e9ecef;
            border-radius: 3px;
        }
        
        .editor-toolbar .divider {
            height: 20px;
            width: 1px;
            background-color: #e9ecef;
            margin: 0 5px;
            display: inline-block;
            vertical-align: middle;
        }
        
        .editor-content {
            background-color: white;
            padding: 20px;
            min-height: 200px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .section-title {
            font-weight: bold;
            margin-bottom: 15px;
        }
        
        .section-item {
            margin-bottom: 10px;
        }
        
        .section-item-header {
            font-weight: bold;
        }
        
        .editor-block {
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
        
        .section-item-content {
            margin-left: 20px;
        }
        
        .image-gallery {
            display: flex;
            flex-wrap: wrap;
            margin-top: 10px;
        }
        
        .image-item {
            width: 100px;
            height: 60px;
            margin-right: 10px;
            margin-bottom: 10px;
            background-size: cover;
            background-position: center;
            border-radius: 3px;
        }
        
        .avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-left: 5px;
        }
        
        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
        
        .btn-publish {
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 3px;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-auto p-0">
                <div class="sidebar">
                    <div class="sidebar-header">
                        <span class="sidebar-brand">
                            <i class="fas fa-cube"></i> AKSIB
                        </span>
                    </div>
                    <div class="py-2">
                        <div class="d-flex justify-content-between px-3">
                            <small class="text-muted">Profil Pengguna</small>
                        </div>
                    </div>
                    <ul class="sidebar-menu">
                        <li><i class="fas fa-home"></i> Dashboard</li>
                        <li class="active"><i class="fas fa-file-alt"></i> Dokumen</li>
                        <li><i class="fas fa-tasks"></i> To-do List</li>
                        <li><i class="fas fa-chart-bar"></i> Statistik</li>
                    </ul>
                    <div class="py-2">
                        <div class="d-flex justify-content-between px-3">
                            <small class="text-muted">Dokumen</small>
                        </div>
                    </div>
                    <ul class="sidebar-menu">
                        <li><i class="fas fa-folder"></i> Arkana 1</li>
                        <li><i class="fas fa-folder"></i> Arkana 2</li>
                        <li><i class="fas fa-folder"></i> Arkana 3</li>
                        <li><i class="fas fa-folder"></i> Arkana 4</li>
                        <li><i class="fas fa-folder"></i> Arkana 5</li>
                        <li><i class="fas fa-folder"></i> Arkana 6</li>
                        <li><i class="fas fa-folder"></i> Arkana 7</li>
                        <li><i class="fas fa-folder"></i> Arkana 8</li>
                    </ul>
                    <div class="py-2">
                        <div class="d-flex justify-content-between px-3">
                            <small class="text-muted">Dokumen Baru</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col p-0">
                <div class="content-area">
                    <div class="editor-header mb-4">
                        <div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Dokumen Arkana 1</li>
                                </ol>
                            </nav>
                        </div>
                        <div>
                            <img src="https://via.placeholder.com/30" class="avatar" alt="User Avatar">
                        </div>
                    </div>
                    
                    <!-- Penetapan Section -->
                    <div class="editor-block mb-4">
                        <div class="d-flex justify-content-between align-items-center bg-primary text-white p-2">
                            <div>
                                <i class="fas fa-file-alt me-2"></i> Penetapan
                            </div>
                            <div>
                                <button class="btn-sm bg-transparent border-0 text-white"><i class="fas fa-expand-alt"></i></button>
                                <button class="btn-sm bg-transparent border-0 text-white"><i class="fas fa-ellipsis-v"></i></button>
                            </div>
                        </div>
                        <div class="editor-toolbar">
                            <div class="btn-group me-2">
                                <button><i class="fas fa-paragraph"></i></button>
                                <button><i class="fas fa-heading"></i></button>
                            </div>
                            <span class="divider"></span>
                            <div class="btn-group me-2">
                                <button><i class="fas fa-bold"></i></button>
                                <button><i class="fas fa-italic"></i></button>
                                <button><i class="fas fa-underline"></i></button>
                                <button><i class="fas fa-strikethrough"></i></button>
                            </div>
                            <span class="divider"></span>
                            <div class="btn-group me-2">
                                <button><i class="fas fa-list-ul"></i></button>
                                <button><i class="fas fa-list-ol"></i></button>
                                <button><i class="fas fa-outdent"></i></button>
                                <button><i class="fas fa-indent"></i></button>
                            </div>
                            <span class="divider"></span>
                            <div class="btn-group me-2">
                                <button><i class="fas fa-link"></i></button>
                                <button><i class="fas fa-image"></i></button>
                            </div>
                        </div>
                        <div class="editor-content">
                            <div class="section-item">
                                <div class="section-item-header">1. Rencana Pelaksanaan Program Kegiatan</div>
                                <div class="section-item-content">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. <a href="#">read more</a>
                                </div>
                            </div>
                            <div class="section-item">
                                <div class="section-item-header">2. Link Salinan/Soft SKPI (isi website)</div>
                                <div class="section-item-content">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. <a href="#">read more</a>
                                </div>
                            </div>
                        </div>
                        <div class="p-2 text-end">
                            <button class="btn-publish">
                                <i class="fas fa-save me-1"></i> Publish
                            </button>
                        </div>
                    </div>
                    
                    <!-- Pelaksanaan Section -->
                    <div class="editor-block mb-4">
                        <div class="d-flex justify-content-between align-items-center bg-primary text-white p-2">
                            <div>
                                <i class="fas fa-file-alt me-2"></i> Pelaksanaan
                            </div>
                            <div>
                                <button class="btn-sm bg-transparent border-0 text-white"><i class="fas fa-expand-alt"></i></button>
                                <button class="btn-sm bg-transparent border-0 text-white"><i class="fas fa-ellipsis-v"></i></button>
                            </div>
                        </div>
                        <div class="editor-toolbar">
                            <div class="btn-group me-2">
                                <button><i class="fas fa-paragraph"></i></button>
                                <button><i class="fas fa-heading"></i></button>
                            </div>
                            <span class="divider"></span>
                            <div class="btn-group me-2">
                                <button><i class="fas fa-bold"></i></button>
                                <button><i class="fas fa-italic"></i></button>
                                <button><i class="fas fa-underline"></i></button>
                                <button><i class="fas fa-strikethrough"></i></button>
                            </div>
                            <span class="divider"></span>
                            <div class="btn-group me-2">
                                <button><i class="fas fa-list-ul"></i></button>
                                <button><i class="fas fa-list-ol"></i></button>
                                <button><i class="fas fa-outdent"></i></button>
                                <button><i class="fas fa-indent"></i></button>
                            </div>
                            <span class="divider"></span>
                            <div class="btn-group me-2">
                                <button><i class="fas fa-link"></i></button>
                                <button><i class="fas fa-image"></i></button>
                            </div>
                        </div>
                        <div class="editor-content">
                            <div class="section-item">
                                <div class="section-item-header">1. Rencana Pelaksanaan Program Kegiatan</div>
                                <div class="section-item-content">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. <a href="#">read more</a>
                                </div>
                            </div>
                            <div class="section-item">
                                <div class="section-item-header">2. Link Salinan/Soft SKPI (isi website)</div>
                                <div class="section-item-content">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. <a href="#">read more</a>
                                </div>
                            </div>
                        </div>
                        <div class="p-2 text-end">
                            <button class="btn-publish">
                                <i class="fas fa-save me-1"></i> Publish
                            </button>
                        </div>
                    </div>
                    
                    <!-- Evaluasi Section -->
                    <div class="editor-block mb-4">
                        <div class="d-flex justify-content-between align-items-center bg-primary text-white p-2">
                            <div>
                                <i class="fas fa-file-alt me-2"></i> Evaluasi
                            </div>
                            <div>
                                <button class="btn-sm bg-transparent border-0 text-white"><i class="fas fa-expand-alt"></i></button>
                                <button class="btn-sm bg-transparent border-0 text-white"><i class="fas fa-ellipsis-v"></i></button>
                            </div>
                        </div>
                        <div class="editor-toolbar">
                            <div class="btn-group me-2">
                                <button><i class="fas fa-paragraph"></i></button>
                                <button><i class="fas fa-heading"></i></button>
                            </div>
                            <span class="divider"></span>
                            <div class="btn-group me-2">
                                <button><i class="fas fa-bold"></i></button>
                                <button><i class="fas fa-italic"></i></button>
                                <button><i class="fas fa-underline"></i></button>
                                <button><i class="fas fa-strikethrough"></i></button>
                            </div>
                            <span class="divider"></span>
                            <div class="btn-group me-2">
                                <button><i class="fas fa-list-ul"></i></button>
                                <button><i class="fas fa-list-ol"></i></button>
                                <button><i class="fas fa-outdent"></i></button>
                                <button><i class="fas fa-indent"></i></button>
                            </div>
                            <span class="divider"></span>
                            <div class="btn-group me-2">
                                <button><i class="fas fa-link"></i></button>
                                <button><i class="fas fa-image"></i></button>
                            </div>
                        </div>
                        <div class="editor-content">
                            <div class="section-item">
                                <div class="section-item-header">1. Dokumen Pelaksanaan Kegiatan</div>
                                <div class="section-item-content">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. <a href="#">read more</a>
                                </div>
                            </div>
                            <div class="section-item">
                                <div class="section-item-header">2. Link Salinan/Soft SKPI (isi website)</div>
                                <div class="section-item-content">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. <a href="#">read more</a>
                                </div>
                            </div>
                        </div>
                        <div class="p-2 text-end">
                            <button class="btn-publish">
                                <i class="fas fa-save me-1"></i> Publish
                            </button>
                        </div>
                    </div>
                    
                    <!-- Pengendalian Section -->
                    <div class="editor-block mb-4">
                        <div class="d-flex justify-content-between align-items-center bg-primary text-white p-2">
                            <div>
                                <i class="fas fa-file-alt me-2"></i> Pengendalian
                            </div>
                            <div>
                                <button class="btn-sm bg-transparent border-0 text-white"><i class="fas fa-expand-alt"></i></button>
                                <button class="btn-sm bg-transparent border-0 text-white"><i class="fas fa-ellipsis-v"></i></button>
                            </div>
                        </div>
                        <div class="editor-toolbar">
                            <div class="btn-group me-2">
                                <button><i class="fas fa-paragraph"></i></button>
                                <button><i class="fas fa-heading"></i></button>
                            </div>
                            <span class="divider"></span>
                            <div class="btn-group me-2">
                                <button><i class="fas fa-bold"></i></button>
                                <button><i class="fas fa-italic"></i></button>
                                <button><i class="fas fa-underline"></i></button>
                                <button><i class="fas fa-strikethrough"></i></button>
                            </div>
                            <span class="divider"></span>
                            <div class="btn-group me-2">
                                <button><i class="fas fa-list-ul"></i></button>
                                <button><i class="fas fa-list-ol"></i></button>
                                <button><i class="fas fa-outdent"></i></button>
                                <button><i class="fas fa-indent"></i></button>
                            </div>
                            <span class="divider"></span>
                            <div class="btn-group me-2">
                                <button><i class="fas fa-link"></i></button>
                                <button><i class="fas fa-image"></i></button>
                            </div>
                        </div>
                        <div class="editor-content">
                            <div class="section-item">
                                <div class="section-item-header">1. Rencana Pelaksanaan Program Kegiatan</div>
                                <div class="section-item-content">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. <a href="#">read more</a>
                                </div>
                            </div>
                            <div class="section-item">
                                <div class="section-item-header">2. Link Salinan/Soft SKPI (isi website)</div>
                                <div class="section-item-content">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. <a href="#">read more</a>
                                </div>
                            </div>
                        </div>
                        <div class="p-2 text-end">
                            <button class="btn-publish">
                                <i class="fas fa-save me-1"></i> Publish
                            </button>
                        </div>
                    </div>
                    
                    <!-- Peningkatan Section -->
                    <div class="editor-block mb-4">
                        <div class="d-flex justify-content-between align-items-center bg-primary text-white p-2">
                            <div>
                                <i class="fas fa-file-alt me-2"></i> Peningkatan
                            </div>
                            <div>
                                <button class="btn-sm bg-transparent border-0 text-white"><i class="fas fa-expand-alt"></i></button>
                                <button class="btn-sm bg-transparent border-0 text-white"><i class="fas fa-ellipsis-v"></i></button>
                            </div>
                        </div>
                        <div class="editor-toolbar">
                            <div class="btn-group me-2">
                                <button><i class="fas fa-paragraph"></i></button>
                                <button><i class="fas fa-heading"></i></button>
                            </div>
                            <span class="divider"></span>
                            <div class="btn-group me-2">
                                <button><i class="fas fa-bold"></i></button>
                                <button><i class="fas fa-italic"></i></button>
                                <button><i class="fas fa-underline"></i></button>
                                <button><i class="fas fa-strikethrough"></i></button>
                            </div>
                            <span class="divider"></span>
                            <div class="btn-group me-2">
                                <button><i class="fas fa-list-ul"></i></button>
                                <button><i class="fas fa-list-ol"></i></button>
                                <button><i class="fas fa-outdent"></i></button>
                                <button><i class="fas fa-indent"></i></button>
                            </div>
                            <span class="divider"></span>
                            <div class="btn-group me-2">
                                <button><i class="fas fa-link"></i></button>
                                <button><i class="fas fa-image"></i></button>
                            </div>
                        </div>
                        <div class="editor-content">
                            <div class="section-item">
                                <div class="section-item-header">1. Rencana Pelaksanaan Program Kegiatan</div>
                                <div class="section-item-content">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. <a href="#">read more</a>
                                </div>
                            </div>
                            <div class="section-item">
                                <div class="section-item-header">2. Link Salinan/Soft SKPI (isi website)</div>
                                <div class="section-item-content">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. <a href="#">read more</a>
                                </div>
                            </div>
                        </div>
                        <div class="p-2 text-end">
                            <button class="btn-publish">
                                <i class="fas fa-save me-1"></i> Publish
                            </button>
                        </div>
                    </div>
                    
                    <!-- Footer buttons -->
                    <div class="d-flex justify-content-between mb-5">
                        <button class="btn btn-outline-secondary">
                            <i class="fas fa-save me-1"></i> Simpan
                        </button>
                        <div>
                            <button class="btn btn-success me-2">
                                <i class="fas fa-paper-plane me-1"></i> Kirim
                            </button>
                            <button class="btn btn-danger">
                                <i class="fas fa-times me-1"></i> Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Include custom JS -->
    <script>
        // Add any custom JavaScript here
    </script>
</body>
</html>