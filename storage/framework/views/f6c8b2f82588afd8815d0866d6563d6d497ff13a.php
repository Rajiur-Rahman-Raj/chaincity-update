<?php $__env->startSection('title',trans('investment details')); ?>
<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo e(trans('Property Investment Information')); ?>

                            <a href="<?php echo e(route('admin.investments')); ?>" class="btn btn-primary btn-rounded btn-sm float-right mb-2"><i class="fa fa-check-circle"></i> <?php echo e(trans('Back')); ?></a>
                        </h4>
                        <hr>

                        <div class="p-4 border shadow-sm rounded">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="list-style-none">
                                        <li class="my-2 pb-3">
                                            <span class="font-weight-medium text-dark"><i class="far fa-calendar-check mr-2 text-primary" aria-hidden="true"></i> <?php echo e(trans('Investment Date')); ?>: <small class="float-right"><?php echo e(dateTime($singleInvestDetails->created_at)); ?></small></span>
                                        </li>

                                        <li class="my-2 border-bottom pb-3">
                                                <span class="font-weight-medium text-dark"><i class="far fa-building text-success mr-2" aria-hidden="true"></i> <?php echo e(trans('Property')); ?>: <small class="float-right"><a href="<?php echo e(route('propertyDetails',[slug(optional($singleInvestDetails->property->details)->property_title), optional($singleInvestDetails->property)->id])); ?>">
                                                                <?php echo app('translator')->get(optional($singleInvestDetails->property->details)->property_title); ?>
                                                            </a></small></span>

                                        </li>


                                        <li class="my-3">
                                                <span><i class="icon-check mr-2 text--site text-warning"></i> <?php echo e(trans('Transaction Id')); ?> : <span
                                                        class="font-weight-medium text-dark"><?php echo e($singleInvestDetails->trx); ?></span></span>
                                        </li>

                                        <li class="my-3">
                                            <span><i class="icon-check mr-2 text--site text-primary"></i> <?php echo e(trans('Invest')); ?> : <span class="font-weight-medium text-primary"><?php echo e(config('basic.currency_symbol')); ?><?php echo e($singleInvestDetails->amount); ?></span></span>
                                        </li>

                                        <li class="my-3">
                                            <span><i class="icon-check far fa-times-circle mr-2 text--site text-primary"></i> <?php echo e(trans('Profit')); ?> : <span class="font-weight-medium text-primary"><?php echo e(config('basic.currency_symbol')); ?><?php echo e($singleInvestDetails->net_profit); ?></span></span>
                                        </li>

                                        <?php if($singleInvestDetails->is_installment == 1): ?>
                                            <li class="my-3">
                                                <span class="font-weight-medium text-dark"><i
                                                        class="icon-check mr-2 text--site text-success"></i> <?php echo app('translator')->get('Total Installment'); ?> : <span
                                                        class="font-weight-medium text-success"> <?php echo e($singleInvestDetails->total_installments); ?> </span></span>
                                            </li>

                                            <li class="my-3">
                                                <span class="font-weight-medium text-dark"><i
                                                        class="icon-check mr-2 text--site text-success"></i> <?php echo app('translator')->get('Due Installment'); ?> : <span
                                                        class="font-weight-medium text-success"> <?php echo e($singleInvestDetails->due_installments); ?> </span></span>
                                            </li>
                                            <li class="my-3">
                                                <span class="font-weight-medium text-dark"><i
                                                        class="icon-check mr-2 text--site text-purple"></i> <?php echo app('translator')->get('Next Installment Date Start'); ?> : <span
                                                        class="font-weight-medium text-purple"> <?php echo e(dateTime($singleInvestDetails->next_installment_date_start)); ?> </span></span>
                                            </li>
                                            <li class="my-3">
                                                <span class="font-weight-medium text-dark"><i
                                                        class="icon-check mr-2 text--site text-purple"></i> <?php echo app('translator')->get('Next Installment Date End'); ?> : <span
                                                        class="font-weight-medium text-purple"> <?php echo e(dateTime($singleInvestDetails->next_installment_date_end)); ?> </span></span>
                                            </li>
                                        <?php endif; ?>


                                        <li class="my-3">
                                            <span><i class="icon-check mr-2 text--site text-primary"></i> <?php echo app('translator')->get('Return Interval'); ?> : <span
                                                    class="font-weight-bold text-primary"><?php echo e($singleInvestDetails->return_time); ?> <?php echo e($singleInvestDetails->return_time_type); ?></span></span>
                                        </li>

                                        <li class="my-3">
                                            <span><i class="icon-check mr-2 text--site text-success <?php echo e($singleInvestDetails->how_many_times == 0 ? 'text-danger' : 'text-success'); ?>"></i> <?php echo app('translator')->get('Return How Many Times'); ?> : <span
                                                    class="font-weight-bold text-success"><?php echo e($singleInvestDetails->how_many_times == null ? 'Lifetime' : $singleInvestDetails->how_many_times); ?></span></span>
                                        </li>

                                        <li class="my-3">
                                            <span>
                                                <i class="icon-check mr-2 text--site text-success"></i> <?php echo e(trans('Next Profit Return Date')); ?> :
                                                <?php if($singleInvestDetails->invest_status == 0): ?>
                                                    <span class="custom-badge bg-danger badge-pill"><?php echo app('translator')->get('After All Installment completed'); ?></span>
                                                <?php elseif($singleInvestDetails->invest_status == 1 && $singleInvestDetails->return_date == null && $singleInvestDetails->status == 1): ?>
                                                    <span class="custom-badge bg-success badge-pill"><?php echo app('translator')->get('completed'); ?></span>
                                                <?php else: ?>
                                                    <span class="font-weight-bold text-dark"><?php echo e(customDate($singleInvestDetails->return_date)); ?></span>
                                                <?php endif; ?>
                                            </span>
                                        </li>

                                        <li class="my-3">
                                            <span>
                                                <i class="mr-2 text--site  <?php echo e($singleInvestDetails->last_return_date != null ? 'far fa-check-circle text-success' : 'far fa-times-circle text-danger'); ?>"></i> <?php echo e(trans('Last Profit Return Date')); ?> :
                                                <span class="font-weight-bold text-warning <?php echo e($singleInvestDetails->last_return_date != null ? 'text-dark' : 'text-danger'); ?>"><?php echo e($singleInvestDetails->last_return_date != null ? customDate($singleInvestDetails->last_return_date) : 'N/A'); ?></span>
                                            </span>
                                        </li>

                                        <li class="my-3">
                                            <span><i class="icon-check mr-2 text--site text-warning"></i> <?php echo e(trans('Investment Payment Status')); ?> :

                                                <span class="custom-badge badge-pill <?php echo e($singleInvestDetails->invest_status == 1 ? 'bg-success': 'bg-warning'); ?>"><?php echo e($singleInvestDetails->invest_status == 1 ? trans('Complete'): trans('Due')); ?></span></span>
                                        </li>

                                        <li class="my-3">
                                            <span><i class="icon-check mr-2 text--site text-warning"></i> <?php echo e(trans('Profit Return Status')); ?> :

                                                <span class="custom-badge badge-pill <?php echo e($singleInvestDetails->status == 1 ? 'bg-success' : 'bg-primary'); ?>"><?php echo e($singleInvestDetails->status == 1 ? trans('Completed') : trans('Running')); ?></span></span>
                                        </li>

                                        <li class="my-3">
                                            <span><i class="icon-check mr-2 text--site text-warning"></i> <?php echo e(trans('Investment Status')); ?> :
                                            <span class="custom-badge badge-pill <?php echo e($singleInvestDetails->is_active == 1 ? 'bg-success' : 'bg-danger'); ?>"><?php echo e($singleInvestDetails->is_active == 1 ? trans('Active') : trans('Deactive')); ?></span></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xammp\htdocs\chaincity_update\project\resources\views/admin/transaction/investDetails.blade.php ENDPATH**/ ?>