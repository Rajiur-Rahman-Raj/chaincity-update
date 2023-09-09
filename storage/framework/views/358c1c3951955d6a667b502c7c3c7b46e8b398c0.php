<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get($title); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="page-header card card-primary m-0 m-md-4 my-4 m-md-0 p-4 shadow">
        <div class="row justify-content-between">
            <div class="col-md-12">
                <form action="<?php echo e(route('admin.investments.search')); ?>" method="get">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="user"><?php echo app('translator')->get('Search User'); ?></label>
                                <input type="text" name="user" value="<?php echo e(@request()->user); ?>" class="form-control" placeholder="<?php echo app('translator')->get('Search by user'); ?>">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="property"><?php echo app('translator')->get('Property'); ?></label>
                                <input type="text" name="property" value="<?php echo e(@request()->property); ?>" class="form-control" placeholder="<?php echo app('translator')->get('Search property'); ?>">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group ">
                                <label for="invest_status"><?php echo app('translator')->get('Invest payment Status'); ?></label>
                                <select class="form-control type" name="invest_status">
                                    <option value=""><?php echo app('translator')->get('All'); ?></option>
                                    <option value="1" <?php if(@request()->invest_status == '1'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Complete'); ?></option>
                                    <option value="0" <?php if(@request()->invest_status == '0'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Due'); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group ">
                                <label for="return_status"><?php echo app('translator')->get('Profit Return Status'); ?></label>
                                <select class="form-control type" name="return_status">
                                    <option value=""><?php echo app('translator')->get('All'); ?></option>
                                    <option value="0" <?php if(@request()->return_status == '0'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Running'); ?></option>
                                    <option value="1" <?php if(@request()->return_status == '1'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Completed'); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group ">
                                <label for="status"><?php echo app('translator')->get('Investment Status'); ?></label>
                                <select name="status" class="form-control type">
                                    <option value=""><?php echo app('translator')->get('All'); ?></option>
                                    <option value="1" <?php if(@request()->status == '1'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Active'); ?></option>
                                    <option value="0" <?php if(@request()->status == '0'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Deactive'); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="from_date"><?php echo app('translator')->get('From Date'); ?></label>
                                <input type="date" class="form-control from_date" id="datepicker" name="from_date" value="<?php echo e(old('from_date',request()->from_date)); ?>" placeholder="<?php echo app('translator')->get('From date'); ?>"/>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="to_date"><?php echo app('translator')->get('To Date'); ?></label>
                                <input type="date" class="form-control to_date" id="datepicker" name="to_date" value="<?php echo e(old('to_date',request()->to_date)); ?>" placeholder="<?php echo app('translator')->get('To date'); ?>" disabled="true"/>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="return_status" class="search__invest"><?php echo app('translator')->get('submit'); ?></label>
                                <button type="submit" class="btn btn-block btn-primary btn-rounded"><i class="fas fa-search"></i> <?php echo app('translator')->get('Search'); ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="col-md-auto invest_check_box mt-2 p-0 d-none">
                    <div class="form-group">
                        <?php if(adminAccessRoute(config('role.investments.access.edit')) == true): ?>
                            <button class="btn btn-outline-primary btn-rounded btn-rounded btn-sm d-inline btn-sm" data-toggle="modal" data-target="#active_selected_invests"><?php echo e(__('Active')); ?></button>
                            <button class="btn btn-outline-warning btn-rounded btn-sm d-inline btn-sm" data-toggle="modal" data-target="#deactive_selected_invests"><?php echo e(__('Deactive')); ?></button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <table class="categories-show-table table table-hover table-striped">
                <thead class="thead-dark">
                <tr>
                    <?php if(adminAccessRoute(config('role.investments.access.edit')) == true): ?>
                        <th scope="col" class="text-center">
                            <input type="checkbox" class="form-check-input check-all tic-check check_all" value="1" name="check-all"
                                   id="check-all" data-status="all">
                            <label for="check-all"></label>
                        </th>
                    <?php endif; ?>
                    <th><?php echo app('translator')->get('SL'); ?></th>
                    <th><?php echo app('translator')->get('User'); ?></th>
                    <th><?php echo app('translator')->get('Property'); ?></th>
                    <th><?php echo app('translator')->get('Investment Amount'); ?></th>
                    <th><?php echo app('translator')->get('Profit'); ?></th>
                    <th><?php echo app('translator')->get('Upcoming Payment'); ?></th>
                    <th><?php echo app('translator')->get('Profit Status'); ?></th>
                    <th><?php echo app('translator')->get('Payment Status'); ?></th>
                    <th><?php echo app('translator')->get('Investment Status'); ?></th>
                    <th scope="col"><?php echo app('translator')->get('Action'); ?></th>

                </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $investments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $invest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <?php if(adminAccessRoute(config('role.investments.access.edit')) == true || adminAccessRoute(config('role.investments.access.delete')) == true): ?>
                            <td class="text-center">
                                <input type="checkbox" name="id[]"
                                       value="<?php echo e($invest->id); ?>"
                                       class="form-check-input row-tic tic-check"
                                       id="customCheck<?php echo e($invest->id); ?>"
                                       data-id="<?php echo e($invest->id); ?>">
                                <label for="customCheck<?php echo e($invest->id); ?>"></label>
                            </td>
                        <?php endif; ?>
                        <td data-label="<?php echo app('translator')->get('SL'); ?>">
                            <?php echo e(loopIndex($investments) + $key); ?>

                        </td>

                        <td data-label="<?php echo app('translator')->get('User'); ?>">
                            <a href="<?php echo e(route('admin.user-edit',$invest->user_id)); ?>" target="_blank">
                                <div class="d-flex no-block align-items-center">
                                    <div class="mr-3"><img src="<?php echo e(getFile(config('location.user.path').optional($invest->user)->image)); ?>" alt="user" class="rounded-circle" width="45" height="45">
                                    </div>
                                    <div class="">
                                        <h5 class="text-dark mb-0 font-16 font-weight-medium">
                                            <?php echo app('translator')->get(optional($invest->user)->firstname); ?> <?php echo app('translator')->get(optional($invest->user)->lastname); ?>
                                        </h5>
                                        <span class="text-muted font-14"><span>@</span><?php echo app('translator')->get(optional($invest->user)->username); ?></span>
                                    </div>
                                </div>
                            </a>
                        </td>

                        <td data-label="<?php echo app('translator')->get('Property'); ?>">
                            <a href="<?php echo e(route('propertyDetails',[@slug(optional($invest->property->details)->property_title), optional($invest->property)->id])); ?>" target="_blank">
                                <div class="d-flex no-block align-items-center">
                                    <div class="mr-3"><img src="<?php echo e(getFile(config('location.propertyThumbnail.path').optional($invest->property)->thumbnail)); ?>" alt="<?php echo app('translator')->get('property_thumbnail'); ?>" class="rounded-circle" width="45" height="45">
                                    </div>
                                    <div class="">
                                        <h5 class="text-dark mb-0 font-16 font-weight-medium">
                                            <?php echo app('translator')->get(\Illuminate\Support\Str::limit(optional($invest->property->details)->property_title, 30)); ?>
                                        </h5>
                                        <span class="text-primary font-weight-medium font-14"><?php echo app('translator')->get('Invested: '); ?><span><?php echo e(config('basic.currency_symbol')); ?></span><?php echo e((int)$invest->amount); ?></span>
                                    </div>
                                </div>
                            </a>
                        </td>

                        <td data-label="<?php echo app('translator')->get('Invest Amount'); ?>">
                            <?php echo e(optional($invest->property)->investmentAmount); ?>

                        </td>

                        <td data-label="<?php echo app('translator')->get('Profit'); ?>">
                            <?php if($invest->invest_status == 1): ?>
                                <?php echo e(config('basic.currency_symbol')); ?><?php echo e($invest->net_profit); ?>

                            <?php else: ?>
                                <span class="custom-badge badge-pill bg-danger"><?php echo app('translator')->get('N/A'); ?></span>
                            <?php endif; ?>

                        </td>

                        <td data-label="<?php echo app('translator')->get('Upcoming Payment'); ?>">
                            <?php if($invest->invest_status == 0): ?>
                                <span class="custom-badge badge-pill bg-danger"><?php echo app('translator')->get('after installments complete'); ?></span>
                            <?php else: ?>
                                <?php echo e(customDate($invest->return_date)); ?>

                            <?php endif; ?>
                        </td>

                            <td data-label="<?php echo app('translator')->get('Profit Status'); ?>">
                            <span class="custom-badge badge-pill
                            <?php if($invest->status == 1 && $invest->invest_status == 1): ?>
                                bg-success
                            <?php elseif($invest->status == 0 && $invest->invest_status == 0): ?>
                                bg-warning
                            <?php elseif($invest->status == 0 && $invest->invest_status == 1): ?>
                                bg-primary
                            <?php endif; ?>
                            ">
                                <?php if($invest->status == 1 && $invest->invest_status == 1): ?>
                                    <?php echo app('translator')->get('Completed'); ?>
                                <?php elseif($invest->status == 0 && $invest->invest_status == 0): ?>
                                    <?php echo app('translator')->get('Upcoming'); ?>
                                <?php elseif($invest->status == 0 && $invest->invest_status == 1): ?>
                                    <?php echo app('translator')->get('Running'); ?>
                                <?php endif; ?>
                            </span>
                            </td>

                        <td data-label="<?php echo app('translator')->get('Payment Status'); ?>">
                            <span class="custom-badge badge-pill <?php echo e($invest->invest_status == 1 ? 'bg-success' : 'bg-warning'); ?>"><?php echo e($invest->invest_status == 1 ? trans('clear') : trans('Due')); ?></span>
                        </td>


                        <td data-label="<?php echo app('translator')->get('Status'); ?>">
                            <span class="custom-badge badge-pill <?php echo e($invest->is_active == 1 ? 'bg-success' : 'bg-warning'); ?>"><?php echo e($invest->is_active == 1 ? trans('Active') : trans('Deactive')); ?></span>
                            <?php if($invest->is_active == 0): ?>
                                <sup>
                                    <a href="javascript:void(0)"
                                       title="<?php echo app('translator')->get('Deactive Reason'); ?>"
                                       data-investor="<?php echo app('translator')->get(optional($invest->user)->firstname); ?> <?php echo app('translator')->get(optional($invest->user)->lastname); ?>"
                                       data-title="<?php echo e(optional($invest->property->details)->property_title); ?>"
                                       data-deactivereason="<?php echo e($invest->deactive_reason); ?>"
                                       class="info-listing-btn investDeactiveInfo" aria-labelledby="dropdownMenuLink">  <i class="fas fa-info"></i>
                                    </a>
                                </sup>
                            <?php endif; ?>
                        </td>

                        <td data-label="<?php echo app('translator')->get('Action'); ?>">
                            <div class="dropdown show">
                                <a class="dropdown-toggle p-3" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="<?php echo e(route('admin.investmentDetails', $invest->id)); ?>">
                                        <i class="far fa-eye text-primary pr-2"
                                           aria-hidden="true"></i> <?php echo app('translator')->get('Details'); ?>
                                    </a>
                                    <?php if(adminAccessRoute(config('role.investments.access.edit')) == true): ?>
                                        <a
                                            <?php if($invest->is_active == 0): ?>
                                                class="dropdown-item activeDeactiveInvest investActive cursor-pointer"
                                            data-id="<?php echo e($invest->id); ?>"
                                            data-title="<?php echo e(optional($invest->property->details)->property_title); ?>"
                                            <?php else: ?>
                                                class="dropdown-item activeDeactiveInvest investDeactive cursor-pointer"
                                            data-id="<?php echo e($invest->id); ?>"
                                            data-title="<?php echo e(optional($invest->property->details)->property_title); ?>"
                                            <?php endif; ?>>
                                            <?php if($invest->is_active == 0): ?>
                                                <i class="fa fa-toggle-off pr-2 text-purple"></i> <?php echo app('translator')->get('Active'); ?>
                                            <?php else: ?>
                                                <i class="fa fa-toggle-on pr-2 text-warning"></i> <?php echo app('translator')->get('Deactive'); ?>
                                            <?php endif; ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td class="text-center text-danger" colspan="100%"><?php echo app('translator')->get('No Investment Data'); ?></td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
            <?php echo e($investments->links('partials.pagination')); ?>

        </div>
    </div>

    <?php $__env->startPush('adminModal'); ?>
        <!-- Single Active Invest Modal -->
        <div id="investActiveModal" class="modal fade" tabindex="-1" role="dialog"
             aria-labelledby="primary-header-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title" id="primary-header-modalLabel"><?php echo app('translator')->get('Active Confirmation'); ?>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="showPropertyTitle"> </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-rounded"
                                data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <form action="<?php echo e(route('admin.investActive')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" value="" class="investActiveId" name="invest_id">
                            <button type="submit" class="btn btn-primary btn-rounded"><?php echo app('translator')->get('Yes'); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Multiple Active Invest Modal -->
        <div id="active_selected_invests" class="modal fade" tabindex="-1" role="dialog"
             aria-labelledby="primary-header-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title" id="primary-header-modalLabel"><?php echo app('translator')->get('Active Confirmation'); ?>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><?php echo app('translator')->get('Are you sure investment active?'); ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-rounded"
                                data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <form action="<?php echo e(route('admin.multiple.invest.active')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="investment_id" class="invest_id_checked">
                            <button type="submit" class="btn btn-primary btn-rounded"><?php echo app('translator')->get('Yes'); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Single Deactive Invest Modal -->
        <div class="modal fade" id="investDeactiveModal" role="dialog">
            <div class="modal-dialog">
                <form action="<?php echo e(route('admin.investDeactive')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-content">
                        <div class="modal-header modal-colored-header bg-primary">
                            <h5 class="modal-title"><?php echo app('translator')->get('Deactive Investment Confirmation'); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                        </div>

                        <div class="modal-body">
                            <p class="showPropertyTitle"></p>

                            <div class="form-group">
                                <label for=""><?php echo app('translator')->get('Write you reason'); ?></label> <span class="text-danger">*</span>
                                <input type="hidden" value="" name="invest_id" class="investDeactiveId">
                                <textarea name="deactive_reason" id="deactive_reason" required rows="4" class="form-control <?php $__errorArgs = ['deactive_reason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="<?php echo app('translator')->get('type here...'); ?>"></textarea>
                                <div class="invalid-feedback">
                                    <?php $__errorArgs = ['deactive_reason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo app('translator')->get($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal"><span><?php echo app('translator')->get('No'); ?></span></button>

                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-primary btn-rounded"><?php echo app('translator')->get('Yes'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Multiple Deactive Invest Modal -->
        <div class="modal fade" id="deactive_selected_invests" role="dialog">
            <div class="modal-dialog">
                <form action="<?php echo e(route('admin.multiple.invest.deactive')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-content">
                        <div class="modal-header modal-colored-header bg-primary">
                            <h5 class="modal-title"><?php echo app('translator')->get('Are You Sure Deactive Investment?'); ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                        </div>

                        <div class="modal-body">
                            <div class="form-group">
                                <label for=""><?php echo app('translator')->get('Write you reason'); ?></label> <span class="text-danger">*</span>
                                <input type="hidden" value="" name="invest_id" class="investDeactiveId">
                                <textarea name="deactive_reason" id="deactive_reason" rows="4" class="form-control <?php $__errorArgs = ['deactive_reason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="<?php echo app('translator')->get('type here...'); ?>"></textarea>
                                <div class="invalid-feedback">
                                    <?php $__errorArgs = ['deactive_reason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo app('translator')->get($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal"><span><?php echo app('translator')->get('Close'); ?></span></button>
                            <input type="hidden" name="investment_id" class="invest_id_checked">
                            <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('Yes'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Invest Deactive Info Modal -->
        <div class="modal fade" id="investDeactiveInfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-primary">
                        <h4 class="modal-title" id="myModalLabel"><?php echo app('translator')->get('Invest Deactive Information'); ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <form role="form" method="POST" class="actionRoute" action="" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('put'); ?>
                        <div class="modal-body">
                            <ul class="list-group">
                                <li class="list-group-item propertyInvestor"></li>
                                <li class="list-group-item propertyTitle"></li>
                                <li class="list-group-item deactiveReason"></li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        'use strict'
        $(document).ready(function (){
            var invest_array = [];
            $(document).on('click', '.check_all', function (){
                invest_array = [];
                if(this.checked){
                    console.log('checked');
                    $('.invest_check_box').removeClass('d-none');
                    $('.invest_check_box').removeClass('d-none');

                    $('.row-tic').each(function(){
                        $(this).prop('checked', true);
                        invest_array.push($(this).attr('data-id'));
                        $('.invest_id_checked').val(invest_array);
                        $('.selected_invest').val(invest_array);
                    });

                }else{

                    $('.invest_check_box').addClass('d-none');

                    $('.row-tic').each(function(){

                        $(this).prop('checked', false);
                        $('.invest_id_checked').val(invest_array);
                        $('.selected_invest').val(invest_array);

                    });
                }

                if(invest_array.length == 0)
                {
                    $('.invest_check_box').addClass('d-none');
                }else{
                    $('.invest_check_box').removeClass('d-none');
                }
            })


            $(document).on("click", ".row-tic", function(){
                var data_id = $(this).attr('data-id');
                $('.row-tic').each(function(){
                    if($(this).is(':checked')){
                        $('.check_all').prop('checked', true)
                    } else{
                        $('.check_all').prop('checked', false)
                        return false;
                    }
                });

                if(invest_array.indexOf(data_id)  != -1){
                    invest_array = invest_array.filter(item => item !== data_id)
                    $('.invest_id_checked').val(invest_array);
                    $('.selected_invest').val(invest_array);
                }
                else{
                    invest_array.push(data_id)
                    $('.invest_id_checked').val(invest_array);
                    $('.selected_invest').val(invest_array);
                }


                if(invest_array.length == 0)
                {
                    $('.invest_check_box').addClass('d-none');
                }else{
                    $('.invest_check_box').removeClass('d-none');
                }
            });
        })
    </script>































    <script>
        'use strict'
        $('.from_date').on('change', function (){
            $('.to_date').removeAttr('disabled');
        });

        $(document).on('click', '.investActive', function () {
            console.log('abc');
            var showInvestActiveModal = new bootstrap.Modal(document.getElementById('investActiveModal'))
            showInvestActiveModal.show();
            let InvestId = $(this).data('id');
            let propertyTitle = $(this).data('title');
            $('.showPropertyTitle').text(`<?php echo app('translator')->get('Are you sure to active '); ?> ${propertyTitle} <?php echo app('translator')->get(' Property Investment?'); ?>`);
            $('.investActiveId').val(InvestId);
        });

        $(document).on('click', '.investDeactive', function () {
            var showPropertyDeactiveModal = new bootstrap.Modal(document.getElementById('investDeactiveModal'))
            showPropertyDeactiveModal.show();

            let InvestId = $(this).data('id');
            let propertyTitle = $(this).data('title');
            $('.showPropertyTitle').text(`<?php echo app('translator')->get('Are you sure to deactive '); ?> ${propertyTitle} <?php echo app('translator')->get(' Property Investment?'); ?>`);
            $('.investDeactiveId').val(InvestId);
        });

        $(document).on('click', '.investDeactiveInfo', function () {
            var investDeactiveInfoModal = new bootstrap.Modal(document.getElementById('investDeactiveInfoModal'));
            investDeactiveInfoModal.show();

            let propertyInvestor = $(this).data('investor');
            let propertyTitle = $(this).data('title');
            let deactiveReason = $(this).data('deactivereason');

            $('.propertyInvestor').text(`<?php echo app('translator')->get('Investor: '); ?> ${propertyInvestor}`);
            $('.propertyTitle').text(`<?php echo app('translator')->get('Property: '); ?> ${propertyTitle}`);
            $('.deactiveReason').text(`<?php echo app('translator')->get('Deactive Reason: '); ?> ${deactiveReason}`);
        });
    </script>



    <script>
        "use strict";
        $(document).ready(function () {
            $(document).on('click', '#check-all', function () {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });

            $(document).on('change', ".row-tic", function () {
                let length = $(".row-tic").length;
                let checkedLength = $(".row-tic:checked").length;
                if (length == checkedLength) {
                    $('#check-all').prop('checked', true);
                } else {
                    $('#check-all').prop('checked', false);
                }
            });

            $('.notiflix-confirm').on('click', function () {
                var route = $(this).data('route');
                $('.deleteRoute').attr('action', route)
            })

        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\chaincity_update\project\resources\views/admin/transaction/investLog.blade.php ENDPATH**/ ?>