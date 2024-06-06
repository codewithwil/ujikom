@extends('back.layout.template')
@section('title', 'edit bagi hasil')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Bagi hasil Koperasi</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Bagi hasil </li>
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
              <h3 class="card-title">Bagi hasil</h3>
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
            <form action="{{route('bagiHasil.update', $bagiHasil->kode_bagi_hasil)}}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                    <label for="kode_bagi_hasil">kode Bagi hasil</label>
                   <input class="input form-control" name="kode_bagi_hasil" readonly id="kode_bagi_hasil" type="text" value="{{$bagiHasil->kode_bagi_hasil}}">
                    @error('kode_bagi_hasil')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
              </div>
              <div class="form-group">
                <label for="periode">Periode cicilan</label>
                <select name="periode" id="periode" class="form-control">
                  <option value="{{$bagiHasil->periode}}" selected>{{$bagiHasil->periode}}</option>
                  <option value="6 bulan">6 bulan</option>
                  <option value="12 bulan">12 bulan</option>
                  <option value="24 bulan">24 bulan</option>
                  <option value="36 bulan">36 bulan</option>
                  <option value="48 bulan">48 bulan</option>
                  <option value="60 bulan">60 bulan</option>
                </select>
              </div>
              <div class="form-group">
                <label for="jumlah">profit</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" min="0" max="100" value="{{$bagiHasil->jumlah}}">
              </div>
                  <div class="form-group">
                    <label for="keterangan">keterangan</label>
                    <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control">{{$bagiHasil->keterangan}}</textarea>
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
