<div class="modal-body px-4 py-5 c-scrollbar-light">
    <div class="row">
        <!-- Product Image gallery -->
        <div class="col-lg-6">
            <div class="row gutters-10 flex-row-reverse">
                <?php
                    $photos = explode(',',$product->photos);
                ?>
                <div class="col">
                    <div class="aiz-carousel product-gallery" data-nav-for='.product-gallery-thumb' data-fade='true' data-auto-height='true'>
                        <?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="carousel-box img-zoom rounded-0">
                            <img class="img-fluid lazyload"
                                src="<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>"
                                data-src="<?php echo e(uploaded_asset($photo)); ?>"
                                onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>';">
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $product->stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($stock->image != null): ?>
                                <div class="carousel-box img-zoom rounded-0">
                                    <img class="img-fluid lazyload"
                                        src="<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>"
                                        data-src="<?php echo e(uploaded_asset($stock->image)); ?>"
                                        onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>';">
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="col-auto w-90px">
                    <div class="aiz-carousel carousel-thumb product-gallery-thumb" data-items='5' data-nav-for='.product-gallery' data-vertical='true' data-focus-select='true'>
                        <?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="carousel-box c-pointer border rounded-0">
                            <img class="lazyload mw-100 size-60px mx-auto"
                                src="<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>"
                                data-src="<?php echo e(uploaded_asset($photo)); ?>"
                                onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>';">
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $product->stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($stock->image != null): ?>
                                <div class="carousel-box c-pointer border rounded-0" data-variation="<?php echo e($stock->variant); ?>">
                                    <img class="lazyload mw-100 size-50px mx-auto"
                                        src="<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>"
                                        data-src="<?php echo e(uploaded_asset($stock->image)); ?>"
                                        onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>';">
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-lg-6">
            <div class="text-left">
                <!-- Product name -->
                <h2 class="mb-2 fs-16 fw-700 text-dark">
                    <?php echo e($product->getTranslation('name')); ?>

                </h2>

                <!-- Product Price & Club Point -->
                <?php if(home_price($product) != home_discounted_price($product)): ?>
                    <div class="row no-gutters mt-3">
                        <div class="col-3">
                            <div class="text-secondary fs-14 fw-400"><?php echo e(translate('Price')); ?></div>
                        </div>
                        <div class="col-9">
                            <div class="">
                                <strong class="fs-16 fw-700 text-primary">
                                    <?php echo e(home_discounted_price($product)); ?>

                                </strong>
                                <del class="fs-14 opacity-60 ml-2">
                                    <?php echo e(home_price($product)); ?>

                                </del>
                                <?php if($product->unit != null): ?>
                                    <span class="opacity-70 ml-1">/<?php echo e($product->getTranslation('unit')); ?></span>
                                <?php endif; ?>
                                <?php if(discount_in_percentage($product) > 0): ?>
                                    <span class="bg-primary ml-2 fs-11 fw-700 text-white w-35px text-center px-2" style="padding-top:2px;padding-bottom:2px;">-<?php echo e(discount_in_percentage($product)); ?>%</span>
                                <?php endif; ?>
                            </div>

                            <!-- Club Point -->
                            <?php if(addon_is_activated('club_point') && $product->earn_point > 0): ?>
                            <div class="mt-2 bg-secondary-base d-flex justify-content-center align-items-center px-3 py-1" style="width: fit-content;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                    <g id="Group_23922" data-name="Group 23922" transform="translate(-973 -633)">
                                      <circle id="Ellipse_39" data-name="Ellipse 39" cx="6" cy="6" r="6" transform="translate(973 633)" fill="#fff"/>
                                      <g id="Group_23920" data-name="Group 23920" transform="translate(973 633)">
                                        <path id="Path_28698" data-name="Path 28698" d="M7.667,3H4.333L3,5,6,9,9,5Z" transform="translate(0 0)" fill="#f3af3d"/>
                                        <path id="Path_28699" data-name="Path 28699" d="M5.33,3h-1L3,5,6,9,4.331,5Z" transform="translate(0 0)" fill="#f3af3d" opacity="0.5"/>
                                        <path id="Path_28700" data-name="Path 28700" d="M12.666,3h1L15,5,12,9l1.664-4Z" transform="translate(-5.995 0)" fill="#f3af3d"/>
                                      </g>
                                    </g>
                                </svg>
                                <small class="fs-11 fw-500 text-white ml-2"><?php echo e(translate('Club Point')); ?>: <?php echo e($product->earn_point); ?></small>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="row no-gutters mt-3">
                        <div class="col-3">
                            <div class="text-secondary fs-14 fw-400"><?php echo e(translate('Price')); ?></div>
                        </div>
                        <div class="col-9">
                            <div class="">
                                <strong class="fs-16 fw-700 text-primary">
                                    <?php echo e(home_discounted_price($product)); ?>

                                </strong>
                                <?php if($product->unit != null): ?>
                                    <span class="opacity-70">/<?php echo e($product->unit); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php
                    $qty = 0;
                    foreach ($product->stocks as $key => $stock) {
                        $qty += $stock->qty;
                    }
                ?>

                <!-- Product Choice options form -->
                <form id="option-choice-form">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" value="<?php echo e($product->id); ?>">
                    
                    <?php if($product->digital !=1): ?>
                        <!-- Product Choice options -->
                        <?php if($product->choice_options != null): ?>
                            <?php $__currentLoopData = json_decode($product->choice_options); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $choice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <div class="row no-gutters mt-3">
                                    <div class="col-3">
                                        <div class="text-secondary fs-14 fw-400 mt-2 "><?php echo e(get_single_attribute_name($choice->attribute_id)); ?></div>
                                    </div>
                                    <div class="col-9">
                                        <div class="aiz-radio-inline">
                                            <?php $__currentLoopData = $choice->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <label class="aiz-megabox pl-0 mr-2 mb-0">
                                                <input
                                                    type="radio"
                                                    name="attribute_id_<?php echo e($choice->attribute_id); ?>"
                                                    value="<?php echo e($value); ?>"
                                                    <?php if($key == 0): ?> checked <?php endif; ?>
                                                >
                                                <span class="aiz-megabox-elem rounded-0 d-flex align-items-center justify-content-center py-1 px-3">
                                                    <?php echo e($value); ?>

                                                </span>
                                            </label>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <!-- Color -->
                        <?php if($product->colors && count(json_decode($product->colors)) > 0): ?>
                            <div class="row no-gutters mt-3">
                                <div class="col-3">
                                    <div class="text-secondary fs-14 fw-400 mt-2"><?php echo e(translate('Color')); ?></div>
                                </div>
                                <div class="col-9">
                                    <div class="aiz-radio-inline">
                                        <?php $__currentLoopData = json_decode($product->colors); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <label class="aiz-megabox pl-0 mr-2 mb-0" data-toggle="tooltip" data-title="<?php echo e(get_single_color_name($color)); ?>">
                                            <input
                                                type="radio"
                                                name="color"
                                                value="<?php echo e(get_single_color_name($color)); ?>"
                                                <?php if($key == 0): ?> checked <?php endif; ?>
                                            >
                                            <span class="aiz-megabox-elem rounded-0 d-flex align-items-center justify-content-center p-1">
                                                <span class="size-25px d-inline-block rounded" style="background: <?php echo e($color); ?>;"></span>
                                            </span>
                                        </label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Quantity -->
                        <div class="row no-gutters mt-3">
                            <div class="col-3">
                                <div class="text-secondary fs-14 fw-400 mt-2"><?php echo e(translate('Quantity')); ?></div>
                            </div>
                            <div class="col-9">
                                <div class="product-quantity d-flex align-items-center">
                                    <div class="row no-gutters align-items-center aiz-plus-minus mr-3" style="width: 130px;">
                                        <button class="btn col-auto btn-icon btn-sm btn-light rounded-0" type="button" data-type="minus" data-field="quantity" disabled="">
                                            <i class="las la-minus"></i>
                                        </button>
                                        <input type="number" name="quantity" class="col border-0 text-center flex-grow-1 fs-16 input-number" placeholder="1" value="<?php echo e($product->min_qty); ?>" min="<?php echo e($product->min_qty); ?>" max="10" lang="en">
                                        <button class="btn col-auto btn-icon btn-sm btn-light rounded-0" type="button" data-type="plus" data-field="quantity">
                                            <i class="las la-plus"></i>
                                        </button>
                                    </div>
                                    <div class="avialable-amount opacity-60">
                                        <?php if($product->stock_visibility_state == 'quantity'): ?>
                                        (<span id="available-quantity"><?php echo e($qty); ?></span> <?php echo e(translate('available')); ?>)
                                        <?php elseif($product->stock_visibility_state == 'text' && $qty >= 1): ?>
                                            (<span id="available-quantity"><?php echo e(translate('In Stock')); ?></span>)
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- Quantity -->
                        <input type="hidden" name="quantity" value="1">
                    <?php endif; ?>
                    
                    <!-- Total Price -->
                    <div class="row no-gutters mt-3 pb-3 d-none" id="chosen_price_div">
                        <div class="col-3">
                            <div class="text-secondary fs-14 fw-400 mt-1"><?php echo e(translate('Total Price')); ?></div>
                        </div>
                        <div class="col-9">
                            <div class="product-price">
                                <strong id="chosen_price" class="fs-20 fw-700 text-primary">

                                </strong>
                            </div>
                        </div>
                    </div>

                </form>

                <!-- Add to cart -->
                <div class="mt-3">
                    <?php if($product->digital == 1): ?>
                        <button type="button" class="btn btn-primary rounded-0 buy-now fw-600 add-to-cart" 
                            <?php if(Auth::check() || get_Setting('guest_checkout_activation') == 1): ?> onclick="addToCart()" <?php else: ?> onclick="showLoginModal()" <?php endif; ?>
                        >
                            <i class="la la-shopping-cart"></i>
                            <span class="d-none d-md-inline-block"><?php echo e(translate('Add to cart')); ?></span>
                        </button>
                    <?php elseif($qty > 0): ?>
                        <?php if($product->external_link != null): ?>
                            <a type="button" class="btn btn-soft-primary rounded-0 mr-2 add-to-cart fw-600" href="<?php echo e($product->external_link); ?>">
                                <i class="las la-share"></i>
                                <span class="d-none d-md-inline-block"><?php echo e(translate($product->external_link_btn)); ?></span>
                            </a>
                        <?php else: ?>
                            <button type="button" class="btn btn-primary rounded-0 buy-now fw-600 add-to-cart" 
                                <?php if(Auth::check() || get_Setting('guest_checkout_activation') == 1): ?> onclick="addToCart()" <?php else: ?> onclick="showLoginModal()" <?php endif; ?>
                            >
                                <i class="la la-shopping-cart"></i>
                                <span class="d-none d-md-inline-block"><?php echo e(translate('Add to cart')); ?></span>
                            </button>
                        <?php endif; ?>
                    <?php endif; ?>
                    <button type="button" class="btn btn-secondary rounded-0 out-of-stock fw-600 d-none" disabled>
                        <i class="la la-cart-arrow-down"></i><?php echo e(translate('Out of Stock')); ?>

                    </button>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#option-choice-form input').on('change', function () {
        getVariantPrice();
    });
</script>
<?php /**PATH /home/u536896586/domains/axvero.in/public_html/resources/views/frontend/partials/cart/addToCart.blade.php ENDPATH**/ ?>