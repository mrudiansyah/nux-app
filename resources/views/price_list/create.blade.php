<div id="kt_activity_home" class="card-body p-0 tab-pane fade show active" role="tabpanel"
    aria-labelledby="kt_activity_home_tab">
    <div class="d-flex flex-column-fluid mt-lg-5 mt-sm-5">
        <div id="kt_content_container" class="container-xxl">
            <div class="card col-xxl-12 card-sticky">
                <div class="card-header border-1 pt-6 pb-6 mb-5">
                    <div class="card-title">
                        Header Price List
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-goodreceive-table-toolbar="base">
                            <button type="button" id="btnBackCreate" class="btn btn-light-success btn-sm me-3">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9.75 14.25 12m0 0 2.25 2.25M14.25 12l2.25-2.25M14.25 12 12 14.25m-2.58 4.92-6.374-6.375a1.125 1.125 0 0 1 0-1.59L9.42 4.83c.21-.211.497-.33.795-.33H19.5a2.25 2.25 0 0 1 2.25 2.25v10.5a2.25 2.25 0 0 1-2.25 2.25h-9.284c-.298 0-.585-.119-.795-.33Z" />
                                    </svg>
                                </span>
                                Back
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-5">
                                <label class="form-label required">Price List</label>
                                <input type="text" class="form-control" id="price_list" />
                            </div>
                            <div class="form-group mb-5">
                                <label class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="start_date" />
                            </div>
                            <div class="form-group mb-5">
                                <label class="form-label">Type</label>
                                <select class="form-select" id="type">
                                    <option selected>PIlih Type</option>
                                    <option value="D">Discount</option>
                                    <option value="P">Unit Price</option>
                                    <option value="B">Both</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-5">
                                <label class="form-label required">Description</label>
                                <input type="text" class="form-control" id="description" />
                            </div>
                            <div class="form-group mb-5">
                                <label class="form-label">End Date</label>
                                <input type="date" class="form-control" id="end_date" />
                            </div>
                            <div class="form-group mb-5">
                                <label class="form-label">Currency</label>
                                <select class="form-select" id="currency">
                                </select>
                            </div>
                            <div class="form-group mb-5">
                                <label class="form-label">Customer PO</label>
                                <input type="text" class="form-control" id="customer_po" />
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="button" id="btnSubmitHeader" class="btn btn-primary btn-sm">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="kt_activity_detail" class="card-body p-0 tab-pane fade" role="tabpanel"
    aria-labelledby="kt_activity_detail_tab">
    <div class="d-flex flex-column-fluid mt-lg-5 mt-sm-5">
        <div id="kt_content_container" class="container-xxl">
            <div class="card col-xxl-12 card-sticky">
                <div class="card-header border-1 pt-6 pb-6 mb-5">
                    <div class="card-title">
                        Part Price List
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-goodreceive-table-toolbar="base">
                            <button type="button" class="btn btn-light-success btn-sm me-3" data-bs-toggle="modal"
                                data-bs-target="#modalImport">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9.75v6.75m0 0-3-3m3 3 3-3m-8.25 6a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                                    </svg>
                                </span>
                                Import
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="modalImport" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Import Excel
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group mb-5">
                                                <label class="form-label required">File Import</label>
                                                <input type="file" class="form-control" id="fileImport" />
                                                <a href="#" class="mt-2">Download Template</a>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-light-primary btn-sm me-3" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </span>
                                Add New
                            </button>
                            <div class="modal fade" id="exampleModal" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Part</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-5">
                                                        <label class="form-label required">Part No</label>
                                                        <input type="text" class="form-control" id="part_no" />
                                                    </div>
                                                    <div class="form-group mb-5">
                                                        <label class="form-label required">Product Name</label>
                                                        <input type="text" class="form-control"
                                                            id="product_name" />
                                                    </div>
                                                    <div class="form-group mb-5">
                                                        <label class="form-label required">Price (Sheet)</label>
                                                        <input type="text" class="form-control"
                                                            id="price_sheet" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-5">
                                                        <label class="form-label required">Spec / Size</label>
                                                        <input type="text" class="form-control" id="spec_size" />
                                                    </div>
                                                    <div class="form-group mb-5">
                                                        <label class="form-label">Customer</label>
                                                        <input type="text" class="form-control"
                                                            id="customer_part" />
                                                    </div>
                                                    <div class="form-group mb-5">
                                                        <label class="form-label required">Price (Kg)</label>
                                                        <input type="text" class="form-control" id="price_kg" />
                                                    </div>
                                                    <div class="form-group mb-5">
                                                        <label class="form-label required">Unit Weight (Kg/Sheet)
                                                        </label>
                                                        <input type="number" class="form-control"
                                                            id="unit_weight" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary"
                                                id="submit_detail_part">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed table-striped gy-2 fs-7"
                        id="price_list_part_table">
                        <thead>
                            <tr class="text-start text-gray-900 fw-bolder fs-8 text-uppercase gs-0">
                                <th class="min-w-20px pe-2">No</th>
                                <th class="min-w-50px">Part No</th>
                                <th class="min-w-50px">Product Name</th>
                                <th class="min-w-50px">Spec RM</th>
                                <th class="min-w-50px">Customer</th>
                                <th class="min-w-50px">Price (Kg)</th>
                                <th class="min-w-20px">Price (Sheet)</th>
                                <th class="min-w-20px">Unit Weight</th>
                                <th class="min-w-20px">View</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="text-start text-gray-900 fw-bolder fs-8 text-uppercase gs-0">
                                <th class="min-w-20px pe-2">No</th>
                                <th class="min-w-50px">Part No</th>
                                <th class="min-w-50px">Product Name</th>
                                <th class="min-w-50px">Spec RM</th>
                                <th class="min-w-50px">Customer</th>
                                <th class="min-w-50px">Price (Kg)</th>
                                <th class="min-w-20px">Price (Sheet)</th>
                                <th class="min-w-20px">Unit Weight</th>
                                <th class="min-w-20px">View</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#btnBackCreate").on('click', function() {
        window.history.replaceState({}, '', '<?php echo env('BASE_URL'); ?>/price_list');
        $("#kt_content").removeClass('d-none')
        $("#preview").addClass('d-none')
        $("#price_list_table").DataTable().ajax.reload()
        header_show()
    })
    $('#currency').select2({
        placeholder: 'Pilih Currency',
        minimumInputLength: 0,
        allowClear: true,
        ajax: {
            url: "{{ url('price_list/list_currency') }}",
            method: "POST",
            dataType: 'json',
            delay: 300,
            data: function(params) {
                return {
                    _token: "{{ csrf_token() }}",
                    search: params.term || '',
                    page: params.page || 1
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;

                return {
                    results: data.results,
                    pagination: {
                        more: data.pagination.more
                    }
                };
            },
            cache: true
        }
    });
    $("#btnSubmitHeader").on('click', function() {
        const price_list = $("#price_list").val()
        const description = $("#description").val()
        const start_date = $("#start_date").val()
        const end_date = $("#end_date").val()
        const type = $("#type").val()
        const currency = $("#currency").val()
        if (!price_list || !description || !type || !currency || !start_date || !end_date) {
            Swal.fire({
                icon: 'error',
                title: 'All fields are required',
                timer: 1500,
                showConfirmButton: false
            });
            return;
        }
        $.ajax({
            url: "{{ url('price_list/submit_header') }}",
            method: "POST",
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                price_list: price_list,
                description: description,
                start_date: start_date,
                end_date: end_date,
                type: type,
                currency: currency,
                customer: $("#customer_po").val()
            },
            success: function(response) {
                if (response.status == true) {
                    first_preview(response.id)
                    $("#kt_activity_detail").addClass('show active')
                    Toast.fire({
                        position: 'top-end',
                        title: response.message,
                        icon: "success"
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: response.message || 'Failed to create price list header',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            },
            error: function(xhr) {
                console.error(xhr);
                Toast.fire({
                    position: 'top-end',
                    title: xhr.responseJSON?.message ||
                        'An error occurred while creating price list header',
                    icon: "error"
                });
            }
        });
    })

    function first_preview(id) {
        $.ajax({
            url: "{{ url('price_list/first_preview') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: id
            },
            success: function(response) {
                if (response.status == true) {
                    window.history.replaceState({}, '', `<?php echo env('BASE_URL'); ?>/price_list?ref_doc=${id}`);
                    $("#price_list").val(response.data.PriceListName)
                    $("#description").val(response.data.Description)
                    $("#start_date").val(response.data.StartDate)
                    $("#end_date").val(response.data.EndDate)
                    $("#type").val(response.data.Type)
                    let currency = response.data.Currency;
                    let option = new Option(currency, currency, true, true);
                    $("#currency").append(option).trigger('change');
                    $("customer_po").val(response.data.Customer)
                    price_list_part_table()
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: response.message || 'Failed to load price list preview',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            },
            error: function(xhr) {
                console.error(xhr);
                Toast.fire({
                    position: 'top-end',
                    title: xhr.responseJSON?.message ||
                        'An error occurred while loading price list preview',
                    icon: "error"
                });
            }
        });
    }
    if (typeof window.formatter === 'undefined') {
        window.formatter = new Intl.NumberFormat('en-US');
    }
    $("#price_kg,#price_sheet").on('input', function() {
        let raw = $(this).val().replace(/[^0-9]/g, '');
        $(this).val(formatter.format(raw));
    });

    function price_list_part_table() {
        $("#price_list_part_table").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('price_list/part_list') }}",
                method: "POST",
                data: function(d) {
                    d._token = "{{ csrf_token() }}";
                    d.ref_doc = new URLSearchParams(window.location.search).get('ref_doc');
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
            }, {
                data: 'View'
            }]
        });
    }
    $("#submit_detail_part").on('click', function() {
        const part_no = $("#part_no").val()
        const product_name = $("#product_name").val()
        const spec_size = $("#spec_size").val()
        const price_kg = $("#price_kg").val()
        const price_sheet = $("#price_sheet").val()
        const unit_weight = $("#unit_weight").val()
        if (!part_no || !product_name || !spec_size || !price_kg || !price_sheet || !unit_weight) {
            Swal.fire({
                icon: 'error',
                title: 'All fields are required',
                timer: 1500,
                showConfirmButton: false
            });
            return;
        }
        $.ajax({
            url: "{{ url('price_list/submit_detail_part') }}",
            method: "POST",
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                ref_doc: new URLSearchParams(window.location.search).get('ref_doc'),
                part_no: part_no,
                product_name: product_name,
                spec_size: spec_size,
                customer: $("#customer_part").val(),
                price_kg: price_kg,
                price_sheet: price_sheet,
                unit_weight: unit_weight
            },
            success: function(response) {
                if (response.status == true) {
                    $("#exampleModal").modal('hide')
                    $("#part_no").val('')
                    $("#product_name").val('')
                    $("#spec_size").val('')
                    $("#price_kg").val('')
                    $("#price_sheet").val('')
                    $("#unit_weight").val('')
                    $("#price_list_part_table").DataTable().ajax.reload()
                    Toast.fire({
                        position: 'top-end',
                        title: response.message,
                        icon: "success"
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: response.message || 'Failed to add part to price list',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            },
            error: function(xhr) {
                console.error(xhr);
                Toast.fire({
                    position: 'top-end',
                    title: xhr.responseJSON?.message ||
                        'An error occurred while adding part to price list',
                    icon: "error"
                });
            }
        });
    })
    $("#part_no").on('input', function() {
        const part_no = $(this).val()
        if (part_no.length >= 3) {
            $.ajax({
                url: "{{ url('price_list/search_part') }}",
                method: "POST",
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    part_no: part_no
                },
                success: function(response) {
                    if (response.status == true) {
                        $("#product_name").val(response.data.ProductName)
                        $("#spec_size").val(response.data.Spec)
                    }
                },
                error: function(xhr) {
                    console.error(xhr);
                }
            });
        }
    })

    function getPartNo(id) {
        const part_no = $("#part_no" + id).val()
        if (part_no.length >= 3) {
            $.ajax({
                url: "{{ url('price_list/search_part') }}",
                method: "POST",
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    part_no: part_no
                },
                success: function(response) {
                    if (response.status == true) {
                        $("#product_name" + id).val(response.data.ProductName)
                        $("#spec_size" + id).val(response.data.Spec)
                    }
                },
                error: function(xhr) {
                    console.error(xhr);
                }
            });
        }
    }

    function update_detail_part(id) {
        const part_no = $("#part_no" + id).val()
        const product_name = $("#product_name" + id).val()
        const spec_size = $("#spec_size" + id).val()
        const price_kg = $("#price_kg" + id).val()
        const price_sheet = $("#price_sheet" + id).val()
        const unit_weight = $("#unit_weight" + id).val()
        if (!part_no || !product_name || !spec_size || !price_kg || !price_sheet || !unit_weight) {
            Swal.fire({
                icon: 'error',
                title: 'All fields are required',
                timer: 1500,
                showConfirmButton: false
            });
            return;
        }
        $.ajax({
            url: "{{ url('price_list/update_detail_part') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                part_no: part_no,
                product_name: product_name,
                spec: spec_size,
                customer: $("#customer_part" + id).val(),
                price_kg: price_kg,
                price_sheet: price_sheet,
                unit_weight: unit_weight
            },
            success: function(response) {
                if (response.status == true) {
                    $("#viewModal" + id).modal('hide')
                    Toast.fire({
                        position: 'top-end',
                        title: response.message,
                        icon: "success"
                    });
                    $("#price_list_part_table").DataTable().ajax.reload()
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: response.message || 'Failed to update part in price list',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            },
            error: function(xhr) {
                console.error(xhr);
                Toast.fire({
                    position: 'top-end',
                    title: xhr.responseJSON?.message ||
                        'An error occurred while updating part in price list',
                    icon: "error"
                });
            }
        });
    }
</script>
