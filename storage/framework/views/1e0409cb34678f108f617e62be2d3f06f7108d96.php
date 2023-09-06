<?php $__env->startSection('title', trans($page_title)); ?>
<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-8 col-xl-8">
            <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
                <div class="card-body">
                    <form method="post" action="<?php echo e(route('admin.share.investment.action')); ?>" class="form-row align-items-center">
                        <?php echo csrf_field(); ?>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold"><?php echo app('translator')->get('Property Share Investment'); ?></label>
                            <div class="custom-switch-btn">
                                <input type='hidden' value='1' name='is_share_investment'>
                                <input type="checkbox" name="is_share_investment"
                                       class="custom-switch-checkbox "
                                       id="is_share_investment" value="0" <?php echo e($control->is_share_investment == 0 ? 'checked' : ''); ?>>
                                <label class="custom-switch-checkbox-label" for="is_share_investment">
                                    <span class="custom-switch-checkbox-for-installments"></span>
                                    <span class="custom-switch-checkbox-switch"></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group col-md-6 col-xl-6 col-12">
                            <button type="submit"
                                    class="btn btn-primary btn-block  btn-rounded mx-2 mt-4">
                                <span><?php echo app('translator')->get('Save Changes'); ?></span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xammp\htdocs\chaincity_update\project\resources\views/admin/property/shareInvestment.blade.php ENDPATH**/ ?>