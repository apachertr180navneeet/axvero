

<?php $__env->startSection('content'); ?>
    <div class="aiz-main-wrapper d-flex flex-column justify-content-center bg-white">
        <section class="bg-white overflow-hidden" style="min-height:100vh;">
            <div class="row" style="min-height: 100vh;">
                <!-- Left Side Image-->
                <div class="col-xxl-6 col-lg-7">
                    <div class="h-100">
                        <img src="<?php echo e(uploaded_asset(get_setting('password_reset_page_image'))); ?>" alt="<?php echo e(translate('Password Reset Page Image')); ?>" class="img-fit h-100">
                    </div>
                </div>
                
                <!-- Right Side -->
                <div class="col-xxl-6 col-lg-5">
                    <div class="right-content">
                        <div class="row align-items-center justify-content-center justify-content-lg-start h-100">
                            <div class="col-xxl-6 p-4 p-lg-5">
                                <!-- Site Icon -->
                                <div class="size-48px mb-3 mx-auto mx-lg-0">
                                    <img src="<?php echo e(uploaded_asset(get_setting('site_icon'))); ?>" alt="<?php echo e(translate('Site Icon')); ?>" class="img-fit h-100">
                                </div>

                                <!-- Titles -->
                                <div class="text-center text-lg-left">
                                    <h1 class="fs-20 fs-md-20 fw-700 text-primary" style="text-transform: uppercase;"><?php echo e(translate('Reset Password')); ?></h1>
                                    <h5 class="fs-14 fw-400 text-dark">
                                        <?php echo e(translate('Enter your email address and new password and confirm password.')); ?>

                                    </h5>
                                </div>

                                <!-- Reset password form -->
                                <div class="pt-3 pt-lg-4 bg-white">
                                    <div class="">
                                        <form class="form-default" role="form" action="<?php echo e(route('password.update')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            
                                            <!-- Email -->
                                            <div class="form-group">
                                                <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e($email ?? old('email')); ?>" <?php if(!empty($email ?? null)): ?> readonly <?php endif; ?> placeholder="<?php echo e(translate('Email')); ?>" required autofocus>
                    
                                                <?php if($errors->has('email')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <!-- Code -->
                                            <div class="form-group">
                                                <input id="code" type="text" class="form-control<?php echo e($errors->has('code') ? ' is-invalid' : ''); ?>" name="code" value="<?php echo e(old('code')); ?>" placeholder="<?php echo e(translate('Code')); ?>" required autofocus>
                    
                                                <?php if($errors->has('code')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('code')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                    
                                            <!-- Password -->
                                            <div class="form-group">
                                                <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" placeholder="<?php echo e(translate('New Password')); ?>" required>
                    
                                                <?php if($errors->has('password')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                    
                                            <!-- Password Confirmation-->
                
                                            <div class="form-group">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="<?php echo e(translate('Reset Password')); ?>" required>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="mb-4 mt-4">
                                                <button type="submit" class="btn btn-primary btn-block fw-700 fs-14 rounded-0"><?php echo e(translate('Reset Password')); ?></button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Go Back -->
                                    <a href="<?php echo e(url()->previous()); ?>" class="mt-3 fs-14 fw-700 d-flex align-items-center text-primary" style="max-width: fit-content;">
                                        <i class="las la-arrow-left fs-20 mr-1"></i>
                                        <?php echo e(translate('Back to Previous Page')); ?>

                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('auth.layouts.authentication', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u536896586/domains/axvero.in/public_html/resources/views/auth/free/reset_password.blade.php ENDPATH**/ ?>