<script>
    'use strict'
    $('.create-profit-schedule').select2({
        width: '100%'
    }).on('select2:open', () => {
        $(".select2-results:not(:has(a))").append(`<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{ route('admin.scheduleManage') }}"
                    class="btn btn-outline-primary" target="_blank">+ Create New Schedule </a>
                    </li>`);
    });

    $('.create-address').select2({
        width: '100%'
    }).on('select2:open', () => {
        $(".select2-results:not(:has(a))").append(`<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{ route('admin.addressList') }}"
                    class="btn btn-outline-primary" target="_blank">+ Create New Address </a>
                    </li>`);
    });

    $('.create-amenities').select2({
        width: '100%'
    }).on('select2:open', () => {
        $(".select2-results:not(:has(a))").append(`<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{ route('admin.amenities') }}"
                    class="btn btn-outline-primary" target="_blank">+ Create New Amenities </a>
                    </li>`);
    });
</script>
