@extends('back.layout.template')
@section('title', 'laporan simpanan')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Simpanan </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Simpanan </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<section class="content">
  <div class="container-fluid">
  <div class="row">
  <div class="col-12">
  <div class="callout callout-info">
  <h5><i class="fas fa-info"></i> {{ optional(optional($pengaturan)->first())->nama_perusahaan }}  </h5>
  Laporan simpanan Anggota {{optional(optional($pengaturan)->first())->nama_perusahaan}}
  </div>

  <div class="invoice p-3 mb-3">

  <div class="row">
  <div class="col-12">
  <h4>
    <img src="{{ asset('storage/back/pengaturan/' . optional(optional($pengaturan)->first())->foto_perusahaan) }}" alt=" Logo" class="brand-image img-circle elevation-3" style="opacity: .8" width="50px">
    {{ optional(optional($pengaturan)->first())->nama_perusahaan }}

  <small class="float-right curentDate" id="currentDate1"></small>
  </h4>
  </div>

  </div>

  <div class="row invoice-info">
  <div class="col-sm-4 invoice-col">

  <address>
  <strong>{{optional(optional($pengaturan)->first())->nama_perusahaan}}</strong><br>
  NIB: {{optional(optional($pengaturan)->first())->nib}}<br>
  Alamat: {{optional(optional($pengaturan)->first())->alamat}} {{optional(optional($pengaturan)->first())->kodepos}}<br>
  Web: {{ optional(optional($pengaturan)->first())->web }}

  </address>
  </div>

  <div class="col-sm-4 invoice-col">
  </div>

  <div class="col-sm-4 invoice-col">
  <b>Invoice #007612</b><br>
  <br>
  <b>Telepon:</b> {{optional(optional($pengaturan)->first())->telepon}}<br>
  <b>Email:</b> {{optional(optional($pengaturan)->first())->email}}<br>
  </div>

  </div>


  <div class="row">
  <div class="col-12 table-responsive">
  <table class="table table-striped">
  <thead>
  <tr>
    <th>No</th>
    <th>tanggal</th>
    <th>ID anggota</th>
    <th>ID transaksi</th>
    <th>Nama anggota</th>
    <th>kas</th>
    <th>nominal</th>
  </tr>
  </thead>
  <tbody>
    @php
    $totalSimpanan = 0;
@endphp
@foreach ($simpanan as $item)
<tr>
    <td>{{$loop->iteration}}</td>
    <td>{{$item->tanggal}}</td>
    <td>{{$item->anggota_kode}}</td>
    <td>{{$item->kode_simpanan_debet}}</td>
    <td>{{$item->Anggota->nama}}</td>
    <td>{{$item->transaksi}}</td>
    <td>
        <li>{{ $item->pokok }}</li>
        <li>{{ $item->wajib }}</li>
        <li>{{ !empty($item->sukarela) ? $item->sukarela : 0 }}</li>
    </td>
    @php
    $totalSimpanan += $item->pokok + $item->wajib + $item->sukarela;
@endphp
    <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
</tr>
@endforeach
  </tbody>
  </table>
  </div>

  </div>

  <div class="row">

  <div class="col-6">
  <p class="lead">pembayaran melalui:</p>
  <img src="{{asset('admin/dist/img/credit/visa.png')}}" alt="Visa">
  <img src="{{asset('admin/dist/img/credit/mastercard.png')}}" alt="Mastercard">
  <img src="{{asset('admin/dist/img/credit/american-express.png')}}" alt="American Express">
  <img src="{{asset('admin/dist/img/credit/paypal2.png')}}" alt="Paypal">
  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
  </p>
  </div>

  <div class="col-6">
  <p class="lead" >Tanggal pembayaran   <span class="curentDate" id="curentDate2"></span></p>
  <div class="table-responsive">
  <table class="table">
  <tr>
  <th>Total Nominal:</th>
  <td>{{$totalSimpanan}}</td>
  </tr>
  </table>
  </div>
  </div>

  </div>


  <div class="row no-print">
  <div class="col-12">
  <a href="{{ route('print.simpanan') }}" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;" onclick="generatePDF()">
  <i class="fas fa-download"></i> Generate PDF
  </button>
  </div>
  </div>
  </div>

  </div>
  </div>
  </div>
  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->



  @push('js')
    <!-- DataTables  & Plugins -->
    <script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <script>

    $(document).ready(function(){

        @if(session('success'))
            // Tampilkan pesan Toastr
            toastr.success('{{ session('success') }}');
            // Hapus pesan 'success' dari session
            {{ session()->forget('success') }}
        @endif
    });
  </script>

<script>
    var currentDateElements = document.getElementsByClassName('currentDate');
    var today = new Date();
    var formattedDate = (today.getMonth() + 1) + '/' + today.getDate() + '/' + today.getFullYear();

    for (var i = 0; i < currentDateElements.length; i++) {
        currentDateElements[i].textContent = formattedDate;
    }
</script>

<script>
  function generatePDF() {
      // Kirim permintaan AJAX ke endpoint yang akan menghasilkan PDF
      fetch('/generate-pdf')
          .then(response => {
              if (!response.ok) {
                  throw new Error('Failed to generate PDF');
              }
              return response.blob();
          })
          .then(blob => {
              // Buat objek URL untuk blob PDF
              const url = window.URL.createObjectURL(blob);
              // Buat elemen <a> untuk mengunduh file PDF
              const a = document.createElement('a');
              a.href = url;
              a.download = 'invoice.pdf';
              // Tambahkan elemen <a> ke DOM dan klik untuk mengunduh
              document.body.appendChild(a);
              a.click();
              // Hapus objek URL setelah file diunduh
              window.URL.revokeObjectURL(url);
          })
          .catch(error => {
              console.error('Error:', error);
              // Tampilkan pesan kesalahan kepada pengguna jika terjadi kesalahan
              alert('Failed to generate PDF');
          });
  }
</script>

  @endpush
@endsection
