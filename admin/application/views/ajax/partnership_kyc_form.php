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
            <input type="text" placeholder="Primary Partner Aadhar" class="form-control" name="primary_partner_aadhar_no" id="primary_partner_aadhar_no">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <input type="text" placeholder="Primary Partner PAN" class="form-control" name="primary_partner_pan_no" id="primary_partner_pan_no">
        </div>
    </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>Primary Partner Aadhar <span style="color: red;">* PDF</span></label>
      <input type="file" onchange="imageTobase64('primary_partner_adhar_document')" name="primary_partner_adhar_document" accept="application/pdf" id="primary_partner_adhar_document" >
      <input type="hidden"  name="hdn_primary_partner_adhar_document" id="hdn_primary_partner_adhar_document">
      <span><i title="Primary Partner Aadhar" class="zmdi zmdi-help-outline"></i></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Primary Partner PAN <span style="color: red;">* PDF</span></label>
      <input type="file" accept="application/pdf" onchange="imageTobase64('primary_partner_pan_document')" name="primary_partner_pan_document" id="primary_partner_pan_document" >
      <input type="hidden" name="hdn_primary_partner_pan_document" id="hdn_primary_partner_pan_document">
      <span><i title="Primary Partner PAN" class="zmdi zmdi-help-outline"></i></span>
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
    <div class="col-md-4">
        <div class="form-group">
          <label>GST Certificate <span style="color: red;">* PDF</span></label>
           <input onchange="imageTobase64('gst_certificate')" placeholder="GST Certificate" accept="application/pdf" title="GST Certificate" type="file" name="gst_certificate" id="gst_certificate">
           <input type="hidden" name="hdn_gst_certificate" id="hdn_gst_certificate">
          <span><i title="GST Certificate" class="zmdi zmdi-help-outline"></i></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
          <label>Self Declaration <span style="color: red;">* PDF</span></label>
           <input onchange="imageTobase64('self_declaration_document')" placeholder="Self Declaration" accept="application/pdf" title="Self Declaration Copy" type="file" name="self_declaration_document" id="self_declaration_document">
           <input type="hidden" name="hdn_self_declaration_document" id="hdn_self_declaration_document">
          <span><i title="Self Declaration" class="zmdi zmdi-help-outline"></i></span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
           <input type="text" placeholder="Business PAN" name="business_pan" class="form-control" id="business_pan">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
           <input type="text" name="gst_no" placeholder="GST No." class="form-control" id="gst_no">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
           <input type="text" placeholder="Registration No." name="registration_no" class="form-control" id="registration_no">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
          <label>Partnership Deed<span style="color: red;">* PDF</span></label>
           <input onchange="imageTobase64('partnership_deed')" placeholder="Partnership Deed" accept="application/pdf" title="Partnership Deed" type="file" name="partnership_deed" id="partnership_deed">
           <input type="hidden" name="hdn_partnership_deed" id="hdn_partnership_deed">
          <span><i title="Partnership Deed" class="zmdi zmdi-help-outline"></i></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
          <label>Business PAN <span style="color: red;">* PDF</span></label>
           <input onchange="imageTobase64('business_pan_document')" placeholder="Business PAN" accept="application/pdf" title="Business PAN" type="file" name="business_pan_document" id="business_pan_document">
           <input type="hidden" name="hdn_business_pan_document" id="hdn_business_pan_document">
          <span><i title="Self Declaration" class="zmdi zmdi-help-outline"></i></span>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
           <input onkeyup="addPartners(this.value)" placeholder="No. Of Partners" title="No. Of Partners" class="form-control" type="number" name="no_of_par">
        </div>
    </div>
</div>
<input type="hidden" name="partners_count" id="partners_count">
<div class="row" id="partners_name_area">
</div>

