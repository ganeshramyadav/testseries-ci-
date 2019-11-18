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
        background-color: #352817;
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

    #prevBtn {
        background-color: #bbbbbb;
    }

    /* Make circles that indicate the steps of the form: */
    .step {
        height: 2em;
        width: 2em;
        margin: 0 7%;
        background-color: #f29e55;
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
        background-color: #f29e55;
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
</style>
<h3 class="heading-3">Student's Form</h3>
<form id="regForm" action="/action_page.php">
    <!-- Circles which indicates the steps of the form: -->
    <div class="rows" style="text-align:center;">
        <div class="col-md-4 col-sm-4">
            <span class="wizard-span">
                <span class="step"></span>
                <div>Account Info</div>
            </span>
        </div>
        <div class="col-md-4 col-sm-4">
            <span class="wizard-span">
                <span class="step"></span>
                <div>Otp</div>
            </span>
        </div>
        <div class="col-md-4 col-sm-4">
            <span class="wizard-span">
                <span class="step"></span>
                <div>Personal Info</div>
            </span>
        </div>
        <!-- <div class="col-md-3 col-sm-3">
            <span style="height: 2em; width: 2em; margin: 0 3%;">
                <span class="step"></span>
                <div>Account Info</div>
            </span>
        </div> -->
    </div>
    <div class="tabStudent">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <input type="text" placeholder="E-mail..." class="form-control required" value="" id="email" name="email" aria-required="true">
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Phone..." class="form-control required" value="" id="phone" name="phone" aria-required="true">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Password..." class="form-control required" value="" id="pword" name="pword" aria-required="true">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Confirm Password..." class="form-control required" value="" id="conf_pword" name="conf_pword" aria-required="true">
                    </div>
                </div>
            </div>
        </div>
        <!-- 
        <p><input placeholder="E-mail..." oninput="this.className = ''" name="email"></p>
        <p><input placeholder="Phone..." oninput="this.className = ''" name="phone"></p>
        <p><input placeholder="Password..." oninput="this.className = ''" name="pword" type="password"></p>
        <p><input placeholder="Confirm Password..." oninput="this.className = ''" name="conf_pword" type="password"></p>
         -->
    </div>
    <div class="tabStudent">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <input type="text" placeholder="Enter Otp..." class="form-control required" value="" id="otp" name="otp" aria-required="true">
                        <!-- <button type="button" id="resend" onclick="reSend()">Resend</button> -->
                    </div>
                    <div class="form-group">
                        <!-- <input type="text" placeholder="Enter Otp..." class="form-control required" value="" id="otp" name="otp" aria-required="true"> -->
                        <button type="button" id="resend" onclick="reSend()" style="float: right;">Resend</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- <p><input placeholder="Enter Otp..." oninput="this.className = ''" name="otp"></p> -->

    </div>
    <div class="tabStudent">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="role" style="color:white;">Full Name</label>
                        <input type="text" placeholder="Enter Full Name..." class="form-control required" value="" id="fname" name="fname" aria-required="true">
                        <!-- <button type="button" id="resend" onclick="reSend()">Resend</button> -->
                    </div>
                    <div class="form-group">
                        <label for="role" style="color:white;">Gender</label>
                        <select class="form-control required" id="role" name="role">
                            <option value="0">Select Gender</option>
                            <?php
                            if (!empty($gender)) {
                                foreach ($gender as $rl) {
                            ?>
                                    <option value="<?php echo $rl->id ?>"><?php echo $rl->name ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <!-- <input type="text" placeholder="Enter Otp..." class="form-control required" value="" id="otp" name="otp" aria-required="true"> -->
                        <!-- <button type="button" id="resend" onclick="reSend()" style="float: right;">Resend</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div style="overflow:auto;">
                <div style="float:right;">
                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                    <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                </div>
            </div>

        </div>
    </div>

</form>


<script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

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
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
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
            if (y[i].value == "") {
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
</script>

<!-- 
    <form id="example-advanced-form" action="#">
    <h3>Account</h3>
    <fieldset>
        <legend>Account Information</legend>
 
        <label for="userName-2">User name *</label>
        <input id="userName-2" name="userName" type="text" class="required">
        <label for="password-2">Password *</label>
        <input id="password-2" name="password" type="text" class="required">
        <label for="confirm-2">Confirm Password *</label>
        <input id="confirm-2" name="confirm" type="text" class="required">
        <p>(*) Mandatory</p>
    </fieldset>
 
    <h3>Profile</h3>
    <fieldset>
        <legend>Profile Information</legend>
 
        <label for="name-2">First name *</label>
        <input id="name-2" name="name" type="text" class="required">
        <label for="surname-2">Last name *</label>
        <input id="surname-2" name="surname" type="text" class="required">
        <label for="email-2">Email *</label>
        <input id="email-2" name="email" type="text" class="required email">
        <label for="address-2">Address</label>
        <input id="address-2" name="address" type="text">
        <label for="age-2">Age (The warning step will show up if age is less than 18) *</label>
        <input id="age-2" name="age" type="text" class="required number">
        <p>(*) Mandatory</p>
    </fieldset>
 
    <h3>Warning</h3>
    <fieldset>
        <legend>You are to young</legend>
 
        <p>Please go away ;-)</p>
    </fieldset>
 
    <h3>Finish</h3>
    <fieldset>
        <legend>Terms and Conditions</legend>
 
        <input id="acceptTerms-2" name="acceptTerms" type="checkbox" class="required"> <label for="acceptTerms-2">I agree with the Terms and Conditions.</label>
    </fieldset>
</form>

 <form id="example-form" action="#">
    <div>
        <h3>Account</h3>
        <section>
            <label for="userName">User name *</label>
            <input id="userName" name="userName" type="text" class="required">
            <label for="password">Password *</label>
            <input id="password" name="password" type="text" class="required">
            <label for="confirm">Confirm Password *</label>
            <input id="confirm" name="confirm" type="text" class="required">
            <p>(*) Mandatory</p>
        </section>
        <h3>Profile</h3>
        <section>
            <label for="name">First name *</label>
            <input id="name" name="name" type="text" class="required">
            <label for="surname">Last name *</label>
            <input id="surname" name="surname" type="text" class="required">
            <label for="email">Email *</label>
            <input id="email" name="email" type="text" class="required email">
            <label for="address">Address</label>
            <input id="address" name="address" type="text">
            <p>(*) Mandatory</p>
        </section>
        <h3>Hints</h3>
        <section>
            <ul>
                <li>Foo</li>
                <li>Bar</li>
                <li>Foobar</li>
            </ul>
        </section>
        <h3>Finish</h3>
        <section>
            <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required"> <label for="acceptTerms">I agree with the Terms and Conditions.</label>
        </section>
    </div>
</form>

-->