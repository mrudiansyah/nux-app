<div class="content d-flex flex-column flex-column-fluid">
    <div class="tab-content">
        <div id="kt_activity_home" class="card-body p-0 tab-pane fade show active" role="tabpanel"
            aria-labelledby="kt_activity_home_tab">
            <div class="d-flex flex-column-fluid mt-lg-5 mt-sm-5">
                <div id="kt_content_container" class="container-xxl">
                    <div class="card col-xxl-12 card-sticky">
                        <div class="card-header border-1 pt-6 pb-6 mb-5">
                            <div class="card-title">
                                <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#material_tab"
                                            id="btn_material_tab">Material</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#document_tab"
                                            id="btn_document_tab">Document</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-toolbar">
                                <div class="d-flex justify-content-end" data-kt-goodreceive-table-toolbar="base">
                                    <button type="button" class="btn btn-light-success btn-sm me-3"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" id="backBtn">
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 9.75 14.25 12m0 0 2.25 2.25M14.25 12l2.25-2.25M14.25 12 12 14.25m-2.58 4.92-6.374-6.375a1.125 1.125 0 0 1 0-1.59L9.42 4.83c.21-.211.497-.33.795-.33H19.5a2.25 2.25 0 0 1 2.25 2.25v10.5a2.25 2.25 0 0 1-2.25 2.25h-9.284c-.298 0-.585-.119-.795-.33Z" />
                                            </svg>
                                        </span>
                                        Back</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="material_tab" role="tabpanel">
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-primary btn-sm me-3 d-none"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                            id="approvedBtn">
                                            Approved</button>
                                        <button type="button" class="btn btn-danger btn-sm me-3 d-none"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                            id="unapprovedBtn">
                                            Unapproved</button>
                                    </div>
                                    <table class="table align-middle table-row-dashed table-striped gy-2 fs-7"
                                        id="detail_table">
                                        <thead>
                                            <tr class="text-start text-gray-900 fw-bolder fs-8 text-uppercase gs-0">
                                                <th class="min-w-10px pe-2">No</th>
                                                <th class="min-w-50px">Part No</th>
                                                <th class="min-w-25px">Product Name</th>
                                                <th class="min-w-50px">Spec/Size</th>
                                                <th class="min-w-20px">Customer</th>
                                                <th class="min-w-20px">Price (Kg)</th>
                                                <th class="min-w-20px">Price (Sheet)</th>
                                                <th class="min-w-20px">Unit Weight Kg/Sheet</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr class="text-start text-gray-900 fw-bolder fs-8 text-uppercase gs-0">
                                                <th class="min-w-10px pe-2">No</th>
                                                <th class="min-w-50px">Part No</th>
                                                <th class="min-w-25px">Product Name</th>
                                                <th class="min-w-50px">Spec/Size</th>
                                                <th class="min-w-20px">Customer</th>
                                                <th class="min-w-20px">Price (Kg)</th>
                                                <th class="min-w-20px">Price (Sheet)</th>
                                                <th class="min-w-20px">Unit Weight Kg/Sheet</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="document_tab" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div
                                                class="card-body d-flex justify-content-center text-center flex-column p-8">
                                                <a href="javascript:void(0)"
                                                    class="text-gray-800 text-hover-primary d-flex flex-column"
                                                    data-bs-toggle="modal" data-bs-target="#modalHeader"
                                                    id="btn_header_mdl">

                                                    <div class="symbol symbol-60px mb-5">
                                                        <img src="<?= env('APP_ASSETS') ?>assets/media/svg/files/doc.svg"
                                                            alt="" />
                                                    </div>

                                                    <div class="fs-5 fw-bolder mb-2">
                                                        Confirmation Letter
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div
                                                class="card-body d-flex justify-content-center text-center flex-column p-8">
                                                <a href="javascript:void(0)"
                                                    class="text-gray-800 text-hover-primary d-flex flex-column"
                                                    data-bs-toggle="modal" data-bs-target="#modalMtl" id="btn_mtl_mdl">

                                                    <div class="symbol symbol-60px mb-5">
                                                        <img src="<?= env('APP_ASSETS') ?>assets/media/svg/files/doc.svg"
                                                            alt="" />
                                                    </div>

                                                    <div class="fs-5 fw-bolder mb-2">
                                                        Price Material
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalHeader" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <iframe id="iframe_header" style="width:100%; height:90vh; border:none;"></iframe>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalMtl" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <iframe id="iframe_material" style="width:100%; height:90vh; border:none;"></iframe>
            </div>
        </div>
    </div>
</div>
<script>
    $("#backBtn").on("click", function() {
        window.history.replaceState({}, '', '<?php echo env('BASE_URL'); ?>/pl_approval');
        $("#kt_content").removeClass('d-none')
        $("#preview").addClass('d-none')
        $("#price_list_table").DataTable().ajax.reload()
        header_show()
    });
    $(document).ready(function() {
        const urlParams = new URLSearchParams(window.location.search);
        const ref_doc = urlParams.get('ref_doc');
        get_status_approval(ref_doc);
        $("#detail_table").DataTable({
            processing: true,
            serverSide: true,
            paging: true,
            lengthChange: true,
            info: true,
            ajax: {
                url: "{{ url('pl_approval/detail_pl_approval') }}",
                type: 'post',
                data: function(d) {
                    d._token = '{{ csrf_token() }}',
                        d.ref_doc = ref_doc
                }
            },
            columns: [{
                data: 'No'
            }, {
                data: 'PartNo'
            }, {
                data: 'ProductName'
            }, {
                data: 'Spec'
            }, {
                data: 'Customer'
            }, {
                data: 'PriceKg'
            }, {
                data: 'PriceSheet'
            }, {
                data: 'UnitWeight'
            }]
        })
    })

    function get_status_approval(ref_doc) {
        $.ajax({
            url: "{{ url('pl_approval/get_status_approval') }}",
            type: 'post',
            data: {
                _token: '{{ csrf_token() }}',
                ref_doc: ref_doc
            },
            success: function(res) {
                if (res.status == 'approved') {
                    $("#approvedBtn").addClass('d-none')
                    $("#unapprovedBtn").removeClass('d-none')
                } else if (res.status == 'pending') {
                    $("#approvedBtn").removeClass('d-none')
                    $("#unapprovedBtn").addClass('d-none')
                }
            }
        })
    }
    $("#btn_header_mdl").on("click", function() {
        const urlParams = new URLSearchParams(window.location.search);
        const ref_doc = urlParams.get('ref_doc');
        let pdfHeader = "{{ url('pl_approval/confirmation_letter') }}/" + ref_doc;
        $("#iframe_header").attr("src", pdfHeader);
    })
    $("#btn_mtl_mdl").on("click", function() {
        const urlParams = new URLSearchParams(window.location.search);
        const ref_doc = urlParams.get('ref_doc');
        let pdfMaterial = "{{ url('pl_approval/price_material') }}/" + ref_doc;
        $("#iframe_material").attr("src", pdfMaterial);
    })
    $("#approvedBtn").on("click", function() {
        const urlParams = new URLSearchParams(window.location.search);
        const ref_doc = urlParams.get('ref_doc');
        $.ajax({
            url: "{{ url('pl_approval/approved') }}",
            type: 'post',
            data: {
                _token: '{{ csrf_token() }}',
                ref_doc: ref_doc
            },
            success: function(res) {
                if (res.status == 'success') {
                    get_status_approval(ref_doc);
                    $("#price_list_table").DataTable().ajax.reload()
                    $("#approvedBtn").addClass('d-none')
                    $("#unapprovedBtn").removeClass('d-none')
                    Toast.fire({
                        position: 'top-end',
                        title: res.message,
                        icon: "success"
                    });
                }
            },
            error: function(xhr) {
                Toast.fire({
                    position: 'top-end',
                    title: xhr.responseJSON.message,
                    icon: "error"
                });
            }
        })
    })
</script>
