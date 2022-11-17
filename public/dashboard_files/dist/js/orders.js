$(function () {
    'use strict';

    var dtOrderssTable = $('.orders-list-table'),
        dtOrdersProductTable = $('.orders-product-list-table'),
        dtOrderCasesTable = $('.order-cases-list-table'),
        dtDeliveryDriversTable = $('.delivery-drivers-list-table');


    if (dtOrderssTable.length) {
        dtOrderssTable.DataTable({
            "processing": true,
            "serverSide": true,
            ajax: {
                url: $url
            }, // JSON file to add data
            columns: [
                // columns according to JSON
                {data: 'id'},
                {data: 'DT_RowIndex'},
                {data: 'order_number'},
                {data: 'supermarket' },
                {data: 'products_number',searchable: false},
                {data: 'date' ,searchable: false},
                {data: 'time' ,searchable: false},
                {data: 'evaluation' ,searchable: false},
                {data: 'total' ,searchable: false},
                {data: 'status', orderable: false ,searchable: false},
                {data: 'driver', orderable: false ,searchable: false},
                {data: 'actions', orderable: false,searchable: false},
            ],
            columnDefs: [{
                targets: 11,
                width: '200px',

            }, {
                // For Checkboxes
                targets: 0,
                orderable: false,
                responsivePriority: 3,
                render: function (data, type, full, meta) {
                    return (
                        '<div class="custom-control custom-checkbox"> <input class="custom-control-input dt-checkboxes" type="checkbox" value=' +
                        data +
                        ' id="checkbox' +
                        data +
                        '" /><label class="custom-control-label" for="checkbox' +
                        data +
                        '"></label></div>'
                    );
                },
                checkboxes: {
                    selectAllRender: '<div class="custom-control custom-checkbox"> <input class="custom-control-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                }
            },],
            order: [1, 'asc'],
            dom: '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
                '<"col-lg-12 col-xl-6" l>' +
                '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'عرض _MENU_',
                zeroRecords: 'لا يوجد بيانات',
                info: "عرض الصفحات _PAGE_ من _PAGES_",
                infoEmpty: 'عرض 0 صفحات',
                search: '',
                searchPlaceholder: 'بحث..',
                paginate: {
                    // remove previous & next text from pagination
                    previous: 'السابق',
                    next: 'التالي'
                }
            },
            // Buttons with Dropdown
            buttons: [{
                text: 'أضافة طلب <span class="svg-icon svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"> <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" /> <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" /></svg></span>',
                className: 'add-new btn btn-primary fw-bolder btn-icon mt-50 m-2 white',
                attr: {
                    'data-toggle': 'modal',
                    'data-target': '#modal_create_new',
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                }

            },
                {
                    text: '<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                        '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                        '        <rect x="0" y="0" width="24" height="24"/>\n' +
                        '        <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>\n' +
                        '        <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\n' +
                        '    </g>\n' +
                        '</svg><!--end::Svg Icon--></span>',
                    className: 'add-new btn btn-danger btn-icon mt-50 btnToggleOrders',
                    attr: {
                        'data-toggle': 'modal',
                        'data-target': '#modals-select',
                        'id': 'delete-all'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }

                },
                {
                    text: '<span className="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Navigation/Check.svg-->'+
                        '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">'+
    '<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">'+
        '<polygon points="0 0 24 0 24 24 0 24"/>'+
        '<path d="M6.26193932,17.6476484 C5.90425297,18.0684559 5.27315905,18.1196257 4.85235158,17.7619393 C4.43154411,17.404253 4.38037434,16.773159 4.73806068,16.3523516 L13.2380607,6.35235158 C13.6013618,5.92493855 14.2451015,5.87991302 14.6643638,6.25259068 L19.1643638,10.2525907 C19.5771466,10.6195087 19.6143273,11.2515811 19.2474093,11.6643638 C18.8804913,12.0771466 18.2484189,12.1143273 17.8356362,11.7474093 L14.0997854,8.42665306 L6.26193932,17.6476484 Z" fill="#000000" fill-rule="nonzero" transform="translate(11.999995, 12.000002) rotate(-180.000000) translate(-11.999995, -12.000002) "/>'+
    '</g>'+
'</svg>'+
                        '<!--end::Svg Icon--></span>',

                    className: 'add-new btn btn-success btn-icon mt-50 btnToggleOrdersDeliver',
                    attr: {
                        'data-toggle': 'modal',
                        'data-target': '#modals-select',
                        'id': 'deliver-all'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }

                },
            ],

        });
    }

    $(document).on('click', '.btnToggleOrdersDeliver', function () {
        var id = [];
        $('#modals-deliver-all').on('hide.bs.modal show.bs.modal', function (event) {
            var $activeElement = $(document.activeElement);

            if ($activeElement.is('[data-toggle], [data-dismiss]')) {
                if ($activeElement[0].id == 'deliver') {
                    $('.dt-checkboxes:checked').each(function () {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: $deliverAllurl,
                            method: "get",
                            data: {id: id},
                            success: function (data) {
                                toastr.success('تم تحديث الحالة بنجاح😍😍');
                                var deleteButton = document.getElementById('deliver-all');
                                deleteButton.setAttribute("data-target", "#modals-select");
                                dtOrderssTable.DataTable().ajax.reload();
                            }
                        });
                    } else {
                        $('#modals-select').modal('toggle');
                    }
                }
            }
        });

    });

    $(document).on('click', '.btnToggleOrders', function () {
        var id = [];
        $('#modals-delete-all').on('hide.bs.modal show.bs.modal', function (event) {
            var $activeElement = $(document.activeElement);

            if ($activeElement.is('[data-toggle], [data-dismiss]')) {
                if ($activeElement[0].id == 'delete') {
                    $('.dt-checkboxes:checked').each(function () {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: $deleteAllurl,
                            method: "get",
                            data: {id: id},
                            success: function (data) {
                                toastr.success('تم الحذف بنجاح😍😍');
                                var deleteButton = document.getElementById('delete-all');
                                deleteButton.setAttribute("data-target", "#modals-select");
                                dtOrderssTable.DataTable().ajax.reload();
                            }
                        });
                    } else {
                        $('#modals-select').modal('toggle');
                    }
                }
            }
        });

    });
    $(document).on('change', '#status', function () {

        var optionSelected = $("option:selected", this);
        var value = this.value;

        var id = $(this).data('id');

        $.ajax({
            url: "/dashboard/orders/status",
            method: "get",
            data: {id: id, value: value},
            success: function (e) {
                toastr.success('تم تحديث الحالة بنجاح😍😍');
            },
            error: function (data) {
                if (data.status == 401 || data.status == 419)
                    location.reload();
            }

        });

    });

    $(document).on('change', '#driver', function () {

        var optionSelected = $("option:selected", this);
        var value = this.value;

        var id = $(this).data('id');

        $.ajax({
            url: "/dashboard/orders/driver",
            method: "get",
            data: {id: id, value: value},
            success: function (e) {
                toastr.success('تم تحديث السائق بنجاح😍😍');
            },
            error: function (data) {
                if (data.status == 401 || data.status == 419)
                    location.reload();
            }

        });

    });

    if (dtOrdersProductTable.length) {
        dtOrdersProductTable.DataTable({
            "processing": true,
            "serverSide": true,
            ajax: {
                url: $url
            }, // JSON file to add data
            columns: [
                // columns according to JSON
                {data: 'id'},
                {data: 'DT_RowIndex'},
                {data: 'order_number'},
                {data: 'supermarket'},
                {data: 'products_number',searchable: false},
                {data: 'date' ,searchable: false},
                {data: 'time' ,searchable: false},
                {data: 'evaluation' ,searchable: false},
                {data: 'total' ,searchable: false},
                {data: 'status', orderable: false ,searchable: false},
                {data: 'driver', orderable: false ,searchable: false},
                {data: 'actions', orderable: false,searchable: false},
            ],
            columnDefs: [{
                targets: 11,
                width: '200px',

            }, {
                // For Checkboxes
                targets: 0,
                orderable: false,
                responsivePriority: 3,
                render: function (data, type, full, meta) {
                    return (
                        '<div class="custom-control custom-checkbox"> <input class="custom-control-input dt-checkboxes" type="checkbox" value=' +
                        data +
                        ' id="checkbox' +
                        data +
                        '" /><label class="custom-control-label" for="checkbox' +
                        data +
                        '"></label></div>'
                    );
                },
                checkboxes: {
                    selectAllRender: '<div class="custom-control custom-checkbox"> <input class="custom-control-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                }
            },],
            order: [1, 'asc'],
            dom: '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
                '<"col-lg-12 col-xl-6" l>' +
                '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'عرض _MENU_',
                zeroRecords: 'لا يوجد بيانات',
                info: "عرض الصفحات _PAGE_ من _PAGES_",
                infoEmpty: 'عرض 0 صفحات',
                search: '',
                searchPlaceholder: 'بحث..',
                paginate: {
                    // remove previous & next text from pagination
                    previous: 'السابق',
                    next: 'التالي'
                }
            },
            // Buttons with Dropdown
            buttons: [{
                text: 'أضافة طلب <span class="svg-icon svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"> <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" /> <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" /></svg></span>',
                className: 'add-new btn btn-primary fw-bolder btn-icon mt-50 m-2 white',
                attr: {
                    'onclick': 'document.location.href="' + $carturl + '"'
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                }

            },
                {
                    text: '<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                        '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                        '        <rect x="0" y="0" width="24" height="24"/>\n' +
                        '        <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>\n' +
                        '        <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\n' +
                        '    </g>\n' +
                        '</svg><!--end::Svg Icon--></span>',
                    className: 'add-new btn btn-danger btn-icon mt-50 btnToggleOrdersProduct',
                    attr: {
                        'data-toggle': 'modal',
                        'data-target': '#modals-select',
                        'id': 'delete-all'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }

                },{
                    text: '<span className="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Navigation/Check.svg-->'+
                        '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">'+
                        '<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">'+
                        '<polygon points="0 0 24 0 24 24 0 24"/>'+
                        '<path d="M6.26193932,17.6476484 C5.90425297,18.0684559 5.27315905,18.1196257 4.85235158,17.7619393 C4.43154411,17.404253 4.38037434,16.773159 4.73806068,16.3523516 L13.2380607,6.35235158 C13.6013618,5.92493855 14.2451015,5.87991302 14.6643638,6.25259068 L19.1643638,10.2525907 C19.5771466,10.6195087 19.6143273,11.2515811 19.2474093,11.6643638 C18.8804913,12.0771466 18.2484189,12.1143273 17.8356362,11.7474093 L14.0997854,8.42665306 L6.26193932,17.6476484 Z" fill="#000000" fill-rule="nonzero" transform="translate(11.999995, 12.000002) rotate(-180.000000) translate(-11.999995, -12.000002) "/>'+
                        '</g>'+
                        '</svg>'+
                        '<!--end::Svg Icon--></span>',

                    className: 'add-new btn btn-success btn-icon mt-50 btnToggleOrdersProductDeliver',
                    attr: {
                        'data-toggle': 'modal',
                        'data-target': '#modals-select',
                        'id': 'deliver-all'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }

                },
            ],

        });
    }

    $(document).on('click', '.btnToggleOrdersProduct', function () {
        var id = [];
        $('#modals-delete-all').on('hide.bs.modal show.bs.modal', function (event) {
            var $activeElement = $(document.activeElement);

            if ($activeElement.is('[data-toggle], [data-dismiss]')) {
                if ($activeElement[0].id == 'delete') {
                    $('.dt-checkboxes:checked').each(function () {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: $deleteAllurl,
                            method: "get",
                            data: {id: id},
                            success: function (data) {
                                toastr.success('تم الحذف بنجاح😍😍');
                                var deleteButton = document.getElementById('delete-all');
                                deleteButton.setAttribute("data-target", "#modals-select");
                                dtOrdersProductTable.DataTable().ajax.reload();
                            }
                        });
                    } else {
                        $('#modals-select').modal('toggle');
                    }
                }
            }
        });

    });

    $(document).on('click', '.btnToggleOrdersProductDeliver', function () {
        var id = [];
        $('#modals-deliver-all').on('hide.bs.modal show.bs.modal', function (event) {
            var $activeElement = $(document.activeElement);

            if ($activeElement.is('[data-toggle], [data-dismiss]')) {
                if ($activeElement[0].id == 'deliver') {
                    $('.dt-checkboxes:checked').each(function () {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: $deliverAllurl,
                            method: "get",
                            data: {id: id},
                            success: function (data) {
                                toastr.success('تم تحديث الحالة بنجاح😍😍');
                                var deleteButton = document.getElementById('deliver-all');
                                deleteButton.setAttribute("data-target", "#modals-select");
                                dtOrdersProductTable.DataTable().ajax.reload();
                            }
                        });
                    } else {
                        $('#modals-select').modal('toggle');
                    }
                }
            }
        });

    });
    $(document).on('change', '#status-order-product', function () {

        var optionSelected = $("option:selected", this);
        var value = this.value;

        var id = $(this).data('id');

        $.ajax({
            url: "/dashboard/orders-product/status",
            method: "get",
            data: {id: id, value: value},
            success: function (e) {
                toastr.success('تم تحديث الحالة بنجاح😍😍');
            },
            error: function (data) {
                if (data.status == 401 || data.status == 419)
                    location.reload();
            }

        });

    });

    $(document).on('change', '#driver-order-product', function () {

        var optionSelected = $("option:selected", this);
        var value = this.value;

        var id = $(this).data('id');

        $.ajax({
            url: "/dashboard/orders-product/driver",
            method: "get",
            data: {id: id, value: value},
            success: function (e) {
                toastr.success('تم تحديث السائق بنجاح😍😍');
            },
            error: function (data) {
                if (data.status == 401 || data.status == 419)
                    location.reload();
            }

        });

    });

    if (dtOrderCasesTable.length) {
        dtOrderCasesTable.DataTable({
            "processing": true,
            "serverSide": true,
            ajax: {
                url: $url
            }, // JSON file to add data
            columns: [
                // columns according to JSON
                {data: 'id'},
                {data: 'DT_RowIndex'},
                {data: 'name'},
                {data: 'description'},
                {data: 'actions', orderable: false},
            ],
            columnDefs: [{
                targets: 4,
                width: '400px',

            }, {
                // For Checkboxes
                targets: 0,
                orderable: false,
                responsivePriority: 3,
                render: function (data, type, full, meta) {
                    return (
                        '<div class="custom-control custom-checkbox"> <input class="custom-control-input dt-checkboxes" type="checkbox" value=' +
                        data +
                        ' id="checkbox' +
                        data +
                        '" /><label class="custom-control-label" for="checkbox' +
                        data +
                        '"></label></div>'
                    );
                },
                checkboxes: {
                    selectAllRender: '<div class="custom-control custom-checkbox"> <input class="custom-control-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                }
            },],
            order: [1, 'asc'],
            dom: '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
                '<"col-lg-12 col-xl-6" l>' +
                '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'عرض _MENU_',
                zeroRecords: 'لا يوجد بيانات',
                info: "عرض الصفحات _PAGE_ من _PAGES_",
                infoEmpty: 'عرض 0 صفحات',
                search: '',
                searchPlaceholder: 'بحث..',
                paginate: {
                    // remove previous & next text from pagination
                    previous: 'السابق',
                    next: 'التالي'
                }
            },
            // Buttons with Dropdown
            buttons: [{
                text: 'أضافة حالة <span class="svg-icon svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"> <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" /> <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" /></svg></span>',
                className: 'add-new btn btn-primary fw-bolder btn-icon mt-50 m-2 white',
                attr: {
                    'data-toggle': 'modal',
                    'data-target': '#modal_create_new',
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                }

            },
                {
                    text: '<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                        '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                        '        <rect x="0" y="0" width="24" height="24"/>\n' +
                        '        <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>\n' +
                        '        <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\n' +
                        '    </g>\n' +
                        '</svg><!--end::Svg Icon--></span>',
                    className: 'add-new btn btn-danger btn-icon mt-50 btnToggleOrderCases',
                    attr: {
                        'data-toggle': 'modal',
                        'data-target': '#modals-select',
                        'id': 'delete-all'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }

                },
            ],

        });
    }

    $(document).on('click', '.btnToggleOrderCases', function () {
        var id = [];
        $('#modals-delete-all').on('hide.bs.modal show.bs.modal', function (event) {
            var $activeElement = $(document.activeElement);

            if ($activeElement.is('[data-toggle], [data-dismiss]')) {
                if ($activeElement[0].id == 'delete') {
                    $('.dt-checkboxes:checked').each(function () {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: $deleteAllurl,
                            method: "get",
                            data: {id: id},
                            success: function (data) {
                                toastr.success('تم الحذف بنجاح😍😍');
                                var deleteButton = document.getElementById('delete-all');
                                deleteButton.setAttribute("data-target", "#modals-select");
                                dtOrderCasesTable.DataTable().ajax.reload();
                            }
                        });
                    } else {
                        $('#modals-select').modal('toggle');
                    }
                }
            }
        });

    });

    if (dtDeliveryDriversTable.length) {
        dtDeliveryDriversTable.DataTable({
            "processing": true,
            "serverSide": true,
            ajax: {
                url: $url
            }, // JSON file to add data
            columns: [
                // columns according to JSON
                {data: 'id'},
                {data: 'DT_RowIndex'},
                {data: 'name'},
                {data: 'description'},
                {data: 'actions', orderable: false},
            ],
            columnDefs: [{
                targets: 4,
                width: '400px',

            }, {
                // For Checkboxes
                targets: 0,
                orderable: false,
                responsivePriority: 3,
                render: function (data, type, full, meta) {
                    return (
                        '<div class="custom-control custom-checkbox"> <input class="custom-control-input dt-checkboxes" type="checkbox" value=' +
                        data +
                        ' id="checkbox' +
                        data +
                        '" /><label class="custom-control-label" for="checkbox' +
                        data +
                        '"></label></div>'
                    );
                },
                checkboxes: {
                    selectAllRender: '<div class="custom-control custom-checkbox"> <input class="custom-control-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                }
            },],
            order: [1, 'asc'],
            dom: '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
                '<"col-lg-12 col-xl-6" l>' +
                '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'عرض _MENU_',
                zeroRecords: 'لا يوجد بيانات',
                info: "عرض الصفحات _PAGE_ من _PAGES_",
                infoEmpty: 'عرض 0 صفحات',
                search: '',
                searchPlaceholder: 'بحث..',
                paginate: {
                    // remove previous & next text from pagination
                    previous: 'السابق',
                    next: 'التالي'
                }
            },
            // Buttons with Dropdown
            buttons: [{
                text: 'أضافة سائق <span class="svg-icon svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"> <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" /> <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" /></svg></span>',
                className: 'add-new btn btn-primary fw-bolder btn-icon mt-50 m-2 white',
                attr: {
                    'data-toggle': 'modal',
                    'data-target': '#modal_create_new',
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                }

            },
                {
                    text: '<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\n' +
                        '    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\n' +
                        '        <rect x="0" y="0" width="24" height="24"/>\n' +
                        '        <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>\n' +
                        '        <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\n' +
                        '    </g>\n' +
                        '</svg><!--end::Svg Icon--></span>',
                    className: 'add-new btn btn-danger btn-icon mt-50 btnToggleDeliveryDrivers',
                    attr: {
                        'data-toggle': 'modal',
                        'data-target': '#modals-select',
                        'id': 'delete-all'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }

                },
            ],

        });
    }

    $(document).on('click', '.btnToggleDeliveryDrivers', function () {
        var id = [];
        $('#modals-delete-all').on('hide.bs.modal show.bs.modal', function (event) {
            var $activeElement = $(document.activeElement);

            if ($activeElement.is('[data-toggle], [data-dismiss]')) {
                if ($activeElement[0].id == 'delete') {
                    $('.dt-checkboxes:checked').each(function () {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: $deleteAllurl,
                            method: "get",
                            data: {id: id},
                            success: function (data) {
                                toastr.success('تم الحذف بنجاح😍😍');
                                var deleteButton = document.getElementById('delete-all');
                                deleteButton.setAttribute("data-target", "#modals-select");
                                dtDeliveryDriversTable.DataTable().ajax.reload();
                            }
                        });
                    } else {
                        $('#modals-select').modal('toggle');
                    }
                }
            }
        });

    });

    $(document).on('change', 'input[type="checkbox"]', function () {

        if ($('input[type="checkbox"]').is(':checked') == true) {
            var deleteButton = document.getElementById('delete-all');
            deleteButton.setAttribute("data-target", "#modals-delete-all");

            var deliverButton = document.getElementById('deliver-all');
            deliverButton.setAttribute("data-target", "#modals-deliver-all");

        } else {
            var deleteButton = document.getElementById('delete-all');
            deleteButton.setAttribute("data-target", "#modals-select");

            var deliverButton = document.getElementById('deliver-all');
            deliverButton.setAttribute("data-target", "#modals-select");

        }
    });
    $(document).on('click', '#checkboxSelectAll', function () {
        if(this.checked) {
            // Iterate each checkbox
            $(':checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $(':checkbox').each(function() {
                this.checked = false;
            });
        }
    });

});
