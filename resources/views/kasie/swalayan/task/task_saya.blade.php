<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@extends('kasie.template')
@section('title', 'Data Task Saya')
@section('content')

  <div class="col g-ml-45 g-ml-0--lg g-pb-65--md">
          <!-- Breadcrumb-v1 -->
          <div class="g-hidden-sm-down g-bg-gray-light-v8 g-pa-20">
            <ul class="u-list-inline g-color-gray-dark-v6">

              <li class="list-inline-item g-mr-10">
                <a class="u-link-v5 g-color-gray-dark-v6 g-color-lightblue-v3--hover g-valign-middle" href="#!">Kasie</a>
                <i class="hs-admin-angle-right g-font-size-12 g-color-gray-light-v6 g-valign-middle g-ml-10"></i>
              </li>

              <li class="list-inline-item g-mr-10">
                <a class="u-link-v5 g-color-gray-dark-v6 g-color-lightblue-v3--hover g-valign-middle" href="#!">Swalayan</a>
                <i class="hs-admin-angle-right g-font-size-12 g-color-gray-light-v6 g-valign-middle g-ml-10"></i>
              </li>

              <li class="list-inline-item">
                <span class="g-valign-middle">Data Task Saya</span>
              </li>
            </ul>
          </div>
          <!-- End Breadcrumb-v1 -->
        
          <div class="g-pa-20">      

@if(session('msg'))
<div class="alert alert-success">
  <strong> {{session('msg')}}</strong>
</div>
@endif

@if(session('msg2'))
<div class="alert alert-danger">
  <strong> {{session('msg2')}}</strong>
</div>
@endif

    <div class="table-responsive g-mb-40">
      <table class="table table-bordered" id="tes">
        <thead>
          <tr>
            <th>No</th>
            <th>Pekerjaan</th>
            <th>Aktifitas</th>
            <th>Deskripsi</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          <?php $no=1; ?>
        @foreach($usulan as $du)
    <tr> 
      <td>{{$no}}</td>
      <td>{{$du->nama_pekerjaan}}</td>
      <td>{{$du->nama_aktifitas}}</td>
      <td>{{$du->deskripsi}}</td>
      <td style="text-align: center">
          @if($du->status_id == 4)
          <a href="#!" class="btn btn-md u-btn-yellow g-mr-10 g-mb-15">{{$du->nama_status}}</a>
          @elseif($du->status_id == 5)
          <a href="#!" class="btn btn-md u-btn-darkgray g-mr-10 g-mb-15">{{$du->nama_status}}</a>
          @elseif($du->status_id == 6)
          <a href="#!" class="btn btn-md u-btn-teal g-mr-10 g-mb-15">{{$du->nama_status}}</a>
          @elseif($du->status_id == 7)
          <a href="#!" class="btn btn-md u-btn-red g-mr-10 g-mb-15">{{$du->nama_status}}</a>
          @endif
      </td>     
      <td style="text-align: center">
        <a href="/kasie/tasksaya/{{$du->id}}"><button type="button" class="btn btn-success">Detail</button></a>
      </td>      
    </tr>
    <?php $no++; ?>
    @endforeach
        </tbody>
      </table>
    </div>
</div>
</div>

@endsection





  