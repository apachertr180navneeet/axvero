

<?php $__env->startSection('content'); ?>

    <section class="my-4 gry-bg">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-8">
                    <form class="form-default" data-toggle="validator" action="<?php echo e(route('payment.checkout')); ?>" role="form" method="POST" id="checkout-form">
                        <?php echo csrf_field(); ?>
                       <input type="hidden" name="is_online_pay" id="is_online_pay" value="<?php echo e($carts->isNotEmpty() ? $carts->first()->is_online_pay : 0); ?>">


                        <div class="accordion" id="accordioncCheckoutInfo">

                            <!-- Shipping Info -->
                            <div class="card rounded-0 border shadow-none" style="margin-bottom: 2rem;">
                                <div class="card-header border-bottom-0 py-3 py-xl-4" id="headingShippingInfo" type="button" data-toggle="collapse" data-target="#collapseShippingInfo" aria-expanded="true" aria-controls="collapseShippingInfo">
                                    <div class="d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                            <path id="Path_42357" data-name="Path 42357" d="M58,48A10,10,0,1,0,68,58,10,10,0,0,0,58,48ZM56.457,61.543a.663.663,0,0,1-.423.212.693.693,0,0,1-.428-.216l-2.692-2.692.856-.856,2.269,2.269,6-6.043.841.87Z" transform="translate(-48 -48)" fill="#9d9da6"/>
                                        </svg>
                                        <span class="ml-2 fs-19 fw-700"><?php echo e(translate('Shipping Info')); ?></span>
                                    </div>
                                    <i class="las la-angle-down fs-18"></i>
                                </div>
                                <div id="collapseShippingInfo" class="collapse show" aria-labelledby="headingShippingInfo" data-parent="#accordioncCheckoutInfo">
                                    <div class="card-body shadow" id="shipping_info">
                                       <?php echo $__env->make('frontend.partials.cart.shipping_info', ['address_id' => $address_id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Delivery Info -->
                            <div class="card rounded-0 border shadow-none" style="margin-bottom: 2rem; overflow: visible !important;">
                                <div class="card-header border-bottom-0 py-3 py-xl-4" id="headingDeliveryInfo" type="button" data-toggle="collapse" data-target="#collapseDeliveryInfo" aria-expanded="true" aria-controls="collapseDeliveryInfo">
                                    <div class="d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                            <path id="Path_42357" data-name="Path 42357" d="M58,48A10,10,0,1,0,68,58,10,10,0,0,0,58,48ZM56.457,61.543a.663.663,0,0,1-.423.212.693.693,0,0,1-.428-.216l-2.692-2.692.856-.856,2.269,2.269,6-6.043.841.87Z" transform="translate(-48 -48)" fill="#9d9da6"/>
                                        </svg>
                                        <span class="ml-2 fs-19 fw-700"><?php echo e(translate('Delivery Info')); ?></span>
                                    </div>
                                    <i class="las la-angle-down fs-18"></i>
                                </div>
                                <div id="collapseDeliveryInfo" class="collapse show" aria-labelledby="headingDeliveryInfo" data-parent="#accordioncCheckoutInfo">
                                    <div class="card-body" id="delivery_info">
                                        <?php echo $__env->make('frontend.partials.cart.delivery_info', ['carts' => $carts, 'carrier_list' => $carrier_list, 'shipping_info' => $shipping_info], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                </div>
                            </div>
                                      <!-- Cart Summary -->
                        <div class="d-lg-none d-block col-lg-4 mt-4 mt-lg-0" id="cart_summary">
                            <?php echo $__env->make('frontend.partials.cart.cart_summary', ['proceed' => 0, 'carts' => $carts], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div> 

                            <!-- Payment Info -->
                            <div class="card rounded-0 mb-0 border shadow-none">
                                <div class="card-header border-bottom-0 py-3 py-xl-4" id="headingPaymentInfo" type="button" data-toggle="collapse" data-target="#collapsePaymentInfo" aria-expanded="true" aria-controls="collapsePaymentInfo">
                                    <div class="d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                            <path id="Path_42357" data-name="Path 42357" d="M58,48A10,10,0,1,0,68,58,10,10,0,0,0,58,48ZM56.457,61.543a.663.663,0,0,1-.423.212.693.693,0,0,1-.428-.216l-2.692-2.692.856-.856,2.269,2.269,6-6.043.841.87Z" transform="translate(-48 -48)" fill="#9d9da6"/>
                                        </svg>
                                        <span class="ml-2 fs-19 fw-700"><?php echo e(translate('Payment')); ?></span>
                                    </div>
                                    <i class="las la-angle-down fs-18"></i>
                                </div>
                                <div id="collapsePaymentInfo" class="collapse show" aria-labelledby="headingPaymentInfo" data-parent="#accordioncCheckoutInfo">
                                    <div class="card-body" id="payment_info">
                                        <?php echo $__env->make('frontend.partials.cart.payment_info', ['carts' => $carts, 'total' => $total], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                        <!-- Agree Box -->
                                        <div class="pt-2rem px-4 fs-14">
                                            <label class="aiz-checkbox">
                                                <input type="checkbox" required id="agree_checkbox" onchange="stepCompletionPaymentInfo()">
                                                <span class="aiz-square-check"></span>
                                                <span><?php echo e(translate('I agree to the')); ?></span>
                                            </label>
                                            <a href="<?php echo e(route('terms')); ?>"
                                                class="fw-700"><?php echo e(translate('terms and conditions')); ?></a>,
                                            <a href="<?php echo e(route('returnpolicy')); ?>"
                                                class="fw-700"><?php echo e(translate('return policy')); ?></a> &
                                            <a href="<?php echo e(route('privacypolicy')); ?>"
                                                class="fw-700"><?php echo e(translate('privacy policy')); ?></a>
                                        </div>

                                        <div class="row align-items-center px-4 pt-3 mb-4">
                                            <!-- Return to shop -->
                                            <div class="col-6">
                                                <a href="<?php echo e(route('home')); ?>" class="btn btn-link fs-14 fw-700 px-0">
                                                    <i class="las la-arrow-left fs-16"></i>
                                                    <?php echo e(translate('Return to shop')); ?>

                                                </a>
                                            </div>
                                            <!-- Pay Now -->
                                            <!--<div class="col-6 text-right">-->
                                            <!--    <button type="button" onclick="submitOrder(this)" id="submitOrderBtn"-->
                                            <!--        class="btn btn-primary fs-14 fw-700 rounded-0 px-4"><?php echo e(translate('Pay Now')); ?></button>-->
                                            <!--</div>-->
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                      <!-- Cart Summary -->
                <div class="d-none d-lg-block col-lg-4 mt-4 mt-lg-0" id="cart_summary">
                    <?php echo $__env->make('frontend.partials.cart.cart_summary', ['proceed' => 0, 'carts' => $carts], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                </div>
              
            </div>
        </div>

    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
    <!-- Address Modal -->
    <?php if(Auth::check()): ?>
        <?php echo $__env->make('frontend.partials.address.address_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
         <?php echo $__env->make('frontend.partials.address.billing_address_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<style>
    .switch {
    position: relative;
    display: inline-block;
    width: 46px;
    height: 24px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0; left: 0; right: 0; bottom: 0;
    background-color: #ccc;
    transition: .4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: .4s;
}

input:checked + .slider {
    background-color: #28a745;
}

input:checked + .slider:before {
    transform: translateX(22px);
}

.slider.round {
    border-radius: 34px;
}

.slider.round:before {
    border-radius: 50%;
}
 
</style>
<?php $__env->startSection('script'); ?>

<script>
 $(document).ready(function() {
    // Initial setup
    var currentOnlinePay = parseInt($('#is_online_pay').val()) === 1;
    $('#online_pay_toggle').prop('checked', currentOnlinePay);
    toggleCodBlock(currentOnlinePay);

    // Prevent multiple AJAX requests
    let isProcessing = false;

    $('#online_pay_toggle').on('change', function () {
        if (isProcessing) return; // already processing

        let toggle = $(this);
        let enableOnlinePay = toggle.is(':checked');
        let confirmText = enableOnlinePay
            ? 'Do you want to enable Online Payment?'
            : 'Do you want to disable Online Payment?';

        Swal.fire({
            title: 'Confirmation',
            text: confirmText,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (!result.isConfirmed) {
                toggle.prop('checked', !enableOnlinePay);
                return;
            }

            // set processing flag
            isProcessing = true;

            // Update hidden field
            $('#is_online_pay').val(enableOnlinePay ? 1 : 0);

            // Toggle COD block
            toggleCodBlock(enableOnlinePay);

            $.ajax({
                url: "<?php echo e(route('checkout.toggle-online-pay')); ?>",
                type: "POST",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    is_online_pay: enableOnlinePay ? 1 : 0
                },
                success: function (res) {
                    if (res.success && res.html) {
                        $('#cart_summary').html(res.html);
                    } else if(!res.success) {
                        Swal.fire('Error', res.message || 'Something went wrong', 'error');
                        revertToggle();
                    }
                },
                error: function () {
                    Swal.fire('Error', 'Server error. Please try again.', 'error');
                    revertToggle();
                },
                complete: function () {
                    isProcessing = false;
                }
            });

            function revertToggle() {
                toggle.prop('checked', !enableOnlinePay);
                $('#is_online_pay').val(enableOnlinePay ? 0 : 1);
                toggleCodBlock(!enableOnlinePay);
            }
        });
    });

    function toggleCodBlock(onlinePayEnabled) {
        if (onlinePayEnabled) {
            $('#cod_block').hide();
            $('#cod_option').prop('checked', false);
        } else {
            $('#cod_block').show();
        }
    }
});

</script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const IS_BULK_BUYER = <?php echo e(auth()->check() && auth()->user()->is_bulk_buyer == "1" ? 'true' : 'false'); ?>;
    const BULK_ONLINE_PERCENT = 30;
    const BULK_ONLINE_AMOUNT = <?php echo e($bulk_online_pay_amount ?? 0); ?>;
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const codRadio = document.getElementById('cod_option');
  const submitBtn = document.getElementById('submitOrderBtn');

    if (codRadio) {
        codRadio.addEventListener('change', function (event) {

            if (!IS_BULK_BUYER) return;

            event.preventDefault();

            Swal.fire({
                title: 'Bulk Buyer Notice',
                html: `
                    <p>
                        You must pay <b>${BULK_ONLINE_PERCENT}%</b> advance
                        via <b>PayU</b>.
                    </p>
                    <p>
                        Remaining amount will be collected via
                        <b>Cash on Delivery</b>.
                    </p>
                `,
                icon: 'info',
                confirmButtonText: 'Proceed to Pay',
                allowOutsideClick: false
            }).then((result) => {

                if (result.isConfirmed) {

                    fetch("<?php echo e(route('set.bulk.cod')); ?>", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ cod_bulk: true })
                    }).then(() => {

                        // ✅ allow checkout
                        submitBtn.disabled = false;

                        // ✅ force PayU as payment option
                        document.querySelector('input[value="payu"]')?.click();

                        // ✅ submit checkout
                        submitOrder(submitBtn);
                    });
                } else {
                    codRadio.checked = false;
                }
            });
        });
    }

});

</script>

<script>
    document.querySelectorAll('input[name="payment_option"]').forEach(el => {
    el.addEventListener('change', function () {

        if (this.value !== 'cash_on_delivery') {
            fetch("<?php echo e(route('set.bulk.cod')); ?>", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ cod_bulk: false })
            });
        }
    });
});

</script>
    <script type="text/javascript">
       var carrierCount=0;
        $(document).ready(function() {
            $(".online_payment").click(function() {
                $('#manual_payment_description').parent().addClass('d-none');
            });
            toggleManualPaymentData($('input[name=payment_option]:checked').data('id'));
        });

        var minimum_order_amount_check = <?php echo e(get_setting('minimum_order_amount_check') == 1 ? 1 : 0); ?>;
        var minimum_order_amount =
            <?php echo e(get_setting('minimum_order_amount_check') == 1 ? get_setting('minimum_order_amount') : 0); ?>;

        function use_wallet() {
            $('input[name=payment_option]').val('wallet');
            if ($('#agree_checkbox').is(":checked")) {
                ;
                if (minimum_order_amount_check && $('#sub_total').val() < minimum_order_amount) {
                    AIZ.plugins.notify('danger',
                        '<?php echo e(translate('You order amount is less then the minimum order amount')); ?>');
                } else {
                    var allIsOk = false;
                    var isOkShipping = stepCompletionShippingInfo();
                    var isOkDelivery = stepCompletionDeliveryInfo();
                    var isOkPayment = stepCompletionWalletPaymentInfo();
                    if(isOkShipping && isOkDelivery && isOkPayment) {
                        allIsOk = true;
                    }else{
                        AIZ.plugins.notify('danger', '<?php echo e(translate("Please fill in all mandatory fields!")); ?>');
                        $('#checkout-form [required]').each(function (i, el) {
                            if ($(el).val() == '' || $(el).val() == undefined) {
                                var is_trx_id = $('.d-none #trx_id').length;
                                if(($(el).attr('name') != 'trx_id') || is_trx_id == 0){
                                    $(el).focus();
                                    $(el).scrollIntoView({behavior: "smooth", block: "center"});
                                    return false;
                                }
                            }
                        });
                    }

                    if (allIsOk) {
                        $('#checkout-form').submit();
                    }
                }
            } else {
                AIZ.plugins.notify('danger', '<?php echo e(translate('You need to agree with our policies')); ?>');
            }
        }

        function submitOrder(el) {
            $(el).prop('disabled', true);
            if ($('#agree_checkbox').is(":checked")) {
                if (minimum_order_amount_check && $('#sub_total').val() < minimum_order_amount) {
                    AIZ.plugins.notify('danger',
                        '<?php echo e(translate('You order amount is less then the minimum order amount')); ?>');
                } else {
                    var offline_payment_active = '<?php echo e(addon_is_activated('offline_payment')); ?>';
                    if (offline_payment_active == '1' && $('.offline_payment_option').is(":checked") && $('#trx_id')
                        .val() == '') {
                        AIZ.plugins.notify('danger', '<?php echo e(translate('You need to put Transaction id')); ?>');
                        $(el).prop('disabled', false);
                    } else {
                        var allIsOk = false;
                        var isOkShipping = stepCompletionShippingInfo();
                        var isOkDelivery = stepCompletionDeliveryInfo();
                        var isOkPayment = stepCompletionPaymentInfo();
                        if(isOkShipping && isOkDelivery && isOkPayment) {
                            allIsOk = true;
                        }else{
                            AIZ.plugins.notify('danger', '<?php echo e(translate("Please fill in all mandatory fields!")); ?>');
                            $('#checkout-form [required]').each(function (i, el) {
                                if ($(el).val() == '' || $(el).val() == undefined) {
                                    var is_trx_id = $('.d-none #trx_id').length;
                                    if(($(el).attr('name') != 'trx_id') || is_trx_id == 0){
                                        $(el).focus();
                                        $(el).scrollIntoView({behavior: "smooth", block: "center"});
                                        return false;
                                    }
                                }
                            });
                        }

                        if (allIsOk) {
                            $('#checkout-form').submit();
                        }
                    }
                }
            } else {
                AIZ.plugins.notify('danger', '<?php echo e(translate('You need to agree with our policies')); ?>');
                $(el).prop('disabled', false);
            }
        }

        function toggleManualPaymentData(id) {
            if (typeof id != 'undefined') {
                $('#manual_payment_description').parent().removeClass('d-none');
                $('#manual_payment_description').html($('#manual_payment_info_' + id).html());
            }
        }
        // coupon apply
        $(document).on("click", "#coupon-apply", function() {
            <?php if(Auth::check()): ?>
                <?php if(Auth::user()->user_type != 'customer'): ?>
                    AIZ.plugins.notify('warning', "<?php echo e(translate('Please Login as a customer to apply coupon code.')); ?>");
                    return false;
                <?php endif; ?>

                var data = new FormData($('#apply-coupon-form')[0]);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    url: "<?php echo e(route('checkout.apply_coupon_code')); ?>",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data, textStatus, jqXHR) {
                        AIZ.plugins.notify(data.response_message.response, data.response_message.message);
                        $("#cart_summary").html(data.html);
                    }
                });
            <?php else: ?>
                $('#login_modal').modal('show');
            <?php endif; ?>
        });

        // coupon remove
        $(document).on("click", "#coupon-remove", function() {
            <?php if(Auth::check() && Auth::user()->user_type == 'customer'): ?>
                var data = new FormData($('#remove-coupon-form')[0]);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    url: "<?php echo e(route('checkout.remove_coupon_code')); ?>",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data, textStatus, jqXHR) {
                        $("#cart_summary").html(data);
                    }
                });
            <?php endif; ?>
        });

        function updateDeliveryAddress(id, city_id = 0, area_id=0) {
            $('.aiz-refresh').addClass('active');
            $.post('<?php echo e(route('checkout.updateDeliveryAddress')); ?>', {
                _token: AIZ.data.csrf,
                address_id: id,
                city_id: city_id,
                area_id: area_id
            }, function(data) {
                $('#delivery_info').html(data.delivery_info);
                $('#cart_summary').html(data.cart_summary);
                $('.aiz-refresh').removeClass('active');
                carrierCount = data.carrier_count;
                checkCarrerShippingInfo();
            });
           
            AIZ.plugins.bootstrapSelect("refresh");
        }

        function updateBillingAddress(id) {
            $('.aiz-refresh').addClass('active');
            $.post('<?php echo e(route('checkout.updateBillingAddress')); ?>', {
                _token: AIZ.data.csrf,
                billing_address_id: id
            }, function(data) {
                $('.aiz-refresh').removeClass('active');
            });
        }

        function stepCompletionShippingInfo() {
            var headColor = '#9d9da6';
            var btnDisable = true;
            var allOk = false;
            <?php if(Auth::check()): ?>
                var length = $('input[name="address_id"]:checked').length;
                if (length > 0) {
                    headColor = '#15a405';
                    btnDisable = false;
                    allOk = true;
                }
            <?php else: ?>
                var count = 0;
                var length = $('#shipping_info [required]').length;
                $('#shipping_info [required]').each(function (i, el) {
                    if ($(el).val() != '' && $(el).val() != undefined && $(el).val() != null) {
                        count += 1;
                    }
                });
                if (count == length) {
                    headColor = '#15a405';
                    btnDisable = false;
                    allOk = true;
                }
            <?php endif; ?>

            $('#headingShippingInfo svg *').css('fill', headColor);
            $("#submitOrderBtn").prop('disabled', btnDisable);
            return allOk;
        }

        $('#shipping_info [required]').each(function (i, el) {
            $(el).change(function(){
                if ($(el).attr('name') == 'address_id') {
                    updateDeliveryAddress($(el).val());
                    setDefaultshippingAddress();
                    setBillingAddress();
                }
                <?php if(get_setting('shipping_type') == 'area_wise_shipping'): ?>
                    if ($(el).attr('name') == 'city_id') {
                        let country_id = $('select[name="country_id"]').length? $('select[name="country_id"]').val() : $('input[name="country_id"]').val();
                        let city_id = $(this).val();
                        updateDeliveryAddress(country_id, city_id);
                    }
                <?php endif; ?>
                if ($(el).attr('name') == 'billing_address_id') {
                    setBillingAddress(el);
                }
                
                
                stepCompletionShippingInfo();
            });
        });

        $('select[name="area_id"].guest-checkout').change(function () {
            let country_id = $('select[name="country_id"]').length
                ? $('select[name="country_id"]').val()
                : $('input[name="country_id"]').val();
            let city_id = $('select[name="city_id"]').val();
            let area_id = $(this).val();

            if (area_id) {
                updateDeliveryAddress(country_id, city_id, area_id);
            } else {
                updateDeliveryAddress(country_id, city_id);
            }

            stepCompletionShippingInfo();
        });

        function stepCompletionDeliveryInfo() {
            var headColor = '#9d9da6';
            var btnDisable = true;
            var allOk = false;
            var content = $('#delivery_info [required]');
            if (content.length > 0) {
                var content_checked = $('#delivery_info [required]:checked');
                if (content_checked.length > 0) {
                    content_checked.each(function (i, el) {
                        allOk = false;
                        if($(el).val() == 'carrier'){
                            var owner = $(el).attr('data-owner');
                            if ($('input[name=carrier_id_'+owner+']:checked').length > 0) {
                                allOk = true;
                            }
                        }else if($(el).val() == 'pickup_point'){
                            var owner = $(el).attr('data-owner');
                            if ($('select[name="pickup_point_id_'+owner+'"]').val() != '') {
                                allOk = true;
                            }
                        }else{
                            allOk = true;
                        }

                        if(allOk == false) {
                            return false;
                        }
                    });

                    if (allOk) {
                        headColor = '#15a405';
                        btnDisable = false;
                    }
                }
            }else{
                allOk = true
                headColor = '#15a405';
                btnDisable = false;
            }

            $('#headingDeliveryInfo svg *').css('fill', headColor);
            $("#submitOrderBtn").prop('disabled', btnDisable);
            return allOk;
        }

        function updateDeliveryInfo(shipping_type, type_id, user_id, country_id = 0, city_id = 0) {
            <?php if(get_setting('shipping_type') == 'area_wise_shipping' || get_setting('shipping_type') == 'carrier_wise_shipping'): ?>
                country_id = $('select[name="country_id"]').val() != null ? $('select[name="country_id"]').val() : 0;
                city_id = $('select[name="city_id"]').val() != null ? $('select[name="city_id"]').val() : 0;
            <?php endif; ?>
            $('.aiz-refresh').addClass('active');
            $.post('<?php echo e(route('checkout.updateDeliveryInfo')); ?>', {
                _token: AIZ.data.csrf,
                shipping_type: shipping_type,
                type_id: type_id,
                user_id: user_id,
                country_id: country_id,
                city_id: city_id
            }, function(data) {
                $('#cart_summary').html(data);
                checkCarrerShippingInfo();
                stepCompletionDeliveryInfo();
                $('.aiz-refresh').removeClass('active');
            });
            AIZ.plugins.bootstrapSelect("refresh");
        }

        function show_pickup_point(el, user_id) {
        	var type = $(el).val();
        	var target = $(el).data('target');
            var type_id = null;

        	if(type == 'home_delivery' || type == 'carrier'){
                if(!$(target).hasClass('d-none')){
                    $(target).addClass('d-none');
                }
                $('.carrier_id_'+user_id).removeClass('d-none');
        	}else{
        		$(target).removeClass('d-none');
        		$('.carrier_id_'+user_id).addClass('d-none');
        	}

            if(type == 'carrier'){
                type_id = $('input[name=carrier_id_'+user_id+']:checked').val();
            }else if(type == 'pickup_point'){
                type_id = $('select[name=pickup_point_id_'+user_id+']').val();
            }
            updateDeliveryInfo(type, type_id, user_id);
        }

        function stepCompletionPaymentInfo() {
            var headColor = '#9d9da6';
            var btnDisable = true;
            var payment = false;
            var agree = false;
            var allOk = false;
            var length = $('input[name="payment_option"]:checked').length;
            if(length > 0){
                if ($('input[name="payment_option"]:checked').hasClass('offline_payment_option')) {
                    if ($('#trx_id').val() != '' && $('#trx_id').val() != undefined && $('#trx_id').val() != null) {
                        payment = true;
                    }
                } else {
                    payment = true;
                }

                if ($('#agree_checkbox').is(":checked")){
                    agree = true;
                }

                if (payment && agree) {
                    headColor = '#15a405';
                    btnDisable = false;
                    allOk = true;
                }
            }

            $('#headingPaymentInfo svg *').css('fill', headColor);
            $("#submitOrderBtn").prop('disabled', btnDisable);
            return allOk;
        }

        function stepCompletionWalletPaymentInfo() {
            var headColor = '#9d9da6';
            var btnDisable = true;
            var allOk = false;
            if ($('#agree_checkbox').is(":checked")){
                headColor = '#15a405';
                btnDisable = false;
                allOk = true;
            }

            $('#headingPaymentInfo svg *').css('fill', headColor);
            $("#submitOrderBtn").prop('disabled', btnDisable);
            return allOk;
        }

        $('input[name="payment_option"]').change(function(){
            stepCompletionPaymentInfo();
        });

        function checkCarrerShippingInfo(){
           const shippingType = <?php echo json_encode(get_setting('shipping_type'), 15, 512) ?>;
            const isDisabled = carrierCount === 0;
            let carrierSelected = false;
            let pickupSelected = false;
            $('.shipping-type-radio').each(function () {
                if ($(this).is(':checked') && $(this).val() === 'carrier') {
                    carrierSelected = true;
                }
            });
            $('.shipping-type-radio').each(function () {
                if ($(this).is(':checked') && $(this).val() === 'pickup_point') {
                    pickupSelected = true;
                }
            });
                if(shippingType == 'carrier_wise_shipping' && carrierSelected){
                    if (carrierCount === 0) {
                        if( (carrierSelected && pickupSelected) || (carrierSelected && !pickupSelected) ){
                            $('#submitOrderBtn').prop('disabled', true);
                            $('#agree_checkbox').prop('checked', false).prop('disabled', true);
                            $('.online_payment, .offline_payment_option').prop('checked', false).prop('disabled', true);
                        }
                    } else {
                        $('#agree_checkbox').prop('disabled', false);
                        $('.online_payment, .offline_payment_option').prop('disabled', false);
                    }
                }else{
                    $('#agree_checkbox').prop('disabled', false);
                    $('.online_payment, .offline_payment_option').prop('disabled', false);
                }
        }

        $(document).ready(function(){
            carrierCount = parseInt(document.getElementById('carrierCount')?.value || 0);
            checkCarrerShippingInfo();
            stepCompletionShippingInfo();
            stepCompletionDeliveryInfo();
            stepCompletionPaymentInfo();
            
        });

        function changeShippingAddress(){
            $('#choose-address-modal').modal('hide');
        }

        function setDefaultshippingAddress() {
            let checkedAddress = $('input[name="address_id"]:checked');

            if (checkedAddress.length) {

                let selectedText = checkedAddress.closest('label').find('.address-text').html();
                $('#choose-default').html(selectedText);
                $('#default-address-change-btn').attr('onclick', "edit_address('" + checkedAddress.val() + "')");
                $('input[name="billing_address_id"]').first().val(checkedAddress.val());
                let $box = $('#default-address-box');
                if ($box.length) {
                    $box.removeClass('border-danger');
                    checkedAddress.prop('checked', true);
                    checkedAddress.prop('disabled', false);
                    $box.find('#hide-no-longer-div').remove();
                    
                }
            }
        }

        function setBillingAddress(el) {
            let type = $(el).data('type');
            let checkedAddress = $(el);
           if(type === 'billing'){
                let checkedAddress = $('input[name="billing_address_id"]:checked');
                if (checkedAddress.length) {

                    let selectedText = checkedAddress.closest('label').find('.address-text').html();
                    $('#choose-default-billing').html(selectedText);
                    $('#default-address-change-btn').attr('onclick', "edit_billing_address('" + checkedAddress.val() + "')");
                    $('input[name="billing_address_id"]').first().val(checkedAddress.val());
                    let $box = $('#default-billing-address-box');
                    if ($box.length) {
                        $box.removeClass('border-danger');
                        checkedAddress.prop('checked', true);
                        checkedAddress.prop('disabled', false);
                        $box.find('#hide-no-valid-div').remove();
                        
                    }
                }
            } else{
                let checkedAddress = $('input[name="address_id"]:checked');
                if (checkedAddress.length) {
                    let selectedText = checkedAddress.closest('label').find('.address-text').html();
                    $('#choose-default-billing').html(selectedText);
                    $('input[name="billing_address_id"]').first().val(checkedAddress.val());
                }
            }
            updateBillingAddress(checkedAddress.val());
        }


    </script>

    <?php echo $__env->make('frontend.partials.address.address_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(get_active_countries()->count() == 1): ?>
    <script>
        $(document).ready(function() {
            <?php if(get_setting('has_state') == 1): ?>
                get_states(<?php echo json_encode(get_active_countries()[0]->id, 15, 512) ?>);
                <?php if(get_setting('billing_address_required') == 1): ?>
                  get_billing_states(<?php echo json_encode(get_active_countries()[0]->id, 15, 512) ?>);
                <?php endif; ?>
            <?php else: ?>
                get_city_by_country(<?php echo json_encode(get_active_countries()[0]->id, 15, 512) ?>);
                <?php if(get_setting('billing_address_required') == 1): ?>
                  get_billing_city_by_country(<?php echo json_encode(get_active_countries()[0]->id, 15, 512) ?>);
                <?php endif; ?>
            <?php endif; ?>
        });
         <?php if(get_setting('shipping_type') == 'carrier_wise_shipping' && !Auth::check() ): ?>
            updateDeliveryAddress(<?php echo e(get_active_countries()[0]->id); ?>);
         <?php endif; ?>
         
         document.querySelectorAll('input[name="payment_option"]').forEach(function(el) {
            el.addEventListener('change', function() {

                setTimeout(function() {
        
                    if (!$('#agree_checkbox').is(':checked')) {
                        AIZ.plugins.notify('danger', 'You need to agree with our policies');
                        return;
                    }
        
                    if (
                        stepCompletionShippingInfo() &&
                        stepCompletionDeliveryInfo() &&
                        stepCompletionPaymentInfo()
                    ) {
                        submitOrder(document.createElement('button'));
                    }
        
                }, 150);

                 });
         });


        $(document).on('click', 'input[name="payment_option"]', function (e) {
        
            if (!$('#agree_checkbox').is(':checked')) {
        
                e.preventDefault(); 
                e.stopImmediatePropagation();
        
                AIZ.plugins.notify('danger', '<?php echo e(translate("You need to agree with our policies")); ?>');
        
                return false;
            }
        
        });
    </script>
    <?php endif; ?>

    <?php if(get_setting('google_map') == 1): ?>
        <?php echo $__env->make('frontend.partials.google_map', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u536896586/domains/axvero.in/public_html/resources/views/frontend/checkout.blade.php ENDPATH**/ ?>