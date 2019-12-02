




<form name="vbd_rp-vbd-self-verify-form" action="#!" method="post">

            <div class="row">
               <div class="col-12 mb-2">
                   <p class="vbd-text-guide">We sent a code confirmation to your email <strong class="vbd-verify-email"></strong>. Insert it and reset your password </p>
               </div>


                <div class="col-12  mt-3">

                    <div class="input-group mb-3 md-form">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">VBD-</span>
                        </div>
                        <input placeholder="XXXXX" min="10000" max="99999" id="rp_code" name="rp_code" type="number" class="validate form-control" required="">
                    </div>

                </div>

                <div class="col-12">
                    <button class="vbd-btn-submit btn-md btn btn-primary  btn-fw mt-2 ml-0 btn-blockx">Verify</button>
                <div class="vbd-submition-loader">
                    <div class="vbd-submition-loader-in">
                    </div>
                </div>

                    <p class="vbd-text-guide mt-3"> Code not working?  <a data-toggle="tab" href="#self-rp-request" role="tab" aria-controls=""
                            aria-selected="true">Request again</a>  </p>

                </div>
            </div>

</form>
