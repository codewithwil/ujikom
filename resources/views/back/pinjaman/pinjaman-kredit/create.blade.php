@extends('back.layout.template')
@section('title', 'tambah pinjaman kredit')
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
            <h1>Tambah pinjaman kredit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tambah pinjaman kredit</li>
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
                <h3 class="card-title">tambah data pinjaman kredit</h3>
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
                        <label for="kode_simpanan_kredit">Kode pinjaman kredit</label>
                        <?php
                        $kodePinjamanKredit = autonumber('pinjaman_kredit', 'kode_pinjaman_kredit', 'PJK', 3);
                    ?>
                    
                       <input class="input @error('kode_pinjaman_kredit') is-invalid @enderror form-control" name="kode_pinjaman_kredit" readonly id="kode_pinjaman_kredit" type="text" value="<?= $kodePinjamanKredit ?>">

                        @error('kode_pinjaman_kredit')
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
                  <div class="form-group">
                    <label for="anggota">Anggota</label>
                    <select name="anggota_kode" id="anggota_kode" class="form-control" onchange="showAnggotaInfo()">
                      <option value="" disabled selected hidden>Pilih Anggota</option>
                      @foreach ($anggota as $item)
                          <option value="{{$item->kode_anggota}}">{{$item->nama}}</option>
                      @endforeach
                    </select>
                    </div>
                    <hr>
                    <p>Nama anggota: <span id="namaAnggota"></span></p>
                    <hr>
                    <p>Alamat: <span id="alamatAnggota"></span></p>
                    <hr>
                    <p>Email: <span id="emailAnggota"></span></p>
                    <hr>
                    <p>Telepon: <span id="teleponAnggota"></span></p>
                      <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                    </div>
                  </div>
                    <div id="transaksi-part" class="content" role="tabpanel" aria-labelledby="transaksi-part-trigger">
                      <div class="card-body">
                      <div class="form-group">
                        <label for="transaksi">Transaksi</label>
                        <select name="transaksi" id="transaksi" class="form-control">
                          @foreach ($transaksi as $item => $get_transaksi)
                          <option value="hidden" disabled selected hidden>Pilih Transaksi</option>
                          <option value="{{$item}}">{{$get_transaksi}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="periode">Periode</label>
                        <select name="periode" id="periode" class="form-control">
                          <option value="hidden" disabled selected hidden>Pilih Periode</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="nominal">Nominal</label>
                        <input type="number" name="nominal" id="nominal" class="form-control" >
                        <div id="max-saldo" data-saldo="{{ $saldoKoperasi->value }}"></div>
                        <div id="batas-pinjam" data-batas-pinjam="{{ $batasPinjamAbsolut }}"></div>

                      </div>
                      <div class="form-group">
                        <label for="bunga">bunga Pinjaman</label>
                        <input type="number" name="bunga" id="bunga" class="form-control" min="0" max="50">
                      </div>
                    <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                    <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                    </div>
                  </div>
                    <div id="keterangan-part" class="content" role="tabpanel" aria-labelledby="keterangan-part-trigger">
                     <div class="card-body">
                      <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control"></textarea>
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

// Mengambil elemen select
var selectPeriode = document.getElementById('periode');

// Menambahkan opsi periode ke dalam elemen select
periodes.forEach(function(periode) {
    var option = document.createElement('option');
    option.value = periode;
    option.textContent = periode + ' bulan';
    selectPeriode.appendChild(option);
});

</script>
<script>
  document.getElementById('submitForm').addEventListener('click', function(event) {

    var kode_pinjaman_kredit  = document.getElementById('kode_pinjaman_kredit').value;
    var tanggal               = document.getElementById('tanggal').value;
    var jenis_pembayaran      = document.getElementById('jenis_pembayaran').value;
    var divisi                = document.getElementById('divisi').value;
    var anggota_kode          = document.getElementById('anggota_kode').value;
    var transaksi             = document.getElementById('transaksi').value;
    var periode               = document.getElementById('periode').value;
    var nominal               = document.getElementById('nominal').value;
    var bunga                 = document.getElementById('bunga').value;
    var keterangan            = document.getElementById('keterangan').value;
    var status_buku           = document.getElementById('status_buku').value;

    var data = {
      kode_pinjaman_kredit: kode_pinjaman_kredit,
      tanggal: tanggal,
      jenis_pembayaran: jenis_pembayaran,
      divisi: divisi,
      anggota_kode: anggota_kode,
      transaksi: transaksi,
      periode: periode,
      nominal: nominal,
      bunga: bunga,
      keterangan: keterangan,
      status_buku: status_buku,
      _token: '{{ csrf_token() }}'
    };

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '{{ route('pinjamanKredit.store') }}');
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          console.log('Data berhasil dikirim ke database.');
          window.location.href = '{{ route('pinjamanKredit.index') }}';
        } else {
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
    var kodeAnggota = selectedAnggota.value;

    // Request untuk mengambil informasi anggota
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/anggota/' + kodeAnggota); 
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                document.getElementById('namaAnggota').textContent = response.data.nama;
                document.getElementById('alamatAnggota').textContent = response.data.alamat;
                document.getElementById('emailAnggota').textContent = response.data.email;
                document.getElementById('teleponAnggota').textContent = response.data.telepon;
            } else {
                console.error('Gagal mengambil informasi anggota.');
            }
        }
    };
    xhr.send();
}
</script>
<script>
$(document).ready(function () {
    var batasPinjamAbsolut = parseFloat($('#batas-pinjam').data('batas-pinjam'));

    $('#nominal').on('input', function () {
        var nominal = parseFloat($(this).val());

        if (nominal > batasPinjamAbsolut) {
            $('#max-saldo').addClass('text-danger').text('Nominal tidak boleh melebihi batas pinjam.');
            $(this).val(batasPinjamAbsolut); // Set nilai input menjadi batas pinjam
        } else {
            $('#batas-pinjam').removeClass('text-danger').text('Saldo koperasi yang boleh dipinjam sebesar ' + batasPinjamAbsolut);
        }
    });
});

</script>



@endpush

@endsection
