

<?php $__env->startSection('content'); ?>
    <!-- aiz-main-wrapper -->
    <div class="aiz-main-wrapper d-flex flex-column justify-content-center bg-white">
        <section class="bg-white overflow-hidden" style="min-height:100vh;">
            <div class="row" style="min-height: 100vh;">
                <!-- Left Side Image-->
                <div class="col-xxl-6 col-lg-7">
                    <div class="d-none d-md-block h-100">
                        <img src="<?php echo e(uploaded_asset(get_setting('seller_login_page_image'))); ?>" alt="" class="img-fit h-100">
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
                                    <h1 class="fs-20 fs-md-24 fw-700 text-primary" style="text-transform: uppercase;"><?php echo e(translate('Welcome Back !')); ?></h1>
                                    <h5 class="fs-14 fw-400 text-dark"><?php echo e(translate('Login To Your Seller Account')); ?></h5>
                                </div>
                                <!-- Login form -->
                                <div class="pt-3 pt-lg-4 bg-white">
                                    <div class="">
                                        <form class="form-default" id="seller-login-form" role="form" action="<?php echo e(route('login')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            
                                            <div class="form-group">
                                                <label for="email" class="fs-12 fw-700 text-soft-dark"><?php echo e(translate('Email')); ?></label>
                                                <input type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?> rounded-0" value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(translate('johndoe@example.com')); ?>" name="email" id="email" autocomplete="off">
                                                <?php if($errors->has('email')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                                
                                            <!-- password -->
                                            <div class="form-group">
                                                <label for="password" class="fs-12 fw-700 text-soft-dark"><?php echo e(translate('Password')); ?></label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control rounded-0 <?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(translate('Password')); ?>" name="password" id="password">
                                                    <i class="password-toggle las la-2x la-eye"></i>
                                                </div>
                                            </div>

                                            <!-- Recaptcha -->
                                            <?php if(get_setting('google_recaptcha') == 1 && get_setting('recaptcha_seller_login') == 1): ?>
                                                
                                                <?php if($errors->has('g-recaptcha-response')): ?>
                                                    <span class="border invalid-feedback rounded p-2 mb-3 bg-danger text-white" role="alert" style="display: block;">
                                                        <strong><?php echo e($errors->first('g-recaptcha-response')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                            <div class="row mb-2">
                                                <!-- Remember Me -->
                                                <div class="col-6">
                                                    <label class="aiz-checkbox">
                                                        <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                                        <span class="has-transition fs-12 fw-400 text-gray-dark hov-text-primary"><?php echo e(translate('Remember Me')); ?></span>
                                                        <span class="aiz-square-check"></span>
                                                    </label>
                                                </div>
                                                <!-- Forgot password -->
                                                <div class="col-6 text-right">
                                                    <a href="<?php echo e(route('password.request')); ?>" class="text-reset fs-12 fw-400 text-gray-dark hov-text-primary"><u><?php echo e(translate('Forgot password?')); ?></u></a>
                                                </div>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="mb-4 mt-4">
                                                <button type="submit" class="btn btn-primary btn-block fw-700 fs-14 rounded-0"><?php echo e(translate('Login')); ?></button>
                                            </div>
                                        </form>

                                        <!-- DEMO MODE -->
                                        <?php if(env("DEMO_MODE") == "On"): ?>
                                            <div class="mb-4">
                                                <table class="table table-bordered mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td><?php echo e(translate('Seller Account')); ?></td>
                                                            <td>
                                                                <button class="btn btn-info btn-sm" onclick="autoFillSeller()"><?php echo e(translate('Copy credentials')); ?></button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Register Now -->
                                    <p class="fs-12 text-gray mb-0">
                                        <?php echo e(translate('Dont have an account?')); ?>

                                        <a href="<?php echo e(route(get_setting('seller_registration_verify') === '1' ? 'shop-reg.verification' : 'shops.create')); ?>" class="ml-2 fs-14 fw-700 animate-underline-primary"><?php echo e(translate('Register Now')); ?></a>
                                    </p>
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

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        function autoFillSeller(){
            $('#email').val('seller@example.com');
            $('#password').val('123456');
        }
    </script>

    <?php if(get_setting('google_recaptcha') == 1 && get_setting('recaptcha_seller_login') == 1): ?>
        <script src="https://www.google.com/recaptcha/api.js?render=<?php echo e(env('CAPTCHA_KEY')); ?>"></script>
        
        <script type="text/javascript">
                document.getElementById('seller-login-form').addEventListener('submit', function(e) {
                    e.preventDefault();
                    grecaptcha.ready(function() {
                        grecaptcha.execute(`<?php echo e(env('CAPTCHA_KEY')); ?>`, {action: 'register'}).then(function(token) {
                            var input = document.createElement('input');
                            input.setAttribute('type', 'hidden');
                            input.setAttribute('name', 'g-recaptcha-response');
                            input.setAttribute('value', token);
                            e.target.appendChild(input);

                            var actionInput = document.createElement('input');
                            actionInput.setAttribute('type', 'hidden');
                            actionInput.setAttribute('name', 'recaptcha_action');
                            actionInput.setAttribute('value', 'recaptcha_seller_login');
                            e.target.appendChild(actionInput);
                            
                            e.target.submit();
                        });
                    });
                });
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('auth.layouts.authentication', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u536896586/domains/axvero.in/public_html/resources/views/auth/free/seller_login.blade.php ENDPATH**/ ?>