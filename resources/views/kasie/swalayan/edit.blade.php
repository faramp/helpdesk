<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="../assets/js/components/hs.range-datepicker.js"></script>

<script>
  $(function(){

    $('.js-select').selectpicker();
  
      $('.js-select').on('shown.bs.select', function (e) {
        $(this).addClass('opened');
      });
  
      $('.js-select').on('hidden.bs.select', function (e) {
        $(this).removeClass('opened');
      });
  
      // initialization of range datepicker
      $.HSCore.components.HSRangeDatepicker.init('.js-range-datepicker');
  
      // initialization of sidebar navigation component
      $.HSCore.components.HSSideNav.init('.js-side-nav');
  
      // initialization of hamburger
      $.HSCore.helpers.HSHamburgers.init('.hamburger');
  
      // initialization of HSDropdown component
      $.HSCore.components.HSDropdown.init($('[data-dropdown-target]'), {dropdownHideOnScroll: false});
  
      // initialization of custom scrollbar
      $.HSCore.components.HSScrollBar.init($('.js-custom-scroll'));
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

<form action="/kasie/datausulan/{{$detail_usulan->id}}" method="post">
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

                    <div class="g-brd-around g-brd-gray-light-v7 g-rounded-4 g-pa-20 g-mb-30">
                      <div class="form-group mb-0 g-max-width-400">
                        <div id="datepickerWrapper" class="u-datepicker-right u-datepicker--v3 g-pos-rel w-100 g-cursor-pointer g-brd-around g-brd-gray-light-v7 g-rounded-4">
                          <input class="js-range-datepicker g-bg-transparent g-font-size-12 g-font-size-default--md g-color-gray-dark-v6 g-pr-80 g-pl-15 g-py-9" type="text" placeholder="Select Date" data-rp-wrapper="#datepickerWrapper" data-rp-date-format="d-m-Y" id="deadline" name="deadline">
                          <div class="d-flex align-items-center g-absolute-centered--y g-right-0 g-color-gray-light-v6 g-color-lightblue-v9--sibling-opened g-mr-15">
                            <i class="hs-admin-calendar g-font-size-18 g-mr-10"></i>
                            <i class="hs-admin-angle-down"></i>
                          </div>
                        </div>
                      </div>
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
