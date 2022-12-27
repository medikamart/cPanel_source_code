<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <input title="Business Contact" onkeyup="sendOtp()" type="text" placeholder="Business Contact" class="form-control" id="business_contact" name="business_contact">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <input title="OTP" type="number" onkeyup="verifyOtpMobile()" placeholder="OTP" class="form-control" id="business_contact_otp" name="business_contact_otp">
            <p id="business_contact_error"></p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
           <p><span style="color:blue;cursor: pointer;"><span id="mobile_otp_resend_btn" onclick="sendOtp()">Resend</span></span> (00.<span id="lbl_mobile_otp_timer">00</span> Sec.)</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <input title="Business Email" onkeyup="ValidateEmail();" onblur="sendOtpEmail()" type="text" placeholder="Business Email" class="form-control" id="business_email" name="business_email">
            <p id="email_id-error"></p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <input title="OTP" type="text" onkeyup="verifyOtpEmail()" placeholder="OTP" class="form-control" id="business_email_otp" name="business_email_otp">
            <p id="business_email_error"></p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
           <p><span style="color:blue;cursor: pointer;"><span id="email_otp_resend_btn" onclick="sendOtpEmail()">Resend</span></span> (00.<span id="lbl_email_otp_timer">00</span> Sec.)</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <textarea placeholder="Business Address" class="form-control" name="business_address" id="business_address"></textarea>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <input type="text" placeholder="Owner Name" class="form-control" name="owner_name" id="owner_name">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <input type="text" placeholder="Owner Aadhar" class="form-control" name="aadhar_no" id="aadhar_no">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <input type="text" placeholder="Owner PAN" class="form-control" name="pan_no" id="pan_no">
        </div>
    </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>Owner Aadhar <span style="color: red;">* PDF</span></label>
      <input type="file" onchange="imageTobase64('adhar_document')" name="adhar_document" accept="application/pdf" id="adhar_document" >
      <input type="hidden"  name="hdn_adhar_document" id="hdn_adhar_document">
      <span><i title="Aadhar Image" class="zmdi zmdi-help-outline"></i></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Owner PAN <span style="color: red;">* PDF</span></label>
      <input type="file" accept="application/pdf" onchange="imageTobase64('pan_document')" name="pan_document" id="pan_document" >
      <input type="hidden" name="hdn_pan_document" id="hdn_pan_document">
      <span><i title="Pan Image" class="zmdi zmdi-help-outline"></i></span>
    </div>
  </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
          <label>Shop Image with Bill Board <span style="color: red;">* JPG/PNG</span></label>
           <input placeholder="Shop Image With Billboard" title="Shop Image With Billboard" type="file" accept="image/png,image/jpeg" onchange="imageTobase64('shop_image_with_billboard')" name="shop_image_with_billboard" id="shop_image_with_billboard">
           <input type="hidden" name="hdn_shop_image_with_billboard" id="hdn_shop_image_with_billboard">
           <span><i title="Shop Image With Billboard" class="zmdi zmdi-help-outline"></i></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
          <label>Address Type</label>
           <select placeholder="Address Type" onchange="addressType(this.value)" class="form-control" title="Address Type" name="address_type" id="address_type">
            <option value="2">Renter</option>
            <option value="1">Owner</option>
           </select>
        </div>
    </div>
    <div id="rent_agreement_area" class="col-md-4">
        <div class="form-group">
          <label>Rent Agreement <span style="color: red;">* PDF</span></label>
           <input placeholder="Rent Agreement" accept="application/pdf" onchange="imageTobase64('rent_agreement')" title="Rent Agreement" type="file" name="rent_agreement" id="rent_agreement">
           <input type="hidden" name="hdn_rent_agreement" id="hdn_rent_agreement">
           <span><i title="Rent Agreement" class="zmdi zmdi-help-outline"></i></span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
          <label>Electricity Bill <span style="color: red;">* PDF</span></label>
           <input onchange="imageTobase64('electricity_bill')" placeholder="Electricity Bill" accept="application/pdf" title="Electricity Bill" type="file" name="electricity_bill" id="electricity_bill">
           <input type="hidden" name="hdn_electricity_bill" id="hdn_electricity_bill">
          <span><i title="Electricity Bill" class="zmdi zmdi-help-outline"></i></span>
        </div>
    </div>
</div>

