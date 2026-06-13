<div class="aiz-main-wrapper d-flex flex-column justify-content-center bg-white">
    <section class="bg-white overflow-hidden" style="min-height:100vh;">
        <div class="row" style="min-height: 100vh;">
            <!-- Left Side Image-->
            <div class="col-xxl-6 col-lg-7">
                <div class="h-100">
                    <img src="<?php echo e(uploaded_asset(get_setting('forgot_password_page_image'))); ?>" alt="<?php echo e(translate('Forgot Password Page Image')); ?>" class="img-fit h-100">
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
                                <h1 class="fs-20 fs-md-20 fw-700 text-primary" style="text-transform: uppercase;"><?php echo e(translate('Forgot password?')); ?></h1>
                                <h5 class="fs-14 fw-400 text-dark">
                                    <?php echo e(addon_is_activated('otp_system') ? 
                                        translate('Enter your email address or phone number to recover your password.') :
                                            translate('Enter your email address to recover your password.')); ?>

                                </h5>
                            </div>

                            <!-- Send password reset link or code form -->
                            <div class="pt-3 pt-lg-4 bg-white">
                                <div class="">
                                    <form class="form-default" id="forgot-pass-form" role="form" action="<?php echo e(route('password.email')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        
                                        <!-- Email or Phone -->
                                        <?php if(addon_is_activated('otp_system')): ?>
                                            <div class="form-group phone-form-group mb-1">
                                                <label for="phone" class="fs-12 fw-700 text-soft-dark"><?php echo e(translate('Phone')); ?></label>
                                                <input type="tel" phone-number id="phone-code" class="form-control<?php echo e($errors->has('phone') ? ' is-invalid' : ''); ?> rounded-0" value="<?php echo e(old('phone')); ?>" placeholder="" name="phone" autocomplete="off">
                                            </div>

                                            <input type="hidden" name="country_code" value="">
                                            
                                            <div class="form-group email-form-group mb-1 d-none">
                                                <label for="email" class="fs-12 fw-700 text-soft-dark"><?php echo e(translate('Email')); ?></label>
                                                <input type="email" class="form-control rounded-0 <?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(translate('johndoe@example.com')); ?>" name="email" id="email" autocomplete="off">
                                                <?php if($errors->has('email')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <div class="form-group text-right">
                                                <button class="btn btn-link p-0 text-primary" type="button" onclick="toggleEmailPhone(this)"><i>*<?php echo e(translate('Use Email Instead')); ?></i></button>
                                            </div>
                                        <?php else: ?>
                                            <div class="form-group">
                                                <label for="email" class="fs-12 fw-700 text-soft-dark"><?php echo e(translate('Email')); ?></label>
                                                <input type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?> rounded-0" value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(translate('johndoe@example.com')); ?>" name="email" id="email" autocomplete="off">
                                                <?php if($errors->has('email')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Recaptcha -->
                                        <?php if(get_setting('google_recaptcha') == 1 && get_setting('recaptcha_forgot_password') == 1): ?>
                                            
                                            <?php if($errors->has('g-recaptcha-response')): ?>
                                                <span class="border invalid-feedback rounded p-2 mb-3 bg-danger text-white" role="alert" style="display: block;">
                                                    <strong><?php echo e($errors->first('g-recaptcha-response')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <!-- Submit Button -->
                                        <div class="mb-4 mt-4">
                                            <button type="submit" class="btn btn-primary btn-block fw-700 fs-14 rounded-0"><?php echo e(translate('Send Password Reset Code')); ?></button>
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
</div><?php /**PATH /home/u536896586/domains/axvero.in/public_html/resources/views/auth/free/forgot_password.blade.php ENDPATH**/ ?>