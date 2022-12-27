
<div class="clearfix"></div>
<div style="background: #F3FCFB!important;padding-top: 125px;" class="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
         <div class="col-sm-9">
            <h4 class="page-title">Pad Image</h4>
         </div>
      </div>
      <!-- End Breadcrumb-->
      

      <div class="row">
         <div class="col-lg-12">
            <!-- End Breadcrumb-->
            <div class="row">
               <div class="col-lg-12">
                  <div class="card">
                     <div class="card-header"><i class="fa fa-table"></i> Pad Image
                     </div>
                     <div style="height:300px;overflow-y: scroll;" class="card-body ul-list">
                        
                        <ul>
                           <?php 

                              if(!empty($result))
                              {
                                 foreach($result as $key=>$value)
                                 {
                                    ?>
                                    <li onclick="selectImage(this.id)" id="image_<?php echo $value['id']; ?>" class="image-box">
                                       <input type="hidden" id="img_<?php echo $value['id']; ?>" value="<?php echo $value['pad_image']; ?>" name="hdn[]">
                                       <img style="width:100%;height:100%;cursor: pointer;" src="<?php echo $value['pad_image']; ?>">
                                    </li>
                                    <?php
                                 }
                              }
                           ?>
                        </ul>
                     </div>
                     <div class="card-body row">
                        <div class="col-md-6">
                           <form id="padform" method="POST" action="<?php echo base_url(); ?>Tool/submitImage" enctype="multipart/form-data">
                              <input style="display:none;" onchange="saveImageForm()" type="file" name="imagefile" id="file">
                           </form>
                           <button onclick="uploadImage()" type="button" class="btn btn-md btn-info">Upload </button>

                           <button type="button" onclick="saveImage()" class="btn btn-md btn-success">Set Image </button>
                           <button type="button" onclick="deleteImage()" class="btn btn-md btn-danger">Delete Image </button>
                           
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- End Row-->
         </div>
      </div>
   </div>
   <!-- End container-fluid-->
   <div class="overlay"></div>
</div>
<!--End content-wrapper-->
<!--Start Back To Top Button-->
<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
<!--End Back To Top Button-->

<input type="hidden" value="<?php echo date('dmYHis'); ?>" name="unique_no">

<script type="text/javascript">

   function uploadImage()
   {
      $('#file').click();
   }

   function saveImageForm()
   {
      $('#padform').submit();
   }

   $(document).ready(function(){
     $('#overlay2').hide();
   });
   let setImageId = '';
   function selectImage(id)
   {
      setImageId = id.split('_')[1];
      $('.image-box').css('border','0px solid blue');
      $('#'+id).css('border','5px solid blue');
   }
   function saveImage()
   {
      let image = $('#img_'+setImageId).val().split('/')[6];
       $.ajax({
         type:'POST',
         url:'<?php echo base_url(); ?>Tool/setImage',
         data:{images:image},
         success:function(res)
         {
           console.log(res);
           res = JSON.parse(res);
           if(res.response_code==200)
           {
             swal('success','Successfully Saved','success');
           }else
           {
             swal('error','something went wwrong try again after some time','error');
           }
           
         }
        })
   }

   function deleteImage()
   {
      let image = $('#img_'+setImageId).val().split('/')[6];
       $.ajax({
         type:'POST',
         url:'<?php echo base_url(); ?>Tool/deleteImage',
         data:{images:image},
         success:function(res)
         {
           console.log(res);
           res = JSON.parse(res);
           if(res.response_code==200)
           {
             swal('success','Successfully Deleted','success');
             setTimeout(()=>{
               window.location.href='<?php echo base_url(); ?>Tool/toolGallery';
             },1000);
           }else
           {
             swal('error','something went wwrong try again after some time','error');
           }
           
         }
        })
   }
</script>
<style type="text/css">
   .ul-list ul li{
      list-style-type: none;
      float: left;
   }
   .image-box{
      width: 300px;
      height: 100px;
      border: 1px solid black;
      margin: 5px;
   }

</style>