<?php $__env->startSection('title',trans($title)); ?>

<?php $__env->startSection('content'); ?>
    <!-- contact section -->
    <div class="contact-section">
        <div class="container">
            <div class="info-wrapper">
                <div class="row g-lg-5 g-4">
                    <div class="col-lg-4">
                        <div class="info-box">
                            <div class="icon"><img src="<?php echo e($themeTrue.'img/location.png'); ?>" alt="" /></div>
                            <div class="text">
                                <h4><?php echo app('translator')->get('Location'); ?></h4>
                                <p><?php echo app('translator')->get(@$contact->address); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="info-box">
                            <div class="icon"><img src="<?php echo e($themeTrue.'img/email.png'); ?>" alt="" /></div>
                            <div class="text">
                                <h4><?php echo app('translator')->get('Email'); ?></h4>
                                <p><?php echo app('translator')->get(@$contact->email); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="info-box">
                            <div class="icon"><img src="<?php echo e($themeTrue.'img/phone-call.png'); ?>" alt="" /></div>
                            <div class="text">
                                <h4><?php echo app('translator')->get('Phone'); ?></h4>
                                <p><?php echo app('translator')->get(@$contact->phone); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-5">
                    <img src="<?php echo e($themeTrue.'img/contact.png'); ?>" alt="" class="img-fluid" />
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-6">
                    <h4><?php echo app('translator')->get(@$contact->heading); ?></h4>
                    <p class="mb-4">
                        <?php echo app('translator')->get(@$contact->sub_heading); ?>
                    </p>
                    <form action="<?php echo e(route('contact.send')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="row g-3">
                            <div class="input-box col-md-6">
                                <input type="text"
                                       name="name"
                                       value="<?php echo e(old('name')); ?>"
                                       class="form-control"
                                       placeholder="<?php echo app('translator')->get('Full Name'); ?>" />
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="input-box col-md-6">
                                <input type="email"
                                       name="email"
                                       value="<?php echo e(old('email')); ?>"
                                       class="form-control"
                                       placeholder="<?php echo app('translator')->get('Email Address'); ?>" />
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="input-box col-12">
                                <input
                                    type="text"
                                    name="subject"
                                    value="<?php echo e(old('subject')); ?>"
                                    class="form-control"
                                    placeholder="<?php echo app('translator')->get('Subject'); ?>"
                                />
                                <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="input-box col-12">
                                <textarea
                                    class="form-control"
                                    name="message"
                                    cols="30"
                                    rows="10"
                                    placeholder="<?php echo app('translator')->get('Message'); ?>"
                                ><?php echo e(old('message')); ?></textarea>
                                <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="input-box col-12">
                                <button class="btn-custom"><?php echo app('translator')->get('Submit'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($theme.'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xammp\htdocs\chaincity_update\project\resources\views/themes/original/contact.blade.php ENDPATH**/ ?>