

<?php $__env->startSection('content'); ?>

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3"><?php echo e(translate('Pending Sellers')); ?></h1>
        </div>
    </div>
</div>

<div class="card">
    <form id="sort_sellers" action="" method="GET">
        <div class="card-header row gutters-5">
            <div class="col">
                <h5 class="mb-md-0 h6"><?php echo e(translate('Pending Seller List')); ?></h5>
            </div>
            <div class="col-md-3 ml-auto">
                <input type="text" class="form-control" name="search" <?php if(isset($sort_search)): ?> value="<?php echo e($sort_search); ?>" <?php endif; ?> placeholder="<?php echo e(translate('Type name or email or mobile number & Enter')); ?>">
            </div>
        </div>

        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo e(translate('Name')); ?></th>
                        <th><?php echo e(translate('Phone')); ?></th>
                        <th><?php echo e(translate('Email')); ?></th>
                        <th><?php echo e(translate('Registration Date')); ?></th>
                        <th data-breakpoints="lg"><?php echo e(translate('Access Approval')); ?></th>
                        <th><?php echo e(translate('Status')); ?></th>
                        <th><?php echo e(translate('Action')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $shops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(($key + 1) + ($shops->currentPage() - 1) * $shops->perPage()); ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="<?php echo e(uploaded_asset($shop->logo)); ?>" class="size-40px img-fit mr-2" onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>';">
                                    <span class="text-truncate-2"><?php echo e($shop->name); ?></span>
                                </div>
                            </td>
                            <td><?php echo e($shop->user->phone ?? '-'); ?></td>
                            <td><?php echo e($shop->user->email ?? '-'); ?></td>
                            <td><?php echo e($shop->created_at ? $shop->created_at->format('Y-m-d H:i:s') : '-'); ?></td>
                            <td>
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('approve_seller')): ?> onchange="update_approved(this)" <?php endif; ?>
                                        value="<?php echo e($shop->id); ?>" type="checkbox"
                                        <?php if($shop->registration_approval == 1) echo "checked";?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('approve_seller')): ?> disabled <?php endif; ?>
                                    >
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            
                            <td><span class="badge badge-inline badge-warning"><?php echo e(translate('Pending')); ?></span></td>
                            <td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_seller')): ?>
                                    <a href="javascript:void();" class="badge badge-inline badge-danger confirm-delete" data-href="<?php echo e(route('sellers.destroy', $shop->id)); ?>">
                                        <?php echo e(translate('Delete')); ?>

                                    </a>
                                <?php endif; ?>
                            </td>
                
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <div class="aiz-pagination">
                <?php echo e($shops->appends(request()->input())->links()); ?>

            </div>
        </div>
    </form>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
    <?php echo $__env->make('modals.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
   function update_approved(el){
        if ('<?php echo e(env('DEMO_MODE')); ?>' === 'On') {
            AIZ.plugins.notify('info', '<?php echo e(translate('Data can not change in demo mode.')); ?>');
            return;
        }
        let registration_approval = el.checked ? 1 : 0;
        let shop_id = el.value;
        let $row = $(el).closest('tr');

        $.post('<?php echo e(route('sellers.registration.approved')); ?>', {
            _token: '<?php echo e(csrf_token()); ?>',
            id: shop_id,
            registration_approval: registration_approval
        }, function (data) {
            if (data == 1) {
                AIZ.plugins.notify('success', '<?php echo e(translate('Pending sellers Approved successfully')); ?>');
                if (registration_approval === 1) {
                    $row.fadeOut(300, function() {
                        $(this).remove();
                    });
                }
            } else {
                AIZ.plugins.notify('danger', '<?php echo e(translate('Something went wrong')); ?>');
            }
        });
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u536896586/domains/axvero.in/public_html/resources/views/backend/sellers/pending_seller.blade.php ENDPATH**/ ?>