<div class="modal-body px-4 py-5 c-scrollbar-light">
    <!-- Item added to your cart -->
    <div class="text-center text-success mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36">
            <g id="Group_23957" data-name="Group 23957" transform="translate(-6269 7766)">
              <path id="Path_28713" data-name="Path 28713" d="M12.8,32.8a3.6,3.6,0,1,0,3.6,3.6A3.584,3.584,0,0,0,12.8,32.8ZM2,4V7.6H5.6l6.471,13.653-2.43,4.41A3.659,3.659,0,0,0,9.2,27.4,3.6,3.6,0,0,0,12.8,31H34.4V27.4H13.565a.446.446,0,0,1-.45-.45.428.428,0,0,1,.054-.216L14.78,23.8H28.19a3.612,3.612,0,0,0,3.15-1.854l6.435-11.682A1.74,1.74,0,0,0,38,9.4a1.8,1.8,0,0,0-1.8-1.8H9.587L7.877,4H2ZM30.8,32.8a3.6,3.6,0,1,0,3.6,3.6A3.584,3.584,0,0,0,30.8,32.8Z" transform="translate(6267 -7770)" fill="#85b567"/>
              <rect id="Rectangle_18068" data-name="Rectangle 18068" width="9" height="3" rx="1.5" transform="translate(6284.343 -7757.879) rotate(45)" fill="#fff"/>
              <rect id="Rectangle_18069" data-name="Rectangle 18069" width="3" height="13" rx="1.5" transform="translate(6295.657 -7760.707) rotate(45)" fill="#fff"/>
            </g>
        </svg>
        <h3 class="fs-28 fw-500"><?php echo e(translate('Item added to your cart!')); ?></h3>
    </div>

    <!-- Product Info -->
    <div class="media mb-1">
        <img src="<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>" data-src="<?php echo e(uploaded_asset($product->thumbnail_img)); ?>"
            class="mr-4 lazyload size-90px img-fit rounded-0" alt="Product Image" onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>';">
        <div class="media-body mt-2 text-left d-flex flex-column justify-content-between">
            <h6 class="fs-14 fw-700 text-truncate-2">
                <?php echo e($product->getTranslation('name')); ?>

            </h6>
            <div class="row mt-2">
                <div class="col-sm-3 fs-14 fw-400 text-secondary">
                    <div><?php echo e(translate('Price')); ?></div>
                </div>
                <div class="col-sm-9">
                    <div class="fs-16 fw-700 text-primary">
                        <strong>
                            <?php echo e(single_price(cart_product_price($cart, $product, false) * $cart->quantity)); ?>

                        </strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related product -->
    <div class="bg-white shadow-sm">
        <div class="py-3">
            <h3 class="fs-16 fw-700 mb-0 text-dark">
                <span class="mr-4"><?php echo e(translate('Frequently Bought Together')); ?></span>
            </h3>
        </div>
        <div class="p-3">
            <div class="aiz-carousel gutters-5 half-outside-arrow" data-items="2" data-xl-items="3" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true' data-infinite='true'>
                <?php $__currentLoopData = get_frequently_bought_products($product); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $related_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="carousel-box hov-scale-img hov-shadow-sm">
                    <div class="aiz-card-box my-2 has-transition">
                        <div class="">
                            <a href="<?php echo e(route('product', $related_product->slug)); ?>" class="d-block">
                                <img class="img-fit lazyload mx-auto h-140px h-md-200px has-transition"
                                    src="<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>"
                                    data-src="<?php echo e(uploaded_asset($related_product->thumbnail_img)); ?>"
                                    alt="<?php echo e($related_product->getTranslation('name')); ?>"
                                    onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>';">
                            </a>
                        </div>
                        <div class="p-md-3 p-2 text-center">
                            <h3 class="fw-400 fs-14 text-dark text-truncate-2 lh-1-4 mb-0 h-35px">
                                <a href="<?php echo e(route('product', $related_product->slug)); ?>" class="d-block text-reset hov-text-primary"><?php echo e($related_product->getTranslation('name')); ?></a>
                            </h3>
                            <div class="fs-14 mt-3">
                                <span class="fw-700 text-primary"><?php echo e(home_discounted_base_price($related_product)); ?></span>
                                <?php if(home_base_price($related_product) != home_discounted_base_price($related_product)): ?>
                                    <del class="fw-600 opacity-50 ml-1"><?php echo e(home_base_price($related_product)); ?></del>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <!-- Back to shopping & Checkout buttons -->
    <div class="row gutters-5">
        <div class="col-sm-6">
            <button class="btn btn-secondary-base mb-3 mb-sm-0 btn-block rounded-0 text-white" data-dismiss="modal"><?php echo e(translate('Back to shopping')); ?></button>
        </div>
        <div class="col-sm-6">
            <a href="<?php echo e(route('cart')); ?>" class="btn btn-primary mb-3 mb-sm-0 btn-block rounded-0"><?php echo e(translate('Proceed to Checkout')); ?></a>
        </div>

    </div>
</div>
<?php /**PATH /home/u536896586/domains/axvero.in/public_html/resources/views/frontend/partials/cart/addedToCart.blade.php ENDPATH**/ ?>