

<?php $__env->startSection('content'); ?>
<section class="align-items-center d-flex h-100 bg-white">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 mx-auto text-center py-4">
				<img src="<?php echo e(static_asset('assets/img/maintainance.svg')); ?>" class="img-fluid w-75">
			    <h3 class="fw-600 mt-5"><?php echo e(translate('We are Under Maintenance.')); ?></h3>
			    <div class="lead"><?php echo e(translate('We will be back soon!')); ?></div>
			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u536896586/domains/axvero.in/public_html/resources/views/errors/503.blade.php ENDPATH**/ ?>