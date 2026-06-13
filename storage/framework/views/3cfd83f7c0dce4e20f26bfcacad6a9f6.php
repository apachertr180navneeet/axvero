<div class="bg-white border mb-4">
    <div class="p-3 p-sm-4">
        <h3 class="fs-16 fw-700 mb-0">
            <span class="mr-4"><?php echo e(translate('Reviews & Ratings')); ?></span>
        </h3>
    </div>
    <!-- Ratting -->
    <div class="px-3 px-sm-4 mb-4">
        <div class="border border-secondary-base bg-soft-secondary-base p-3 p-sm-4">
            <div class="row align-items-center">
                <div class="col-md-8 mb-3">
                    <div class="d-flex align-items-center justify-content-between justify-content-md-start">
                        <div class="w-100 w-sm-auto">
                            <span class="fs-36 mr-3"><?php echo e($detailedProduct->rating); ?></span>
                            <span class="fs-14 mr-3"><?php echo e(translate('out of 5.0')); ?></span>
                        </div>
                        <div class="mt-sm-3 w-100 w-sm-auto d-flex flex-wrap justify-content-end justify-content-md-start">
                            <?php
                                $total = 0;
                                $total += $detailedProduct->reviews->where('status', 1)->count();
                            ?>
                            <span class="rating rating-mr-2">
                                <?php echo e(renderStarRating($detailedProduct->rating)); ?>

                            </span>
                            <span class="ml-1 fs-14">(<?php echo e($total); ?>

                                <?php echo e(translate('reviews')); ?>)</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-right">
                    <a href="javascript:void(0);" onclick="product_review('<?php echo e($detailedProduct->id); ?>', '<?php echo e($order_id ?? ''); ?>')"
                        class="btn btn-secondary-base fw-400 rounded-0 text-white">
                        <span class="d-md-inline-block"> <?php echo e(translate('Rate this Product')); ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Reviews -->
    <?php echo $__env->make('frontend.product_details.reviews', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php /**PATH /home/u536896586/domains/axvero.in/public_html/resources/views/frontend/product_details/review_section.blade.php ENDPATH**/ ?>