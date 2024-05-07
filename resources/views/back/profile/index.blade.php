@extends('back.layout.template')
@section('title', 'profile')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Profile</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Profile </li>
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
              <h3 class="card-title">Atur Profile</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->

          
            <form action="{{route('profile.update', $users->id)}}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                    <label for="foto">Foto Profile</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="foto" name="foto_profile">
                        <label class="custom-file-label" for="foto">Choose file</label>
                      </div>
                    </div>
                    @empty($users->foto_profile)
                    <p>Foto Profile tidak ada</p>
                @else
                <small>Foto lama:</small>
                    <div class="mt-2" >
                        <img src="{{asset('storage/back/foto-profile/'.$users->foto_profile) }}" class="img-thumbnail img-preview" alt="Foto Pengguna" width="120px">                              
                    </div>
                @endempty
                  </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="name" placeholder="isi nama..." value="{{$users->name}}">
                  </div>
                <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="number" class="form-control" id="nik" name="nik" placeholder="isi nik..." value="{{$users->nik }}">
                </div>
                <div class="form-group">
                    <label for="telepon">Telepon</label>
                    <input type="number" class="form-control" id="telepon" name="telepon" placeholder="isi telepon..." value="{{$users->telepon }}">
                </div>
                <div class="form-group">
                    <label for="nama">Alamat</label>
                    <textarea name="alamat" id="" cols="10" rows="3" class="form-control">{{$users->alamat}}</textarea>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" value="{{$users->email}}" >
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                </div>
                <div class="form-group">
                    <label for="password">masukan ulang password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password_repeat">
                  </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-warning">Submit</button>
                <a href="{{route('dashboard')}}" class="btn btn-primary">Kembali</a>
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
  <script src="admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- AdminLTE App -->
  <script src="admin/dist/js/adminlte.min.js"></script>
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
  <script>
  $(function () {
    bsCustomFileInput.init();
  });
  </script>

  
  @endpush
@endsection
