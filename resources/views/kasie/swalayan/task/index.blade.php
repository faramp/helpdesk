
@extends('kasie.template')
@section('title', 'Task')
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
                <span class="g-valign-middle">Task</span>
              </li>
            </ul>
          </div>
          <!-- End Breadcrumb-v1 -->
        
          <div class="g-pa-20">      
<!--             <header class="g-mb-20">            
               <a href="/staff/datausulan/create"><button type="button" class="btn btn-primary">Tambah Usulan</button></a>
            </header> -->

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
            <th> No</th>
            <th> Ativitas</th>
            <th> User</th>
            <th> Deskripsi</th>
            <th> Status</th>
            <th> Nilai</th>
            <th> Action</th>
          </tr>
        </thead>

        <tbody>
          <?php $no=1; ?>
        @foreach($task as $t)
        <tr> 
          <td>{{$no}}</td>
          <td>{{$t->nama_aktifitas}}</td>
          <td>{{$t->nama_user}}</td>
          <td>{{$t->deskripsi}}</td>
          <td style="text-align: center">
                  <span class="u-tags-v1 text-center g-width-110 g-brd-around g-brd-teal-v2 g-bg-teal-v2 g-font-weight-400 g-color-white g-rounded-50 g-py-4 g-px-15">{{$t->nama_status}}</span>
          </td>   
           <td>
           @if(!empty($t->status_id))
           {{$t->nilai}} 
           @else
           -
           @endif
           </td>  
           <td style="text-align: center">
            @if($t->status_id == 4)
            <a href="/kasie/task/{{$t->id}}"><button type="button" class="btn btn-success">Nilai</button></a>
            @else
            <a href="/kasie/task/{{$t->id}}"><button type="button" class="btn btn-success" disabled="">Nilai</button></a>
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