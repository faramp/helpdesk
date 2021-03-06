
@extends('kasubdit.template')
@section('title', 'Data Intruksi')
@section('content')

  <div class="col g-ml-45 g-ml-0--lg g-pb-65--md">
          <!-- Breadcrumb-v1 -->
          <div class="g-hidden-sm-down g-bg-gray-light-v8 g-pa-20">
            <ul class="u-list-inline g-color-gray-dark-v6">

              <li class="list-inline-item g-mr-10">
                <a class="u-link-v5 g-color-gray-dark-v6 g-color-lightblue-v3--hover g-valign-middle" href="#!">Kasubdit</a>
                <i class="hs-admin-angle-right g-font-size-12 g-color-gray-light-v6 g-valign-middle g-ml-10"></i>
              </li>

              <li class="list-inline-item g-mr-10">
                <a class="u-link-v5 g-color-gray-dark-v6 g-color-lightblue-v3--hover g-valign-middle" href="#!">Intruksi</a>
                <i class="hs-admin-angle-right g-font-size-12 g-color-gray-light-v6 g-valign-middle g-ml-10"></i>
              </li>

              <li class="list-inline-item">
                <span class="g-valign-middle">Izin Bantuan</span>
              </li>
            </ul>
          </div>
          
            <div class="g-pa-20">
          


      
            <div class="table-responsive g-mb-40">
              
              <table class="table table-bordered" id="tes">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Aktifitas</th>
                     <th>Staf</th>
                     <th>Permintaan Dari</th>
                     <th>Status</th>
                     
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                     <?php $no=1; ?>
                @foreach($intruksi as $r)
            <tr>
         
              <td style="text-align: center">{{$no}}</td>
              <td style="text-align: center">{{$r->task_id}}</td>
               <td style="text-align: center">{{$r->username}}</td>
                <td style="text-align: center">{{$r->assign_to}}</td>
               
                  <td style="text-align: center"> @if ($r->status_approval_id === 1)
                        <span class="u-tags-v1 text-center g-width-180 g-brd-around g-brd-primary g-bg-primary g-font-weight-400 g-color-white g-rounded-50 g-py-4 g-px-15">{{$r->nama_status}}</span>
                @elseif ($r->status_approval_id === 2)
<span class="u-tags-v1 text-center g-width-180 g-brd-around g-brd-lightblue-v3 g-bg-lightblue-v3 g-font-size-default g-color-white g-rounded-50 g-py-4 g-px-15">{{$r->nama_status}}</span>
                  @elseif ($r->status_approval_id === 3)
                 <span class="u-tags-v1 text-center g-width-180 g-brd-around g-brd-teal-v2 g-bg-teal-v2 g-font-weight-400 g-color-white g-rounded-50 g-py-4 g-px-15">{{$r->nama_status}}</span>
               

                 @endif</td>
             
              <td style="text-align: center">
               
               
                 <a href="/kasubdit/intruksi/detail_izin/{{$r->id}}"><button type="button" class="btn btn-success" title="edit">Detail</button></a>
                
                  
               </td>
              
            </tr>
            <?php $no++; ?>
            @endforeach

                </tbody>
              </table>
            </div>


@endsection