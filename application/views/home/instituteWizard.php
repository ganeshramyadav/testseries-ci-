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
<h3 class="heading-3">Institute's Form</h3>
