@extends('back.layout.template')
@section('title', 'simpanan debet')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Simpanan debet</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Simpanan debet</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Kelola data Simpanan debet</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <a href="{{route('simpananDebet.tambah')}}" class="btn btn-warning mb-2"  >Tambah Simpanan</a>
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>anggota</th>
                    <th>tanggal</th>
                    <th>Jenis</th>
                    <th>Transaksi</th>
                    <th>divisi</th>
                    <th>keterangan</th>
                    <th>pokok</th>
                    <th>wajib</th>
                    <th>sukarela</th>
                    <th>status buku</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($simpanD as $item)
                  <tr>
                   
                    <td>{{$item->kode_simpanan_debet}}</td>
                    <td>{{$item->Anggota->nama}}</td>
                    <td>{{$item->tanggal}}</td>
                    <td>{{$item->jenis_pembayaran}}</td>
                    <td>{{$item->transaksi}}</td>
                    <td>{{$item->divisi}}</td>
                    <td>{{$item->keterangan}}</td>
                    <td>{{$item->pokok}}</td>
                    <td>{{$item->wajib}}</td>
                    <td>{{$item->sukarela}}</td>
                    <td>{{$item->status_buku}}</td>
                    <td>
                      <a href="{{route('simpananDebet.edit', $item->kode_simpanan_debet)}}" class="btn btn-primary shadow btn-xs sharp me-1 btn-edit"><i class="fas fa-pencil-alt"></i></a>

                        <a href="#" onclick="deletesimpanD(this)" data-id="{{$item->kode_simpanan_debet}}" 
                            class="btn btn-danger shadow btn-xs sharp"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>anggota</th>
                    <th>tanggal</th>
                    <th>Jenis</th>
                    <th>Transaksi</th>
                    <th>divisi</th>
                    <th>keterangan</th>
                    <th>pokok</th>
                    <th>sukarela</th>
                    <th>wajib</th>
                    <th>status buku</th>
                    <th>Aksi</th>
                  </tr>
                  </tfoot>
                </table>
               </div>
               <div class="container-fluid">
                <div class="row">
                <div class="col-12">
                <div class="callout callout-info">
                <h5><i class="fas fa-info"></i> Note:</h5>
                This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                </div>
                
                <div class="invoice p-3 mb-3">
                
                <div class="row">
                <div class="col-12">
                <h4>
                <i class="fas fa-globe"></i> AdminLTE, Inc.
                <small class="float-right">Date: 2/10/2014</small>
                </h4>
                </div>
                
                </div>
                
                <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                From
                <address>
                <strong>Admin, Inc.</strong><br>
                795 Folsom Ave, Suite 600<br>
                San Francisco, CA 94107<br>
                Phone: (804) 123-5432<br>
                Email: <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="c7aea9a1a887a6abaaa6b4a6a2a2a3b4b3b2a3aea8e9a4a8aa">[email&#160;protected]</a>
                </address>
                </div>
                
                <div class="col-sm-4 invoice-col">
                To
                <address>
                <strong>John Doe</strong><br>
                795 Folsom Ave, Suite 600<br>
                San Francisco, CA 94107<br>
                Phone: (555) 539-1037<br>
                Email: <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="b1dbded9df9fd5ded4f1d4c9d0dcc1ddd49fd2dedc">[email&#160;protected]</a>
                </address>
                </div>
                
                <div class="col-sm-4 invoice-col">
                <b>Invoice #007612</b><br>
                <br>
                <b>Order ID:</b> 4F3S8J<br>
                <b>Payment Due:</b> 2/22/2014<br>
                <b>Account:</b> 968-34567
                </div>
                
                </div>
                
                
                <div class="row">
                <div class="col-12 table-responsive">
                <table class="table table-striped">
                <thead>
                <tr>
                <th>Qty</th>
                <th>Product</th>
                <th>Serial #</th>
                <th>Description</th>
                <th>Subtotal</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                <td>1</td>
                <td>Call of Duty</td>
                <td>455-981-221</td>
                <td>El snort testosterone trophy driving gloves handsome</td>
                <td>$64.50</td>
                </tr>
                <tr>
                <td>1</td>
                <td>Need for Speed IV</td>
                <td>247-925-726</td>
                <td>Wes Anderson umami biodiesel</td>
                <td>$50.00</td>
                </tr>
                <tr>
                <td>1</td>
                <td>Monsters DVD</td>
                <td>735-845-642</td>
                <td>Terry Richardson helvetica tousled street art master</td>
                <td>$10.70</td>
                </tr>
                <tr>
                <td>1</td>
                <td>Grown Ups Blue Ray</td>
                <td>422-568-642</td>
                <td>Tousled lomo letterpress</td>
                <td>$25.99</td>
                </tr>
                </tbody>
                </table>
                </div>
                
                </div>
                
                <div class="row">
                
                <div class="col-6">
                <p class="lead">Payment Methods:</p>
                <img src="../../dist/img/credit/visa.png" alt="Visa">
                <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                <img src="../../dist/img/credit/american-express.png" alt="American Express">
                <img src="../../dist/img/credit/paypal2.png" alt="Paypal">
                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                plugg
                dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                </p>
                </div>
                
                <div class="col-6">
                <p class="lead">Amount Due 2/22/2014</p>
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
                <td>$265.24</td>
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
    $(function () {
        $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        });
    });
    </script>



<script>
    function deletesimpanD(e) {
        let kode_simpanan_debet = e.getAttribute('data-id');
        console.log("ID Saldo yang Dihapus:", kode_simpanan_debet);
    
        Swal.fire({
            title: 'Delete Saldo ' + kode_simpanan_debet,
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
                    url: '{{ route("simpananDebet.delete") }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'POST', 
                        kode_simpanan_debet: kode_simpanan_debet 
                    },
                    dataType: "json",
                    success: function (response) {
                        Swal.fire({
                            title: "Success",
                            text: response.message,
                            icon: 'success',
                        }).then((result) => {
                            window.location.href = '/simpanan/debet';
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
  @endpush
@endsection
