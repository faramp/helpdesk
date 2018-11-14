
@extends('staf.template')
@section('title', 'Data Intruksi')
@section('content')

  <div class="col g-ml-45 g-ml-0--lg g-pb-65--md">
          <!-- Breadcrumb-v1 -->
          <div class="g-hidden-sm-down g-bg-gray-light-v8 g-pa-20">
            <ul class="u-list-inline g-color-gray-dark-v6">

              <li class="list-inline-item g-mr-10">
                <a class="u-link-v5 g-color-gray-dark-v6 g-color-lightblue-v3--hover g-valign-middle" href="#!">Staf</a>
                <i class="hs-admin-angle-right g-font-size-12 g-color-gray-light-v6 g-valign-middle g-ml-10"></i>
              </li>

              <li class="list-inline-item g-mr-10">
                <a class="u-link-v5 g-color-gray-dark-v6 g-color-lightblue-v3--hover g-valign-middle" href="#!">Intruksi</a>
                <i class="hs-admin-angle-right g-font-size-12 g-color-gray-light-v6 g-valign-middle g-ml-10"></i>
              </li>

              <li class="list-inline-item">
                <span class="g-valign-middle">Data Intruksi</span>
              </li>
            </ul>
          </div>

          
            <div class="g-pa-20">

              
             @if(session('msg'))

   <div class="alert alert-success">
  <strong> {{session('msg')}}</strong>
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
                @foreach($intruksi as $r)
            <tr>
         
              <td style="text-align: center">{{$no}}</td>
              <td style="text-align: center">{{$r->nama}}</td>
               <td style="text-align: center">{{$r->deskripsi}}</td>
                <td style="text-align: center">
                      @if ($r->status_id === 4)
                        <span class="u-tags-v1 text-center g-width-180 g-brd-around g-brd-primary g-bg-primary g-font-weight-400 g-color-white g-rounded-50 g-py-4 g-px-15">{{$r->namas}}</span>
                @elseif ($r->status_id === 5)
<span class="u-tags-v1 text-center g-width-180 g-brd-around g-brd-lightblue-v3 g-bg-lightblue-v3 g-font-size-default g-color-white g-rounded-50 g-py-4 g-px-15">{{$r->namas}}</span>
                  @elseif ($r->status_id === 6)
                 <span class="u-tags-v1 text-center g-width-180 g-brd-around g-brd-teal-v2 g-bg-teal-v2 g-font-weight-400 g-color-white g-rounded-50 g-py-4 g-px-15">{{$r->namas}}</span>
                 @elseif ($r->status_id === 7)
                    <span class="u-tags-v1 text-center g-width-180 g-brd-around g-brd-lightbrown g-bg-lightbrown g-font-weight-400 g-color-white g-rounded-50 g-py-4 g-px-15">{{$r->namas}}</span>

                 @endif
                </td>
             
              <td style="text-align: center">
               
               
                 <a href="/staf/intruksi/edit/{{$r->id}}"><button type="button" class="btn btn-success" title="edit">Detail</button></a>
                
                  
               </td>
              
            </tr>
            <?php $no++; ?>
            @endforeach
                </tbody>
              </table>
            </div>


@endsection