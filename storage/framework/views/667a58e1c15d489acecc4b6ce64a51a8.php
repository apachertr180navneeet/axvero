<div class="z-3 sticky-top-lg">
<div class="card border-0 shadow-lg rounded-4 overflow-hidden">


           <?php
            $subtotal_for_min_order_amount = 0;
            $subtotal = 0;
            $tax = 0;
            $gst = 0;
            $product_shipping_cost = 0;
            $shipping = 0;
            $coupon_code = null;
            $coupon_discount = 0;
            $total_point = 0;
            $has_bulk_product = false;
        
            $agent_discount_total = 0;
            $isAgentMember = false;
            if (Auth::check()) {
                $isAgentMember = \App\Models\AgentJoin::where('user_id', auth()->id())
                                    ->where('payment_status', 'success')
                                    ->exists();
            }
        ?>
        
           <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cartItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $product = get_single_product($cartItem['product_id']);
                if ($cartItem->quantity > 1) {
                    $has_bulk_product = true;
                }
                $subtotal_for_min_order_amount += cart_product_price($cartItem, $cartItem->product, false, false) * $cartItem['quantity'];
                $subtotal += cart_product_price($cartItem, $product, false, false) * $cartItem['quantity'];
                $tax += cart_product_tax($cartItem, $product, false) * $cartItem['quantity'];
                if (addon_is_activated('gst_system')) {
                    $gst += cart_product_gst($cartItem, $product, false);
                }
                $product_shipping_cost = $cartItem['shipping_cost'];
                $shipping += $product_shipping_cost;
                if ((get_setting('coupon_system') == 1) && ($cartItem->coupon_applied == 1)) {
                    $coupon_code = $cartItem->coupon_code;
                    $coupon_discount = $carts->sum('discount');
                }
                if (addon_is_activated('club_point')) {
                    $total_point += $product->earn_point * $cartItem['quantity'];
                }
        
                // Agent discount
                if ($isAgentMember && $product->agent_discount > 0) {
                    $product_price = cart_product_price($cartItem, $product, false, false);
                    $agent_discount_total += ($product_price * $product->agent_discount / 100) * $cartItem['quantity'];
                }
            ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      <div class="card-header bg-white pt-4 pb-3 border-0">
           <h3 class="fs-18 fw-bold mb-1 text-dark"><?php echo e(translate('Order Summary')); ?></h3>
            <div class="text-right">
                <!-- Minimum Order Amount -->
                <?php if(get_setting('minimum_order_amount_check') == 1 && $subtotal_for_min_order_amount < get_setting('minimum_order_amount')): ?>
                    <span class="badge badge-inline badge-warning fs-12 rounded-0 px-2">
                        <?php echo e(translate('Minimum Order Amount') . ' ' . single_price(get_setting('minimum_order_amount'))); ?>

                    </span>
                <?php endif; ?>
            </div>
        </div>

        <div class="card-body pt-2">

            <div class="row gutters-5">
                <!-- Total Products -->
                <div class="<?php if(addon_is_activated('club_point')): ?> col-6 <?php else: ?> col-12 <?php endif; ?>">
                   <div class="d-flex align-items-center justify-content-between bg-primary bg-gradient rounded-3 px-3 py-2 shadow-sm">
                        <span class="fs-13 text-white"><?php echo e(translate('Total Products')); ?></span>
                        <span class="fs-13 fw-700 text-white"><?php echo e(sprintf("%02d", count($carts))); ?></span>
                    </div>
                </div>
                <?php if(addon_is_activated('club_point')): ?>
                    <!-- Total Clubpoint -->
                    <div class="col-6">
                        <div class="d-flex align-items-center justify-content-between bg-secondary bg-gradient rounded-3 px-3 py-2 shadow-sm">
                            <span class="fs-13 text-white"><?php echo e(translate('Total Clubpoint')); ?></span>
                            <span class="fs-13 fw-700 text-white"><?php echo e(sprintf("%02d", $total_point)); ?></span>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <input type="hidden" id="sub_total" value="<?php echo e($subtotal); ?>">

            <table class="table table-borderless my-4">
                <tfoot>
                    <!-- Subtotal -->
                    <tr class="cart-subtotal">
                        <th class="pl-0 fs-14 fw-400 pt-0 pb-2 text-dark border-top-0"><?php echo e(translate('Subtotal')); ?> (<?php echo e(sprintf("%02d", count($carts))); ?> <?php echo e(translate('Products')); ?>)</th>
                        <td class="text-right pr-0 fs-14 pt-0 pb-2 text-dark border-top-0"><?php echo e(single_price($subtotal)); ?></td>
                    </tr>
                    
                    <!-- Tax -->
                     <?php if(!addon_is_activated('gst_system')): ?>
                    <tr class="cart-tax">
                        <th class="pl-0 fs-14 fw-400 pt-0 pb-2 text-dark border-top-0"><?php echo e(translate('Tax')); ?></th>
                        <td class="text-right pr-0 fs-14 pt-0 pb-2 text-dark border-top-0"><?php echo e(single_price($tax)); ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if($proceed != 1): ?>
                    <!-- Total Shipping -->
                    <tr class="cart-shipping">
                        <th class="pl-0 fs-14 fw-400 pt-0 pb-2 text-dark border-top-0"><?php echo e(translate('Total Shipping')); ?></th>
                        <td class="text-right pr-0 fs-14 pt-0 pb-2 text-dark border-top-0"><?php echo e(single_price($shipping)); ?></td>
                    </tr>
                    <?php endif; ?>
                    <!-- Redeem point -->
                    <?php if(Session::has('club_point')): ?>
                        <tr class="cart-club-point">
                            <th class="pl-0 fs-14 fw-400 pt-0 pb-2 text-dark border-top-0"><?php echo e(translate('Redeem point')); ?></th>
                            <td class="text-right pr-0 fs-14 pt-0 pb-2 text-dark border-top-0"><?php echo e(single_price(Session::get('club_point'))); ?></td>
                        </tr>
                    <?php endif; ?>
                    <!-- Coupon Discount -->
                    <?php if($coupon_discount > 0): ?>
                        <tr class="cart-coupon-discount">
                            <th class="pl-0 fs-14 fw-400 pt-0 pb-2 text-dark border-top-0"><?php echo e(translate('Coupon Discount')); ?></th>
                            <td class="text-right pr-0 fs-14 pt-0 pb-2 text-dark border-top-0"><?php echo e(single_price($coupon_discount)); ?></td>
                        </tr>
                    <?php endif; ?>
                    
                    <?php if($isAgentMember && $agent_discount_total > 0): ?>
                    <tr class="cart-agent-discount">
                        <th class="pl-0 fs-14 fw-400 pt-0 pb-2 text-success border-top-0">
                            <?php echo e(translate('Membership Discount')); ?>

                        </th>
                        <td class="text-right pr-0 fs-14 pt-0 pb-2 text-success border-top-0">
                            - <?php echo e(single_price($agent_discount_total)); ?>

                        </td>
                    </tr>
                <?php endif; ?>
                    <?php if(addon_is_activated('gst_system')): ?>
                    <!-- Gst -->
                    <tr class="cart-gst">
                        <th class="pl-0 fs-14 fw-400 pt-0 pb-2 text-dark border-top-0"><?php echo e(translate('GST')); ?></th>
                        <td class="text-right pr-0 fs-14 pt-0 pb-2 text-dark border-top-0"><?php echo e(single_price($gst)); ?></td>
                    </tr>
                    <?php endif; ?>

                  <?php
                        $onlinePayDiscountTotal = $carts->sum('online_pay_discount');
                    
                        $total = $subtotal + $tax + $shipping + $gst;
                    
                        if (Session::has('club_point')) {
                            $total -= Session::get('club_point');
                        }
                    
                        if ($coupon_discount > 0) {
                            $total -= $coupon_discount;
                        }
                    
                          if ($isAgentMember && $agent_discount_total > 0) {
             $total -= $agent_discount_total;
                }

 
                    
                        $total -= $onlinePayDiscountTotal;
                    ?>

                  
                <?php if($carts->isNotEmpty() && $carts->first()->is_online_pay == 1 && $onlinePayDiscountTotal > 0): ?>
                    <tr>
                        <th class="pl-0 fs-14 fw-400 text-success">
                            <?php echo e(translate('Online Pay Discount')); ?>

                        </th>
                        <td class="text-right pr-0 fs-14 fw-700 text-success">
                            - <?php echo e(single_price($onlinePayDiscountTotal)); ?>

                        </td>
                    </tr>
                    <?php endif; ?>


                    <!-- Total -->
               <tr class="cart-total border-top pt-3">
                        <th class="pl-0 fs-14 text-dark fw-700 border-top-0 pt-3 text-uppercase"><?php echo e(translate('Total')); ?></th>
                        <td class="text-end fw-bold fs-5 text-primary pt-3"><?php echo e(single_price($total)); ?></td>
                    </tr>
                  <?php if($is_bulk_buyer): ?>
                    <tr>
                        <th class="pl-0 fs-14 fw-400 text-dark">
                            Online Payment (40% via PayU)
                        </th>
                      <td class="text-end fw-bold text-success">
                            <?php echo e(single_price($bulk_online_pay_amount)); ?>

                        </td>
                    </tr>
                    
                    <tr>
                        <th class="pl-0 fs-14 fw-400 text-dark">
                            Cash on Delivery (60%)
                        </th>
                        <td class="text-right pr-0 fs-14 fw-700 text-warning">
                            <?php echo e(single_price($bulk_cod_pay_amount)); ?>

                        </td>
                    </tr>
                    <?php endif; ?>


                </tfoot>
            </table>

            <!-- Coupon System -->
            <?php if(get_setting('coupon_system') == 1): ?>
                <?php if($coupon_discount > 0 && $coupon_code): ?>
                    <div class="mt-3">
                        <form class="" id="remove-coupon-form" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="proceed" value="<?php echo e($proceed); ?>">
                            <div class="input-group">
                                <div class="form-control"><?php echo e($coupon_code); ?></div>
                                <div class="input-group-append">
                                    <button type="button" id="coupon-remove"
                                        class="btn btn-primary"><?php echo e(translate('Change Coupon')); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php else: ?>
                    <div class="mt-3">
                        <form class="" id="apply-coupon-form" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="proceed" value="<?php echo e($proceed); ?>">
                            <div class="input-group">
                                <input type="text" class="form-control rounded-start" name="code"
                                    onkeydown="return event.key != 'Enter';"
                                    placeholder="<?php echo e(translate('Have coupon code? Apply here')); ?>" required>
                                <div class="input-group-append">
                                    <button type="button" id="coupon-apply"
                                        class="btn btn-primary rounded-end px-4"><?php echo e(translate('Apply')); ?></button>
                                </div>
                            </div>
                            <?php if(!auth()->check()): ?>
                                <small><?php echo e(translate('You must Login as customer to apply coupon')); ?></small>
                            <?php endif; ?>

                        </form>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
              
            <?php if($proceed == 1): ?>
            <!-- Continue to Shipping -->
            <div class="mt-4">
                <a href="<?php echo e(route('checkout')); ?>" class="btn btn-primary w-100 fw-bold py-3 rounded-3 shadow-sm">
                    <?php echo e(translate('Proceed to Checkout')); ?> (<?php echo e(sprintf("%02d", count($carts))); ?>)
                </a>
            </div>
            <?php endif; ?>

        </div>
    </div>
</div>
<?php /**PATH /home/u536896586/domains/axvero.in/public_html/resources/views/frontend/partials/cart/cart_summary.blade.php ENDPATH**/ ?>