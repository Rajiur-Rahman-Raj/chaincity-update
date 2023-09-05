<?php $__env->startSection('title', trans($title)); ?>
<?php $__env->startSection('content'); ?>

    <!-- main -->
    <div class="container-fluid">
        <div class="main row">
            <div class="dashboard-heading">
                <h2 class="mb-0"><?php echo app('translator')->get('Withdraw'); ?></h2>
            </div>
            <div class="col-md-3">
                <div class="card card-type-1 text-center bgGateway">
                    <ul class="list-group">
                        <li class="list-group-item border-0 d-flex justify-content-between align-items-start">
                            <img
                                src="<?php echo e(getFile(config('location.withdraw.path').optional($withdraw->method)->image)); ?>"
                                class="card-img-top w-50" alt="<?php echo e(optional($withdraw->method)->name); ?>">
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-between align-items-start"><?php echo app('translator')->get('Request Amount'); ?> :
                            <span
                                class="float-right greenColorText"><?php echo e(@$basic->currency_symbol); ?><?php echo e(getAmount($withdraw->amount)); ?> </span>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-between align-items-start"><?php echo app('translator')->get('Charge Amount'); ?> :
                            <span
                                class="float-right text-danger"><?php echo e(@$basic->currency_symbol); ?><?php echo e(getAmount($withdraw->charge)); ?> </span>
                        </li>
                        <li class="list-group-item border-0 d-flex justify-content-between align-items-start"><?php echo app('translator')->get('Total Payable'); ?> :
                            <span
                                class="float-right text-danger"><?php echo e(@$basic->currency_symbol); ?><?php echo e(getAmount($withdraw->net_amount)); ?> </span>
                        </li>
                        <?php if($layout != 'layouts.payment'): ?>
                            <li class="list-group-item border-0 d-flex justify-content-between align-items-start"><?php echo app('translator')->get('Available Balance'); ?> :
                                <span
                                    class="float-right greenColorText"><?php echo e(@$basic->currency_symbol); ?><?php echo e($remaining); ?> </span>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

            </div>

            <div class="col-md-8">

                <div class="card card-type-1 bgGateway">
                    <div class="text-center">
                        <h3 class="card-title"><?php echo app('translator')->get('Additional Information To Withdraw Confirm'); ?></h5>
                    </div>

                    <div class="card-body">

                        <form <?php if($layout == 'layouts.payment'): ?> action="<?php echo e(route('user.payout.submit',$billId)); ?>"
                              <?php else: ?> action="" <?php endif; ?> method="post" enctype="multipart/form-data" class="form-row form text-left preview-form">
                            <?php echo csrf_field(); ?>
                            <?php if($payoutMethod->supported_currency): ?>
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div class="form-group input-box search-currency-dropdown">
                                            <label for="from_wallet"><?php echo app('translator')->get('Select Bank Currency'); ?></label>
                                            <select id="from_wallet" name="currency_code"
                                                    class="form-control form-control-sm transfer-currency"
                                                    required>
                                                <option value="" disabled=""
                                                        selected=""><?php echo app('translator')->get('Select Currency'); ?></option>
                                                <?php $__currentLoopData = $payoutMethod->supported_currency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleCurrency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option
                                                        value="<?php echo e($singleCurrency); ?>"
                                                        <?php $__currentLoopData = $payoutMethod->convert_rate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($singleCurrency == $key): ?> data-rate="<?php echo e($rate); ?>" <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php echo e(old('transfer_name') == $singleCurrency ?'selected':''); ?>><?php echo e($singleCurrency); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['currency_code'];
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
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($payoutMethod->code == 'paypal'): ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group input-box search-currency-dropdown">
                                            <label for="from_wallet"><?php echo app('translator')->get('Select Recipient Type'); ?></label>
                                            <select id="from_wallet" name="recipient_type"
                                                    class="form-control form-control-sm mb-3" required>
                                                <option value="" disabled=""
                                                        selected=""><?php echo app('translator')->get('Select Recipient'); ?></option>
                                                <option value="EMAIL"><?php echo app('translator')->get('Email'); ?></option>
                                                <option value="PHONE"><?php echo app('translator')->get('phone'); ?></option>
                                                <option value="PAYPAL_ID"><?php echo app('translator')->get('Paypal Id'); ?></option>
                                            </select>
                                            <?php $__errorArgs = ['recipient_type'];
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
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if(optional($withdraw->method)->input_form): ?>

                                <div class="row g-4">
                                    <?php $__currentLoopData = optional($withdraw->method)->input_form; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($v->type == "text"): ?>
                                            <div class="input-box col-md-12">
                                                <label><?php echo app('translator')->get($v->label?? $v->field_level); ?> <?php if($v->validation == 'required'): ?>
                                                        <span class="text-danger">*</span>
                                                    <?php endif; ?></label>
                                                <input type="text" name="<?php echo e($k); ?>"
                                                       class="form-control"
                                                       <?php if($v->validation == "required"): ?> required <?php endif; ?>>
                                                <?php if($errors->has($k)): ?>
                                                    <span
                                                        class="text-danger"><?php echo e(trans($errors->first($k))); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php elseif($v->type == "textarea"): ?>
                                            <div class="input-box col-12">
                                                <div class="form-group">
                                                    <label><?php echo app('translator')->get($v->label?? $v->field_level); ?> <?php if($v->validation == 'required'): ?>
                                                            <span class="text-danger">*</span>
                                                        <?php endif; ?>
                                                    </label>
                                                    <textarea name="<?php echo e($k); ?>" class="form-control"
                                                              cols="30"
                                                              rows="10"
                                                              <?php if($v->validation == "required"): ?> required <?php endif; ?>></textarea>
                                                    <?php if($errors->has($k)): ?>
                                                        <span
                                                            class="text-danger"><?php echo e(trans($errors->first($k))); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php elseif($v->type == "file"): ?>
                                            <div class="input-box col-12">
                                                <label
                                                    for=""><?php echo app('translator')->get($v->label?? $v->field_level); ?> <?php if($v->validation == 'required'): ?>
                                                        <span class="text-danger">*</span>
                                                    <?php endif; ?></label>
                                                <input class="form-control" name="<?php echo e($k); ?>" accept="image/*"
                                                       <?php if($v->validation == "required"): ?> required <?php endif; ?> type="file"
                                                       id="formFile"/>
                                                <span class="icon"> <i class="fal fa-paperclip"></i></span>
                                                <?php if($errors->has($k)): ?>
                                                    <br>
                                                    <span
                                                        class="text-danger"><?php echo e(__($errors->first($k))); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>

                            <input type="hidden" name="wallet_type" value="<?php echo e($wallet_type); ?>">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-custom w-100 mt-3">
                                        <span><?php echo app('translator')->get('Confirm Now'); ?></span>
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('css-lib'); ?>
    <link rel="stylesheet" href="<?php echo e(asset($themeTrue.'css/bootstrap-fileinput.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('extra-js'); ?>
    <script src="<?php echo e(asset($themeTrue.'js/bootstrap-fileinput.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <?php if($errors->any()): ?>
        <?php
            $collection = collect($errors->all());
            $errors = $collection->unique();
        ?>

        <script>
            "use strict";
            <?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            Notiflix.Notify.Failure("<?php echo e(trans($error)); ?>");
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($theme.$layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xammp\htdocs\chaincity_update\project\resources\views/themes/original/user/payout/preview.blade.php ENDPATH**/ ?>