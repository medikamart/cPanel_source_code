<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="text/javascript">
    let paths = '<?php echo base_url(); ?>';
  </script>
	<style type="text/css">
  body
  {

		width: 80%;
    margin: 0px auto;
  }
  /*Design default*/
  .outer-design{
    width:100%;
    margin: 0px auto;
    height: 145px;
    border: 1px solid black;
    /*line-height: 2px;*/
    text-align: center;
     font-family: system-ui;
  }
  .heading{
    margin: 0px auto;
    width: 40%;
  }
  .heading h1{
    float: left;
  }

  .heading-4{
    width: 40%;
  }
  .sub-heading{
    width: 70%;
    margin: -24px auto;
    float: left;
  }
  .img{
    width: 100px;
    height: 100px;
    border-radius: 25px;
    margin: 10px;
    position: relative;
    top: 0px;
    left: 0px;
    float: left;
  }
  .clinic-data{
    text-align: right;
    font-weight: bold;
    padding-right: 1.75rem;
    font-size: 12px;
    padding-top: 0.75rem;

  }
/*Design 2*/
  .outer-design-2{
    width:100%;
    height: 145px;
    border: 1px solid black;
    /*line-height: 2px;*/
    text-align: center;
     font-family: system-ui;
  }
  .img-2{
    width: 100px;
    height: 100px;
    border-radius: 25px;
    margin: 10px;
    position: relative;
    top: 0px;
    right: 0px;
    float: right;
  }
  .sub-heading-1{
    float: left;
    text-align: center;
    width: 72%;
    margin-left: 35px;
  }
  .clinic-data-2{
    text-align: left;
    float: left;
    position: absolute;
    top: 55px;
    /*left: 0px;*/
    font-weight: bold;
    padding-left: 1.75rem;
    font-size: 12px;
    padding-top: 0.75rem;
  }

/*Design 3*/

  .outer-design-3{
    width:100%;
    height: 145px;
    border: 1px solid black;
    /*line-height: 2px;*/
    text-align: center;
     font-family: system-ui;
  }
  .img-3{
    width: 100px;
    height: 100px;
    border-radius: 25px;
    margin: 10px;
    position: relative;
    top: 0px;
    right: 0px;
    float: right;
  }
  .clinic-data-3{
    text-align: right;
    font-weight: bold;
    padding-left: 1.75rem;
    font-size: 12px;
    padding-top: 0.75rem;


  }
  .sub-heading-2{
    float: left;
    margin-left: 1.75rem;
  }
  .heading-3{
        margin-left: 1.75rem;
        text-align: left;
        float: left;
  }
  .address-3{
    /*position: absolute;
    margin: 90px;*/
  }

/*Design 4*/

  .outer-design-4{
    width:100%;
    height: 145px;
    border: 1px solid black;
    /*line-height: 2px;*/
    text-align: left;
     font-family: system-ui;
  }
  .outer-design-4 h1
  {
    padding-left: 0.75rem;
    float: left;
  }
  .outer-design-4 p
  {
    padding-left: 0.75rem;
  }
  .address-4{
    font-size: 10px;
    float: left;
  }
  .img-4{
    width: 80px;
    height: 80px;
    border-radius: 25px;
    float: right;
    position: relative;
    margin: 10px;
  
  }
  .clinic-data-4{
    float: left;
    font-weight: bold;
    padding-left: 1.75rem;
    font-size: 12px;
    padding-top: 0.75rem;


  }
  #outer-div
  {
    width: 100%;
    height: 200px;
    background: white;
    padding: 20px;
  }
  #render-area{
    margin: 20px;
  }

  .info-box-left{
    width: 25%;
    float: left;
    border: 1px solid white;
    padding: 10px;
    position: relative;
    color: grey;
    background: white;
    box-shadow: 2px 0px 5px 5px lightgrey;
    height: 280px;
  }
  .info-box-right{
    width: 68%;
    float: right;
    border: 1px solid white;
    overflow-y: scroll;
    color: grey;
    padding: 10px;
    background: white;
    box-shadow: 2px 0px 5px 5px lightgrey;
    height: 280px;
  }

  body{
    background: #444444;
  }
	</style>
	<script type="text/javascript" src="<?php echo base_url('assets/tool/custom.js'); ?>"></script>
</head>
<body>
  <hr>
  <div style="min-width: 840px;max-width: 850;padding: 10px;" id="outer-div">
      <div style="min-width: 840px;max-width: 850;margin: 0px auto;" id="render-area">
        
      </div>
  </div>
	
	<div class="info-box">
    <div class="info-box-left">
        <h4>Element Box</h4>
        <hr>
        <table class="table">
          <tr>
            <th colspan="2">Design</th>
            <th>
              <select onchange="changeTheme()" class="data-input" name="design" id="design">
                <option value="0">Default</option>
                <option value="1">Design 1</option>
                <option value="2">Design 2</option>
                <option value="3">Design 3</option>
              </select>
            </th>
          </tr>
          <tr>
            <th>
                <input type="radio" onclick="styleNow(this)" name="effect" value="clinic_name">
            </th>
            <th>
                Clinic Name
            </th>
            <th>
              <input onkeyup="updateData()" class="data-input" id="clinic_name" value="Health Care Center" type="text" name="clinic_name">
            </th>
            
          </tr>
          <tr>
            <th>
                <input type="radio" onclick="styleNow(this)" name="effect" value="clinic_address">
            </th>
            <th>
                Clinic Address
            </th>
            <th><textarea onkeyup="updateData()" class="data-input" id="clinic_address" name="clinic_address">HNo-12, Vidyapati nagar desh ratan road, Baridih, Jamshedpur, Jharkhand,831017</textarea></th>
            
          </tr>
          <tr>
            <th>
                <input type="radio" onclick="styleNow(this)" name="effect" value="clinic_contact">
            </th>
            <th>
                Contact No
            </th>
            <th><input onkeyup="updateData()" value="7678411561" id="clinic_contact" class="data-input" type="text" name="clinic_contact"></th>
            
          </tr>
          <tr>
            <th>
                <input type="radio" onclick="styleNow(this)" name="effect" value="clinic_gst">
            </th>
            <th>
                GST No.
            </th>
            <th><input  onkeyup="updateData(this)" value="ZAXXXDDDDDDDDD" class="data-input" type="text" name="clinic_gst" id="clinic_gst"></th>
            
          </tr>
          <tr>
            <th>
                <input type="radio" onclick="styleNow(this)" name="effect" value="logo">
            </th>
            <th>Logo</th>
            <th><input onchange="imagePreview(this)" class="data-input" type="file" name="logo"></th>
          </tr>
          <tr>
            <th>
                <input type="radio" onclick="styleNow(this)" name="effect" value="main-banner">
            </th>
            <th>Banner</th>
            <th></th>
          </tr>
        </table>
    </div>
    <div class="info-box-right">
      <h4>Style Box</h4>
      <hr>
      <table>
        <tr>
          <th>Font Color</th>
          <th><input type="color" onblur="fontColor(this.value)" name="font_color" id="font_color" ></th>
          <th>Background Color</th>
          <th><input type="color" onblur="backgroundColor(this.value)" name="background_color" id="background_color" ></th>
          <th>Border Color</th>
          <th><input type="color" onblur="borderColor(this.value)" name="border_color" id="border_color" ></th>
        </tr>
        <tr>
          <th>Font Size</th>
          <th><input value="10" onkeyup="fontSize(this.value)" type="number" name="font_size" id="font_size" ></th>
          <th>Border Size</th>
          <th><input value="1" onkeyup="borderSize(this.value)" type="number" name="border_size" id="border_size" ></th>
          <th>Border Radius</th>
          <th><input type="number" onkeyup="borderRadius(this.value)" name="border_radius" id="border_radius" ></th>
        </tr>
        <tr>
          <th colspan="6" align="right">
            <button type="button" onclick= "saveImage(1)" style="cursor:pointer;height: 25px;" type="button">Save Changes</button>
            <button type="button" onclick= "saveImage(2)" style="cursor:pointer;height: 25px;" type="button">Save Exit</button>
            <button type="button" onclick= "closeNow()" style="cursor:pointer;height: 25px;" type="button">Close Now</button>
          </th>
        </tr>
      </table>
    </div>
    
	</div>
  

</body>
</html>
<style type="text/css">
	.info-box{
		width: 100%;
		height: fit-content;
		/*border: 1px solid black;*/
    margin-top: 50px;
    background: white;
    /*padding: 20px;*/
    clear: both;
	}
	.data-input{
		width: 100%;
	}
</style>
<img id="canvasimg" src="" />
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
	console.log(designArray);
	document.getElementById('render-area').innerHTML = designArray[0];

	function changeTheme()
	{
    let design = document.querySelector('#design').value;
    document.getElementById('render-area').innerHTML = designArray[design];
	}
  function  updateData()
  {
    
    let clinic_name = document.querySelector('#clinic_name').value;
    let clinic_address = document.querySelector('#clinic_address').value;
    let clinic_contact = document.querySelector('#clinic_contact').value;
    let gst_no = document.querySelector('#clinic_gst').value;
    console.log(clinic_name);
    document.querySelector('.clinic_name').innerHTML = clinic_name;
    document.querySelector('.clinic_address').innerHTML = clinic_address;
    document.querySelector('.clinic_contact').innerHTML = clinic_contact;
    document.querySelector('.clinic_gst').innerHTML = gst_no;
  }
  let selectedElement = '';
  function styleNow(elem)
  {
    selectedElement = elem.value;
    console.log(selectedElement);
  }
  function fontColor(color)
  {
    document.querySelector('.'+selectedElement).style.color = color;
  }

  function backgroundColor(color)
  {
    document.querySelector('.'+selectedElement).style.background = color;
  }
  let border_color = '';
  let border_size = 0;
  function borderColor(color)
  {
    border_color = color;
    console.log(border_color);
    document.querySelector('.'+selectedElement).style.border = border_size+'px solid '+border_color;
  }

  function borderSize(size)
  {
    border_size = size;
    console.log(border_color);
    document.querySelector('.'+selectedElement).style.border = border_size+'px solid '+border_color;
  }

  function fontSize(size)
  {
    document.querySelector('.'+selectedElement).style.fontSize  = size+'px';
  }

  function borderRadius(size)
  {
    document.querySelector('.'+selectedElement).style.borderRadius  = size+'px';
  }

  function bannerColor(color)
  {
    document.querySelector('.'+selectedElement).style.background  = color;
  }

	function imagePreview(src)
	{
		var ext = src.files[0]['name'].substring(src.files[0]['name'].lastIndexOf('.') + 1).toLowerCase();
		if (src.files && src.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
		{
		    var reader = new FileReader();
		    reader.onload = function (e) {
		        document.querySelector('.logo').src = e.target.result;
		    }

		    reader.readAsDataURL(src.files[0]);
		}else
		{
			console.log(src.files[0])
			document.querySelector('.logo').src = '/assets/no_preview.png';
		}
	}

function saveImage(action)
{
    html2canvas(document.querySelector("#outer-div"),{ proxy: this._proxyURL,
          allowTaint: true,useCORS:true}).then(canvas => {
           // document.querySelector("#render-area").appendChild(canvas);
           let images = canvas.toDataURL().split('data:image/png;base64,')[1];
           $.ajax({
            type:'POST',
            url:'<?php echo base_url(); ?>Tool/submitImage',
            data:{images:images},
            success:function(res)
            {
              console.log(res);
              res = JSON.parse(res);
              if(res.response_code==200)
              {
                swal('success','Successfully Saved','success');
                if(action==2)
                {
                  window.location.href ='<?php echo base_url('Tool/toolGallery'); ?>';
                }
              }else
              {
                swal('error','something went wwrong try again after some time','error');
              }
              
            }
           })
    });
}


function closeNow() {
  window.location.href ='<?php echo base_url('Tool/toolGallery'); ?>';
}
	





</script>
