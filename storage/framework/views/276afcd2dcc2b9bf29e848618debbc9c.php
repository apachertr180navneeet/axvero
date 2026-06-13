

<?php $__env->startSection('content'); ?>
    <div class="position-relative">
        <div class="position-absolute" id="particles-js"></div>
        <div class="position-relative container">
            <!-- Breadcrumb -->
            <section class="pt-4 mb-4">
                    <div class="row">
                        <div class="col-lg-6 text-center text-lg-left">
                            <h1 class="fw-700 fs-20 fs-md-24 text-dark"><?php echo e(translate('Flash Deals')); ?></h1>
                        </div>
                        <div class="col-lg-6">
                            <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                                <li class="breadcrumb-item has-transition opacity-60 hov-opacity-100">
                                    <a class="text-reset" href="<?php echo e(route('home')); ?>">
                                        <?php echo e(translate('Home')); ?>

                                    </a>
                                </li>
                                <li class="text-dark fw-600 breadcrumb-item">
                                    "<?php echo e(translate('Flash Deals')); ?>"
                                </li>
                            </ul>
                        </div>
                    </div>
            </section>
            <input type="hidden" id="selected_homepage" value="<?php echo e(get_setting('homepage_select')); ?>">
            <!-- Banner -->
            <?php if(get_setting('flash_deal_banner') != null || get_setting('flash_deal_banner_small') != null): ?>
                <div class="mb-3 overflow-hidden hov-scale-img d-none d-md-block">
                    <img src="<?php echo e(static_asset('assets/img/placeholder-rect.jpg')); ?>" 
                        data-src="<?php echo e(uploaded_asset(get_setting('flash_deal_banner'))); ?>" 
                        alt="<?php echo e(env('APP_NAME')); ?> promo" class="lazyload img-fit h-100 has-transition" 
                        onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/placeholder-rect.jpg')); ?>';">
                </div>
                <div class="mb-3 overflow-hidden hov-scale-img d-md-none">
                    <img src="<?php echo e(static_asset('assets/img/placeholder-rect.jpg')); ?>" 
                        data-src="<?php echo e(get_setting('flash_deal_banner_small') != null ? uploaded_asset(get_setting('flash_deal_banner_small')) : uploaded_asset(get_setting('flash_deal_banner'))); ?>" 
                        alt="<?php echo e(env('APP_NAME')); ?> promo" class="lazyload img-fit h-100 has-transition" 
                        onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/placeholder-rect.jpg')); ?>';">
                </div>
            <?php endif; ?>
            <!-- All flash deals -->
            <section class="mb-4">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3 gutters-16">
                    <?php $__currentLoopData = $all_flash_deals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col py-3 h-400px h-xl-475px">
                        <a href="<?php echo e(route('flash-deal-details', $single->slug)); ?>" target="_blank" rel="noopener noreferrer">
                            <div class="h-100 w-100 position-relative hov-scale-img">
                                <div class="position-absolute overflow-hidden h-100 w-100">
                                    <img src="<?php echo e(uploaded_asset($single->banner)); ?>" class="img-fit h-100 has-transition"  
                                                        onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>';">
                                </div>
                                <div class="py-5 px-2 px-lg-3 px-xl-5 absolute-top-left w-100">
                                    <div class="bg-white">
                                        <div class="aiz-count-down-circle" end-date="<?php echo e(date('Y/m/d H:i:s', $single->end_date)); ?>"></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </section>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        AIZ.plugins.particles();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u536896586/domains/axvero.in/public_html/resources/views/frontend/flash_deal/all_flash_deal_list.blade.php ENDPATH**/ ?>