@extends('../layouts/app')
@section('subhead')
    <title>{{ $head_title }}</title>
    <script>
        $(document).ready(function() {
            const urlParams = new URLSearchParams(window.location.search);
            const ref_doc = urlParams.get('ref_doc');
            if (!ref_doc) {
                $("#kt_activity_home_tab").addClass('show active');
                window.history.replaceState({}, '', '<?php echo env('BASE_URL'); ?>/pl_approval');
                return;
            } else {
                document_preview(ref_doc);
                return;
            }
            $('#temp_id').val(ref_doc);
            document_preview(ref_doc, 0);
        });
    </script>
@endsection
<script src="<?= env('APP_ASSETS') ?>assets/js/jquery/jquery.min.js"></script>
<style>
    #loadingOverlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.7);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .loading-box {
        text-align: center;
        font-weight: 500;
    }

    #preview_quotation {
        position: relative;
    }
</style>
@section('subcontent')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{ $head_title }}
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">#{{ auth()->user()->full_name }}</small>
                </h1>
            </div>
        </div>
    </div>

    <div hidden>
        <div class="card-toolbar m-0">
            <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bolder" role="tablist">
                <li class="nav-item" role="presentation">
                    <a id="kt_activity_home_tab" class="nav-link justify-content-center text-active-gray-800 active"
                        data-bs-toggle="tab" role="tab" href="#kt_activity_home">Home</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a id="kt_form_tab" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab"
                        role="tab" href="#kt_form">Preview</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="tab-content">
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <div id="kt_content_container" class="container-xxl">
                    <div class="row g-5 g-xl-8 mb-2">
                        <div class="col-xl-3 col-lg-6 col-sm-6">
                            <a href="#" onclick="docSearch(0, this);"
                                class="card bgi-no-repeat card-xl-stretch mb-xl-8 card-front"
                                style="background-position: right top; background-size: 30% auto; background-image: url(<?= env('APP_ASSETS') ?>assets/media/svg/shapes/abstract-4.svg)">
                                <div class="card-body">
                                    <div class="text-gray-900 fw-bolder fs-4 mb-2 mt-2" id="wait_check"></div>
                                    <div class="fw-bold text-gray-900">Waiting Check</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-sm-6">
                            <a href="#" onclick="docSearch(1, this);"
                                class="card bgi-no-repeat card-xl-stretch mb-xl-8 card-front"
                                style="background-position: right top; background-size: 30% auto; background-image: url(<?= env('APP_ASSETS') ?>assets/media/svg/shapes/abstract-2.svg)">
                                <div class="card-body">
                                    <div class="text-gray-900 fw-bolder fs-4 mb-2 mt-2" id="wait_app"></div>
                                    <div class="fw-bold text-gray-900">Waiting Approved</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-sm-6">
                            <a href="#" onclick="docSearch(2, this);"
                                class="card bgi-no-repeat card-xl-stretch mb-xl-8 card-front"
                                style="background-position: right top; background-size: 30% auto; background-image: url(<?= env('APP_ASSETS') ?>assets/media/svg/shapes/abstract-1.svg)">
                                <div class="card-body">
                                    <div class="text-gray-900 fw-bolder fs-4 mb-2 mt-2" id="wait_legal"></div>
                                    <div class="fw-bold text-gray-900">Waiting Legalize</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-sm-6">
                            <a href="#" onclick="docSearch('all', this);"
                                class="card bgi-no-repeat card-xl-stretch mb-xl-8 card-front card-front-1"
                                style="background-position: right top; background-size: 30% auto; background-image: url(<?= env('APP_ASSETS') ?>assets/media/svg/shapes/abstract-3.svg)">
                                <div class="card-body">
                                    <div class="text-gray-900 fw-bolder fs-4 mb-2 mt-2" id="all_doc"></div>
                                    <div class="fw-bold text-gray-900">All Documents</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="kt_activity_home" class="card-body p-0 tab-pane fade show active" role="tabpanel"
                aria-labelledby="kt_activity_home_tab">
                <div class="d-flex flex-column-fluid mt-lg-5 mt-sm-5">
                    <div id="kt_content_container" class="container-xxl">
                        <div class="card col-xxl-12 card-sticky">
                            <div class="card-header border-1 pt-6 pb-6 mb-5">
                                <div class="card-title">
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                                    rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                                <path
                                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                        <input type="text" data-kt-goodreceive-table-filter="search" id="primary_search"
                                            class="form-control form-control-solid w-250px ps-15 text-sm form-control-sm"
                                            placeholder="Search..." />
                                    </div>
                                </div>
                                <div class="card-toolbar">
                                    <div class="d-flex justify-content-end" data-kt-goodreceive-table-toolbar="base">
                                        <button type="button" class="btn btn-light-primary btn-sm me-3"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                                                        fill="black" />
                                                </svg>
                                            </span>
                                            Filter</button>
                                        <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px"
                                            data-kt-menu="true" id="kt-toolbar-filter">
                                            <div class="px-7 py-5">
                                                <div class="fs-4 text-dark fw-bolder">Filter Options</div>
                                            </div>
                                            <div class="separator border-gray-200"></div>
                                            <div class="px-7 py-5">
                                                <div class="mb-5">
                                                    <label class="form-label fs-5 fw-bold mb-3">Status :</label>
                                                    <select class="form-select form-select-solid fw-bolder"
                                                        data-kt-select2="true" data-placeholder="Select option"
                                                        data-allow-clear="false" id="status_filter"
                                                        data-hide-search="true">
                                                        <option selected disabled>Selected Option</option>
                                                        <option value="0">Waiting Checked</option>
                                                        <option value="1">Waiting Approved</option>
                                                        <option value="2">Waiting Legalize</option>
                                                        <option value="all">All Documents</option>
                                                    </select>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" id="submit_filter"
                                                        class="btn btn-primary btn-sm" data-kt-menu-dismiss="true"
                                                        data-kt-goodreceive-table-filter="filter">Filter</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <table class="table align-middle table-row-dashed table-striped gy-2 fs-7"
                                    id="price_list_table" width="100%">
                                    <thead>
                                        <tr class="text-start text-gray-900 fw-bolder fs-8 text-uppercase gs-0">
                                            <th width="5%">No</th>
                                            <th width="15%">Code</th>
                                            <th width="20%">Description</th>
                                            <th width="10%">Start Date</th>
                                            <th width="10%">End Date</th>
                                            <th width="10%">Status</th>
                                            <th width="10%" align="center">View</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr class="text-start text-gray-900 fw-bolder fs-8 text-uppercase gs-0">
                                            <th width="5%">No</th>
                                            <th width="15%">Code</th>
                                            <th width="20%">Description</th>
                                            <th width="10%">Start Date</th>
                                            <th width="10%">End Date</th>
                                            <th width="10%">Status</th>
                                            <th width="10%" align="center">View</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-none" id="preview"></div>
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        let price_list_table
        $(document).ready(function() {
            header_show()
            price_list_table = $("#price_list_table").DataTable({
                processing: true,
                serverSide: true,
                paging: false,
                lengthChange: false,

                info: false,
                ajax: {
                    url: "{{ url('pl_approval/show_pl_approval') }}",
                    type: 'post',
                    data: function(d) {
                        d._token = '{{ csrf_token() }}',
                            d.search = $("#primary_search").val(),
                            d.filter = $('#status_filter').val()
                    }
                },
                columns: [{
                    data: 'No'
                }, {
                    data: 'Code'
                }, {
                    data: 'Description'
                }, {
                    data: 'StartDate'
                }, {
                    data: 'EndDate'
                }, {
                    data: 'Status'
                }, {
                    data: 'View'
                }]
            })
        })
        $("#primary_search").on('keyup', function() {
            price_list_table.ajax.reload()
        })
        $("#submit_filter").on('click', function() {
            price_list_table.ajax.reload()
        })

        function docSearch(num, el) {
            $('#status_filter').val(num).trigger('change');
            price_list_table.ajax.reload()
        }

        function header_show() {
            $.ajax({
                url: "{{ url('price_list/show_header') }}",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    const doc = ' Documents'
                    $("#wait_check").text(res.wait_check + doc)
                    $("#wait_app").text(res.wait_app + doc)
                    $("#wait_legal").text(res.wait_legal + doc)
                    $("#all_doc").text(res.all_doc + doc)
                }
            })
        }
        function document_preview(ref_doc) {
            window.history.replaceState({}, '', `<?php echo env('BASE_URL'); ?>/pl_approval?ref_doc=${ref_doc}`);
            $.ajax({
                url: "{{ url('pl_approval/pl_detail_view') }}",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    ref_doc: ref_doc
                },
                success: function(res) {
                    $("#kt_content").addClass('d-none')
                    $("#preview").removeClass('d-none').html(res)
                },
                error: function(xhr) {
                    console.log(xhr)
                }
            })
        }
    </script>
@endsection
