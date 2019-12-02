



<form name="vbd_newsletter-vbd-updatefdata-form" class="vbd-form-gen" action="#!" method="post" >
    <div class="container">

        <div class="row">
            <div class="col-12 mb-2">
                <p class="form-title-item">Update Newsletter</p>
            </div>
            
<!--
                <div class='col-12 vbd-input-w mt-3'> 
 <div class='md-form vbd-md-form '> 

                    <label for='ns_date'>Ns Date</label>  

                    <input placeholder='Ns Date' name='ns_date' type='text' class='validate form-control'  required > 

                </div> 
  
                </div> -->


                <div class='col-12 vbd-input-w mt-3'> 
 <div class='md-form vbd-md-form '> 

                    <label for='ns_subject'>Subject</label>

                    <input placeholder='Subject' name='ns_subject' type='text' class='validate form-control'  required >

                </div> 
  
                </div>



            <div class="col-12 vbd-input-w mt-3">
                <div class="md-form vbd-md-form ">

                    <label for="ns_body">Body</label>


                    <textarea rows="4" placeholder="Body" name="ns_body" class="validate form-control" required=""></textarea>

                </div>

            </div>


            <div class="col-12 vbd-input-w mt-3">
                <div class="md-form vbd-md-form ">

                    <label for="ns_altbody">Alt body</label>

                    <textarea rows="4" placeholder="Alt body" name="ns_altbody" class="validate form-control" required=""></textarea>

                </div>

            </div>


            <div class="col-12 vbd-input-w mt-3">
                <div class="md-form vbd-md-form ">

                    <label for="ns_cleanbody">Clean body</label>
                    <textarea rows="4" placeholder="Clean body" name="ns_cleanbody" class="validate form-control" required=""></textarea>

                </div>

            </div>


                <div class='col-12 vbd-input-w mt-3'> 
 <div class='md-form vbd-md-form '> 

                    <label for='ns_attach'>Ns Attach</label>  

                    <input placeholder='Ns Attach' name='ns_attach[]' type='file' class='validate form-control'  multiple > 
                            <!--  // for uploaded files  -->
                            <div class="row"
                                 id="vbd_newsletter-ns_attach-update-vbd-upd">

                            </div>
                            
                </div> 
  
                </div> 



                <div class='col-12 vbd-input-w mt-3'> 
 <div class='md-form vbd-md-form '> 

                    <label for='ns_cover'>Ns Cover</label>  

                    <input placeholder='Ns Cover' name='ns_cover[]' type='file' class='validate form-control'  multiple > 
                            <!--  // for uploaded files  -->
                            <div class="row"
                                 id="vbd_newsletter-ns_cover-update-vbd-upd">

                            </div>
                            
                </div> 
  
                </div> 


                <div class='col-12 vbd-input-w mt-3'> 
 <div class='md-form vbd-md-form '> 

                    <label for='ns_pdf'>Ns Pdf</label>  

                    <input placeholder='Ns Pdf' name='ns_pdf[]' type='file' class='validate form-control'  multiple > 
                            <!--  // for uploaded files  -->
                            <div class="row"
                                 id="vbd_newsletter-ns_pdf-update-vbd-upd">

                            </div>
                            
                </div> 
  
                </div> 

            <div class="col-12">
                <button class="vbd-btn-submit btn-md btn btn-primary  btn-fw mt-2 ml-0">Submit</button>
                <a href="javascript:;" class="vbd-send-vbd_newsletter vbd-btn-submit btn-md btn btn-primary  btn-fw mt-2 ml-2">Send Newsletter</a>
                <!--                loading img-->
                <div class="vbd-submition-loader">
                    <div class="vbd-submition-loader-in">
                    </div>
                </div>

            </div>
        </div>




    </div>

</form>
