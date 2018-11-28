<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>


<script type="text/javascript">
  $(function () {
    $('#deadline').datetimepicker({
      format: 'DD-MM-YYYY HH:mm'
    });
  });
  
function myFunction() {
    var x = document.getElementById("status").value;
    if(x==2){
      $('#deadline_show').show();
      $('#pesan_show').hide();
    }
    else if(x==3){
      $('#deadline_show').hide();
      $('#pesan_show').show();
    }
    else{
      $('#deadline_show').hide();
      $('#pesan_show').hide();
    }
}
</script>
@extends('kasie.template')
@section('title', 'Edit Data Usulan')
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
                <span class="g-valign-middle">Edit Data Usulan</span>
              </li>
            </ul>
          </div>

<form action="/kasie/usulanstaf/{{$detail_usulan->id}}" method="post">
  <input type="hidden" name="_method" value="put">
          <div class="g-pa-20">
            <h1 class="g-font-weight-300 g-font-size-28 g-color-black g-mb-28">Edit Data Usulan</h1>

            <div class="row">
              <!-- 1-st column -->
              <div class="col-md-6">
                <!-- Basic Text Inputs -->
                <div class="g-brd-around g-brd-gray-light-v7 g-rounded-4 g-pa-15 g-pa-20--md g-mb-30">
                

                  <!-- Default Input -->
                  <div class="form-group g-mb-30">
                    <label class="g-mb-10" for="inputGroup-1_1">Nama</label>

                    <div class="g-pos-rel">
                      <span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
	                  	<i class="hs-admin-check g-absolute-centered g-font-size-default g-color-lightblue-v3"></i>
	                	</span>
                      <input id="inputGroup-1_1" name="nama" class="form-control form-control-md g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-px-14 g-py-10" type="text" value="{{$detail_usulan->nama_user}}"  >
                    </div>
                  </div>

                  <div class="g-mb-30">
                    <label class="g-mb-10">Aktifitas</label>

                    <div class="g-pos-rel">
                      <span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
                      <i class="hs-admin-check g-absolute-centered g-font-size-default g-color-lightblue-v3"></i>
                    </span>
                      <input id="inputGroup-1_1" name="nama" class="form-control form-control-md g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-px-14 g-py-10" type="text" value="{{$detail_usulan->nama_aktifitas}}"  >
                    </div>                    
                  </div>


                  <div class="g-mb-30">
                    <label class="g-mb-10">Deskripsi</label>
                    <div class="g-pos-rel">
                      <span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
                      <i class="hs-admin-check g-absolute-centered g-font-size-default g-color-lightblue-v3"></i>
                    </span>
                      <input id="inputGroup-1_1" name="aktifitas" class="form-control form-control-md g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-px-14 g-py-10" type="text" value="{{$detail_usulan->deskripsi}}">
                    </div>
                  </div>

                  <div class="g-mb-30">
                    <label class="g-mb-10">Status</label>
                    <div class="form-group u-select--v3 g-pos-rel g-brd-gray-light-v7 g-rounded-4 mb-0">
                      <select class="js-select u-select--v3-select u-sibling w-100" id="status" name="status" required="required" style="display: none;" onchange="myFunction()">
                         @foreach($status as $s)
                        <option value="{{$s->id}}" data-content='<span class="d-flex align-items-center w-100"><span>{{$s->nama}}</span></span>'>
                          {{$s->nama}}
                        </option>
                        @endforeach                      
                      </select>

                      <div class="d-flex align-items-center g-absolute-centered--y g-right-0 g-color-gray-light-v6 g-color-lightblue-v9--sibling-opened g-mr-15">
                        <i class="hs-admin-angle-down"></i>
                      </div>
                    </div>
                  </div>

                  <div class="g-mb-30" id="deadline_show" style="display:none;">
                    <label class="g-mb-10">Deadline</label>
                    <div class='input-group date' >
                        <input type="text" class="form-control" id="deadline" name="deadline"/>
                    </div>
                  </div>

                  <div class="g-mb-30" id="pesan_show" style="display:none;">
                    <label class="g-mb-10">Pesan</label>
                    <div class="g-pos-rel">
                      <span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
                      <i class="hs-admin-check g-absolute-centered g-font-size-default g-color-lightblue-v3"></i>
                      </span>
                      <textarea id="inputGroup-1_3" class="form-control form-control-md u-textarea-expandable g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-resize-none g-overflow-hidden" rows="3" type="text" name="pesan"></textarea>
                    </div>
                  </div>
                  <input type="task_id" name="task_id" value="{{$detail_usulan->task_id}}" hidden="">

                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                     {{csrf_field()}}
               
                </div>
                <!-- End Basic Text Inputs -->
</form>
@endsection
