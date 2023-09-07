<?php $__env->startSection('title',trans('Offer Conversation')); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid p-5" id="messenger" v-cloak>
        <div class="main row">
            <div class="media mt-0 mb-2 d-flex justify-content-end">
                <?php if($singlePropertyOffer->offered_from != Auth::id()): ?>
                    <a href="<?php echo e(route('user.offerList', $singlePropertyOffer->property_share_id)); ?>"
                       class="btn btn-sm bgPrimary text-white mr-2">
                        <span><i class="fas fa-arrow-left font-12"></i> <?php echo app('translator')->get('Back'); ?></span>
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(route('user.propertyMarket', 'my-offered-properties')); ?>"
                       class="btn btn-sm bgPrimary text-white mr-2">
                        <span><i class="fas fa-arrow-left font-12"></i> <?php echo app('translator')->get('Back'); ?></span>
                    </a>
                <?php endif; ?>
            </div>

            <div class="col-xl-12 col-md-12 col-12">
                <div class="search-bar my-search-bar">
                    <section class="conversation-section  pt-3 pb-3">
                        <div class="container-fluid">
                            <div class="row g-4">
                                <div class="col-lg-7">
                                    <div class="inbox_right_side__profile__info__phone d-flex">
                                        <i class="far fa-question custom--mar"></i>
                                        <p class="ms-2"> <?php echo app('translator')->get($singlePropertyOffer->description); ?> </p>
                                    </div>

                                    <div class="inbox-wrapper shop-section p-0">
                                        <!-- top bar -->
                                        <div class="top-bar d-flex justify-content-between property-box">
                                            <div>
                                                <?php if($singlePropertyOffer->offered_from != Auth::id()): ?>
                                                    <div class="massenger_active">
                                                        <img class="user img-fluid"
                                                             src="<?php echo e(getFile(config('location.user.path').optional($singlePropertyOffer->user)->image)); ?>"
                                                             alt="<?php echo e(config('basic.site_title')); ?>"/>
                                                        <p class="<?php echo e(optional($singlePropertyOffer->user)->last_seen == 'true' ? 'active-icon-messenger':'deActive-icon-messenger'); ?>"></p>
                                                        <span
                                                            class="name text-white"><?php echo app('translator')->get(optional($singlePropertyOffer->user)->firstname); ?> <?php echo app('translator')->get(optional($singlePropertyOffer->user)->lastname); ?></span>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="massenger_active">
                                                        <img class="user img-fluid"
                                                             src="<?php echo e(getFile(config('location.user.path').optional($singlePropertyOffer->owner)->image)); ?>"/>
                                                        <p class="<?php echo e(optional($singlePropertyOffer->owner)->last_seen == 'true' ? 'active-icon-messenger':'deActive-icon-messenger'); ?>"></p>
                                                        <span
                                                            class="name text-white"><?php echo app('translator')->get(optional($singlePropertyOffer->owner)->firstname); ?> <?php echo app('translator')->get(optional($singlePropertyOffer->owner)->lastname); ?></span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <?php if($singlePropertyOffer->offered_from != Auth::id()): ?>
                                                <div>
                                                    <div class="sidebar-dropdown-items">
                                                        <button
                                                            type="button"
                                                            class="dropdown-toggle"
                                                            data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="fal fa-cog"></i>
                                                        </button>

                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <?php if($singlePropertyOffer->lockInfo() && optional($singlePropertyOffer->offerlock)->status == 1 && $singlePropertyOffer->lockInfo()->status == 1): ?>

                                                            <?php else: ?>
                                                                <?php if($singlePropertyOffer->offerlock && $singlePropertyOffer->lockInfo() != null && $singlePropertyOffer->status != 1): ?>
                                                                    <li>
                                                                        <a class="dropdown-item btn acceptOffer"
                                                                           data-route="<?php echo e(route('user.offerAccept', $singlePropertyOffer->id)); ?>">
                                                                            <i class="fal fa-check-circle"></i> <?php echo app('translator')->get('Accept Offer'); ?>
                                                                        </a>
                                                                    </li>
                                                                <?php endif; ?>

                                                                <?php if($singlePropertyOffer->status != 1): ?>
                                                                    <li>
                                                                        <a class="dropdown-item btn acceptOffer"
                                                                           data-route="<?php echo e(route('user.offerAccept', $singlePropertyOffer->id)); ?>">
                                                                            <i class="fal fa-check-circle"></i> <?php echo app('translator')->get('Accept Offer'); ?>
                                                                        </a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if($singlePropertyOffer->status != 2): ?>
                                                                    <li>
                                                                        <a class="dropdown-item btn rejectOffer"
                                                                           data-route="<?php echo e(route('user.offerReject', $singlePropertyOffer->id)); ?>">
                                                                            <i class="fal fa-times-circle"></i> <?php echo app('translator')->get('Reject Offer'); ?>
                                                                        </a>
                                                                    </li>
                                                                <?php endif; ?>
                                                            <?php endif; ?>

                                                            <?php if($singlePropertyOffer->lockInfo() && optional($singlePropertyOffer->offerlock)->status == 0 && $singlePropertyOffer->lockInfo()->status == 0): ?>
                                                                <li>
                                                                    <a class="dropdown-item btn paymentLockInfo"
                                                                       data-route="<?php echo e(route('user.paymentLockUpdate', $singlePropertyOffer->lockInfo()->id)); ?>"
                                                                       data-lockamount="<?php echo e($singlePropertyOffer->lockInfo()->lock_amount); ?>"
                                                                       data-duration="<?php echo e($singlePropertyOffer->lockInfo()->duration); ?>">
                                                                        <i class="fal fa-lock"></i> <?php echo app('translator')->get('Payment Lock Info'); ?>
                                                                    </a>
                                                                </li>
                                                            <?php elseif($singlePropertyOffer->lockInfo() && optional($singlePropertyOffer->offerlock)->status == 1 && $singlePropertyOffer->lockInfo()->status == 1): ?>
                                                                <li>
                                                                    <a class="dropdown-item btn paymentCompletedInfo"
                                                                       data-lockamount="<?php echo e($singlePropertyOffer->lockInfo()->lock_amount); ?>"
                                                                       data-duration="<?php echo e($singlePropertyOffer->lockInfo()->duration); ?>">
                                                                        <i class="fal fa-check-double"></i> <?php echo app('translator')->get('Payment Completed'); ?>
                                                                    </a>
                                                                </li>

                                                            <?php elseif($singlePropertyOffer->offerlock && $singlePropertyOffer->lockInfo() == null): ?>
                                                                <li>
                                                                    <button class="dropdown-item btn disabled">
                                                                        <i class="fal fa-lock"></i> <?php echo app('translator')->get('Already Locked'); ?>
                                                                    </button>

                                                                </li>
                                                            <?php else: ?>
                                                                <li>
                                                                    <a class="dropdown-item btn paymentLock"
                                                                       data-route="<?php echo e(route('user.paymentLock', $singlePropertyOffer->id)); ?>">
                                                                        <i class="fal fa-lock"></i> <?php echo app('translator')->get('Lock Payment'); ?>
                                                                    </a>
                                                                </li>
                                                            <?php endif; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <?php if($singlePropertyOffer->receiveMyOffer && optional($singlePropertyOffer->receiveMyOffer)->status == 0): ?>
                                                    <div>
                                                        <div class="sidebar-dropdown-items">
                                                            <button
                                                                type="button"
                                                                class="dropdown-toggle"
                                                                data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="fal fa-cog"></i>
                                                            </button>

                                                            <ul class="dropdown-menu dropdown-menu-right">
                                                                <li>
                                                                    <a class="dropdown-item btn paymentInfo"
                                                                       data-route="<?php echo e(route('user.paymentLockConfirm', $singlePropertyOffer->lockInfo()->id)); ?>"
                                                                       data-payableamount="<?php echo e($singlePropertyOffer->lockInfo()->lock_amount); ?>"
                                                                       data-payableduration="<?php echo e($singlePropertyOffer->lockInfo()->duration); ?>">
                                                                        <i class="fal fa-money-check-alt"></i> <?php echo app('translator')->get('Payment Information'); ?>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a class="dropdown-item btn paymentLockCancel"
                                                                       data-route="<?php echo e(route('user.paymentLockCancel', $singlePropertyOffer->lockInfo()->id)); ?>">
                                                                        <i aria-hidden="true"
                                                                           class="fal fa-times-circle"></i> <?php echo app('translator')->get('Cancel Payment'); ?>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                <?php elseif($singlePropertyOffer->receiveMyOffer && optional($singlePropertyOffer->receiveMyOffer)->status == 1): ?>
                                                    <div>
                                                        <div class="sidebar-dropdown-items">
                                                            <button
                                                                type="button"
                                                                class="dropdown-toggle"
                                                                data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="fal fa-cog"></i>
                                                            </button>

                                                            <ul class="dropdown-menu dropdown-menu-right">
                                                                <li>
                                                                    <a class="dropdown-item btn buyerPaymentCompletedInfo"
                                                                       data-payableamount="<?php echo e($singlePropertyOffer->lockInfo()->lock_amount); ?>"
                                                                       data-payableduration="<?php echo e($singlePropertyOffer->lockInfo()->duration); ?>">
                                                                        <i class="fal fa-check-double"></i> <?php echo app('translator')->get('Payment Completed Info'); ?>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>

                                        <!-- chats -->
                                        <div class="chats">
                                            <div v-for="message in messages">
                                                <div v-if="message.client_id != authUser" class="chat-box this-side">
                                                    <div class="text-wrapper">
                                                        <div class="text">
                                                            <p>{{ message.reply }}</p>
                                                        </div>
                                                        <div class="fileimg" v-if="message.fileImage">
                                                            <a :href="message.fileImage" data-fancybox="gallery">
                                                                <img :src="message.fileImage" width="50px"
                                                                     height="50px">
                                                            </a>
                                                        </div>
                                                        <span class="time" v-cloak>{{ message.sent_at }}</span>
                                                    </div>
                                                    <div class="img">
                                                        <img class="img-fluid" :src="message.sender_image"/>
                                                    </div>
                                                </div>

                                                <div v-else class="chat-box opposite-side">
                                                    <div class="img">
                                                        <img class="img-fluid" :src="message.sender_image"/>
                                                    </div>
                                                    <div class="text-wrapper">
                                                        <div class="text">
                                                            <p>{{ message.reply }}</p>
                                                        </div>
                                                        <div class="fileimg" v-if="message.fileImage">
                                                            <a :href="message.fileImage" data-fancybox="gallery">
                                                                <img :src="message.fileImage" width="50px"
                                                                     height="50px">
                                                            </a>
                                                        </div>
                                                        <span class="time" v-cloak>{{ message.sent_at }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!------------------------------------- typing area ---------------------------------------------->
                                        <div class="typing-area">
                                            <div class="img-preview" v-if="file.name">
                                                <button class="delete" @click="removeImage">
                                                    <i class="fal fa-times"></i>
                                                </button>
                                                <img id="attachment" :src="photo" class="img-fluid"/>
                                            </div>

                                            <small v-if="typingFriend.firstname" v-cloak>{{ typingFriend.firstname
                                                }} <?php echo app('translator')->get('is typing...'); ?></small>

                                            <div class="input-group">
                                                <div>
                                                    <button class="upload-img send-file-btn">
                                                        <i class="fal fa-paperclip" aria-hidden="true"></i>
                                                        <input class="form-control" id="upload" accept="image/*"
                                                               type="file" @change="handleFileUpload( $event )"/>
                                                    </button>
                                                    <span class="text-danger file"></span>
                                                </div>

                                                <input type="hidden" name="property_offer_id" value="<?php echo e($id); ?>"
                                                       class="form-control property_offer_id">

                                                <textarea v-model="message" @keydown.enter.prevent="sendMessage"
                                                          @keydown="onTyping" cols="30" rows="10"
                                                          class="form-control type-message"
                                                          placeholder="<?php echo app('translator')->get('Type your message...'); ?>"></textarea>

                                                <button @click.prevent="sendMessage" class="submit-btn">
                                                    <i class="fal fa-paper-plane reply-submit-btn"
                                                       aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-5">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="search-bar my-search-bar">
                                                <form action="" method="get" enctype="multipart/form-data">
                                                    <div class="row g-3">
                                                        <div class="inbox_right_side bg-white rounded">
                                                            <div class="d-flex justify-content-center">
                                                                <h5><?php echo app('translator')->get('Offer Information'); ?></h5>
                                                            </div>
                                                            <div class="inbox_right_side__profile  p-3">
                                                                <div
                                                                    class="inbox_right_side__profile__header text-center mb-4">
                                                                    <img
                                                                        src="<?php echo e(getFile(config('location.propertyThumbnail.path').optional($singlePropertyOffer->property)->thumbnail)); ?>"
                                                                        class="productInfoThumbnail">
                                                                </div>

                                                                <div class="inbox_right_side__profile__info">
                                                                    <div
                                                                        class="inbox_right_side__profile__info__phone d-flex justify-content-between">
                                                                        <p><?php echo e(__('Property')); ?> : </p>
                                                                        <p><?php if(optional(optional($singlePropertyOffer->property)->details)->property_title): ?>
                                                                                <a href="<?php echo e(route('propertyDetails',[slug(optional(optional($singlePropertyOffer->property)->details)->property_title), optional($singlePropertyOffer->property)->id])); ?>"
                                                                                   target="_blank">
                                                                                    <?php echo app('translator')->get(Str::limit(optional(optional($singlePropertyOffer->property)->details)->property_title, 30)); ?>
                                                                                </a>
                                                                            <?php else: ?>
                                                                                <?php echo app('translator')->get('N/A'); ?>
                                                                            <?php endif; ?></p>
                                                                    </div>
                                                                    <div
                                                                        class="inbox_right_side__profile__info__phone d-flex justify-content-between">
                                                                        <p><?php echo e(__('Offer Amount')); ?> : </p>
                                                                        <p>
                                                                            <?php echo e(config('basic.currency_symbol')); ?><?php echo e($singlePropertyOffer->amount); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <?php if($singlePropertyOffer->offered_from != Auth::id()): ?>
                                                <div class="search-bar my-search-bar">
                                                    <form action="" method="get" enctype="multipart/form-data">
                                                        <div class="row g-3">
                                                            <div class="d-flex justify-content-center">
                                                                <h5><?php echo app('translator')->get('Buyer Information'); ?></h5>
                                                            </div>
                                                            <div class="inbox_right_side bg-white rounded m-0">
                                                                <div class="inbox_right_side__profile  p-3">
                                                                    <div
                                                                        class="inbox_right_side__profile__header text-center mb-4">
                                                                        <img
                                                                            src="<?php echo e(getFile(config('location.user.path').optional($singlePropertyOffer->user)->image)); ?>"
                                                                            class="productClientImage">
                                                                        <h6 class="mt-2 mb-0">
                                                                            <b><?php echo app('translator')->get(optional($singlePropertyOffer->user)->firstname); ?> <?php echo app('translator')->get(optional($singlePropertyOffer->user)->lastname); ?></b>
                                                                        </h6>
                                                                    </div>

                                                                    <div class="inbox_right_side__profile__info">
                                                                        <div
                                                                            class="inbox_right_side__profile__info__phone d-flex justify-content-between">
                                                                            <p><?php echo e(__('Phone')); ?>:</p>
                                                                            <p><?php echo e((optional($singlePropertyOffer->user)->phone) ? __(optional($singlePropertyOffer->user)->phone) : __('N/A')); ?></p>
                                                                        </div>

                                                                        <div
                                                                            class="inbox_right_side__profile__info__phone d-flex justify-content-between">
                                                                            <p><?php echo e(__('Email')); ?>:</p>
                                                                            <p><?php echo e((optional($singlePropertyOffer->user)->email) ? __(optional($singlePropertyOffer->user)->email) : __('N/A')); ?></p>
                                                                        </div>

                                                                        <div
                                                                            class="inbox_right_side__profile__info__phone d-flex justify-content-between">
                                                                            <p><?php echo e(__('Address')); ?>: </p>
                                                                            <p><?php echo e((optional($singlePropertyOffer->user)->address) ? __(optional($singlePropertyOffer->user)->address) : __('N/A')); ?></p>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="right_side_bottom p-3">
                                                                    <a href="<?php echo e(route('investorProfile', [slug(optional($singlePropertyOffer->user)->username), optional($singlePropertyOffer->user)->id])); ?>"
                                                                       target="_blank"
                                                                       class="btn w-100 text-white btn-custom d-flex justify-content-center"><?php echo app('translator')->get('Visit Profile'); ?></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            <?php else: ?>
                                                <div class="search-bar my-search-bar">
                                                    <form action="" method="get" enctype="multipart/form-data"
                                                          class="reply__form">
                                                        <div class="row g-3">
                                                            <div class="d-flex justify-content-center">
                                                                <h5><?php echo app('translator')->get('Owner Information'); ?></h5>
                                                            </div>
                                                            <div class="inbox_right_side bg-white rounded m-0">
                                                                <div class="inbox_right_side__profile  p-3">
                                                                    <div
                                                                        class="inbox_right_side__profile__header text-center mb-4">
                                                                        <img
                                                                            src="<?php echo e(getFile(config('location.user.path').optional($singlePropertyOffer->owner)->image)); ?>"
                                                                            class="productClientImage">
                                                                        <h6 class="mt-2 mb-0">
                                                                            <b><?php echo app('translator')->get(optional($singlePropertyOffer->owner)->firstname); ?> <?php echo app('translator')->get(optional($singlePropertyOffer->owner)->lastname); ?></b>
                                                                        </h6>
                                                                    </div>

                                                                    <div class="inbox_right_side__profile__info">
                                                                        <div
                                                                            class="inbox_right_side__profile__info__phone d-flex justify-content-between">
                                                                            <p><?php echo e(__('Phone')); ?>:</p>
                                                                            <p><?php echo e((optional($singlePropertyOffer->owner)->phone) ? __(optional($singlePropertyOffer->owner)->phone) : __('N/A')); ?></p>
                                                                        </div>

                                                                        <div
                                                                            class="inbox_right_side__profile__info__phone d-flex justify-content-between">
                                                                            <p><?php echo e(__('Email')); ?>:</p>
                                                                            <p><?php echo e((optional($singlePropertyOffer->owner)->email) ? __(optional($singlePropertyOffer->owner)->email) : __('N/A')); ?></p>
                                                                        </div>

                                                                        <div
                                                                            class="inbox_right_side__profile__info__phone d-flex justify-content-between">
                                                                            <p><?php echo e(__('Address')); ?>: </p>
                                                                            <p><?php echo e((optional($singlePropertyOffer->owner)->address) ? __(optional($singlePropertyOffer->owner)->address) : __('N/A')); ?></p>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="right_side_bottom p-3">
                                                                    <a href="<?php echo e(route('investorProfile', [slug(optional($singlePropertyOffer->owner)->username), optional($singlePropertyOffer->owner)->id])); ?>"
                                                                       target="_blank"
                                                                       class="btn w-100 text-white btn-custom d-flex justify-content-center"><?php echo app('translator')->get('Visit Profile'); ?></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->startPush('loadModal'); ?>
        
        <div class="modal fade" id="acceptOfferModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
                        <form action="" method="get" class="accept_offer_form">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn-custom"><?php echo app('translator')->get('Accept'); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="modal fade" id="rejectOfferModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
                        <form action="" method="get" class="reject_offer_form">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn-custom"><?php echo app('translator')->get('Reject'); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="modal fade" id="paymentLockModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <form action="" method="post" class="payment_lock_form">
                    <?php echo csrf_field(); ?>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel"><?php echo app('translator')->get('Lock Payment'); ?></h5>
                            <button type="button" class="close-btn close_invest_modal" data-bs-dismiss="modal"
                                    aria-label="Close">
                                <i class="fal fa-times"></i>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="input-box col-12">
                                <label for=""><?php echo app('translator')->get('Sell Amount'); ?></label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="invest-amount amount form-control <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        name="amount"
                                        value=""
                                        onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"
                                        autocomplete="off"
                                        placeholder="<?php echo app('translator')->get('Enter amount'); ?>" required>
                                    <button class="show-currency" type="button"></button>
                                </div>
                                <?php $__errorArgs = ['amount'];
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

                            <div class="input-box col-12 mt-2">
                                <label for="duration"><?php echo app('translator')->get('Payment Duration'); ?></label>
                                <input type="datetime-local" class="form-control" name="duration"
                                       value="<?php echo e(old('duration',request()->duration)); ?>"
                                       placeholder="<?php echo app('translator')->get('schedule time'); ?>" autocomplete="off"/>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn-custom btn2 btn-secondary close_invest_modal close__btn"
                                    data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>

                            <button type="submit" class="btn-custom"><?php echo app('translator')->get('Submit'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        
        <div class="modal fade" id="paymentLockInfoModal" data-bs-backdrop="static" data-bs-keyboard="false"
             tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <form action="" method="post" class="payment_lock_update">
                    <?php echo csrf_field(); ?>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel"><?php echo app('translator')->get('Payment Lock Infromation'); ?></h5>
                            <button type="button" class="close-btn close_invest_modal" data-bs-dismiss="modal"
                                    aria-label="Close">
                                <i class="fal fa-times"></i>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="input-box col-12">
                                <label for=""><?php echo app('translator')->get('Sell Amount'); ?></label>
                                <div class="input-group">

                                    <input
                                        type="text"
                                        class="invest-amount lock_amount form-control <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        name="amount"
                                        value=""
                                        onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"
                                        autocomplete="off"
                                        placeholder="<?php echo app('translator')->get('Enter amount'); ?>" required>
                                    <button class="show-currency" type="button"></button>
                                </div>
                                <?php $__errorArgs = ['amount'];
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

                            <div class="input-box col-12 mt-2">
                                <label for="duration"><?php echo app('translator')->get('Payment Duration'); ?></label>
                                <input type="datetime-local" class="form-control lock_duration" name="duration"
                                       placeholder="<?php echo app('translator')->get('schedule time'); ?>" autocomplete="off"/>
                            </div>


                            <div class="input-box col-12 mt-2">
                                <label for="duration" class="mb-1 payment_expired" data-expired="<?php echo e($singlePropertyOffer->lockinfo() ? $singlePropertyOffer->lockinfo()->duration : 0); ?>"><?php echo app('translator')->get('Remaining Time'); ?></label>
                                <?php if($singlePropertyOffer->lockinfo()): ?>
                                    <p id="ownerTime"></p>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn-custom btn2 btn-danger close_invest_modal close__btn"
                                    data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                            <button type="submit" class="btn-custom"><?php echo app('translator')->get('Update'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        
        <div class="modal fade" id="paymentCompletedInfoModal" data-bs-backdrop="static" data-bs-keyboard="false"
             tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <form action="" method="post" class="payment_lock_form">
                    <?php echo csrf_field(); ?>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel"><?php echo app('translator')->get('Payment Infromation'); ?></h5>
                            <button type="button" class="close-btn close_invest_modal" data-bs-dismiss="modal"
                                    aria-label="Close">
                                <i class="fal fa-times"></i>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="input-box col-12">
                                <label for=""><?php echo app('translator')->get('Selling Amount'); ?></label>
                                <div class="input-group">

                                    <input
                                        type="text"
                                        class="invest-amount lock_amount form-control <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        name="amount"
                                        value=""
                                        onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"
                                        autocomplete="off"
                                        placeholder="<?php echo app('translator')->get('Enter amount'); ?>" required>
                                    <button class="show-currency" type="button"></button>
                                </div>
                                <?php $__errorArgs = ['amount'];
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

                            <div class="input-box col-12 mt-2">
                                <label for="duration"><?php echo app('translator')->get('Payment Duration'); ?></label>
                                <input type="datetime-local" class="form-control lock_duration" name="duration"
                                       placeholder="<?php echo app('translator')->get('schedule time'); ?>" autocomplete="off"/>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn-custom btn2 btn-danger close_invest_modal close__btn"
                                    data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        
        <div class="modal fade" id="paymentInfoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <form action="" method="post" class="payment_info_form">
                    <?php echo csrf_field(); ?>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel"><?php echo app('translator')->get('Payment Infromation'); ?></h5>
                            <button type="button" class="close-btn close_invest_modal" data-bs-dismiss="modal"
                                    aria-label="Close">
                                <i class="fal fa-times"></i>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="input-box col-12">
                                <label for=""><?php echo app('translator')->get('Select Wallet'); ?></label>
                                <select class="form-control form-select" id="exampleFormControlSelect1"
                                        name="balance_type">
                                    <?php if(auth()->guard()->check()): ?>
                                        <option
                                            value="balance"><?php echo app('translator')->get('Deposit Balance - '.$basic->currency_symbol.getAmount(auth()->user()->balance)); ?></option>
                                        <option
                                            value="interest_balance"><?php echo app('translator')->get('Interest Balance -'.$basic->currency_symbol.getAmount(auth()->user()->interest_balance)); ?></option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="input-box col-12 mt-3">
                                <label for=""><?php echo app('translator')->get('Payable Amount'); ?></label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="invest-amount payable_amount form-control <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        name="amount"
                                        value=""
                                        onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"
                                        autocomplete="off"
                                        placeholder="<?php echo app('translator')->get('Enter amount'); ?>" required readonly>
                                    <button class="show-currency" type="button"></button>
                                </div>
                                <?php $__errorArgs = ['amount'];
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

                            <div class="input-box col-12 mt-2">
                                <label for="duration"><?php echo app('translator')->get('Payment Duration'); ?></label>
                                <input type="datetime-local" class="form-control payable_duration" name="duration"
                                       placeholder="<?php echo app('translator')->get('schedule time'); ?>" autocomplete="off" readonly/>
                            </div>

                            <div class="input-box col-12 mt-2">
                                <label for="duration" class="mb-1 payment_expired" data-expired="<?php echo e($singlePropertyOffer->lockinfo() ? $singlePropertyOffer->lockinfo()->duration : 0); ?>"><?php echo app('translator')->get('Remaining Time'); ?></label>
                                <?php if($singlePropertyOffer->lockinfo()): ?>
                                    <p id="customerTime"></p>
                                    <input type="hidden" class="expired_time" name="expired_time">
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn-custom btn2 btn-danger close_invest_modal close__btn"
                                    data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                            <button type="submit" class="btn-custom"><?php echo app('translator')->get('Pay Now'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        
        <div class="modal fade" id="buyerPaymentCompletedInfoModal" data-bs-backdrop="static" data-bs-keyboard="false"
             tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <form action="" method="post" class="payment_info_form">
                    <?php echo csrf_field(); ?>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel"><?php echo app('translator')->get('Payment Infromation'); ?></h5>
                            <button type="button" class="close-btn close_invest_modal" data-bs-dismiss="modal"
                                    aria-label="Close">
                                <i class="fal fa-times"></i>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="input-box col-12 mt-3">
                                <label for=""><?php echo app('translator')->get('Payable Amount'); ?></label>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="invest-amount payable_amount form-control <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        name="amount"
                                        value=""
                                        onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"
                                        autocomplete="off"
                                        placeholder="<?php echo app('translator')->get('Enter amount'); ?>" required readonly>
                                    <button class="show-currency" type="button"></button>
                                </div>
                                <?php $__errorArgs = ['amount'];
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

                            <div class="input-box col-12 mt-2">
                                <label for="duration"><?php echo app('translator')->get('Payment Duration'); ?></label>
                                <input type="datetime-local" class="form-control payable_duration" name="duration"
                                       placeholder="<?php echo app('translator')->get('schedule time'); ?>" autocomplete="off"/>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn-custom btn2 btn-danger close_invest_modal close__btn"
                                    data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        
        <div class="modal fade" id="paymentLockCancelModal" data-bs-backdrop="static" data-bs-keyboard="false"
             tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><?php echo app('translator')->get('Confirmation'); ?></h5>
                        <button type="button" class="close-btn close_invest_modal" data-bs-dismiss="modal"
                                aria-label="Close">
                            <i class="fal fa-times"></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <p><?php echo app('translator')->get('Are you sure to cancel this?'); ?></p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-custom btn2 btn-secondary close_invest_modal close__btn"
                                data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <form action="" method="get" class="cancel_offer_form">
                            <button type="submit" class="btn-custom"><?php echo app('translator')->get('Yes'); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('assets/global/js/laravel-echo.common.min.js')); ?>"></script>

    <script>
        'use strict'
        // Set the date we're counting down to
        var expired = $('.payment_expired').data('expired');
        var countDownDate = new Date(expired).getTime();

        var offeredForm = <?php echo e($singlePropertyOffer->offered_from); ?>;
        var authId = <?php echo e(Auth::id()); ?>;

        if(offeredForm != authId){
            // Update the count down every 1 second
            var x = setInterval(function() {

                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Output the result in an element with id="ownerTime"
                document.getElementById("ownerTime").innerHTML = days + "d " + hours + "h "
                    + minutes + "m " + seconds + "s ";

                // If the count down is over, write some text
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("ownerTime").innerHTML = "EXPIRED";
                }
            }, 1000);
        }else{
            // Update the count down every 1 second
            var x = setInterval(function() {

                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Output the result in an element with id="customerTime"
                $('.expired_time').val('available');
                document.getElementById("customerTime").innerHTML = days + "d " + hours + "h "
                    + minutes + "m " + seconds + "s ";


                // If the count down is over, write some text
                if (distance < 0) {
                    clearInterval(x);
                    $('.expired_time').val('expired');
                    document.getElementById("customerTime").innerHTML = "EXPIRED";


                }
            }, 1000);
        }

    </script>


    <script>
        "use strict";
        let messenger = new Vue({
            el: "#messenger",
            data: {
                item: {},
                authUser: '',
                id: '',
                selectedContactId: 0,
                selectedContact: null,
                messages: [],
                message: '',
                file: '',
                photo: '',
                myProfile: [],  //<!-- typing show -->
                typingFriend: {},   //<!-- typing show -->
                typingClock: null,  //<!-- typing show -->
                errors: {},
            },
            mounted() {
                this.authUser = "<?php echo e(auth()->user()->id); ?>";
                this.allMessages();
                this.wsConnection();
                this.listenUser();
            },
            watch: {
                messages(messages) {
                    this.scrollToBottom();
                }
            },
            methods: {
                handleFileUpload(event) {
                    if (event.target.files[0].size > 10485760) {  //made condition: file will less than 3MB(3*1024*1024=1048576 byte)
                        Notiflix.Notify.Failure("<?php echo app('translator')->get('Image should be less than 3MB!'); ?>");
                    } else {
                        this.file = event.target.files[0];
                        this.photo = URL.createObjectURL(event.target.files[0]);
                    }
                },
                removeImage() {
                    this.file = '';
                    this.photo = '';
                },
                scrollToBottom() {
                    setTimeout(() => {
                        let messagesContainer = this.$el.querySelector(".chats");
                        messagesContainer.scrollTop = messagesContainer.scrollHeight;
                    }, 50);
                },
                allMessages() {
                    let item = this.item;
                    var property_offer_id = $('.property_offer_id').val();
                    var client_id = <?php echo e(optional($singlePropertyOffer->user)->id); ?>;
                    item.offerId = property_offer_id;
                    this.selectedContactId = client_id;
                    axios.post("<?php echo e(route('user.offerReplyMessageRender')); ?>", this.item)
                        .then(response => {
                            this.myProfile = response.data[response.data.length - 1];   //<!-- typing show -->
                            this.messages = response.data.filter(ownProfile => ownProfile.id !== this.myProfile.id); //<!-- typing show -->
                        });
                },
                sendMessage() {
                    var _this = this;
                    if (this.message === '' && this.file === '') {
                        Notiflix.Notify.Failure("<?php echo app('translator')->get('Can\'t send empty message'); ?>");
                        return;
                    }
                    let formData = new FormData();
                    formData.append('file', this.file);
                    formData.append('reply', this.message);
                    formData.append('property_offer_id', $('.property_offer_id').val());
                    var check = "<?php echo e($singlePropertyOffer->offered_to); ?>";
                    if (this.authUser != check) {
                        var client_id = <?php echo e($singlePropertyOffer->offered_to); ?>;
                    } else {
                        var client_id = <?php echo e($singlePropertyOffer->offered_from); ?>;
                    }

                    formData.append('client_id', client_id);

                    const headers = {'Content-Type': 'multipart/form-data'};
                    axios.post("<?php echo e(route('user.offerReplyMessage')); ?>", formData, {headers})
                        .then(function (res) {
                            _this.message = '';
                            _this.file = '';
                            _this.messages.push(res.data);
                        })
                        .catch(error => this.errors = error.response.data.errors);
                },
                wsConnection() {
                    window.Echo = new Echo({
                        broadcaster: 'pusher',
                        key: '<?php echo e(config("broadcasting.connections.pusher.key")); ?>',
                        cluster: '<?php echo e(config("broadcasting.connections.pusher.options.cluster")); ?>',
                        forceTLS: true,
                        authEndpoint: '<?php echo e(url('/')); ?>/broadcasting/auth'
                    });
                },
                listenUser() {
                    let _this = this;
                    window.Echo.private('user.chat.<?php echo e(auth()->id()); ?>')
                        .listen('ChatEvent', (e) => {
                            _this.messages.push(e.message);
                        })
                        .listenForWhisper('typing', (e) => {            //<!-- typing show -->
                            console.log('test');
                            _this.typingFriend = e.user;
                        });
                },
                onTyping() {        //<!-- typing show -->
                    var check = "<?php echo e($singlePropertyOffer->offered_to); ?>";
                    if (this.authUser != check) {
                        var client_id = <?php echo e($singlePropertyOffer->offered_to); ?>;
                    } else {
                        var client_id = <?php echo e($singlePropertyOffer->offered_from); ?>;
                    }
                    Echo.private('user.chat.' + client_id).whisper('typing', {
                        user: this.myProfile
                    });
                },
            }
        });

        $(document).on('click', '.acceptOffer', function () {
            var acceptOfferModal = new bootstrap.Modal(document.getElementById('acceptOfferModal'))
            acceptOfferModal.show();
            let dataRoute = $(this).data('route');
            $('.accept_offer_form').attr('action', dataRoute);
        });
        $(document).on('click', '.rejectOffer', function () {
            var rejectOfferModal = new bootstrap.Modal(document.getElementById('rejectOfferModal'))
            rejectOfferModal.show();
            let dataRoute = $(this).data('route');
            $('.reject_offer_form').attr('action', dataRoute);
        });

        $(document).on('click', '.paymentLock', function () {
            var paymentLockModal = new bootstrap.Modal(document.getElementById('paymentLockModal'))
            paymentLockModal.show();

            let dataRoute = $(this).data('route');

            $('.payment_lock_form').attr('action', dataRoute);
            $('.show-currency').text("<?php echo e(config('basic.currency')); ?>");
        });

        $(document).on('click', '.paymentLockInfo', function () {
            var paymentLockInfoModal = new bootstrap.Modal(document.getElementById('paymentLockInfoModal'))
            paymentLockInfoModal.show();

            let daraRoute = $(this).data('route');
            let lockAmount = $(this).data('lockamount');
            let duration = $(this).data('duration');
            let durationType = $(this).data('durationtype');

            $('.payment_lock_update').attr('action', daraRoute);
            $('.lock_amount').val(lockAmount);
            $('.lock_duration').val(duration);
            $('.lock_duration_type').val(durationType);
            $('.show-currency').text("<?php echo e(config('basic.currency')); ?>");
        });

        $(document).on('click', '.paymentCompletedInfo', function () {
            var paymentCompletedInfoModal = new bootstrap.Modal(document.getElementById('paymentCompletedInfoModal'))
            paymentCompletedInfoModal.show();

            let lockAmount = $(this).data('lockamount');
            let duration = $(this).data('duration');

            $('.lock_amount').val(lockAmount);
            $('.lock_duration').val(duration);
            $('.show-currency').text("<?php echo e(config('basic.currency')); ?>");
        });

        $(document).on('click', '.paymentInfo', function () {
            var paymentInfoModal = new bootstrap.Modal(document.getElementById('paymentInfoModal'))
            paymentInfoModal.show();

            let dataRoute = $(this).data('route');
            let payableAmount = $(this).data('payableamount');
            let payableDuration = $(this).data('payableduration');

            $('.payment_info_form').attr('action', dataRoute);
            $('.payable_amount').val(payableAmount);
            $('.payable_duration').val(payableDuration);
            $('.show-currency').text("<?php echo e(config('basic.currency')); ?>");
        });

        $(document).on('click', '.buyerPaymentCompletedInfo', function () {
            var buyerPaymentCompletedInfoModal = new bootstrap.Modal(document.getElementById('buyerPaymentCompletedInfoModal'))
            buyerPaymentCompletedInfoModal.show();

            let payableAmount = $(this).data('payableamount');
            let payableDuration = $(this).data('payableduration');

            $('.payable_amount').val(payableAmount);
            $('.payable_duration').val(payableDuration);
            $('.show-currency').text("<?php echo e(config('basic.currency')); ?>");
        });

        $(document).on('click', '.paymentLockCancel', function () {
            var paymentLockCancelModal = new bootstrap.Modal(document.getElementById('paymentLockCancelModal'))
            paymentLockCancelModal.show();
            let dataRoute = $(this).data('route');
            $('.cancel_offer_form').attr('action', dataRoute);
        });


        $('.notiflix-confirm').on('click', function () {
            var route = $(this).data('route');
            $('.deleteRoute').attr('action', route)
        })
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make($theme.'layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xammp\htdocs\chaincity_update\project\resources\views/themes/original/user/property/offerConversation.blade.php ENDPATH**/ ?>