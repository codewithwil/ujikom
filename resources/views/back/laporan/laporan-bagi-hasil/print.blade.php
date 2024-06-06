@extends('back.layout.template')
@section('title', 'laporan Bagi hasil')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">


  <div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-12">
          <h2 class="page-header">
            <img src="{{ asset('storage/back/pengaturan/' . optional(optional($pengaturan)->first())->foto_perusahaan) }}" alt=" Logo" class="brand-image img-circle elevation-3" style="opacity: .8" width="50px">
            {{ optional(optional($pengaturan)->first())->nama_perusahaan }}
            <small class="float-right currentDate" id="currentDate1"></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
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

      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-12 table-responsive">
          <table class="table table-striped">
            <thead>
                <tr>
                  <th>No</th>
                  <th>kode bagi hasil</th>
                  <th>periode cicilan</th>
                  <th>Jumlah</th>
                  <th>Keterangan</th>
                </tr>
                </thead>
                <tbody>
              
              @foreach ($bagiHasil as $item)
              <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$item->kode_bagi_hasil}}</td>
                  <td>{{$item->periode}}</td>
                  <td>{{$item->jumlah}}</td>
                  <td>{{$item->keterangan}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->

        <div class="col-6">
            <p class="lead">pembayaran melalui:</p>
            <img src="{{asset('admin/dist/img/credit/visa.png')}}" alt="Visa">
            <img src="{{asset('admin/dist/img/credit/mastercard.png')}}" alt="Mastercard">
            <img src="{{asset('admin/dist/img/credit/american-express.png')}}" alt="American Express">
            <img src="{{asset('admin/dist/img/credit/paypal2.png')}}" alt="Paypal">
            <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
            </p>
            </div>

        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>


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
    <script>
        window.addEventListener("load", window.print());
      </script>

    <script>
        var currentDateElements = document.getElementsByClassName('currentDate');
        var today = new Date();
        var formattedDate = (today.getMonth() + 1) + '/' + today.getDate() + '/' + today.getFullYear();

        for (var i = 0; i < currentDateElements.length; i++) {
            currentDateElements[i].textContent = formattedDate;
        }
    </script>
  @endpush
@endsection



<!-- ./wrapper -->
<!-- Page specific script -->

