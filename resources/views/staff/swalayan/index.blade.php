
@extends('kasie.template')
@section('title', 'Data Usulan')
@section('content')

  <div class="col g-ml-45 g-ml-0--lg g-pb-65--md">
          <!-- Breadcrumb-v1 -->
          <div class="g-hidden-sm-down g-bg-gray-light-v8 g-pa-20">
            <ul class="u-list-inline g-color-gray-dark-v6">

              <li class="list-inline-item g-mr-10">
                <a class="u-link-v5 g-color-gray-dark-v6 g-color-lightblue-v3--hover g-valign-middle" href="#!">Staff</a>
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
            <header class="g-mb-20">            
               <a href="/staff/datausulan/create"><button type="button" class="btn btn-primary">Tambah Usulan</button></a>
            </header>

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
            <th>Aktifitas</th>
            <th>Deskripsi</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          <?php $no=1; ?>
        @foreach($data_usulan as $du)
    <tr> 
      <td>{{$no}}</td>
      <td>{{$du->nama_aktifitas}}</td>
      <td>{{$du->deskripsi}}</td>
      <td style="text-align: center">
              <span class="u-tags-v1 text-center g-width-110 g-brd-around g-brd-teal-v2 g-bg-teal-v2 g-font-weight-400 g-color-white g-rounded-50 g-py-4 g-px-15">{{$du->nama_status}}</span>
      </td>     
      <td style="text-align: center">
        @if(($du->status_id == 2)||($du->status_id == 5))
        <form action="{{action('Staff\SwalayanController@update', ['id' => $du->id])}}" method="post">
          {{csrf_field()}} 
          <button type="submit" name="submit" class="btn btn-success">Kumpulkan</button>
          <input type="hidden" name="_method" value="put" />
        </form>
        @else
        <a href="/staff/datausulan/{{$du->id}}"><button type="button" class="btn btn-success" disabled="">Kumpulkan</button></a>
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





