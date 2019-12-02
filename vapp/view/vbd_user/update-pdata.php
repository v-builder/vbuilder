

<form id="vbd_user_pdata-vbd-update-form" class="vbd-form-gen" name="vbd_user_pdata-vbd-update-form" action="#!" method="post">

    <div class="container">

            <div class="row">
               <div class="col-12 mb-2">
                   <p class="form-title-item">Personal Data</p>
               </div>
                


                <div class="col-12 col-md-6 col-lg-4 vbd-input-w mt-3">
 <div class="md-formx vbd-md-formx ">

                    <label for="vbd_at_id">Account data type</label>

     <select class="form-control d-block " id='vbd_at_id' name='vbd_at_id' required>
         <option></option>
     </select>
                </div> 
  
                </div>

                <div class="col-12 col-md-6 col-lg-4 vbd-input-w mt-3">

                    <div class="md-formx vbd-md-form ">

                        <label for="gender_pdata">Gender</label>


                        <select class="form-control d-block " id='gender_pdata' name='gender' >
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>

                </div>

                <div class="col-12 col-md-6 col-lg-4 vbd-input-w mt-3">

                    <div class="md-formx vbd-md-form ">

                        <label for="user_bdate">Birthdate</label>


                        <input type="date" name="user_bdate" id="user_bdate" class="validatex form-control" />
                    </div>

                </div>

                <div class="col-12 col-md-6 col-lg-4 vbd-input-w mt-3">
 <div class="md-form vbd-md-form "> 

                    <label for="usp_label_value">Company/School</label>

                    <input placeholder="Company" name="usp_label_value" type="text" class="validate form-control">

                </div> 
  
                </div>


                <div class="col-12 col-md-6 col-lg-4 vbd-input-w mt-3">
                    <div class="md-form vbd-md-form ">

                    <label for="usp_type_value">Ocupation/Course</label>

                    <input placeholder="Ocupation" name="usp_type_value" type="text" class="validate form-control" >

                </div>
                </div>


                <div class="col-12 col-md-6 vbd-input-w mt-3">

 <div class="md-formx vbd-md-form ">

                    <label for="phone_code">Phone Code</label>

     <select class="form-control d-block" id='phone_code' name='phone_code' searchable="Search here..." >
         <option></option>
     </select>


                </div> 
  
                </div>


                <div class="col-12 col-md-6 vbd-input-w mt-3">
 <div class="md-formx vbd-md-form ">

     <label for="phone_number">Phone Number</label>

     <div class="input-group mb-3 md-formx">
         <div class="input-group-prepend">
             <span class="input-group-text" id="phone_code_h">+258</span>
         </div>
         <input id="phone_number" name="phone_number" minlength="5" type="number" class="validate form-control" >
     </div>

                </div> 
  
                </div>


                <div class="col-12 col-md-6 vbd-input-w mt-3">
 <div class="md-form vbd-md-form "> 

                    <label for="phone_number_alt">Alternative Phone Nr</label>

                    <input placeholder="Number" name="phone_number_alt" type="text" class="validate form-control" >

                </div> 
  
                </div>


                <div class="col-12 col-md-6 vbd-input-w mt-3">
 <div class="md-formx vbd-md-form ">

                    <label for="phone_shown">Nr Shown</label>


     <select class="form-control d-block" id='phone_shown' name='phone_shown'>
         <option value="def">Default</option>
         <option value="alt">Alt</option>
     </select>
                </div> 
  
                </div>





                <div class="col-12 vbd-input-w mt-3">
 <div class="md-form vbd-md-form ">

                    <label for="about_pdata">About</label>

     <textarea  placeholder="About you" rows="3" id="about_pdata" name="about" type="text" class="validate md-textarea form-control" ></textarea>
                </div>

                </div>


                <div class="col-12 vbd-input-w mt-3">
 <div class="md-form vbd-md-form ">

                    <label for="bio">Bio</label>

     <textarea  placeholder="Your bio" rows="5" id="bio_pdata" name="bio" type="text" class="validate md-textarea form-control" ></textarea>

                </div>

                </div>

                <div class="col-12">
                    <button class="vbd-btn-submit btn-md btn btn-primary  btn-fw  mt-2 ml-0">Update</button>
                    <!--                loading img-->
                    <div class="vbd-submition-loader">
                        <div class="vbd-submition-loader-in">
                        </div>
                    </div>

                </div>
            </div>




    </div>

</form>
