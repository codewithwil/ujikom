@extends('back.layout.template')
@section('title', 'tambah jenisSimpanan')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tambah Jenis simpanan Koperasi</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Tambah jenis simpanan </li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Jenis simpanan</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
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
            <form action="{{route('jenisSimpanan.store')}}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                    <label for="kode_jenis_simpanan">kode jenis simpanan</label>
                    <?php
                    $kodeJenis = autonumber('jenis_simpanan', 'kode_jenis_simpanan','JSN', 3);
                ?>
                   <input class="input @error('kode_jenis_simpanan') is-invalid @enderror form-control" name="kode_jenis_simpanan" readonly id="kode_jenis_simpanan" type="text" value="<?= $kodeJenis ?>">
                    @error('kode_jenis_simpanan')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
                  <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="nominal">Nominal(tidak wajib) </label>
                    <input type="number" name="nominal" id="nominal" class="form-control">
                  </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Submit</button>
                    <a href="{{route('jenisSimpanan.index')}}" class="btn btn-primary">Kembali</a>
                  </div>
        </form>
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>


  @push('js')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script>
    $(document).ready(function(){
        // Cek apakah pesan 'success' ada dalam session
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
