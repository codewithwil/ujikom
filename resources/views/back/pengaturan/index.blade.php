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
            <!-- /.card-header -->
            <!-- form start -->
            @if($pengaturan)
            <form action="{{route('pengaturan.update', $pengaturan->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="foto_perusahaan">Foto Perusahaan</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="foto_perusahaan" name="foto_perusahaan">
                            <label class="custom-file-label" for="foto_perusahaan">Choose file</label>
                          </div>
                        </div>
                        @empty($pengaturan->foto_perusahaan)
                        <p>Foto Perusahaan tidak ada</p>
                    @else
                    <small>Foto lama:</small>
                        <div class="mt-2" >
                            <img src="{{asset('storage/back/pengaturan/'.$pengaturan->foto_perusahaan) }}" class="img-thumbnail img-preview" alt="Foto perusahaan" width="120px">                              
                        </div>
                    @endempty
                      </div>
                    <div class="form-group">
                        <label for="nama_perusahaan">Nama Perusahaan</label>
                        <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" value="{{$pengaturan->nama_perusahaan}}" >
                        @error('nama_perusahaan')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                      </div>
                      <div class="form-group">
                        <label for="nib">NIB</label>
                        <input type="number" class="form-control" id="nib" name="nib" placeholder="isi nib..." value="{{$pengaturan->nib}}" >
                        @error('nib')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="web">website</label>
                        <input type="url" class="form-control" id="web" name="web" placeholder="isi web..." value="{{$pengaturan->web}}" >
                        @error('web')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="telepon">Telepon</label>
                        <input type="number" class="form-control" id="telepon" name="telepon" placeholder="isi telepon..." value="{{$pengaturan->telepon}}">
                        @error('telepon')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                   </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="" cols="10" rows="3" class="form-control">{{$pengaturan ->alamat}}</textarea>
                        @error('alamat')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                      <label for="kodepos">Kodepos</label>
                      <input type="number" class="form-control" id="kodepos" name="kodepos" value="{{$pengaturan->kodepos}}">
                      @error('kodepos')
                      <div class="invalid-feedback">
                          {{$message}}
                      </div>
                  @enderror
                    </div>
                     

                <button type="submit" class="btn me-2 btn-primary">Submit</button>
                <a href="{{route('pengaturan.index')}}" class="btn btn-danger">Kembali</a>
            </form>
        @else
        <form action="{{route('pengaturan.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="foto_perusahaan">Foto Perusahaan</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="foto_perusahaan" name="foto_perusahaan">
                        <label class="custom-file-label" for="foto_perusahaan">Choose file</label>
                      </div>
                    </div>
                  </div>
                <div class="form-group">
                    <label for="nama_perusahaan">Nama Perusahaan</label>
                    <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan"  >
                    @error('nama_perusahaan')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
                  </div>
                  <div class="form-group">
                    <label for="nib">NIB</label>
                    <input type="number" class="form-control" id="nib" name="nib" placeholder="isi nib..."  >
                    @error('nib')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
                </div>
                <div class="form-group">
                    <label for="web">website</label>
                    <input type="url" class="form-control" id="web" name="web" placeholder="isi web..."  >
                    @error('web')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
                </div>
                <div class="form-group">
                    <label for="telepon">Telepon</label>
                    <input type="number" class="form-control" id="telepon" name="telepon" placeholder="isi telepon...">
                    @error('telepon')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
               </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="" cols="10" rows="3" class="form-control"></textarea>
                    @error('alamat')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
                </div>
                <div class="form-group">
                  <label for="kodepos">Kodepos</label>
                  <input type="number" class="form-control" id="kodepos" name="kodepos" >
                  @error('kodepos')
                  <div class="invalid-feedback">
                      {{$message}}
                  </div>
              @enderror
                </div>
            <button type="submit" class="btn me-2 btn-primary">Submit</button>
            <a href="{{route('pengaturan.index')}}" class="btn btn-danger">Kembali</a>
        </form>
        @endif
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
