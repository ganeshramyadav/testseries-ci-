<style>
    #Students {
        padding-bottom: 12px !important;
        border-radius: 12px;
        background-color: #35281787 !important;
        display: block;
    }

    .heading-3 {
        text-align: center !important;
        font-weight: 800;
        color: white !important;
    }

    #regForm {
        /* background-color: #ffffff; */
        /* margin: 100px auto;
        font-family: Raleway;
        padding: 40px;
        width: 70%;
        min-width: 300px; */
    }

    input {
        padding: 10px;
        width: 100%;
        font-size: 17px;
        font-family: Raleway;
        border: 1px solid #aaaaaa;
    }

    .form-control {
        border-radius: 12px !important;
        /* background-color: #1d1a1838  !important; */
    }


    /* Mark input boxes that gets an error on validation: */
    input.invalid {
        background-color: #ffdddd;
        background-color: #fd39393b !important;
    }

    /* Hide all steps by default: */
    .tabStudent {
        display: none;
    }

    button {
        background-color: #3c8dbc;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        font-size: 17px;
        font-family: Raleway;
        cursor: pointer;
        border-radius: 15px;
    }

    button:hover {
        opacity: 0.8;
    }

    /* Make circles that indicate the steps of the form: */
    .step {
        height: 2em;
        width: 2em;
        margin: 0 7%;
        background-color:#204d74;
        border: none;
        border-radius: 50%;
        display: inline-block;
        opacity: 0.5;
    }

    .step.active {
        opacity: 1;
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
        background-color: #204d74;
    }

    >option {
        border-radius: 30px;
    }

    .wizard-span{
        height: 2em; 
        width: 2em; 
        margin: 0 3%;
        color:white;
    }
    .text-color{
        color: black;
        width: 101%;
    }
</style>
<!-- <h3 class="heading-3">Student's Form</h3> -->
<form id="regForm" action="<?php echo base_url(); ?>registerMe" method="post" onsubmit="return mySubmit()">
    <!-- Circles which indicates the steps of the form: -->
    <div class="rows" style="text-align:center;">
        <div class="col-md-4 col-sm-4">
            <span class="wizard-span">
                <span class="step"></span>
                <div class="text-color">Account Info</div>
            </span>
        </div>
        <div class="col-md-4 col-sm-4">
            <span class="wizard-span">
                <span class="step"></span>
                <div class="text-color">Otp</div>
            </span>
        </div>
        <div class="col-md-4 col-sm-4">
            <span class="wizard-span">
                <span class="step"></span>
                <div class="text-color">Personal Info</div>
            </span>
        </div>
    </div>
    <div class="tabStudent">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <input type="email" required onblur="myEmail()" placeholder="E-mail..." class="form-control required" value="" id="email" name="email" aria-required="true">
                    </div>
                    <div class="form-group">
                        <input type="text" required onblur="myContact()" maxlength="10" minlength="10" placeholder="Phone..." class="form-control required" value="" id="phone" name="phone" aria-required="true">
                    </div>
                    <div class="form-group">
                        <input type="password" required  minlength="6" placeholder="Password..." class="form-control required" value="" id="pword" name="pword" aria-required="true">
                    </div>
                    <div class="form-group">
                        <input type="password" required onblur="myPwd()" minlength="6" placeholder="Confirm Password..." class="form-control required" value="" id="conf_pword" name="conf_pword" aria-required="true">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tabStudent">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <input type="text" required onblur="myOtp()" placeholder="Enter Otp..." class="form-control required" style="width: 69%; float: left;" value="" id="otp" name="otp" aria-required="true">
                        <button type="button" id="resend" onclick="reSend()" style="float: right;">Resend</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tabStudent">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <div class="row">
                            
                            <div class="col-md-12 col-sm-12">
                                <select class="form-control required" required style="" onchange="myReg()" id="regType" name="regType">
                                    <option value="0">Select...</option>
                                    <option value="1">Student</option>
                                    <option value="2">Institute</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="studentsform">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <input type="text" placeholder="Enter Full Name..."  class="form-control required" value="" id="fName" name="fName" aria-required="true">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <select class="form-control required" id="gender" name="gender" >
                                        <option value="0">Select Gender</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="institutesform">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <input type="text" placeholder="Institute Name..." class="form-control required" value="" id="insName" name="insName" aria-required="true">
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <input type="text" placeholder="Institute Address..." class="form-control required" value="" id="insAdd" name="insAdd" aria-required="true">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <input type="text" placeholder="GSTN Number..." class="form-control required" value="" id="insGstn" name="insGstn" aria-required="true">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <input type="text" maxlength="10" minlength="10" placeholder="Office Contact Number..." class="form-control required" value="" id="insContact" name="insContact" aria-required="true">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <input type="text" placeholder="Office Email Id..." class="form-control required" value="" id="insEmail" name="insEmail" aria-required="true">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="btn btn-primary btn-block btn-flat">Previous</button>
        </div>
        <div class="col-md-4 col-sm-4"></div>
        <div class="col-md-4 col-sm-4">
            <button type="button" id="nextBtn" onclick="nextPrev(1)" class="btn btn-primary btn-block btn-flat">Next</button>
        </div>
    </div>
</form>


<script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab
    myReg();
    
    // document.getElementById("nextBtn").hide();
    document.getElementById("nextBtn").style.display = "none";
    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tabStudent");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        
        myReg();
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    function myReg(){
        var regType = document.getElementById("regType").value;
        var _btnText =   document.getElementById("nextBtn").innerHTML;
        if(document.getElementById("regType").value == 0 && _btnText === 'Submit'){
            document.getElementById("nextBtn").disabled = true;
        }else{
            document.getElementById("nextBtn").disabled = false;
        }
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
       
        var x = document.getElementsByClassName("tabStudent");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("regForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tabStudent");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tabStudent:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "" && y[i].required == true) {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }

    function myContact()
    {
        var inputtxt = document.getElementById("phone").value;
        var phoneno = /^\d{10}$/;
        if(inputtxt.match(phoneno))
        {
            return true;
        } else {
            document.getElementById("phone").value = "";
            return false;
        }
    }

    function myEmail(){
        var email = document.getElementById("email").value;
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))
        {
            return (true);
        }
        document.getElementById("email").value = "";
        return (false);
    }

    function myPwd(){
        var pwd = document.getElementById("pword").value;
        var confPwd = document.getElementById("conf_pword").value;
        if((pwd === confPwd) && (confPwd !='undefined' && confPwd!='') && (pwd !='undefined' && pwd !='') ){
            document.getElementById("nextBtn").style.display = "inline";
            // alert("true");
        }
        else{
            document.getElementById("nextBtn").style.display = "none";
            // alert("false");
        }
    }

    function myOtp(){
        var otp = document.getElementById("otp").value;
        document.getElementById("nextBtn").style.display = "none";
        if(otp != "" && otp != "undefined"){
            // alert(otp);
            document.getElementById("nextBtn").style.display = "inline";
        }else {
            alert(otp);
            // return ("false");
        }
    }

    function mySubmit(){
        alert("Submited.");
    }

</script>

