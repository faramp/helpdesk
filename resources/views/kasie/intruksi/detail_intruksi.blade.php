<!-- first jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/af.js"></script>

<script type="text/javascript">
  function display(){
      $(document).ready(function(){

        var temp=$('#status_id').val();
       // alert(temp);
       if(temp==6){
          $('#nilai').show();
           $('#deskripsi').hide();
       
       }

       if(temp==5){
          $('#nilai').hide();
           $('#deskripsi').hide();
        
       }

        if(temp==7){
          $('#deskripsi').show();
          $('#nilai').hide();
        
       }


      
      });
  }
</script>

@extends('kasie.template')
@section('title', 'Detail Intruksi')
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
                <a class="u-link-v5 g-color-gray-dark-v6 g-color-lightblue-v3--hover g-valign-middle" href="#!">Intruksi</a>
                <i class="hs-admin-angle-right g-font-size-12 g-color-gray-light-v6 g-valign-middle g-ml-10"></i>
              </li>

              <li class="list-inline-item">
                <span class="g-valign-middle">Detail</span>
              </li>
            </ul>
          </div>

 <div class="g-pa-20">
            

            <div class="row">
              <!-- 1-st column -->
              <div class="col-md-6">
                <!-- Basic Text Inputs -->
                <div class="g-brd-around g-brd-gray-light-v7 g-rounded-4 g-pa-15 g-pa-20--md g-mb-30">
                 

                  <!-- Default Input -->
                  <div class="form-group g-mb-30">
                    <h4 class="h6 g-font-weight-600 g-color-black g-mb-20">Aktifitas</h4>

                    <div class="g-pos-rel">
                      <span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
                      <i class="hs-admin-check g-absolute-centered g-font-size-default g-color-lightblue-v3"></i>
                    </span>
                      <input id="inputGroup-1_1" class="form-control form-control-md g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-px-14 g-py-10" type="text" value="{{$intruksi->aktifitas_id}}">
                    </div>
                  </div>
                  <!-- End Default Input -->

                   <div class="form-group g-mb-30">
           <h4 class="h6 g-font-weight-600 g-color-black g-mb-20">Deskripsi Intruksi</h4>
          <textarea id="inputGroup-1_1" class="form-control form-control-md g-resize-none g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4" rows="3" placeholder="Penjelasan tentang intruksi" name="deskripsi">{{$intruksi->deskripsi}}</textarea>
           </div>

             <div class="form-group g-mb-30">
                    <h4 class="h6 g-font-weight-600 g-color-black g-mb-20">Dikerjakan Oleh</h4>

                    <div class="g-pos-rel">
                      <span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
                      <i class="hs-admin-check g-absolute-centered g-font-size-default g-color-lightblue-v3"></i>
                    </span>
                      <input id="inputGroup-1_1" class="form-control form-control-md g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-px-14 g-py-10" type="text" value="{{$intruksi->username}}">
                    </div>
                  </div>

                    <div class="form-group g-mb-30">
                    <h4 class="h6 g-font-weight-600 g-color-black g-mb-20">Deadline</h4>

                    <div class="g-pos-rel">
                      <span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
                      <i class="hs-admin-check g-absolute-centered g-font-size-default g-color-lightblue-v3"></i>
                    </span>
                      <input id="inputGroup-1_1" class="form-control form-control-md g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-px-14 g-py-10" type="text" value="{{$intruksi->deadline}}">
                    </div>
                  </div>

                  @if ($intruksi->status_id === 5)
<div class="form-group g-mb-30">
                    <h4 class="h6 g-font-weight-600 g-color-black g-mb-20">Waktu Pengerjaan</h4>

                    <div class="g-pos-rel">
                      <span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
                      <i class="hs-admin-check g-absolute-centered g-font-size-default g-color-lightblue-v3"></i>
                    </span>
                      <input id="inputGroup-1_1" class="form-control form-control-md g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-px-14 g-py-10" type="text" value="{{$elapsed}}" >
                    </div>
                  </div>
                  @endif
               
                </div>
               
              </div>
              <!-- End 1-st column -->

              <!-- 2-nd column -->
              <div class="col-md-6">
                <!-- Rounded Text Inputs -->
                <div class="g-brd-around g-brd-gray-light-v7 g-rounded-4 g-pa-15 g-pa-20--md g-mb-30">
                  <h3 class="d-flex align-self-center text-uppercase g-font-size-12 g-font-size-default--md g-color-black g-mb-20">Tim Pengerjaan</h3>
                  <input type="hidden" name="task_id" value="{{$intruksi->task_id}}">
                    <div class="g-pa-20">
           <div class="table-responsive g-mb-40">
              <table class="table table-bordered" id="tes">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Status</th>
                  </tr>
                </thead>

                <tbody>
                 <?php $no=1; ?>
                @foreach($tim as $r)
            <tr>
         
              <td style="text-align: center">{{$no}}</td>
              <td style="text-align: center">{{$r->username}}</td>
               <td style="text-align: center"> @if ($r->status_id === 4 || $r->status_id === 1)
                        <span class="u-tags-v1 text-center g-width-180 g-brd-around g-brd-primary g-bg-primary g-font-weight-400 g-color-white g-rounded-50 g-py-4 g-px-15">{{$r->nama}}</span>
                @elseif ($r->status_id === 5 || $r->status_id === 2)
<span class="u-tags-v1 text-center g-width-180 g-brd-around g-brd-lightblue-v3 g-bg-lightblue-v3 g-font-size-default g-color-white g-rounded-50 g-py-4 g-px-15">{{$r->nama}}</span>
                  @elseif ($r->status_id === 6 || $r->status_id === 8 )
                 <span class="u-tags-v1 text-center g-width-180 g-brd-around g-brd-teal-v2 g-bg-teal-v2 g-font-weight-400 g-color-white g-rounded-50 g-py-4 g-px-15">{{$r->nama}}</span>
                  @elseif ($r->status_id === 7 || $r->status_id === 3)
                    <span class="u-tags-v1 text-center g-width-180 g-brd-around g-brd-lightbrown g-bg-lightbrown g-font-weight-400 g-color-white g-rounded-50 g-py-4 g-px-15">{{$r->nama}}</span>

                 @endif</td>
            
            
              
            </tr>
            <?php $no++; ?>
            @endforeach
                </tbody>
              </table>
            </div>
@if ($intruksi->status_id === 5)
<form action="/kasie/intruksi/penilaian/{{$intruksi->id}}" method="post">
   <input type="hidden" name="_method" value="put">
             

                    <div class="g-mb-30">
                    <label class="g-mb-10">Status</label>

                    <div class="form-group u-select--v3 g-pos-rel g-brd-gray-light-v7 g-rounded-4 mb-0">
                      <select class="js-select u-select--v3-select u-sibling w-100" name="status_id" id="status_id" required="required" onchange="display()">
                        
                      
                        <option value="5">Menunggu Penilaian</option>
                         <option value="6">Selesai</option>
                          <option value="7">Revisi</option>
                       
                      </select>

                      
                    </div>
                  </div>

                   <div class="form-group g-mb-30" style="display:none" id="nilai">
                    <h4 class="h6 g-font-weight-600 g-color-black g-mb-20">Nilai</h4>

                    <div class="g-pos-rel">
                      <span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
                      <i class="hs-admin-check g-absolute-centered g-font-size-default g-color-lightblue-v3"></i>
                    </span>
                      <input id="inputGroup-1_1" name="nilai" class="form-control form-control-md g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-px-14 g-py-10" type="text" >
                    </div>
                  </div>

                    <div class="form-group g-mb-30" id="deskripsi" style="display:none">
                   <h4 class="h6 g-font-weight-600 g-color-black g-mb-20">Pesan Revisi</h4>
                  <textarea id="inputGroup-1_1" class="form-control form-control-md g-resize-none g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4" rows="3"  name="pesan"></textarea>
           </div>

                  <button type="submit" name="submit" class="btn btn-success">Submit</button>
                     {{csrf_field()}}
                  @endif
                </form>
                 
              
                </div>
                <!-- End Rounded Text Inputs -->

@endsection