@extends('back.layout.template')
@section('title', 'pinjaman debet')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pinjaman debet</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Pinjaman debet</li>
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
                @if($simpanan->isNotEmpty())
                <h3>Data simpanan anggota</h3>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>tanggal</th>
                            <th>ID anggota</th>
                            <th>ID transaksi</th>
                            <th>kas</th>
                            <th>nominal</th>
                            <th></th>

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
                            <td>{{$item->transaksi}}</td>
                            <td>
                                <li>Pokok: {{$item->pokok}}</li>
                                <li>Wajib: {{$item->wajib}}</li>
                                    @if(!empty($item->sukarela))
                                        {{$item->sukarela}}
                                    @else
                                        <li>0</li>
                                    @endif
                                
                            </td>
                            <td></td>
                            @php
                            $totalSimpanan += $item->pokok + $item->wajib + $item->sukarela;
                        @endphp
                            <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                        </tr>
                        @endforeach
                        <tr> <!-- Baris baru untuk total simpanan -->
                            <td colspan="5"></td> 
                            <td>Total Simpanan</td>
                            <td>{{$totalSimpanan}}</td>
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
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            @endif
            
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
  @endpush
@endsection
