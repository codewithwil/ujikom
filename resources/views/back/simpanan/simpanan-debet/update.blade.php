@extends('back.layout.template')
@section('title', 'edit simpanan debet')
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
            <h1>Edit simpan debet</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit simpan debet</li>
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
                <h3 class="card-title">Edit Data Simpanan Debet</h3>
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
                      <div class="form-group">
                        <label for="kode_simpanan_kredit">Kode simpan edit</label>
                       <input class="input form-control" name="kode_simpanan_kredit" readonly id="kode_simpanan_kredit" type="text" value="{{$simpanD->kode_simpanan_debet}}">
                        @error('kode_simpanan_kredit')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                      </div>
                  <div class="form-group">
                    <label for="tanggal">tanggal transaksi</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{$simpanD->tanggal}}">
                  </div>
                  <div class="form-group">
                    <label for="jenisPembayaran">Jenis pembayaran</label>
                    <select name="jenis_pembayaran" id="jenis_pembayaran" class="form-control">
                    @foreach($jenisBayar as $item => $jenis)
                      <option value="{{ $item }}" {{ ($simpanD->jenis_pembayaran == $item) ? 'selected' : '' }}>{{$jenis}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="anggota">Anggota</label>
                        <select name="anggota_kode" id="anggota_kode" class="form-control" onchange="showAnggotaInfo()">
                            @foreach ($anggota as $item)
                            <option value="{{$item->kode_anggota}}" @if($simpanD->anggota_kode == $item->kode_anggota) selected @endif>{{$item->nama}}</option>
                        @endforeach
                        </select>
                    </div>
                    <hr>
                    <p>Nama anggota: <span id="namaAnggota">{{$simpanD->Anggota->nama}}</span></p>
                    <hr>
                    <p>Alamat: <span id="alamatAnggota">{{$simpanD->Anggota->alamat}}</span></p>
                    <hr>
                    <p>Email: <span id="emailAnggota">{{$simpanD->Anggota->email}}</span></p>
                    <hr>
                    <p>Telepon: <span id="teleponAnggota">{{$simpanD->Anggota->telepon}}</span></p>
                    <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                </div>
                    <div id="transaksi-part" class="content" role="tabpanel" aria-labelledby="transaksi-part-trigger">
                      @foreach ($propsArray as $key => $item)
                      <div class="form-group">
                          <label for="props_{{ $key }}">Nominal {{ $item->nama }}</label>
                          <input type="hidden" name="props[{{ $key }}][nama]" value="{{ $item->nama }}">
                          <input type="number" name="props[{{ $key }}][nominal]" id="props_{{ $key }}" class="form-control" value="{{ $item->nominal }}">
                      </div>
                      @endforeach
                    <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                    <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                    </div>
                    <div id="keterangan-part" class="content" role="tabpanel" aria-labelledby="keterangan-part-trigger">
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control">{{$simpanD->keterangan}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="status_buku">Status buku</label>
                        <select name="status_buku" id="status_buku" class="form-control">
                            @foreach ($statusBuku as $item => $getStatusBuku)
                            <option value="{{$item}}" {{ ($simpanD->status_buku == $item) ? 'selected' : '' }}>{{$getStatusBuku}}</option>
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

    var tanggal          = document.getElementById('tanggal').value;
    var jenis_pembayaran = document.getElementById('jenis_pembayaran').value;
    var anggota_kode     = document.getElementById('anggota_kode').value;
    var keterangan       = document.getElementById('keterangan').value;
    var status_buku      = document.getElementById('status_buku').value;
    var props = [];
  document.querySelectorAll('input[name^="props"]').forEach(function(input) {
    var name = input.name.match(/\[([0-9]+)\]\[([a-z]+)\]/);
    var index = name[1];
    var key = name[2];

    if (!props[index]) {
      props[index] = {};  
    }

    props[index][key] = input.value;
  });
    var data = {
      tanggal: tanggal,
      jenis_pembayaran: jenis_pembayaran,
      anggota_kode: anggota_kode,
      props: props,
      keterangan: keterangan,
      status_buku: status_buku,
      _token: '{{ csrf_token() }}' 
    };

    // Kirim data menggunakan AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '{{ route('simpananDebet.update', $simpanD->kode_simpanan_debet) }}');
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // Berhasil, lakukan sesuatu jika diperlukan
          console.log('Data berhasil dikirim ke database.');
          // Redirect atau tindakan lain setelah berhasil
          window.location.href = '{{ route('simpananDebet.index') }}';
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