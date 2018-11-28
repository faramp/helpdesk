@extends('kasie.template')
@section('title', 'Tambah Data Usulan')
@section('content')

 <div class="col g-ml-45 g-ml-0--lg g-pb-65--md">
          <!-- Breadcrumb-v1 -->
          <div class="g-hidden-sm-down g-bg-gray-light-v8 g-pa-20">
            <ul class="u-list-inline g-color-gray-dark-v6">

              <li class="list-inline-item g-mr-10">
                <a class="u-link-v5 g-color-gray-dark-v6 g-color-lightblue-v3--hover g-valign-middle"href="#!">Staf</a>
                <i class="hs-admin-angle-right g-font-size-12 g-color-gray-light-v6 g-valign-middle g-ml-10"></i>
              </li>

              <li class="list-inline-item g-mr-10">
                <a class="u-link-v5 g-color-gray-dark-v6 g-color-lightblue-v3--hover g-valign-middle" href="#!">Swalayan</a>
                <i class="hs-admin-angle-right g-font-size-12 g-color-gray-light-v6 g-valign-middle g-ml-10"></i>
              </li>

              <li class="list-inline-item">
                <span class="g-valign-middle">Data Usulan</span>
              </li>
            </ul>
          </div>

<form action="/kasie/usulkan" method="post">
          <div class="g-pa-20">
            <h1 class="g-font-weight-300 g-font-size-28 g-color-black g-mb-28">Tambah Data Usulan</h1>

            <div class="row">
              <!-- 1-st column -->
              <div class="col-md-6">
                <!-- Basic Text Inputs -->
                <div class="g-brd-around g-brd-gray-light-v7 g-rounded-4 g-pa-15 g-pa-20--md g-mb-30">
                

                  <!-- Default Input -->
                  <div class="form-group g-mb-30">
                    <label class="g-mb-10" for="inputGroup-1_1">Nama Pekerjaan</label>

                    <div class="form-group u-select--v3 g-pos-rel g-brd-gray-light-v7 g-rounded-4 mb-0">
                      <input type="text" name="pekerjaan" value="{{$detail->id_pekerjaan}}" hidden="">
                      {{$detail->nama_pekerjaan}}
                    </div>
                  </div>

                   <div class="g-mb-30">
                    <label class="g-mb-10">Nama Aktifitas</label>

                    <div class="form-group u-select--v3 g-pos-rel g-brd-gray-light-v7 g-rounded-4 mb-0">
                      <input type="text" name="aktifitas" value="{{$detail->id_aktifitas}}" hidden="">
                      {{$detail->nama_aktifitas}}
                    </div>
                  </div>

                  <div class="g-mb-30">
                    <label class="g-mb-10">Bobot</label>

                    <div class="form-group u-select--v3 g-pos-rel g-brd-gray-light-v7 g-rounded-4 mb-0">
                      {{$detail->nilai}}
                    </div>
                  </div>

                  <div class="form-group g-mb-30">
                    <label class="g-mb-10" for="inputGroup-1_1">Deskripsi</label>

                    <div class="g-pos-rel">
                      <span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
                      <i class="hs-admin-check g-absolute-centered g-font-size-default g-color-lightblue-v3"></i>
                    </span>
                       <textarea id="inputGroup-1_3" class="form-control form-control-md u-textarea-expandable g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-resize-none g-overflow-hidden" rows="3" name="deskripsi" placeholder="Deskripsi Usulan"></textarea>
                    </div>
                  </div>

                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                     {{csrf_field()}}
               
                </div>
                <!-- End Basic Text Inputs -->
</form>
@endsection