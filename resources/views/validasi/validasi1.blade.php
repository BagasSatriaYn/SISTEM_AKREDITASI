<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('Argon/assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{ asset('Argon/assets/img/favicon.png')}}">
  <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <title>
    Argon Dashboard 3 by Creative Tim
  </title>
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Canonical SEO -->
  <link rel="canonical" href="https://www.creative-tim.com/product/argon-dashboard" />
  <!--  Social tags      -->
  <meta name="keywords" content="creative tim, html dashboard, html css dashboard, web dashboard, bootstrap 5 dashboard, bootstrap 5, css3 dashboard, bootstrap 5 admin, Argon Dashboard 2 bootstrap 5 dashboard, frontend, responsive bootstrap 5 dashboard, free dashboard, free admin dashboard, free bootstrap 5 admin dashboard">
  <meta name="description" content="Argon Dashboard 3 is a beautiful Bootstrap 5 admin dashboard with a large number of components, designed to look beautiful and organized. If you are looking for a tool to manage and visualize data about your business, this dashboard is the thing for you.">
  <!-- Twitter Card data -->
  <meta name="twitter:card" content="product">
  <meta name="twitter:site" content="@creativetim">
  <meta name="twitter:title" content="Argon Dashboard 3 by Creative Tim">
  <meta name="twitter:description" content="Argon Dashboard 3 is a beautiful Bootstrap 5 admin dashboard with a large number of components, designed to look beautiful and organized. If you are looking for a tool to manage and visualize data about your business, this dashboard is the thing for you.">
  <meta name="twitter:creator" content="@creativetim">
  <meta name="twitter:image" content="https://s3.amazonaws.com/creativetim_bucket/products/450/original/opt_sd_free_thumbnail.png">
  <!-- Open Graph data -->
  <meta property="fb:app_id" content="655968634437471">
  <meta property="og:title" content="Argon Dashboard 3 by Creative Tim" />
  <meta property="og:type" content="article" />
  <meta property="og:url" content="http://demos.creative-tim.com/argon-dashboard/examples/dashboard.html" />
  <meta property="og:image" content="https://s3.amazonaws.com/creativetim_bucket/products/450/original/opt_sd_free_thumbnail.png" />
  <meta property="og:description" content="Argon Dashboard 3 is a beautiful Bootstrap 5 admin dashboard with a large number of components, designed to look beautiful and organized. If you are looking for a tool to manage and visualize data about your business, this dashboard is the thing for you." />
  <meta property="og:site_name" content="Creative Tim" />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('Argon/assets/css/argon-dashboard.min.css?v=2.1.0')}}" rel="stylesheet" />
  <!-- Anti-flicker snippet (recommended)  -->
  <style>
    .async-hide {
      opacity: 0 !important
    }
    .card {
      border-radius: 10px;
      margin-bottom: 20px;
      margin-top: -7%;
    }
    .box-content{
      background-color: white;
      padding: 20px;
      border-radius: 5px;
      margin-bottom: 20px;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }
    .box-header{
      background-color: #00437F;
      padding: 15px;
      border-radius: 5px;
      margin-bottom: 20px;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }
    .title{
      color: white;
      font-size: 20px;
      font-weight: bold;
      margin-top: 8px;
    }
    .box-informasi{
      background-color: #E6F2FF;
      padding: 50px;
      border-radius: 5px;
      margin-bottom: 20px;
    }
    .informasi{
      margin-top: 6%;
      color:#1F4265;
    }
  </style>
  <script>
    (function(a, s, y, n, c, h, i, d, e) {
      s.className += ' ' + y;
      h.start = 1 * new Date;
      h.end = i = function() {
        s.className = s.className.replace(RegExp(' ?' + y), '')
      };
      (a[n] = a[n] || []).hide = h;
      setTimeout(function() {
        i();
        h.end = null
      }, c);
      h.timeout = c;
    })(window, document.documentElement, 'async-hide', 'dataLayer', 4000, {
      'GTM-K9BGS8K': true
    });
  </script>
  <!-- Analytics-Optimize Snippet -->
  <script>
    (function(i, s, o, g, r, a, m) {
      i['GoogleAnalyticsObject'] = r;
      i[r] = i[r] || function() {
        (i[r].q = i[r].q || []).push(arguments)
      }, i[r].l = 1 * new Date();
      a = s.createElement(o),
        m = s.getElementsByTagName(o)[0];
      a.async = 1;
      a.src = g;
      m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-46172202-22', 'auto', {
      allowLinker: true
    });
    ga('set', 'anonymizeIp', true);
    ga('require', 'GTM-K9BGS8K');
    ga('require', 'displayfeatures');
    ga('require', 'linker');
    ga('linker:autoLink', ["2checkout.com", "avangate.com"]);
  </script>
  <!-- end Analytics-Optimize Snippet -->
  <!-- Google Tag Manager -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-NKDMSK6');
  </script>
  <!-- End Google Tag Manager -->
</head>

@extends('layouts.template')

@section('title', 'Dashboard-KPS, Kajur')
<body class="g-sidenav-show   bg-gray-100">
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  {{-- <div class="min-height-100 bg-dark position-absolute w-100"></div> --}}
  @include('layouts.sidebar')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('layouts.header')
    <!-- End Navbar -->
  </main>
  {{-- Content Start --}}

  @section('content')
  <div class="card">
    <div class="box-header">
      <h3 class="title">Validasi Data Kriteria Tahap 1</h3>
    </div>
  <div class="box-content">
    <div class="box-informasi">
          <div class="informasi">
            <center>
            {{-- <svg class="icon-warning" width="69" height="69" viewBox="0 0 69 69" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M34.5 4.3125C42.5062 ... Z" fill="#077E24"/>
            </svg> --}}
            <strong>Informasi</strong><br>
            Berikut daftar data kriteria yang akan divalidasi pada <strong>tahap 1</strong>.<br>
            Mohon Validator agar melakukan validasi terhadap data yang sudah disubmit oleh Admin dengan teliti.</center>
          </div>
        </div>

        
          <div class="card-body">
      <!-- untuk Filter data -->
        <div id="filter" class="form-horizontal filter-date p-2 border-bottom mb-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group form-group-sm row text-sm mb-0">
                        <label for="filter_date" class="col-md-1 col-form-label">Filter</label>
                        <div class="col-md-3">
                            <select name="filter_kategori" class="form-control form-control-sm filter_kategori">
                                <option value="">- Semua -</option>
                                {{-- @foreach($kategori as $l) --}}
                                    {{-- <option value="{{ $l->kategori_id }}">{{ $l->kategori_nama }}</option> --}}
                                    <option>Tahap 1</option>
                                    <option>Tahap 2</option>
                                {{-- @endforeach --}}
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table id="tableKriteria" class="table" style="text-align: center; width: 100%;">
        <thead class="table-primary">
          <tr>
            <th>ID</th>
            <th>Data Kriteria</th>
            <th>Penanggungjawab</th>
            <th>Status</th>
            <th>Tanggal Diubah</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="tableBody">
          <!-- Data akan diisi JS -->
        </tbody>
      </table>

      <!-- Modal Validasi Tahap 1 -->
<div class="modal fade" id="modalValidasi" tabindex="-1" role="dialog" aria-labelledby="modalValidasiLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Validasi Tahap 1</h5>
      </div>
      <div class="modal-body">
        <form id="formValidasiTahap1">
          <div class="row">
            <div class="col-md-6">
              <!-- FORM VALIDASI -->
              <p><strong>Pelaksana:</strong> <span id="validasiPelaksana"></span></p>
              <p><strong>Judul Kriteria:</strong> <span id="validasiJudul"></span></p>
              <p><strong>Di Submit Pada:</strong> <span id="validasiTanggal"></span></p>
              <p><strong>Status Validasi:</strong></p>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="status_validasi" value="diterima" id="statusDiterima">
                <label class="form-check-label" for="statusDiterima">
                  Pengajuan Tahap 1 diterima <i class="fas fa-check-circle text-success me-1"></i>
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="status_validasi" value="ditolak" id="statusDitolak">
                <label class="form-check-label" for="statusDitolak">
                  Pengajuan Tahap 1 ditolak <i class="fas fa-times-circle text-danger me-1"></i>
                </label>
              </div>
              <div class="form-group mt-3">
                <p for="catatan"><strong>Catatan</strong></p>
                <textarea name="catatan" id="catatan" class="form-control" rows="3" placeholder="Mohon Bapak/Ibu..."></textarea>
              </div>
              <input type="hidden" name="id_kriteria" id="id_kriteria">
            </div>

            <div class="col-md-6">
              <p><strong>Preview</strong></p>
              <iframe id="pdfViewer" src="" width="100%" height="400px" style="border:1px solid #ccc;"></iframe>
            </div>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="btnBatalValidasi">Batal</button>
        <button type="button" class="btn btn-primary" id="btnSimpanValidasi">Simpan</button>
      </div>
    </div>
  </div>
</div>

     <script>
  function statusBadge(status) {
    switch (status) {
      case 'SAVE': return '<span class="badge bg-primary">SAVE</span>';
      case 'REVISI': return '<span class="badge bg-danger">REVISI</span>';
      case 'ACC TAHAP 1': return '<span class="badge bg-success">ACC TAHAP 1</span>';
      case 'ACC TAHAP 2': return '<span class="badge bg-success">ACC TAHAP 2</span>';
      default: return '<span class="badge bg-secondary">' + status + '</span>';
    }
  }

  function loadData() {
  const filterStatus = $('#filterStatus').val();

  $.ajax({
    url: "{{ route('validasi1.data') }}",
    method: "GET",
    data: { status: filterStatus }, // kirim filter
    success: function (response) {
      const tbody = document.getElementById('tableBody');
      tbody.innerHTML = '';

      response.forEach(item => {
        const kriteria = item.kriteria ?? {};
        tbody.innerHTML += `
          <tr>
            <td>${item.id_detail_kriteria}</td>
            <td>Kriteria ${kriteria.id_kriteria ?? '-'} - ${kriteria.nama ?? '-'}</td>
            <td>${kriteria.penanggung_jawab ?? '-'}</td>
            <td>${statusBadge(item.status)}</td>
            <td>${new Date(item.updated_at).toLocaleDateString()}</td>
            <td>
              <button class="btn btn-warning btn-sm btn-validasi"
                      data-id="${item.id_detail_kriteria}"
                      data-pj="${kriteria.penanggung_jawab ?? '-'}"
                      data-nama="${kriteria.nama ?? '-'}"
                      data-tanggal="${item.updated_at}">
                Validasi
              </button>
            </td>
          </tr>`;
      });
    },
    error: function () {
      alert('Gagal memuat data dari server.');
    }
  });
}

  $(document).ready(function () {
    loadData();

    $('#tableKriteria').on('click', '.btn-validasi', function () {
      const btn = $(this);
      $('#validasiPelaksana').text(btn.data('pj'));
      $('#validasiJudul').text(`Kriteria - ${btn.data('nama')}`);
      $('#validasiTanggal').text(new Date(btn.data('tanggal')).toLocaleDateString());
      $('#id_kriteria').val(btn.data('id'));
      $('#formValidasiTahap1')[0].reset();
      $('#modalValidasi').modal('show');
    });

    $('#btnBatalValidasi').on('click', function () {
      $('#modalValidasi').modal('hide');
    });

    $('#btnSimpanValidasi').on('click', function () {
      const status = $('input[name="status_validasi"]:checked').val();
      const catatan = $('#catatan').val().trim();
      const form = $('#formValidasiTahap1');

      if (!status) {
        Swal.fire({ icon: 'warning', title: 'Peringatan', text: 'Pilih status validasi terlebih dahulu!' });
        return;
      }

      if (status === 'ditolak' && catatan === '') {
        Swal.fire({ icon: 'error', title: 'Catatan wajib diisi!', text: 'Isi catatan jika menolak pengajuan.' });
        return;
      }

      $.ajax({
        url: "{{ route('validasi1.simpan') }}",
        method: 'POST',
        data: form.serialize(),
        success: function () {
          Swal.fire({ icon: 'success', title: 'Berhasil', text: 'Validasi berhasil disimpan!' }).then(() => {
            $('#modalValidasi').modal('hide');
            loadData(); // Refresh table
          });
        },
        error: function () {
          Swal.fire({ icon: 'error', title: 'Gagal', text: 'Gagal menyimpan validasi.' });
        }
      });
    });
  });
</script>



      <script>
        $(document).ready(function () {
          $('#btnSimpanValidasi').on('click', function () {
            const status = $('input[name="status_validasi"]:checked').val();
            const catatan = $('#catatan').val().trim();

            if (!status) {
              Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Pilih status validasi terlebih dahulu!',
              });
              return;
            }

            if (status === 'ditolak' && catatan === '') {
              Swal.fire({
                icon: 'error',
                title: 'Catatan wajib diisi!',
                text: 'Silakan isi catatan jika menolak pengajuan.',
              });
              return;
            }

            // Jika valid, lanjut kirim AJAX atau submit
            // Contoh saja (ubah sesuai kebutuhanmu)
              $.ajax({
              url: "{{ route('validasi1.simpan') }}",

              method: 'POST',
              data: $('#formValidasiTahap1').serialize(),
              success: function (response) {
                Swal.fire({
                  icon: 'success',
                  title: 'Berhasil',
                  text: 'Validasi berhasil disimpan!',
                }).then(() => {
                  $('#modalValidasi').modal('hide');
                  // refresh tabel jika pakai DataTable
                  $('#t_kriteria').DataTable().ajax.reload();
                });
              }
            });
          });
        });
        </script>

          </div>
        </div>

    </div>
        </div>
  </div>
        @endsection

  @section('scripts')

  <!--   Core JS Files   -->
  <script src="{{ asset('Argon/assets/js/core/popper.min.js')}}"></script>
  <script src="{{ asset('Argon/assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{ asset('Argon/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{ asset('Argon/assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script src="{{ asset('Argon/assets/js/plugins/chartjs.min.js')}}"></script>
  <script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Mobile apps",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#5e72e4",
          backgroundColor: gradientStroke1,
          borderWidth: 3,
          fill: true,
          data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#fbfbfb',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#ccc',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
 <!-- 1. jQuery harus paling atas -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- 2. Bootstrap setelah jQuery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- 3. DataTables (butuh jQuery) -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

<!-- 4. SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- 5. Argon Dashboard -->
<script src="{{ asset('Argon/assets/js/argon-dashboard.min.js?v=2.1.0') }}"></script>

</body>
</html>