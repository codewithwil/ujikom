@extends('back.layout.template')
@section('title', 'tambah Anggota')
@section('content')
@push('css')
      <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{asset('admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{asset('admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="{{asset('admin/plugins/bs-stepper/css/bs-stepper.min.cs')}}s">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="{{asset('admin/plugins/dropzone/min/dropzone.min.css')}}">
@endpush



    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Anggota Koperasi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tambah Anggota</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">tambah data Anggota</h3>
              </div>
              <div class="card-body p-0">
                <div class="bs-stepper">
                  <div class="bs-stepper-header" role="tablist">
                    <!-- your steps here -->
  
                    <div class="step" data-target="#pendaftaran-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="pendaftaran-part" id="pendaftaran-part-trigger">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">Pendaftaran</span>
                      </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#pendataan-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="pendataan-part" id="pendataan-part-trigger">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">Pendataan</span>
                      </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#transaksi-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="transaksi-part" id="transaksi-part-trigger">
                        <span class="bs-stepper-circle">3</span>
                        <span class="bs-stepper-label">Transaksi</span>
                      </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#keterangan-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="keterangan-part" id="keterangan-part-trigger">
                        <span class="bs-stepper-circle">4</span>
                        <span class="bs-stepper-label">Keterangan</span>
                      </button>
                    </div>
                  </div>
                  <div class="bs-stepper-content">
                    <div id="pendaftaran-part" class="content" role="tabpanel" aria-labelledby="pendaftaran-part-trigger">
                      <div class="form-group">
                        <label for="kode_anggota">Kode anggota</label>
                        <?php
                        $kodeAnggota = autonumber('anggota', 'kode_anggota', 3, 'ANG');
                    ?>
                       <input class="input @error('kode_anggota') is-invalid @enderror form-control" name="kode_anggota" readonly id="kode_anggota" type="text" value="<?= $kodeAnggota ?>">
    
                      </div>
                      <div class="form-group">
                        <label for="nik">Nik anggota</label>
                        <input type="text" name="nik" id="nik" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="nama">Nama anggota</label>
                        <input type="text" name="nama" id="nama" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="alamat">Alamat anggota</label>
                        <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="email">Email anggota</label>
                        <input type="email" name="email" id="email" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="telepon">Telepon anggota</label>
                        <input type="number" name="telepon" id="telepon" class="form-control">
                      </div>
                    <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                    </div>
                    <!-- your steps content here -->
                    <div id="pendataan-part" class="content" role="tabpanel" aria-labelledby="pendataan-part-trigger">
                      <div class="form-group">
                        <label for="kode_simpanan_kredit">Kode simpan debet</label>
                        <?php
                        $kodeSimpanDebet = autonumber('simpanan_debet', 'kode_simpanan_debet', 3, 'SPD');
                    ?>
                       <input class="input @error('kode_simpanan_debet') is-invalid @enderror form-control" name="kode_simpanan_debet" readonly id="kode_simpanan_debet" type="text" value="<?= $kodeSimpanDebet ?>">
    
                        @error('kode_simpanan_debet')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                      </div>
                  <div class="form-group">
                    <label for="tanggal">tanggal transaksi</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal">
                  </div>
                  <div class="form-group">
                    <label for="jenisPembayaran">Jenis pembayaran</label>
                    <select name="jenis_pembayaran" id="jenis_pembayaran" class="form-control">
                    @foreach($jenisBayar as $item => $jenis)
                      <option value="hidden" disabled selected hidden>Pilih jenis pembayaran</option>
                      <option value="{{ $item }}">{{$jenis}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="divisi">Divisi</label>
                    <select name="jenis_pembayaran" id="divisi" class="form-control">
                      @foreach ($divisi as $item => $getdivisi)
                      <option value="hidden" disabled selected hidden>Pilih divisi</option>
                      <option value="{{$item}}">{{$getdivisi}}</option>
                      @endforeach
                      
                    </select>
                  </div>
                      <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                    </div>
                    <div id="transaksi-part" class="content" role="tabpanel" aria-labelledby="transaksi-part-trigger">
                      <div class="form-group">
                        <label for="transaksi">Transaksi</label>
                        <select name="transaksi" id="transaksi" class="form-control">
                          <option value="debet">debet</option>
                          <option value="kredit">kredit</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="pokok">simpanan pokok</label>
                        <input type="number" name="pokok" id="pokok" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="wajib">simpanan wajib</label>
                        <input type="number" name="wajib" id="wajib" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="sukarela">simpanan sukarela</label>
                        <input type="number" name="sukarela" id="sukarela" class="form-control">
                      </div>
                    <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                    <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                    </div>
                    <div id="keterangan-part" class="content" role="tabpanel" aria-labelledby="keterangan-part-trigger">
                      <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <select name="keterangan" id="keterangan" class="form-control">
                            <option value="" disabled selected hidden>Pilih keterangan</option>
                            @foreach ($keterangan as $item => $getKeterangan)
                            <option value="{{$item}}">{{$getKeterangan}}</option>
                            @endforeach
                        </select>
                     </div>
                    <div class="form-group">
                        <label for="status_buku">Status buku</label>
                        <select name="status_buku" id="status_buku" class="form-control">
                            <option value="" disabled selected hidden>Pilih status buku</option>
                            @foreach ($statusBuku as $item => $getStatusBuku)
                            <option value="{{$item}}">{{$getStatusBuku}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                    <button type="button" id="submitForm" class="btn btn-primary">Submit</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                Visit <a href="https://github.com/Johann-S/bs-stepper/#how-to-use-it">bs-stepper documentation</a> for more examples and information about the plugin.
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
   

      </div>
      <!-- /.container-fluid -->
    </section>




@push('js')
    <!-- Select2 -->
<script src="{{asset('admin/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{asset('admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('admin/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('admin/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<!-- date-range-picker -->
<script src="{{asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{asset('admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>

<!-- Bootstrap Switch -->
<script src="{{asset('admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<!-- BS-Stepper -->
<script src="{{asset('admin/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
<!-- dropzonejs -->
<script src="{{asset('admin/plugins/dropzone/min/dropzone.min.js')}}"></script>


<!-- Page specific script -->
<script>

  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })



</script>
<script>
  document.getElementById('submitForm').addEventListener('click', function(event) {
    event.preventDefault();

    var kode_anggota     = document.getElementById('kode_anggota').value;
    var nik              = document.getElementById('nik').value;
    var nama             = document.getElementById('nama').value;
    var alamat           = document.getElementById('alamat').value;
    var email            = document.getElementById('email').value;
    var telepon          = document.getElementById('telepon').value;
    var tanggal          = document.getElementById('tanggal').value;
    var jenis_pembayaran = document.getElementById('jenis_pembayaran').value;
    var divisi           = document.getElementById('divisi').value;
    var transaksi        = document.getElementById('transaksi').options[document.getElementById('transaksi').selectedIndex].value;
    var pokok            = document.getElementById('pokok').value;
    var wajib            = document.getElementById('wajib').value;
    var sukarela         = document.getElementById('sukarela').value;
    var keterangan       = document.getElementById('keterangan').value;
    var status_buku      = document.getElementById('status_buku').value;

    var data = {
      kode_anggota: kode_anggota,
      nik: nik,
      nama: nama,
      alamat: alamat,
      email: email,
      telepon: telepon,
      tanggal: tanggal,
      jenis_pembayaran: jenis_pembayaran,
      divisi: divisi,
      pokok: pokok,
      transaksi: transaksi,
      wajib: wajib,
      sukarela: sukarela,
      keterangan: keterangan,
      status_buku: status_buku,
      _token: '{{ csrf_token() }}' 
    };

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '{{ route('anggota.store') }}');
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          console.log('Data berhasil dikirim ke database.');
          window.location.href = '{{ route('anggota.index') }}';
        } else {
          console.error('Gagal mengirim data ke database.');
        }
      }
    };
    xhr.send(JSON.stringify(data));
  });
</script>

@endpush

@endsection