<?php $__env->startSection('title', trans('Offer List')); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startPush('style'); ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/global/css/bootstrap-datepicker.css')); ?>"/>
    <?php $__env->stopPush(); ?>
    <!-- Invest history -->
    <section class="transaction-history">
        <div class="container-fluid">
            <div class="row mt-4 mb-2">
                <div class="col ms-2">
                    <div class="header-text-full">
                        <h3 class="dashboard_breadcurmb_heading mb-1"><?php echo app('translator')->get('Offer List'); ?></h3>
                        <nav aria-label="breadcrumb" class="ms-2">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo e(route('user.home')); ?>">
                                        <?php echo app('translator')->get('Dashboard'); ?>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo app('translator')->get('Offer List'); ?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- search area -->
            <div class="search-bar mt-3 me-2 ms-2 p-0">
                <form action="" method="get" enctype="multipart/form-data">
                    <div class="row g-3 align-items-end">
                        <div class="input-box col-lg-2">
                            <label for=""><?php echo app('translator')->get('Property'); ?></label>
                            <input
                                type="text"
                                name="property"
                                value="<?php echo e(request()->property); ?>"
                                class="form-control"
                                placeholder="<?php echo app('translator')->get('Search property'); ?>"/>
                        </div>

                        <div class="input-box col-lg-2">
                            <label for=""><?php echo app('translator')->get('Sort By'); ?></label>
                            <select class="form-select" name="sort_by" aria-label="Default select example">
                                <option value=""><?php echo app('translator')->get('All'); ?></option>
                                <option value="1"
                                        <?php if(request()->sort_by == '1'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Newest first'); ?></option>
                                <option value="2"
                                        <?php if(request()->sort_by == '2'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Oldest first'); ?></option>
                                <option value="3"
                                        <?php if(request()->sort_by == '3'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Offer Amount High to Low'); ?></option>
                                <option value="4"
                                        <?php if(request()->sort_by == '4'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Offer Amount Low to High'); ?></option>
                            </select>
                        </div>

                        <div class="input-box col-lg-2">
                            <label for=""><?php echo app('translator')->get('Status'); ?></label>
                            <select class="form-select" name="status" aria-label="Default select example">
                                <option value=""><?php echo app('translator')->get('All'); ?></option>
                                <option value="0"
                                        <?php if(request()->status == '0'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Pending'); ?></option>
                                <option value="1"
                                        <?php if(request()->status == '1'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Accepted'); ?></option>
                                <option value="2"
                                        <?php if(request()->status == '2'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Rejected'); ?></option>
                            </select>
                        </div>

                        <div class="input-box col-lg-2">
                            <label for="from_date"><?php echo app('translator')->get('From Date'); ?></label>
                            <input
                                type="text" class="form-control datepicker from_date" name="from_date"
                                value="<?php echo e(old('from_date',request()->from_date)); ?>" placeholder="<?php echo app('translator')->get('From date'); ?>"
                                autocomplete="off" readonly/>
                        </div>
                        <div class="input-box col-lg-2">
                            <label for="to_date"><?php echo app('translator')->get('To Date'); ?></label>
                            <input
                                type="text" class="form-control datepicker to_date" name="to_date"
                                value="<?php echo e(old('to_date',request()->to_date)); ?>" placeholder="<?php echo app('translator')->get('To date'); ?>"
                                autocomplete="off" readonly disabled="true"/>
                        </div>
                        <div class="input-box col-lg-2">
                            <button class="btn-custom w-100" type="submit"><i class="fal fa-search"></i><?php echo app('translator')->get('Search'); ?>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-parent table-responsive me-2 ms-2 mt-4">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col"><?php echo app('translator')->get('SL'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Property'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Offered From'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Sell Amount'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Offer Amount'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Action'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $allOfferList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $offerList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td data-label="<?php echo app('translator')->get('SL'); ?>"><?php echo e(loopIndex($allOfferList) + $key); ?></td>

                            <td class="company-logo" data-label="<?php echo app('translator')->get('Property'); ?>">
                                <div>
                                    <a href="<?php echo e(route('propertyDetails',[slug(optional(optional($offerList->property)->details)->property_title), optional($offerList->property)->id])); ?>"
                                       target="_blank">
                                        <img
                                            src="<?php echo e(getFile(config('location.propertyThumbnail.path').optional($offerList->property)->thumbnail)); ?>">
                                    </a>
                                </div>

                                <div>
                                    <a href="<?php echo e(route('propertyDetails',[slug(optional(optional($offerList->property)->details)->property_title), optional($offerList->property)->id])); ?>"
                                       target="_blank"><?php echo app('translator')->get(Str::limit(optional(optional($offerList->property)->details)->property_title, 30)); ?></a>
                                    <br>
                                </div>
                            </td>

                            <td data-label="<?php echo app('translator')->get('Offered From'); ?>">
                                <a href="<?php echo e(route('investorProfile', [slug(optional($offerList->user)->username), optional($offerList->user)->id])); ?>"
                                   target="_blank">
                                    <div class="d-flex no-block align-items-center">
                                        <div class="me-2">
                                            <img
                                                src="<?php echo e(getFile(config('location.user.path').optional($offerList->user)->image)); ?>"
                                                alt="user" class="rounded-circle" width="45" height="45">
                                        </div>
                                        <div class="">
                                            <h5 class="text-dark mb-0 font-16 font-weight-medium"><?php echo app('translator')->get(optional($offerList->user)->fullname); ?></h5>
                                            <span class="text-muted font-14 text-lowercase"><span></span><?php echo app('translator')->get(optional($offerList->user)->email); ?></span>
                                        </div>
                                    </div>
                                </a>
                            </td>

                            <td data-label="<?php echo app('translator')->get('Sell Amount'); ?>">
                                <?php echo e(config('basic.currency_symbol')); ?><?php echo e($offerList->sell_amount); ?>

                            </td>

                            <td data-label="<?php echo app('translator')->get('Offer Amount'); ?>">
                                <?php echo e(config('basic.currency_symbol')); ?><?php echo e($offerList->amount); ?>

                            </td>

                            <td data-label="<?php echo app('translator')->get('Status'); ?>">
                                <span
                                    class="badge <?php echo e(($offerList->status == 0) ? 'bg-warning' : (($offerList->status == 1) ? 'bg-success'  : 'bg-danger')); ?>">
                                    <?php echo e(($offerList->status == 0) ? __('Pending') : (($offerList->status == 1) ? __('Accepted')  : __('Rejected'))); ?>

                                </span>
                            </td>


                            <td data-label="Action">
                                <div class="sidebar-dropdown-items">
                                    <button
                                        type="button"
                                        class="dropdown-toggle"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fal fa-cog"></i>
                                    </button>

                                    <ul class="dropdown-menu dropdown-menu-end">

                                        <?php if(optional($offerList->propertyShare)->status == 0 && $offerList->payment_status == 0): ?>
                                            <li>
                                                <a class="dropdown-item btn disabled">
                                                    <i class="fal fa-shopping-cart"></i> <?php echo app('translator')->get('Sold out'); ?>
                                                </a>
                                            </li>
                                        <?php else: ?>
                                            <li>
                                                <a class="dropdown-item btn notiflix-confirm"
                                                   data-bs-toggle="modal" data-bs-target="#accept-modal"
                                                   data-route="<?php echo e(route('user.offerAccept', $offerList->id)); ?>">
                                                    <i class="fal fa-check-circle"></i> <?php echo app('translator')->get('Accept'); ?>
                                                </a>
                                            </li>
                                        <?php endif; ?>

                                        <?php if($offerList->lockInfo() && optional($offerList->offerlock)->status == 1 && $offerList->lockInfo()->status == 1): ?>
                                            <li>
                                                <a href="<?php echo e(route('user.offerConversation', $offerList->id)); ?>"
                                                   class="dropdown-item"> <i
                                                        class="fal fa-envelope"></i> <?php echo app('translator')->get('Conversation'); ?> </a>
                                            </li>
                                        <?php else: ?>

                                        <li>
                                            <a href="<?php echo e(route('user.offerConversation', $offerList->id)); ?>"
                                               class="dropdown-item"> <i
                                                    class="fal fa-envelope"></i> <?php echo app('translator')->get('Conversation'); ?> </a>
                                        </li>


                                        <li>
                                            <a class="dropdown-item btn notiflix-confirm"
                                               data-bs-toggle="modal" data-bs-target="#reject-modal"
                                               data-route="<?php echo e(route('user.offerReject', $offerList->id)); ?>">
                                                <i class="fal fa-times-circle"></i> <?php echo app('translator')->get('Reject'); ?>
                                            </a>
                                        </li>

                                            <li>
                                                <a class="dropdown-item btn notiflix-confirm"
                                                   data-bs-toggle="modal" data-bs-target="#delete-modal"
                                                   data-route="<?php echo e(route('user.propertyOfferRemove', $offerList->id)); ?>">
                                                    <i class="fal fa-trash-alt"></i> <?php echo app('translator')->get('Remove'); ?>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr class="text-center">
                            <td colspan="100%" class="text-danger text-center"><?php echo e(trans('No Data Found!')); ?></td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <?php $__env->startPush('loadModal'); ?>
        
        <div class="modal fade" id="accept-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><?php echo app('translator')->get('Accept Confirmation'); ?></h5>
                        <button type="button" class="close-btn close_invest_modal" data-bs-dismiss="modal"
                                aria-label="Close">
                            <i class="fal fa-times"></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <p><?php echo app('translator')->get('Are you sure to Accept this?'); ?></p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-custom btn2 btn-secondary close_invest_modal close__btn"
                                data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <form action="" method="get" class="deleteRoute">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn-custom"><?php echo app('translator')->get('Accept'); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="modal fade" id="reject-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><?php echo app('translator')->get('Reject Confirmation'); ?></h5>
                        <button type="button" class="close-btn close_invest_modal" data-bs-dismiss="modal"
                                aria-label="Close">
                            <i class="fal fa-times"></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <p><?php echo app('translator')->get('Are you sure to reject this?'); ?></p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-custom btn2 btn-secondary close_invest_modal close__btn"
                                data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <form action="" method="get" class="deleteRoute">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn-custom"><?php echo app('translator')->get('Reject'); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="modal fade" id="delete-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><?php echo app('translator')->get('Remove Confirmation'); ?></h5>
                        <button type="button" class="close-btn close_invest_modal" data-bs-dismiss="modal"
                                aria-label="Close">
                            <i class="fal fa-times"></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <p><?php echo app('translator')->get('Are you sure to remove this?'); ?></p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-custom btn2 btn-secondary close_invest_modal close__btn"
                                data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <form action="" method="post" class="deleteRoute">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('delete'); ?>
                            <button type="submit" class="btn-custom"><?php echo app('translator')->get('Remove'); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('assets/global/js/bootstrap-datepicker.js')); ?>"></script>
    <script>
        'use strict'
        $(document).ready(function () {
            $(".datepicker").datepicker({});

            $('.from_date').on('change', function () {
                $('.to_date').removeAttr('disabled');
            });
        });

        $('.notiflix-confirm').on('click', function () {
            var route = $(this).data('route');
            $('.deleteRoute').attr('action', route)
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($theme.'layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\chaincity_update\project\resources\views/themes/original/user/property/offerList.blade.php ENDPATH**/ ?>