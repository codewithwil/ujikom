@extends('back.layout.template')
@section('title', 'edit pinjaman kredit')
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
            <h1>Edit pinjaman kredit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit pinjaman kredit</li>
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
                <h3 class="card-title">Edit Data Pinjaman debet</h3>
              </div>
              <div class="card-body p-0">
                <div class="bs-stepper">
                    <div class="bs-stepper-header" role="tablist">
                      <!-- your steps here -->
                      <div class="step" data-target="#pendataan-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="pendataan-part" id="pendataan-part-trigger">
                          <span class="bs-stepper-circle">1</span>
                          <span class="bs-stepper-label">Pendataan</span>
                        </button>
                      </div>
                      <div class="line"></div>
                      <div class="step" data-target="#transaksi-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="transaksi-part" id="transaksi-part-trigger">
                          <span class="bs-stepper-circle">2</span>
                          <span class="bs-stepper-label">Transaksi</span>
                        </button>
                      </div>
                      <div class="line"></div>
                      <div class="step" data-target="#keterangan-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="keterangan-part" id="keterangan-part-trigger">
                          <span class="bs-stepper-circle">3</span>
                          <span class="bs-stepper-label">Keterangan</span>
                        </button>
                      </div>
                    </div>
                    <div class="bs-stepper-content">
                      <!-- your steps content here -->
                      <div id="pendataan-part" class="content" role="tabpanel" aria-labelledby="pendataan-part-trigger">
                        <div class="card-body">
                        <div class="form-group">
                          <label for="kode_pinjaman_debet">Kode pinjaman debet</label>
                         <input class="input form-control" name="kode_pinjaman_debet" readonly id="kode_pinjaman_debet" type="text" value="{{$pinjamD->kode_pinjaman_debet}}">
      
                          @error('kode_pinjaman_debet')
                              <div class="invalid-feedback">
                                  {{$message}}
                              </div>
                          @enderror
                        </div>
                    <div class="form-group">
                      <label for="tanggal">tanggal transaksi</label>
                      <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{$pinjamD->tanggal}}">
                    </div>
                    <div class="form-group">
                        <label for="jenisPembayaran">Jenis pembayaran</label>
                        <select name="jenis_pembayaran" id="jenis_pembayaran" class="form-control">
                        @foreach($jenisBayar as $item => $jenis)
                          <option value="{{ $item }}" {{ ($pinjamD->jenis_pembayaran == $item) ? 'selected' : '' }}>{{$jenis}}</option>
                          @endforeach
                        </select>
                      </div>    
                      <div class="form-group">
                        <label for="divisi">Divisi</label>
                        <select name="jenis_pembayaran" id="divisi" class="form-control">
                          @foreach ($divisi as $item => $getdivisi)
                          <option value="{{$item}}" {{ ($pinjamD->divisi == $item) ? 'selected' : '' }}>{{$getdivisi}}</option>
                          @endforeach
                          
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="anggota">Anggota</label>
                            <select name="anggota_kode" id="anggota_kode" class="form-control" onchange="showAnggotaInfo()">
                                @foreach ($anggota as $item)
                                <option value="{{$item->kode_anggota}}" @if($pinjamD->anggota_kode == $item->kode_anggota) selected @endif>{{$item->nama}}</option>
                            @endforeach
                            </select>
                        </div>
                        <hr>
                        <p>Nama anggota: <span id="namaAnggota">{{$pinjamD->Anggota->nama}}</span></p>
                        <hr>
                        <p>Alamat: <span id="alamatAnggota">{{$pinjamD->Anggota->alamat}}</span></p>
                        <hr>
                        <p>Email: <span id="emailAnggota">{{$pinjamD->Anggota->email}}</span></p>
                        <hr>
                        <p>Telepon: <span id="teleponAnggota">{{$pinjamD->Anggota->telepon}}</span></p>
                        <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                      </div>
                    </div>
                      <div id="transaksi-part" class="content" role="tabpanel" aria-labelledby="transaksi-part-trigger">
                        <div class="card-body">
                        <div class="form-group">
                          <label for="transaksi">Transaksi</label>
                          <select name="transaksi" id="transaksi" class="form-control">
                            @foreach ($transaksi as $item => $get_transaksi)
                            <option value="{{$item}}" {{ ($pinjamD->transaksi == $item) ? 'selected' : '' }}>{{$get_transaksi}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="periode">Periode</label>
                          <select name="periode" id="periode" class="form-control" value="{{$pinjamD->nominal}}">
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="nominal">Nominal</label>
                          <input type="number" name="nominal" id="nominal" class="form-control" value="{{$pinjamD->nominal}}">
                        </div>
                      <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                      <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                      </div>
                    </div>
                      <div id="keterangan-part" class="content" role="tabpanel" aria-labelledby="keterangan-part-trigger">
                       <div class="card-body">
                        <div class="form-group">
                          <label for="keterangan">Keterangan</label>
                          <select name="keterangan" id="keterangan" class="form-control">
                              <option value="" disabled selected hidden>Pilih keterangan</option>
                              @foreach ($keterangan as $item => $getKeterangan)
                              <option value="{{$item}}" {{ ($pinjamD->keterangan == $item) ? 'selected' : '' }}>{{$getKeterangan}}</option>
                              @endforeach
                          </select>
                       </div>
                      <div class="form-group">
                          <label for="status_buku">Status buku</label>
                          <select name="status_buku" id="status_buku" class="form-control">
                              <option value="" disabled selected hidden>Pilih status buku</option>
                              @foreach ($statusBuku as $item => $getStatusBuku)
                              <option value="{{$item}}" {{ ($pinjamD->status_buku == $item) ? 'selected' : '' }}>{{$getStatusBuku}}</option>
                              @endforeach
                          </select>
                      </div>
                      <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                      <button type="button" id="submitForm" class="btn btn-primary">Submit</button>
                      </div>
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
    var periodes = [6, 12, 24, 36, 48, 60];

    var selectPeriode = document.getElementById('periode');

    var selectedValue = {!! json_encode($pinjamD->periode) !!};

    periodes.forEach(function (periode) {
        var option = document.createElement('option');
        option.value = periode;
        option.textContent = periode + ' bulan';

        if (periode == selectedValue) { // Menggunakan operator ==
            option.selected = true;
        }

        selectPeriode.appendChild(option);
    });
</script>



<script>
  document.getElementById('submitForm').addEventListener('click', function(event) {
    event.preventDefault();

    var tanggal          = document.getElementById('tanggal').value;
    var jenis_pembayaran = document.getElementById('jenis_pembayaran').value;
    var divisi           = document.getElementById('divisi').value;
    var anggota_kode     = document.getElementById('anggota_kode').value;
    var transaksi        = document.getElementById('transaksi').value;
    var periode          = document.getElementById('periode').value;
    var nominal          = document.getElementById('nominal').value;
    var keterangan       = document.getElementById('keterangan').value;
    var status_buku      = document.getElementById('status_buku').value;

    var data = {
      tanggal: tanggal,
      jenis_pembayaran: jenis_pembayaran,
      divisi: divisi,
      anggota_kode: anggota_kode,
      periode: periode,
      nominal: nominal,
      keterangan: keterangan,
      status_buku: status_buku,
      _token: '{{ csrf_token() }}' 
    };

    // Kirim data menggunakan AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '{{ route('pinjamanDebet.update', $pinjamD->kode_pinjaman_debet) }}');
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // Berhasil, lakukan sesuatu jika diperlukan
          console.log('Data berhasil dikirim ke database.');
          // Redirect atau tindakan lain setelah berhasil
          window.location.href = '{{ route('pinjamanDebet.index') }}';
        } else {
          // Gagal, lakukan sesuatu jika diperlukan
          console.error('Gagal mengirim data ke database.');
        }
      }
    };
    xhr.send(JSON.stringify(data));
  });
</script>
<script>
  function showAnggotaInfo() {
      var anggotaSelect = document.getElementById('anggota_kode');
      var selectedAnggota = anggotaSelect.options[anggotaSelect.selectedIndex];
      var namaAnggota = selectedAnggota.text; // Mendapatkan teks opsi yang dipilih
      var kode_anggota = selectedAnggota.value; // Mendapatkan nilai opsi yang dipilih

      // Mengatur nilai nama anggota di dalam span dengan id "namaAnggota"
      document.getElementById('namaAnggota').textContent = namaAnggota;

      // Lakukan permintaan AJAX untuk mendapatkan informasi anggota lainnya
      var xhr = new XMLHttpRequest();
      xhr.open('GET', '/anggota/' + kode_anggota); // Ganti URL sesuai dengan endpoint yang sesuai di server Anda
      xhr.setRequestHeader('Content-Type', 'application/json');
      xhr.onreadystatechange = function() {
          if (xhr.readyState === XMLHttpRequest.DONE) {
              if (xhr.status === 200) {
                  var response = JSON.parse(xhr.responseText);
                  // Atur nilai alamat, email, dan telepon berdasarkan respons dari server
                  document.getElementById('alamatAnggota').textContent = response.alamat;
                  document.getElementById('emailAnggota').textContent = response.email;
                  document.getElementById('teleponAnggota').textContent = response.telepon;
              } else {
                  console.error('Gagal mengambil informasi anggota.');
              }
          }
      };
      xhr.send();
      axios.get('anggota' + kode_anggota)
            .then(function(response) {
                var data = response.data;

                // Perbarui tampilan dengan data anggota yang diterima
                document.getElementById('namaAnggota').innerText = data.nama;
                document.getElementById('alamatAnggota').innerText = data.alamat;
                document.getElementById('emailAnggota').innerText = data.email;
                document.getElementById('teleponAnggota').innerText = data.telepon;
            })
            .catch(function(error) {
                console.error('Error fetching anggota info:', error);
            });
  }
</script>
@endpush

@endsection