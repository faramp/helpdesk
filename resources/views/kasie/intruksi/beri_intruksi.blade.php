<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
     $( "#tes" ).click(function() {
      $('#x').hide();
      $('#y').show();

});
});
 </script>

 <script type="text/javascript">
    $(document).ready(function(){
     $( "#prev" ).click(function() {
      $('#y').hide();
      $('#x').show();

});
});
 </script>

  <script type="text/javascript">
    $(document).ready(function(){
     $( "#next2" ).click(function() {
      $('#y').hide();
      $('#x').hide();
       $('#z').show();

});
});
 </script>

   <script type="text/javascript">
    $(document).ready(function(){
     $( "#prev2" ).click(function() {
        $('#x').hide();
      $('#y').show();
       $('#z').hide();

});
});
 </script>

 <script type="text/javascript">
  $(document).ready(function(){
     $('input[type=radio][name=bantu]').change(function() {
    if (this.value == '1') {
       $('#zz').show();
    }
    else if (this.value == '2') {
        $('#zz').hide();
      
    }
});
  });

 </script>
 

 <script type="text/javascript">

 function tampilkan_aktifitas(){

  var x = $('input[name=pekerjaan]:checked').val();

   $.ajax({
   type:"GET",
   url:"/kasie/intruksi/get_aktifitas",
   data:"x="+x,
   success:function(html){
    //alert('berhasil');
   $("#pekerjaan_id").html(html);
                       
                        }
                      });
}

 </script>

  <script type="text/javascript">

  

   function tampilkan_bawahan_bantuan(){

 var z=$("#approved_by").val();

   $.ajax({
   type:"GET",
   url:"/kasie/intruksi/get_bawahan_bantuan",
   data:"z="+z,
   success:function(html){
    //alert('berhasil');
   $("#bawahan_id").html(html);
                       
                        }
                      });
}

  

 </script>





 <script type="text/javascript">
  $(function() {
    $('#datetimepicker1').datetimepicker({
      language: 'pt-BR'
    });
  });
</script>



@extends('kasie.template')
@section('title', 'Data Unit Kerja')
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
                <span class="g-valign-middle">Beri Intruksi</span>
              </li>
            </ul>
          </div>
          <br>

<form  action="/kasie/intruksi/create_intruksi" method="post" novalidate>

            <div class="col-md-12" id="x">
                <div class="g-brd-around g-brd-gray-light-v7 g-rounded-4 g-pa-15 g-pa-20--md g-mb-30">
                 <h4 class="h6 g-font-weight-600 g-color-black g-mb-20">Pilih Jenis Pekerjaan</h4>
                  <div class="row g-mb-30">
                    <!-- Left Column -->
                     @foreach($pekerjaan as $r)
                    <div class="col-md-3">
                    <div class="form-group g-mb-10">
                        <label class="u-check g-pl-25">
                          <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" name="pekerjaan" value="{{$r->id}}"  onchange="tampilkan_aktifitas()" type="radio">
                          <div class="u-check-icon-font g-absolute-centered--y g-left-0">
                            <i class="fa" data-check-icon="&#xf192" data-uncheck-icon="&#xf1db"></i>
                          </div>
                          {{$r->nama}}
                        </label>
                      </div>
                        </div>
                     @endforeach  
                       </div>

           <div class="form-group">
            <h4 class="h6 g-font-weight-600 g-color-black g-mb-20" >Aktifitas</h4>
            <select class="form-control" id="pekerjaan_id" name="aktifitas_id">
            
            </select>
            </div>

         
                  
                    
                     <input type="button" class="btn btn-success" id="tes" value="Selanjutnya">

              </div>
              </div>
          



              <div class="col-md-12" id="y" style="display:none" >


              <div class="g-brd-around g-brd-gray-light-v7 g-rounded-4 g-pa-15 g-pa-20--md g-mb-30">

                  <div class="form-group g-mb-30">
           <h4 class="h6 g-font-weight-600 g-color-black g-mb-20">Deskripsi Intruksi</h4>
          <textarea id="inputGroup-1_1" class="form-control form-control-md g-resize-none g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4" rows="3" placeholder="Penjelasan tentang intruksi" name="deskripsi"></textarea>
           </div>


                   <h4 class="h6 g-font-weight-600 g-color-black g-mb-20 ">Pilih Teknisi</h4>
             

                  <div class="row g-mb-30">
                 @foreach($user as $r)
                  <div class="col-md-6">
                    
                      <div class="form-group g-mb-10">
                        <label class="u-check g-pl-25">
                          <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" name="user[]" value="{{$r->user_id}}" type="checkbox">
                          <div class="u-check-icon-checkbox-v4 g-absolute-centered--y g-left-0">
                            <i class="fa" data-check-icon="&#xf00c"></i>
                          </div>
                          {{$r->nama}}
                        </label>
                      </div>
                    
                      
                    </div>
                      @endforeach
                  </div>

               <input type="button" class="btn btn-primary" id="prev" value="Sebelumnya">
               <input type="button" class="btn btn-success" id="next2" value="Selanjutnya">
                {{csrf_field()}}
                
               </div>
              </div>

                <div class="col-md-12" id="z" style="display:none">


              <div class="g-brd-around g-brd-gray-light-v7 g-rounded-4 g-pa-15 g-pa-20--md g-mb-30">

            


                    <div class="form-group g-mb-30">
                    <h4 class="h6 g-font-weight-600 g-color-black g-mb-20 ">Dedline Task</h4>

                    <div class="g-pos-rel">
                      <span class="g-pos-abs g-top-0 g-right-0 d-block g-width-40 h-100 opacity-0 g-opacity-1--success">
                      <i class="hs-admin-check g-absolute-centered g-font-size-default g-color-lightblue-v3"></i>
                    </span>
                      <input id="inputGroup-1_1" name="nama" ass="form-control" class="form-control form-control-md g-brd-gray-light-v7 g-brd-gray-light-v3--focus g-rounded-4 g-px-14 g-py-10" type="datetime-local" >
                    </div>
                  </div>
                  <!-- End Columned Checkboxes -->
                   <h4 class="h6 g-font-weight-600 g-color-black g-mb-20 ">Butuh bantuan dari unit kerja lain ?</h4>
                    <div class="g-mb-15">
                    <label class="form-check-inline u-check g-pl-25 ml-0 g-mr-25">
                      <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" name="bantu" id="bantu" value="1" type="radio">
                      <div class="u-check-icon-radio-v4 g-absolute-centered--y g-left-0 g-width-18 g-height-18">
                        <i class="g-absolute-centered d-block g-width-10 g-height-10 g-bg-primary--checked"></i>
                      </div>
                      Iya
                    </label>

                    <label class="form-check-inline u-check g-pl-25 ml-0 g-mr-25">
                      <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" name="bantu" id="bantu" value="2" checked=""  type="radio">
                      <div class="u-check-icon-radio-v4 g-absolute-centered--y g-left-0 g-width-18 g-height-18">
                        <i class="g-absolute-centered d-block g-width-10 g-height-10 g-bg-primary--checked"></i>
                      </div>
                      Tidak
                    </label>
                  </div>

                   <div class="g-mb-30" style="display:none" id="zz">
                    <label class="g-mb-10">Bantuan</label>

                    <div class="form-group u-select--v3 g-pos-rel g-brd-gray-light-v7 g-rounded-4 mb-0">
                      <select class="js-select u-select--v3-select u-sibling w-100" name="approved_by" id="approved_by" onchange="tampilkan_bawahan_bantuan()" required="required" title="Pilih bantuan dari mana" style="display: none;">
                         @foreach($teman_setingkat as $r)
                        <option value="{{$r->id}}" data-content='<span class="d-flex align-items-center w-100"><span>{{$r->nama}}</span></span>'>{{$r->nama}}
                        </option>
                        @endforeach
                       
                      </select>

                      <div class="d-flex align-items-center g-absolute-centered--y g-right-0 g-color-gray-light-v6 g-color-lightblue-v9--sibling-opened g-mr-15">
                        <i class="hs-admin-angle-down"></i>
                      </div>
                    </div>
                  </div>

                <div name="bawahan_id" id="bawahan_id">

                </div>





             

                  
               <input type="button" class="btn btn-primary" id="prev2" value="Sebelumnya">
               <button name="submit" type="submit" class="btn btn-success">Simpan</button>
                {{csrf_field()}}
                
               </div>
              </div>


</form>
            
 
@endsection





