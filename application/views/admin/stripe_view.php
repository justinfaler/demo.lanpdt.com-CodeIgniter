<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/stripe.css'); ?>" media="all" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.noconflict.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.payment.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/stripe.js"); ?>"></script>

<form method="post" action="<?= base_url('admin/dashboard/place_order'); ?>" id="payment-form">
		<div class="row checkout-section">
			
			<div class="col-md-5 col-sm-5 product-section">
				<div class="TogglePanel__Content form-group">
					<div class="form-list" id="payment_form_stripe_cc">
						<div id="stripe-cards-select">
							<div class="card_loader"></div>
							<input type="hidden" name="stripeToken" id="stripe_token">
							<input type="hidden" name="stripe_customer_id" id="stripe_customer_id" value="<?= !empty($stripe_customer_id) ? $stripe_customer_id : ''; ?>">
							<?php $source = !empty($cards[0]->id) ? $cards[0]->id : ''; ?>
							<input type="hidden" name="source" id="source" value="<?= $source; ?>">
							<div class="form-group">
								<label>Contact information</label>
								
								<input type="email" class="form-control" required="" name="email" placeholder="Email" value="">
							</div>
						
							<div id="stripe-cards-select-new" class="new-card" >
								<ol>
									<li>
										<label for="stripe_cc_number" class="district-label_placeholder">Card Number</label>
										<input id="stripe_cc_number" type="tel" x-autocompletetype="cc-number" autocompletetype="cc-number" autocorrect="off" spellcheck="off" autocapitalize="off" placeholder="Card Number" data-stripe="number" size="20" class="form-control" required="">
									</li>
									<li class="district-float">
										<label for="stripe_cc_exp" class="district-label_placeholder">Expiry</label>
										<input id="stripe_cc_exp" type="tel" x-autocompletetype="off" autocompletetype="off" autocorrect="off" spellcheck="off" autocapitalize="off" placeholder="MM / YY" size="5" data-stripe="exp" class="form-control" required="">
									</li>
									<li class="district-float">
										<label for="stripe_cc_cvc" class="district-label_placeholder">CVC</label>
										<input id="stripe_cc_cvc" type="tel" autocomplete="off" autocorrect="off" spellcheck="off" autocapitalize="off" placeholder="CVC" data-stripe="cvc" size="4" maxlength="4" class="form-control" required="">
									</li>
								</ol>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-5 col-sm-12 btn_placeorder">
					<button type="submit" class="btn btn-primary form-control onclick="savepayment();">Place Order</button>
				</div>
			</div>
		</div>
	</form>

<script type="text/javascript">
	

    Stripe.setPublishableKey("<?php echo STRIPE_PUBLISHABLE_KEY; ?>"); 
    (function() {
        district.stripeCc.init('AE,VI,MC,DI');
    })();
    // jQuery("#payment-form").submit(function (e) {
    //     e.preventDefault();
    //     // placeorder();
    // });

    function savepayment(){
    	
        district.stripeCc.paymentSave(placeorder);
    };
    function placeorder(){
        var form = jQuery("#payment-form");
        jQuery('body').prepend('<div class="wait"></div>');
        jQuery.ajax({
            type 	 : "POST",
            url 	 : form.attr("action"),
            data 	 : form.serialize(),
            dataType : "json",
            success  : function(response) {

                // if(response.success == true) {
                //     window.location.href = "<?php echo base_url('thankyou'); ?>?id="+response.id+'&shop='+response.shop;
                // } else {
                //     alert(response.message);
                // }
                // jQuery('body .wait').remove();
            }
        });
    }
</script>