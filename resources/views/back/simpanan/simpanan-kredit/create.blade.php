@extends('back.layout.template')
@section('title', 'tambah simpanan kredit')
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
            <h1>Tambah simpan kredit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tambah simpan kredit</li>
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
                <h3 class="card-title">Simpan kredit</h3>
              </div>
              <div class="card-body p-0">
                <div class="bs-stepper">
                  <div class="bs-stepper-header" role="tablist">
                    <!-- your steps here -->
                    <div class="step" data-target="#divisi-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="divisi-part" id="divisi-part-trigger">
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
                    <div id="divisi-part" class="content" role="tabpanel" aria-labelledby="divisi-part-trigger">
                      <div class="form-group">
                        <label for="tanggal">tanggal transaksi</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                      </div>
                      <div class="form-group">
                        <label for="jenisPembayaran">Jenis pembayaran</label>
                        <select name="jenis_pembayaran" id="" class="form-control">
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
                        <select name="anggota_kode" id="anggota" class="form-control">
                          @foreach ($anggota as $item)
                          <option value="hidden" disabled selected hidden>Pilih Anggota</option>
                          <option value="{{$item->kode_anggota}}">{{$item->nama}}</option>
                      @endforeach
                        </select>
                      </div>
                      <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                    </div>
                    <div id="transaksi-part" class="content" role="tabpanel" aria-labelledby="transaksi-part-trigger">
                      <div id="payment-form" style="display: none;">
                        <div class="form-group">
                          <label for="nominal">Nominal</label>
                          <input type="number" name="nominal" id="nominal" class="form-control">
                        </div>
                      </div>
                      <div id="midtrans-form" style="display: none;">
                        <h1>sip</h1>
                      </div>
                      <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                      <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                    </div>
                    <div id="keterangan-part" class="content" role="tabpanel" aria-labelledby="keterangan-part-trigger">
                      <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <select name="keterangan" id="keterangan" class="form-control">
                          @foreach ($keterangan as $item => $getKeterangan)
                          <option value="hidden" disabled selected hidden>Pilih keterangan</option>
                          <option value="{{$item}}">{{$getKeterangan}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="status_buku">Status buku</label>
                        <select name="status_buku" id="status_buku" class="form-control">
                          @foreach ($statusBuku as $item => $getStatusBuku)
                          <option value="hidden" disabled selected hidden>Pilih status buku</option>
                          <option value="{{$item}}">{{$getStatusBuku}}</option>
                          @endforeach
                        </select>
                      </div>
                      <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
               Develop by codewithwil
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

  document.addEventListener("DOMContentLoaded", function() {
    const jenisPembayaranSelect = document.querySelector('select[name="jenis_pembayaran"]');
    const paymentForm = document.querySelector('#payment-form');
    const midtransForm = document.querySelector('#midtrans-form');

    jenisPembayaranSelect.addEventListener('change', function() {
      if (jenisPembayaranSelect.value === 'tunai') {
        paymentForm.style.display = 'block';
        midtransForm.style.display = 'none';
      } else if (jenisPembayaranSelect.value === 'nontunai') {
        paymentForm.style.display = 'none';
        midtransForm.style.display = 'block';
      } else {
        paymentForm.style.display = 'none';
        midtransForm.style.display = 'none';
      }
    });
  });



</script>
@endpush

@endsection