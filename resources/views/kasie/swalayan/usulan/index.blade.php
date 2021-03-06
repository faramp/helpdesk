@extends('kasie.template')
@section('title', 'Data Usulan')
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
        <span class="g-valign-middle">Data Usulan</span>
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
    <table class="table table-bordered" id="dataUsulan">
      <thead>
      <tr>
        <th> No</th>
        <th> Ativitas</th>
        <th> Staf</th>
        <th> Deskripsi</th>
        <th> Status</th>
        <th> Action</th>
      </tr>
      </thead>
      <tbody>
        <?php $no=1; ?>
        @foreach($data_usulan as $du)
        <tr>
          <td>{{$no}}</td>
          <td>{{$du->nama_aktifitas}}</td>
          <td>{{$du->nama_user}}</td>
          <td>{{$du->deskripsi}}</td>
          <td style="text-align: center">
            @if($du->status_id == 3)
            <a href="#!" class="btn btn-md u-btn-red g-mr-10 g-mb-15">{{$du->nama_status}}</a>
            @else
            <a href="#!" class="btn btn-md u-btn-blue g-mr-10 g-mb-15">{{$du->nama_status}}</a>
            @endif
          </td>
          <td style="text-align: center">
            @if($du->status_id == 1)
            <a href="/kasie/usulanstaf/{{$du->id}}"><button type="button" class="btn btn-success" title="detail">Detail</button></a>
            @else
            <a href="/kasie/usulanstaf/{{$du->id}}"><button type="button" class="btn btn-success" title="detail" disabled="">Detail</button></a>
            @endif
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