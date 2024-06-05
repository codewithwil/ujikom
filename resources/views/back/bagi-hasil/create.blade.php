@extends('back.layout.template')
@section('title', 'tambah Bagi hasil')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tambah bagi hasil Koperasi</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Tambah bagi hasil </li>
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
              <h3 class="card-title">bagi hasil</h3>
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
            <form action="{{route('bagiHasil.store')}}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                    <label for="kode_bagi_hasil">kode bagi hasil</label>
                    <?php
                    $kodeJenis = autonumber('bagi_hasil', 'kode_bagi_hasil','BGL', 3);
                ?>
                   <input class="input @error('kode_bagi_hasil') is-invalid @enderror form-control" name="kode_bagi_hasil" readonly id="kode_bagi_hasil" type="text" value="<?= $kodeJenis ?>">
                    @error('kode_bagi_hasil')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
                <div class="form-group">
                  <label for="jumlah">Nominal(tidak wajib) </label>
                  <input type="number" name="jumlah" id="jumlah" class="form-control" min="0" max="100">
                </div>
                  <div class="form-group">
                    <label for="keterangan">keterangan</label>
                    <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control"></textarea>
                  </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Submit</button>
                    <a href="{{route('bagiHasil.index')}}" class="btn btn-primary">Kembali</a>
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
