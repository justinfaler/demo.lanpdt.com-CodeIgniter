var district = district || {};
district.stripeCc = function($) {
    var self = {},
        $inputs = {},
        inputsStr = "",
        address = {},
        cardsMap = {
            AE: "amex",
            DI: "discover",
            DC: "dinersclub",
            JCB: "jcb",
            MC: "mastercard",
            VI: "visa"
        },
        allowedCards = [];
    return self.init = function(enabledCards) {
        self.setupEnabledCards(enabledCards), self.initVars(), self.createInputMasks(), self.paymentMethodListener(), self.toggleNewCard(), self.cardValidationListener(), self.paymentController()
    }, self.paymentController = function() {
        $("body").on("keyup", inputsStr, self.frontendKeyup);
    }, $.fn.toggleInputError = function(valid) {
        return this.val().length && this.parent().toggleClass("district-has-error", !valid), this
    }, self.toggleNewCard = function() {
        $inputs.savedCard.change(function() {
            $inputs.savedCard.parent().removeClass("district-label-active").end().filter($(this)).parent().addClass("district-label-active"), "" === $(this).val() ? ($("#stripe-cards-select-new").show(), self.newTokenRequired() && self.disableContinueBtn(!0), self.isIE() || $inputs.cardNumber.focus()) : ($("#stripe-cards-select-new").hide(), self.disableContinueBtn(!1))
        })
    }, self.paymentMethodListener = function() {
        self.newTokenRequired() && self.disableContinueBtn(!0), $("input[name=payment\\[method\\]]").click(function() {
            self.disableContinueBtn(!0)
        })
    }, self.initVars = function() {
        $inputs.cardNumber = $("input#stripe_cc_number"), $inputs.cardExpiry = $("input#stripe_cc_exp"), $inputs.cardCVC = $("input#stripe_cc_cvc"), $inputs.cardToken = $("input#stripe_token"), $inputs.savedCard = $("input[name=stripeSavedCard]"), $inputs.continueBtn = $(".complete_order button:first"), inputsStr = "input#stripe_cc_number, input#stripe_cc_exp, input#stripe_cc_cvc", self.tokenValues = {
            cardNumber: 0,
            cardExpiry: 0,
            cardCVC: 0
        }
    }, self.createInputMasks = function() {
        $inputs.cardNumber.payment("formatCardNumber"), $inputs.cardExpiry.payment("formatCardExpiry"), $inputs.cardCVC.payment("formatCardCVC")
    }, self.frontendKeyup = function() {
        self.disableContinueBtn(!0), self.delay(self.cardEntryListener, 750), self.showLabel($(this))
    }, self.showLabel = function($el) {
        $el.parents("li").toggleClass("district-show_label", !!$el.val().length)
    }, self.delay = function() {
        var timer = 0;
        return function(callback, ms) {
            clearTimeout(timer), timer = setTimeout(callback, ms)
        }
    }(), self.cardEntryListener = function() {
        self.validCard() && ($("#payment_form_stripe_cc .district-has-error").removeClass("district-has-error"), self.newTokenRequired() ? self.createToken() : self.disableContinueBtn(!1))
    }, self.cardValidationListener = function() {
        $("body").on("blur", "input#stripe_cc_number", function() {
            $(this).toggleInputError(self.validateCardNumber())
        }), $("body").on("blur", "input#stripe_cc_exp", function() {
            $(this).toggleInputError(self.validateCardExpiry())
        }), $("body").on("blur", "input#stripe_cc_cvc", function() {
            $(this).toggleInputError(self.validateCardCVC())
        })
    }, self.disableContinueBtn = function(state) {
        $inputs.continueBtn.prop("disabled", state).toggleClass("disabled", state)
    }, self.validCard = function() {
        return self.validateCardNumber() && self.validateCardExpiry() && self.validateCardCVC() ? !0 : !1
    }, self.validateCardNumber = function() {
        var cardNumber = $.trim($inputs.cardNumber.val()),
            valid = !1;
        return "" !== cardNumber && cardNumber.replace(/ /g, "").length > 12 && (valid = $.payment.validateCardNumber(cardNumber)), valid
    }, self.validateCardExpiry = function() {
        var cardExpiry = $.trim($inputs.cardExpiry.val()),
            valid = !1;
        return "" !== cardExpiry && cardExpiry.length > 6 && (valid = $.payment.validateCardExpiry($.payment.cardExpiryVal(cardExpiry))), valid
    }, self.validateCardCVC = function() {
        var cardCVC = $.trim($inputs.cardCVC.val()),
            valid = !1;
        return "" !== cardCVC && cardCVC.length > 2 && (valid = $.payment.validateCardCVC(cardCVC, $.payment.cardType($inputs.cardNumber.val()))), valid
    }, self.newTokenRequired = function() {
        return $.trim($inputs.cardNumber.val()) !== self.tokenValues.cardNumber || $.trim($inputs.cardExpiry.val()) !== self.tokenValues.cardExpiry || $.trim($inputs.cardCVC.val()) !== self.tokenValues.cardCVC ? !0 : !1
    }, self.setupEnabledCards = function(enabledCards) {
        var enabledCardsArr = enabledCards.split(",");
        $.each(cardsMap, function(mageKey, stripeKey) {
            $.inArray(mageKey, enabledCardsArr) > -1 && allowedCards.push(stripeKey)
        })
    }, self.paymentDataChange = function(getPaymentData) {
        self.cardEntryListener()
    }, self.paymentSave = function(validateParent) {
        if ("stripe_cc" === "stripe_cc" && $inputs.savedCard.length <= 0 && (null == $inputs.savedCard.val() || "" === $inputs.savedCard.val()) && self.validCard()) {
            var cardType = $.payment.cardType($inputs.cardNumber.val());
            if ($.inArray(cardType, allowedCards) < 0)
                return window.alert("Sorry, " + cardType + " is not currently accepted. Please use a different card."), !1
        }
        validateParent()
    }, self.createToken = function() {
        Stripe.card.createToken({
            number: $inputs.cardNumber.val(),
            exp: $inputs.cardExpiry.val(),
            cvc: $inputs.cardCVC.val(),
            address_country: address.country,
            address_line1: address.line1,
            address_zip: address.zip,
            name: address.name
        }, self.stripeResponseHandler)
    }, self.stripeResponseHandler = function(status, response) {
        200 !== status || response.error ? $("#stripe-cards-select-new").find(".district-error").remove().end().prepend('<p class="district-error">' + response.error.message + "</p>") : ($("#stripe-cards-select-new .district-error").remove(), self.tokenValues.cardNumber = $.trim($inputs.cardNumber.val()), self.tokenValues.cardExpiry = $.trim($inputs.cardExpiry.val()), self.tokenValues.cardCVC = $.trim($inputs.cardCVC.val()), $inputs.cardToken.val(response.id), self.disableContinueBtn(!1))
    }, self.isIE = function() {
        return window.navigator.userAgent.indexOf("MSIE ") > 0 || navigator.userAgent.match(/Trident.*rv\:11\./) ? !0 : !1
    }, self
}(window.district.$ || window.jQuery);