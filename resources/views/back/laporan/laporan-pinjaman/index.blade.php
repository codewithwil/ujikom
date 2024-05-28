@extends('back.layout.template')
@section('title', 'laporan pinjaman')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pinjaman </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Pinjaman </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    {{-- <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Kelola data Pinjaman debet</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <a href="{{route('pinjamanDebet.tambah')}}" class="btn btn-warning mb-2">Tambah Pinjaman</a>
                @if ($errors->any())
                <div class="my-3">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div> 
                </div> 
                @endif
               <div class="table-responsive">
            
            @if($pinjaman->isNotEmpty())
            <h3>Data pinjaman Anggota</h3>
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>tanggal</th>
                            <th>ID anggota</th>
                            <th>ID transaksi</th>
                            <th>kas</th>
                            <th>nominal</th>
                            <th>bunga</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                            @php
                            $totalPinjaman = 0;
                        @endphp
                        @foreach ($pinjaman as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->tanggal}}</td>
                            <td>{{$item->anggota_kode}}</td>
                            <td>{{$item->kode_pinjaman_kredit}}</td>
                            <td>{{$item->transaksi}}</td>
                            <td>{{$item->nominal}}</td>
                            <td>{{$item->bunga}}</td>
                            <td></td>
                            @php
                            $totalPinjaman += $item->nominal;
                        @endphp
                            <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                        </tr>
                        @endforeach
                        <tr> <!-- Baris baru untuk total simpanan -->
                            <td colspan="6"></td> 
                            <td>Total Nominal pinjaman murni</td>
                            <td>{{$totalPinjaman}}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>tanggal</th>
                            <th>ID anggota</th>
                            <th>ID transaksi</th>
                            <th>kas</th>
                            <th>nominal</th>
                            <th>bunga</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            @endif
            
               </div>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section> --}}
    
<section class="content">
  <div class="container-fluid">
  <div class="row">
  <div class="col-12">
  <div class="callout callout-info">
  <h5><i class="fas fa-info"></i> {{$pengaturan->first()->nama_perusahaan}}</h5>
  Laporan pinjaman Anggota {{$pengaturan->first()->nama_perusahaan}}
  </div>
  
  <div class="invoice p-3 mb-3">
  
  <div class="row">
  <div class="col-12">
  <h4>
    <img src="{{ asset('storage/back/pengaturan/' . optional($pengaturan)->first()->foto_perusahaan) }}" alt=" Logo" class="brand-image img-circle elevation-3" style="opacity: .8" width="50px">
     {{$pengaturan->first()->nama_perusahaan}}
  <small class="float-right " id="currentDate"></small>
  </h4>
  </div>
  
  </div>
  
  <div class="row invoice-info">
  <div class="col-sm-4 invoice-col">

  <address>
  <strong>{{$pengaturan->first()->nama_perusahaan}}</strong><br>
  NIB: {{$pengaturan->first()->nib}}<br>
  Alamat: {{$pengaturan->first()->alamat}} {{$pengaturan->first()->kodepos}}<br>
  Telepon: {{$pengaturan->first()->telepon}}<br>
  Email: <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="c7aea9a1a887a6abaaa6b4a6a2a2a3b4b3b2a3aea8e9a4a8aa">{{$pengaturan->first()->email}}</a>
  </address>
  </div>
  
  <div class="col-sm-4 invoice-col">
  </div>
  
  <div class="col-sm-4 invoice-col">
  <b>Invoice #007612</b><br>
  <br>
  {{-- <b>Order ID:</b> 4F3S8J<br>
  <b>Payment Due:</b> 2/22/2014<br>
  <b>Account:</b> 968-34567 --}}
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
    <th>kas</th>
    <th>bunga</th>
    <th>nominal</th>
    <th></th>
  </tr>
  </thead>
  <tbody>
    @php
    $totalPinjaman = 0;
@endphp
@foreach ($pinjaman as $item)
<tr>
    <td>{{$loop->iteration}}</td>
    <td>{{$item->tanggal}}</td>
    <td>{{$item->anggota_kode}}</td>
    <td>{{$item->kode_pinjaman_kredit}}</td>
    <td>{{$item->transaksi}}</td>
    <td>{{$item->bunga}}</td>
    <td>{{$item->nominal}}</td>
    <td></td>
    @php
    $totalPinjaman += $item->nominal;
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
  <p class="lead" >Tanggal pembayaran   <span id="curentDate"></span></p>
  <div class="table-responsive">
  <table class="table">
  <tr>
  <th style="width:50%">Subtotal:</th>
  <td>$250.30</td>
  </tr>
  <tr>
  <th>Tax (9.3%)</th>
  <td>$10.34</td>
  </tr>
  <tr>
  <th>Shipping:</th>
  <td>$5.80</td>
  </tr>
  <tr>
  <th>Total:</th>
  <td>{{$totalPinjaman}}</td>
  </tr>
  </table>
  </div>
  </div>
  
  </div>
  
  
  <div class="row no-print">
  <div class="col-12">
  <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
  <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
  Payment
  </button>
  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
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
    function deletePinjamD(e) {
        let kode_pinjaman_debet = e.getAttribute('data-id');
        console.log("ID Saldo yang Dihapus:", kode_pinjaman_debet);
    
        Swal.fire({
            title: 'Delete Saldo ' + kode_pinjaman_debet,
            text: "Are you sure?",
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route("pinjamanDebet.delete") }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'POST', 
                        kode_pinjaman_debet: kode_pinjaman_debet 
                    },
                    dataType: "json",
                    success: function (response) {
                        Swal.fire({
                            title: "Success",
                            text: response.message,
                            icon: 'success',
                        }).then((result) => {
                            window.location.href = '/pinjaman/debet';
                        });
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });
    }
    </script>
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
  // Ambil elemen dengan id 'currentDate'
  var currentDateElement = document.getElementById('currentDate');

  // Buat objek tanggal hari ini
  var today = new Date();

  // Format tanggal menjadi MM/DD/YYYY
  var formattedDate = (today.getMonth() + 1) + '/' + today.getDate() + '/' + today.getFullYear();

  // Set nilai dalam elemen 'currentDate' dengan tanggal hari ini
  currentDateElement.textContent = formattedDate;
</script>
<script>
  // Ambil elemen dengan id 'currentDate'
  var currentDateElement = document.getElementById('curentDate');

  // Buat objek tanggal hari ini
  var today = new Date();

  // Format tanggal menjadi MM/DD/YYYY
  var formattedDate = (today.getMonth() + 1) + '/' + today.getDate() + '/' + today.getFullYear();

  // Set nilai dalam elemen 'currentDate' dengan tanggal hari ini
  currentDateElement.textContent = formattedDate;
</script>

  @endpush
@endsection
