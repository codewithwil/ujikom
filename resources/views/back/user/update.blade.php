@extends('back.layout.template')
@section('title', 'edit user')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit User</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit User </li>
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
              <h3 class="card-title">User</h3>
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
          
            <form action="{{route('users.update', $users->id)}}" method="post" enctype="multipart/form-data">
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
                    <input type="text" class="form-control" id="nama" name="name" value="{{$users->name}}" >
                    @error('nama')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
                  </div>
                <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="number" class="form-control" id="nik" name="nik" placeholder="isi nik..." value="{{$users->nik}}">
                    @error('nik')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
               </div>
                <div class="form-group">
                    <label for="telepon">Telepon</label>
                    <input type="number" class="form-control" id="telepon" name="telepon" placeholder="isi telepon..." value="{{$users->telepon}}" >
                    @error('telepon')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="" cols="10" rows="3" class="form-control">{{$users->alamat}}</textarea>
                    @error('alamat')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control br-style" id="role" name="role"  @if(Auth::user()->hasRole(['supervisor', 'petugas'])) disabled @endif>
                        <option value="">Pilih Peran</option>
                        @foreach($roles as $role)
                        <option value="{{ $role->name }}" @if($role->name == old('role', $users->roles->pluck('name')->first())) selected @endif>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @if(Auth::user()->hasRole(['supervisor', 'petugas']))
                    <input type="hidden" name="role" value="{{ Auth::user()->roles->pluck('name')->first() }}">
                    <div class="alert alert-info mt-2" role="alert">
                        Anda adalah {{ Auth::user()->roles->pluck('name')->first() }}
                    </div>
                @endif
                    @error('role')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" value="{{$users->email}}">
                  @error('email')
                  <div class="invalid-feedback">
                      {{$message}}
                  </div>
              @enderror
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                  @error('password')
                      <div class="invalid-feedback">
                          {{$message}}
                      </div>
                  @enderror
              </div>
              <div class="form-group">
                  <label for="password_confirmation">Masukkan Ulang Password</label>
                  <input type="password" class="form-control" id="password_confirmation" placeholder="Masukkan Ulang Password" name="password_confirmation">
                  @error('password_confirmation')
                      <div class="invalid-feedback">
                          {{$message}}
                      </div>
                  @enderror
              </div>
                  </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-warning">Submit</button>
                <a href="{{route('users.index')}}" class="btn btn-primary">Kembali</a>
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
