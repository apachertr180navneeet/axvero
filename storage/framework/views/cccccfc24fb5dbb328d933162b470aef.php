<style>
.modern-pay {
    width: 100%;
    cursor: pointer;
}

.modern-pay input {
    display: none;
}

.modern-pay-box {
    display: flex;
    align-items: center;
    padding: 16px 18px;
    border-radius: 12px;
    border: 1px solid #e4e6eb;
    background: #fff;
    transition: all 0.25s ease;
    position: relative;
}

.modern-pay-box:hover {
    border-color: #ff6a00;
    box-shadow: 0 4px 14px rgba(0,0,0,0.06);
}

/* Left Icon Circle */
.modern-icon {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: #fff4ec;
    color: #ff6a00;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    margin-right: 14px;
}

/* Text */
.modern-text span {
    font-weight: 600;
    font-size: 15px;
    display: block;
}

.modern-text small {
    font-size: 12px;
    color: #777;
}

/* Check icon */
.modern-check {
    margin-left: auto;
    color: #ff6a00;
    font-size: 18px;
    opacity: 0;
}

/* Selected state */
.modern-pay input:checked + .modern-pay-box {
    border: 2px solid #ff6a00;
    background: #fff9f4;
}

.modern-pay input:checked + .modern-pay-box .modern-check {
    opacity: 1;
}
</style>

<div class="mb-4 d-none">
    <?php
    $cod_on = 0;
?>
    <h3 class="fs-16 fw-700 text-dark">
        <?php echo e(translate('Any additional info?')); ?>

    </h3>
    <textarea name="additional_info" rows="5" class="form-control rounded-0"
        placeholder="<?php echo e(translate('Type your text...')); ?>"></textarea>
</div>
<div class="col-xl-4 col-md-6 pb-4">
    <div class="d-flex align-items-center justify-content-between">
        <div>
        
            <span class="fw-700 text-success fs-13">
                <?php echo e(translate('Extra Discount')); ?>

            </span>
        </div>

      <label class="switch">
    <input type="checkbox" id="online_pay_toggle" <?php echo e(($carts->isNotEmpty() && $carts->first()->is_online_pay == 1) ? 'checked' : ''); ?>>
    <span class="slider round"></span>
</label>
    </div>
</div>

<input type="radio" name="payment_option" value="online_pay" id="online_pay_radio" class="d-none">



    <div class="row gutters-10">
<?php $__currentLoopData = get_activate_payment_methods(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-xl-4 col-md-6">
        <label class="modern-pay">
            <input value="<?php echo e($payment_method->name); ?>"
                   type="radio"
                   name="payment_option">

            <div class="modern-pay-box">
                <div class="modern-icon">
                      <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M2 5C2 3.9 2.9 3 4 3H20C21.1 3 22 3.9 22 5V19C22 20.1 21.1 21 20 21H4C2.9 21 2 20.1 2 19V5ZM4 7H20V5H4V7ZM4 11V19H20V11H4ZM6 15H10V17H6V15Z"/>
                    </svg>
                </div>
                <div class="modern-text">
                    <span>Online Pay</span>
                    <small>UPI / Card </small>
                </div>
                <div class="modern-check">
                    <i class="fa fa-check"></i>
                </div>
            </div>
        </label>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    
        <!-- Cash Payment -->
<?php if(get_setting('cash_payment') == 1): ?>
    <?php
        $digital = 0;
        $cod_on = 1;
        foreach ($carts as $cartItem) {
            $product = get_single_product($cartItem['product_id']);
            if ($product['digital'] == 1) {
                $digital = 1;
            }
            if ($product['cash_on_delivery'] == 0) {
                $cod_on = 0;
            }
        }

        // Agent membership check
        $hasAgentMembership = false;
        if (Auth::check()) {
            $hasAgentMembership = \App\Models\AgentJoin::where('user_id', auth()->id())
                                    ->where('payment_status', 'success')
                                    ->exists();
        }
    ?>


        <div class="col-xl-4 col-md-6" id="cod_block">
            <label class="aiz-megabox d-block mb-3">
                <input value="cash_on_delivery" id="cod_option" class="online_payment" type="radio" name="payment_option">
                <span class="d-flex align-items-center justify-content-between aiz-megabox-elem rounded-0 p-3">
                    <span class="d-block fw-400 fs-14"><?php echo e(translate('Cash on Delivery')); ?></span>
                    <span class="rounded-1 h-40px w-70px overflow-hidden">
                        <img src="<?php echo e(static_asset('assets/img/cards/cod.png')); ?>"
                        class="img-fit h-100">
                    </span>
                </span>
            </label>
        </div>


<?php endif; ?>

        
        
        <?php if(Auth::check() && Auth::user()->is_bulk_buyer && $cod_on == 1): ?>
            <div class="col-12">
                <div class="alert alert-warning border" style="border-color: #ffc107 !important; background-color: #fff3cd;">
                    <div class="d-flex align-items-start">
                        <i class="las la-info-circle fs-20 mr-2" style="color: #856404;"></i>
                        <div style="color: #856404;">
                            <strong><?php echo e(translate('Bulk Buyer Notice:')); ?></strong>
                            <?php echo e(translate('As a bulk buyer, when you select Cash on Delivery, you will be required to pay 30% advance payment through PayU gateway. The remaining 70% will be paid upon delivery.')); ?>

                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if(Auth::check()): ?>
            <!-- Offline Payment -->
            <?php if(addon_is_activated('offline_payment')): ?>
                <?php $__currentLoopData = get_all_manual_payment_methods(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-xl-4 col-md-6">
                        <label class="aiz-megabox d-block mb-3">
                            <input value="<?php echo e($method->heading); ?>" type="radio"
                                name="payment_option" class="offline_payment_option"
                                onchange="toggleManualPaymentData(<?php echo e($method->id); ?>)"
                                data-id="<?php echo e($method->id); ?>" checked>
                            <span class="d-flex align-items-center justify-content-between aiz-megabox-elem rounded-0 p-3">
                                <span class="d-block fw-400 fs-14"><?php echo e($method->heading); ?></span>
                                <span class="rounded-1 h-40px w-70px overflow-hidden">
                                    <img src="<?php echo e(uploaded_asset($method->photo)); ?>"
                                    class="img-fit h-100">
                                </span>
                            </span>
                        </label>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php $__currentLoopData = get_all_manual_payment_methods(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div id="manual_payment_info_<?php echo e($method->id); ?>" class="d-none">
                        <?php echo $method->description ?>
                        <?php if($method->bank_info != null): ?>
                            <ul>
                                <?php $__currentLoopData = json_decode($method->bank_info); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e(translate('Bank Name')); ?> -
                                        <?php echo e($info->bank_name); ?>,
                                        <?php echo e(translate('Account Name')); ?> -
                                        <?php echo e($info->account_name); ?>,
                                        <?php echo e(translate('Account Number')); ?> -
                                        <?php echo e($info->account_number); ?>,
                                        <?php echo e(translate('Routing Number')); ?> -
                                        <?php echo e($info->routing_number); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <!-- Offline Payment Fields -->
    <?php if(addon_is_activated('offline_payment') && count(get_all_manual_payment_methods())>0): ?>
        <div class="d-none mb-3 rounded border bg-white p-3 text-left">
            <div id="manual_payment_description">

            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label><?php echo e(translate('Transaction ID')); ?> <span
                            class="text-danger">*</span></label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control mb-3" name="trx_id" onchange="stepCompletionPaymentInfo()"
                        id="trx_id" placeholder="<?php echo e(translate('Transaction ID')); ?>"
                        required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label"><?php echo e(translate('Photo')); ?></label>
                <div class="col-md-9">
                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                        <div class="input-group-prepend">
                            <div class="input-group-text bg-soft-secondary font-weight-medium">
                                <?php echo e(translate('Browse')); ?></div>
                        </div>
                        <div class="form-control file-amount"><?php echo e(translate('Choose image')); ?>

                        </div>
                        <input type="hidden" name="photo" class="selected-files">
                    </div>
                    <div class="file-preview box sm">
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Wallet Payment -->
    <?php if(Auth::check() && get_setting('wallet_system') == 1): ?>
        <div class="py-4 px-4 text-center bg-soft-secondary-base mt-4">
            <div class="fs-14 mb-3">
                <span class="opacity-80"><?php echo e(translate('Or, Your wallet balance :')); ?></span>
                <span class="fw-700"><?php echo e(single_price(Auth::user()->balance)); ?></span>
            </div>
            <?php if(Auth::user()->balance < $total): ?>
                <button type="button" class="btn btn-secondary" disabled>
                    <?php echo e(translate('Insufficient balance')); ?>

                </button>
            <?php else: ?>
                <button type="button" onclick="use_wallet()"
                    class="btn btn-primary fs-14 fw-700 px-5 rounded-0">
                    <?php echo e(translate('Pay with wallet')); ?>

                </button>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH /home/u536896586/domains/axvero.in/public_html/resources/views/frontend/partials/cart/payment_info.blade.php ENDPATH**/ ?>