

<?php $__env->startSection('content'); ?>
    <section class="mb-5" style="margin-top: 2rem;">
        <div class="container">
            <!-- Banner -->
            <?php
                $lang = get_system_language()->code;
                $todays_deal_banner = get_setting('todays_deal_banner', null, $lang);
                $todays_deal_banner_small = get_setting('todays_deal_banner_small', null, $lang);
            ?>
            <?php if($todays_deal_banner != null || $todays_deal_banner_small != null): ?>
                <div class="mb-4 overflow-hidden hov-scale-img d-none d-md-block">
                    <img src="<?php echo e(static_asset('assets/img/placeholder-rect.jpg')); ?>" 
                        data-src="<?php echo e(uploaded_asset($todays_deal_banner)); ?>" 
                        alt="<?php echo e(env('APP_NAME')); ?> promo" class="lazyload img-fit h-100 has-transition" 
                        onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/placeholder-rect.jpg')); ?>';">
                </div>
                <div class="mb-4 overflow-hidden hov-scale-img d-md-none">
                    <img src="<?php echo e(static_asset('assets/img/placeholder-rect.jpg')); ?>" 
                        data-src="<?php echo e($todays_deal_banner_small != null ? uploaded_asset($todays_deal_banner_small) : uploaded_asset($todays_deal_banner)); ?>" 
                        alt="<?php echo e(env('APP_NAME')); ?> promo" class="lazyload img-fit h-100 has-transition" 
                        onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/placeholder-rect.jpg')); ?>';">
                </div>
            <?php endif; ?>
            <!-- Products Section -->
            <div class="px-3">
                <div class="row row-cols-xxl-6 row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 gutters-16 border-top border-left">
                    <?php $__currentLoopData = $todays_deal_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col text-center border-right border-bottom has-transition hov-shadow-out z-1">
                            <?php echo $__env->make('frontend.'.get_setting('homepage_select').'.partials.product_box_1',['product' => $product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u536896586/domains/axvero.in/public_html/resources/views/frontend/todays_deal.blade.php ENDPATH**/ ?>