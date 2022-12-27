<div class="clearfix"></div>
  
  <div class="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
        <h4 class="page-title">Report Settings</h4>
        
     </div>
     <div class="col-sm-3">
       <div class="btn-group float-sm-right">
        <button type="button" class="btn btn-outline-primary waves-effect waves-light"><i class="fa fa-cog mr-1"></i> Create</button>
        <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split waves-effect waves-light" data-toggle="dropdown">
        <span class="caret"></span>
        </button>
        <div class="dropdown-menu">
          <a href="<?php echo base_url().'Billing/billing';  ?>">
          <button class="dropdown-item">New</button>
          </a>
        </div>
      </div>
     </div>
     </div>
    <!-- End Breadcrumb-->
      <div class="row">
          <div class="col-lg-12">
            <!-- End Breadcrumb-->
      <div class="row">
        <div class="col-lg-8">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Report Page</div>
            <div  class="card-body">
              <div class="a4">
                    <img id="header_image" style="position:relative;display: none;width: 100%;top: 2px;" src="">

                    <img id="footer_image" style="position:inherit;display: none;width: 100%;bottom: 2px;" src="">
                    
                    
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Tools</div>
            <div class="card-body">
              <div class="toolbox">
                <div class="row">
                  <div class="col-sm-12">
                  
                    <h6>Header Settings</h6>
                    <hr>
                    <button onclick="choose_file(1)" style="width: 100%;" class="btn btn-sm btn-warning">Choose Header Image File</button>

                    <input onchange="headerImageShow(event)" id="header_file" type="file" style="display: none;" name="header_image">
                  </div>
                  
                  <div class="col-sm-12">
                    <hr>
                    <h6>Footer Settings</h6>
                    <hr>
                    <button onclick="choose_file(1)" style="width: 100%;" class="btn btn-sm btn-warning">Choose Footer Image File</button>
                    <input onchange="headerImageShow(event)" id="header_file" type="file" style="display: none;" name="header_image">
                  </div>
                  <div class="col-sm-12">
                    <hr>
                    <h6>DS Settings</h6>
                    <hr>
                    <button onclick="choose_file(1)" style="width: 100%;" class="btn btn-sm btn-warning">Choose DS Image File</button>
                    <input onchange="headerImageShow(event)" id="header_file" type="file" style="display: none;" name="header_image">
                  </div>

                  <div class="col-sm-12">
                    <hr>
                    <h6>Tag Line Settings</h6>
                    <hr>
                    <input type="text" placeholder="Write Report Tag Line" class="form-control" name="">
                  </div>
                  <div class="col-sm-12">
                    <hr>
                    <h6>Below Signature</h6>
                    <hr>
                    <input type="text" placeholder="Write here" class="form-control" name="">
                    <hr>
                  </div>
                  <div class="col-sm-12">
                    <h6>Report Style</h6>
                    <hr>
                    <select class="form-control select2" name="">
                      <option value="1">Normal</option>
                      <option value="1">Binary</option>
                      <option value="1">Lighter</option>
                    </select>
                    
                  </div>

                  <div class="col-sm-12 text-center">
                    <hr>
                    <button class="btn btn-md btn-info">Save Changes</button>
                    <button class="btn btn-md btn-warning">Cancel</button>
                    <hr>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- End Row-->
        </div>
      </div>

    </div>
    <!-- End container-fluid-->
   


    <div class="overlay"></div>
    
   </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>

    <style type="text/css">
      .a4{
        height: 842px;
        width: 595px;
        border: 3px solid lightgrey;
        margin: 0px auto; 
      }
      .toolbox{
        
        border: 3px solid lightgrey;
        margin: 0px auto; 
        padding: 10px;
      }

    </style>
    <!--End Back To Top Button-->
  <script type="text/javascript">
    $(document).ready(function(){
      $('#overlay2').hide();
      $('#transaction_id_area').hide();
    });
   
   function choose_file(file_type)
   {
      if(file_type==1)
      {
        $('#header_file').click();
      }else if(file_type==2)
      {

      }
   }

   function headerImageShow(event)
   {
      console.log(event);
      
      src = URL.createObjectURL(event.target.files[0]);
      var image = $('#footer_image').attr('src',src);
      $('#footer_image').show();
   }
   
  </script>