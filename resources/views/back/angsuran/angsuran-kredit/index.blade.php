@extends('back.layout.template')
@section('title', 'angsuran kredit')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data angsuran Pinjaman kredit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data angsuran Pinjaman kredit</li>
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
                <h3 class="card-title">Kelola data angsuran Pinjaman kredit</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <a href="{{route('laporan.angsuranK')}}" class="btn btn-info mb-3">invoice</a>
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
                    <th>periode</th>
                    <th>bunga</th>
                    <th>cicilan</th>
                    <th>status buku</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($angsuranKredit as $item)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->kode_pinjaman_kredit}}</td>
                    <td>{{$item->Anggota->nama}}</td>
                    <td>{{$item->tanggal}}</td>
                    <td>{{$item->jenis_pembayaran}}</td>
                    <td>{{$item->transaksi}}</td>
                    <td>{{$item->divisi}}</td>
                    <td>{{$item->keterangan}}</td>
                    <td>{{$item->periode}} bulan</td>
                    <td>{{$item->bunga}}%</td>

                <td>Rp.{{ number_format(hitungCicilan($item->nominal, $item->bunga, $item->periode), 2, ',', '.') }}</td>

                    <td>{{$item->status_buku}}</td>
                    <td>
                      <a href="{{route('angsuran.kredit.detail', $item->kode_pinjaman_kredit)}}" class="btn btn-primary shadow btn-xs sharp me-1 btn-edit"><i class="fa fa-eye"></i></a>
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
                    <th>periode</th>
                    <th>bunga</th>
                    <th>cicilan</th>
                    <th>status buku</th>
                    <th>Aksi</th>
                  </tr>
                  </tfoot>
                </table>
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
    function deletePinjamD(e) {
        let kode_pinjaman_kredit = e.getAttribute('data-id');
        console.log("ID Saldo yang Dihapus:", kode_pinjaman_kredit);
    
        Swal.fire({
            title: 'Delete Saldo ' + kode_pinjaman_kredit,
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
                        kode_pinjaman_kredit: kode_pinjaman_kredit 
                    },
                    dataType: "json",
                    success: function (response) {
                        Swal.fire({
                            title: "Success",
                            text: response.message,
                            icon: 'success',
                        }).then((result) => {
                            window.location.href = '/angsuran/kredit';
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
