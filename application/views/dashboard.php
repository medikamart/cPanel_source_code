

<div class="clearfix"></div>

<div style="background: #F3FCFB!important;padding-top: 125px;" class="content-wrapper">

   <div class="container-fluid">

      <div class="row">

         <?php 

            if($permissions['dashboard_7_days_report']==1)

            {

               ?>

               <div class="col-12 col-lg-6">

               <div class="card">

                  <div class="card-header">

                     Last 7 Days Report

                     <div class="card-action">

                        <div class="dropdown">

                           <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">

                           <i class="icon-options"></i>

                           </a>

                           <div class="dropdown-menu dropdown-menu-right">

                              <a class="dropdown-item" href="javascript:void();">Action</a>

                              <a class="dropdown-item" href="javascript:void();">Another action</a>

                              <a class="dropdown-item" href="javascript:void();">Something else here</a>

                              <div class="dropdown-divider"></div>

                              <a class="dropdown-item" href="javascript:void();">Separated link</a>

                           </div>

                        </div>

                     </div>

                  </div>

                  <div class="card-body">

                     <div class="chart-container-2">

                        <canvas id="dashboard-chart-1"></canvas>

                     </div>

                  </div>

               </div>

            </div>

            <script type="text/javascript">

               last7daysReport();

                function last7daysReport()

                {



                     $.ajax({

                       type:'POST',

                       url:'<?php echo base_url();  ?>Dashboard/dashboard7daysReport',

                       data:{},

                       success:function(res)

                       {

                         res = JSON.parse(res);

                         console.log(res);

                         var labelArray = [];

                         var labArray = [];

                         $.each(res.response_data,function(index,value){

                             labelArray.push(value.date);

                             labArray.push(parseFloat(value.lab_amt));

                         });

                           var ctx = document.getElementById("dashboard-chart-1").getContext('2d');

                           var myChart = new Chart(ctx, {

                             type: 'bar',

                             data: {

                               labels: labelArray,

                               datasets: [{

                                 label: 'Lab Earning',

                                 data: labArray,

                                 borderColor: '#11cdef',

                                 backgroundColor: '#11cdef',

                                 hoverBackgroundColor: '#11cdef',

                                 pointRadius: 0,

                                 fill: false,

                                 borderWidth: 1

                               }]

                             },

                         options:{

                         maintainAspectRatio: false,

                           legend: {

                             position: 'bottom',

                                   display: true,

                             labels: {

                                     boxWidth:12

                                   }

                                 },  

                           scales: {

                             xAxes: [{

                             stacked: true,

                             barPercentage: .5

                             }],

                               yAxes: [{ 

                                 stacked: true

                                  }]

                              },

                           tooltips: {

                             displayColors:false,

                           }

                         }

                           });

                       }

                     })



                }

            </script>

               <?php

            }

          ?>

         <?php

            if($permissions['dashboard_most_selling_category_report']==1)

            {

               ?>

                  <div class="col-12 col-lg-6">

                     <div class="card">

                        <div class="card-header">

                           Most Selling Category

                           <div class="card-action">

                              <div class="dropdown">

                                 <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">

                                 <i class="icon-options"></i>

                                 </a>

                                 <div class="dropdown-menu dropdown-menu-right">

                                    <a class="dropdown-item" href="javascript:void();">Action</a>

                                    <a class="dropdown-item" href="javascript:void();">Another action</a>

                                    <a class="dropdown-item" href="javascript:void();">Something else here</a>

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" href="javascript:void();">Separated link</a>

                                 </div>

                              </div>

                           </div>

                        </div>

                        <div class="card-body">

                           <div class="chart-container-2">

                              <canvas id="dashboard-chart-2"></canvas>

                           </div>

                        </div>

                     </div>

                  </div>

               <?php

            }

         ?>

         

      </div>

      <!--End Row-->

      <div class="row">

         <?php 

            if($permissions['dashboard_last_30_days_sell_report']==1)

            {

               ?>

                  <div class="col-12 col-lg-12 col-xl-12">

                        <div class="card">

                           <div class="card-header">

                              <i class="fa fa-area-chart"></i> Sales Report Last 30 Days

                              <div class="card-action">

                              </div>

                           </div>

                           <div class="card-body">

                              <div class="chart-container-1">

                                 <canvas id="dashboard-chart-3"></canvas>

                              </div>

                           </div>

                        </div>

                     </div>

               <?php

            }



          ?>

         



      </div>

      <!--End Row-->

      <div class="row">

         <?php 

            if($permissions['dashboard_top_test_list_report']==1)

            {

               ?>

                  <div class="col-12 col-lg-6 col-xl-8">

                     <div  class="card" style="height: 380px;overflow-y: scroll;">

                        <div class="card-header border-0">

                           Top Test List

                           <div class="card-action">

                              

                           </div>

                        </div>

                        <div class="table-responsive">

                           <table class="table align-items-center table-flush">

                              <thead>

                                 <tr>

                                    <th>Rank</th>

                                    <th>Test</th>

                                    <th>Category</th>

                                    <th>Count</th>

                                 </tr>

                              </thead>

                              <tbody id="test_result">

                                 

                              </tbody>

                           </table>

                        </div>

                     </div>

                  </div>

               <?php 

               }

            ?>



         <?php 

         if($permissions['dashboard_top_refered_by_report']==1)

         {

            ?>

            <div class="col-12 col-lg-6 col-xl-4">

               <div class="card" style="height: 380px; overflow-y: scroll;">

                  <div class="card-header">Refered By Report</div>

                  <div id="doctors_result" class="card-body">

                     

                     

                  </div>

               </div>

            </div>

            <?php

         }

         ?>

      </div>

      <!--End Row-->

      <div class="card">

         <div class="card-content">

            <div class="row row-group m-0 text-center">

       <?php 

         if($permissions['dashboard_total_report_count_card']==1)

         {

            ?>

            <div class="col-12 col-lg-4 col-xl-4">

                  <div class="card-body">

                     <span class="donut" data-peity='{ "fill": ["#5e72e4", "#f2f2f2"], "innerRadius": 45, "radius": 32 }'>4/5</span>

                     <hr>

                     <h6 class="mb-0">Total Report : <span id="total_report_done">0</span></h6>

                  </div>

               </div>

            <?php



         }

         ?>



         <?php 

         if($permissions['dashboard_total_earning_card']==1)

         {

            ?>

            <div class="col-12 col-lg-4 col-xl-4">

                  <div class="card-body">

                     <span class="donut" data-peity='{ "fill": ["#ff2fa0", "#f2f2f2"], "innerRadius": 45, "radius": 32 }'>2/5</span>

                     <hr>

                     <h6 class="mb-0">Total Earning : <span id="total_earning">0.00</span></h6>

                  </div>

               </div>

            <?php



         }

         ?>

         <?php 

         if($permissions['dashboard_total_dues_card']==1)

         {

            ?>

            <div class="col-12 col-lg-4 col-xl-4">

                  <div class="card-body">

                     <span class="donut" data-peity='{ "fill": ["#2dce89", "#f2f2f2"], "innerRadius": 45, "radius": 32 }'>3/5</span>

                     <hr>

                     <h6 class="mb-0">Total Due : <span id="total_due">0.00</span></h6>

                  </div>

               </div>

            <?php



         }

         ?>

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