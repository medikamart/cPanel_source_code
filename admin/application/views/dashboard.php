
<div class="clearfix"></div>
<div style="background: #F3FCFB!important;padding-top: 125px;" class="content-wrapper">
   <div class="container-fluid">
      <div class="card">
         <div class="card-content">
            <div class="row row-group m-0 text-center">
               <div class="col-12 col-lg-4 col-xl-4">
                  <div class="card-body">
                     <span class="donut" data-peity='{ "fill": ["#5e72e4", "#f2f2f2"], "innerRadius": 45, "radius": 32 }'>5/5</span>
                     <hr>
                     <h6 class="mb-0">Total Clinics : <span id="total_report_done"><?php echo $data['total_clinic']; ?></span></h6>
                  </div>
               </div>
            <div class="col-12 col-lg-4 col-xl-4">
                  <div class="card-body">
                     <span class="donut" data-peity='{ "fill": ["#ff2fa0", "#f2f2f2"], "innerRadius": 45, "radius": 32 }'>5/5</span>
                     <hr>
                     <h6 class="mb-0">Total Non Active Clinic : <span id="total_earning"><?php echo $data['total_non_active']; ?></span></h6>
                  </div>
               </div>
            
            <div class="col-12 col-lg-4 col-xl-4">
                  <div class="card-body">
                     <span class="donut" data-peity='{ "fill": ["#2dce89", "#f2f2f2"], "innerRadius": 45, "radius": 32 }'>5/5</span>
                     <hr>
                     <h6 class="mb-0">Total Active Clinic : <span id="total_due"><?php echo $data['total_active']; ?></span></h6>
                  </div>
               </div>
           
            </div>
            <!--End Row-->
         </div>
      </div>
      
      <!--End Row-->
      <!--End Dashboard Content-->
   </div>
   <!-- End container-fluid-->
</div>
<!--End content-wrapper-->
  
<!--Start Back To Top Button-->
<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
<!--End Back To Top Button-->
<script type="text/javascript">
    $(document).ready(function(){
      $('#overlay2').hide();
    });

getdata();
function getdata()
{
   $.ajax({

      type:'POST',
      url:'<?php echo base_url();  ?>Dashboard/dashboardReport',
      data:{},
      success:function(res)
      {
         res = JSON.parse(res);
         console.log(res);
         
         // chart 2
            var category_label_array = [];
            var category_value_array = [];
            $.each(res.response_data.category_report,function(index,value){
                  category_label_array.push(value.category_name);
                  category_value_array.push(value.total);
            });
             var ctx = document.getElementById("dashboard-chart-2").getContext('2d');
               var myChart = new Chart(ctx, {
                 type: 'doughnut',
                 data: {
                   labels: category_label_array,
                   datasets: [{
                     backgroundColor: [
                       '#5e72e4',
                       '#ff2fa0',
                       '#2dce89',
                       '#f5365c',
                       '#fb6340',
                       '#11cdef'
                     ],
                     hoverBackgroundColor: [
                       '#5e72e4',
                       '#ff2fa0',
                       '#2dce89',
                       '#f5365c',
                       '#fb6340',
                       '#11cdef'
                     ],
                     data: category_value_array,
               borderWidth: [1, 1, 1, 1, 1, 1]
                   }]
                 },
                 options: {
                  maintainAspectRatio: false,
               cutoutPercentage: 25,
                     legend: {
                 position: 'right',
                       display: true,
                 labels: {
                         boxWidth:12
                       }
                     },
               tooltips: {
                 displayColors:false,
               }
                 }
               });
      //  sales report graph
      var sales_label_array = [];
      var sales_value_array = [];
      $.each(res.response_data.sales_report,function(index,value){
            sales_label_array.push(parseInt(value.billing_date));
            sales_value_array.push(parseFloat(value.grand_total_amount));
      });

       var ctx = document.getElementById('dashboard-chart-3').getContext('2d');
      
       var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
          gradientStroke1.addColorStop(0, 'rgba(37, 117, 252, 0.9)');
          gradientStroke1.addColorStop(1, 'rgba(106, 17, 203, 0.5)');
      
       var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: sales_label_array,
          datasets: [{
            label: 'Sales Amount',
            data: sales_value_array,
            backgroundColor: gradientStroke1,
            borderColor: gradientStroke1,
            pointBackgroundColor:'#fff',
            pointHoverBackgroundColor:gradientStroke1,
            pointBorderColor :gradientStroke1,
            pointHoverBorderColor :gradientStroke1,
            pointBorderWidth :2,
            pointRadius :4,
            pointHoverRadius :4,
            lineTension :'0',
            borderWidth: 3
          }]
        }
        ,
        options: {
         maintainAspectRatio: false,
            legend: {
        position: false,
              display: true,
            },
      tooltips: {
        displayColors:false,
      }
        }
      });
   // test list
   $.each(res.response_data.test_report,function(index,value){
         $('#test_result').append('<tr>'+
                        '<td>'+(index+1)+'</td>'+
                        '<td>'+value.test_name+'</td>'+
                        '<td>'+value.category_name+'</td>'+
                        '<td>'+value.total+'</td>'+
                        '</tr>');
      });

   // test list
   var count = 0;
   var max = 0;
   $.each(res.response_data.doctors_report,function(index,value){
      console.log(value.total);
         if(max<value.total)
                max=value.total; 
      }); 
   var unit =  max/100;
   $.each(res.response_data.doctors_report,function(index,value){
         var report_perct = parseInt(value.total/unit);
         
         $('#doctors_result').append('<div class="media align-items-center">'+
                     '<div><i class="fa fa-user-md fa-2x text-facebook"></i></div>'+
                     '<div class="media-body text-left ml-3">'+
                        '<div class="progress-wrapper">'+
                           '<p>'+value.vendor_name+' <span class="float-right">'+report_perct+'%</span></p>'+
                           '<div class="progress" style="height: 7px;">'+
                              '<div class="progress-bar bg-facebook" style="width:'+report_perct+'%"></div>'+
                           '</div>'+
                        '</div>'+
                     '</div>'+
                  '</div>'+
                  '<hr>');
      }); 

      }
   });
}


    
    getTotalCount();
    function getTotalCount()
    {
      $.ajax({
        type:'POST',
        url:'<?php echo base_url(); ?>Dashboard/dashboardCountReport',
        data:{},
        success:function(res)
        {
          res = JSON.parse(res);
          $('#total_report_done').html(res.response_data.total_report_done);
          $('#total_earning').html(res.response_data.total_earning);
          $('#total_due').html(res.response_data.total_due);
          $('#outing_earning').html(res.response_data.outing_earning);
          console.log(res);
        }
      });
    }

</script>