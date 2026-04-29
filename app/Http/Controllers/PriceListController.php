<?php

namespace App\Http\Controllers;

use App\Libraries\Pdf;
use App\Models\PriceList;
use Carbon\Carbon;
use Crypt;
use Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TCPDF;

class PriceListController extends Controller
{
    protected $PriceList;
    public function __construct(PriceList $PriceList)
    {
        $this->PriceList = $PriceList;
    }
    public function index()
    {
        $my_id = Auth::user()->id;
        $uri = explode("/", url()->current());
        if (count($uri) < 5) {
            $menu = $this->menu($my_id, 'Verification');
        } else {
            $menu = $this->menu($my_id, $uri[4]);
        }
        $data['head_title'] = 'Price List';
        $data['menu_level_1'] = $menu['menu_level_1'];
        $data['menu_level_2'] = $menu['menu_level_2'];
        $data['menu_level_3'] = $menu['menu_level_3'];
        $data['menu_level_4'] = $menu['menu_level_4'];
        return view('price_list/index', $data);
    }
    public function index_approval()
    {
        $my_id = Auth::user()->id;
        $uri = explode("/", url()->current());
        if (count($uri) < 5) {
            $menu = $this->menu($my_id, 'Verification');
        } else {
            $menu = $this->menu($my_id, $uri[4]);
        }
        $data['head_title'] = 'Price List';
        $data['menu_level_1'] = $menu['menu_level_1'];
        $data['menu_level_2'] = $menu['menu_level_2'];
        $data['menu_level_3'] = $menu['menu_level_3'];
        $data['menu_level_4'] = $menu['menu_level_4'];
        return view('price_list/approval_index', $data);
    }
    public function show_price_list(Request $request)
    {
        $offset = $request->start;
        $limit = $request->length;
        $search = $request->input('search');
        $filter = $request->filter;
        $base = $this->PriceList->PriceList();
        if (!empty($search)) {
            $base->where(function ($q) use ($search) {
                $q->where('PriceListName', 'LIKE', "%{$search}%")
                    ->orWhere('Description', 'LIKE', "%{$search}%");
            });
        }
        if ($filter !== null && $filter !== 'all') {
            $base->where('Status', $filter);
        }
        $data = $base->offset($offset)->limit($limit)->get();
        $data = collect($data)->map(function ($row, $index) use ($offset) {
            $btn_status = '';
            if ($row->Status == 0) {
                $btn_status = '<button type="button" class="btn btn-warning btn-sm">Pending</button>';
            } else if ($row->Status == 1) {
                $btn_status = '<button type="button" class="btn btn-primary btn-sm">Checked</button>';
            } else if ($row->Status == 2) {
                $btn_status = '<button type="button" class="btn btn-primary btn-sm">Approved</button>';
            } else if ($row->Status == 3) {
                $btn_status = '<button type="button" class="btn btn-success btn-sm">Legalize</button>';
            }

            return [
                'No' => $offset + $index + 1,
                'Code' => $row->PriceListName,
                'Description' => $row->Description,
                'StartDate' => Carbon::parse($row->StartDate)->format('d-m-Y'),
                'EndDate' => Carbon::parse($row->EndDate)->format('d-m-Y'),
                'Status' => $btn_status,
                'View' =>
                    '<divclass="d-flex justify-content-start gap-2 flex-nowrap">
                    <button type="button" class="btn btn-success btn-sm"
                    onclick="openDualModal(\'' . Crypt::encryptString($row->ID) . '\')">
                    <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13" />
                    </svg>
                </span>
                </button>
                <button type="button" class="btn btn-primary btn-sm" onclick="document_preview(\'' . Crypt::encryptString($row->ID) . '\')">
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </span>
                </button>
                <button type="button" class="btn btn-danger btn-sm" onclick="priceListDelete(' . $row->ID . ')">
                <span class="svg-icon svg-icon-2">
                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </span>
                </button>
                </div>'
            ];
        });
        $count = $base->count();
        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => intval($count),
            'recordsFiltered' => intval($count),
            'data' => $data
        ]);
    }
    public function show_pl_approval(Request $request)
    {
        $offset = $request->start;
        $limit = $request->length;
        $search = $request->input('search');
        $filter = $request->filter;
        $base = DB::table('PriceHeader')
            ->selectRaw("
            StartDate,
            EndDate,
            COUNT(*) as total,
            MAX(Status) as Status,
            MIN(PriceListName) as PriceListName,
            MIN(Description) as Description
        ")
            ->groupBy('StartDate', 'EndDate');
        if (!empty($search)) {
            $base->where(function ($q) use ($search) {
                $q->where('PriceListName', 'LIKE', "%{$search}%")
                    ->orWhere('Description', 'LIKE', "%{$search}%");
            });
        }
        if ($filter !== null && $filter !== 'all') {
            $base->where('Status', $filter);
        }
        $data = $base->offset($offset)->limit($limit)->get();
        $data = collect($data)->map(function ($row, $index) use ($offset) {
            $btn_status = '';
            if ($row->Status == 0) {
                $btn_status = '<button type="button" class="btn btn-warning btn-sm">Pending</button>';
            } else if ($row->Status == 1) {
                $btn_status = '<button type="button" class="btn btn-primary btn-sm">Checked</button>';
            } else if ($row->Status == 2) {
                $btn_status = '<button type="button" class="btn btn-primary btn-sm">Approved</button>';
            } else if ($row->Status == 3) {
                $btn_status = '<button type="button" class="btn btn-success btn-sm">Legalize</button>';
            }
            $detail = Crypt::encryptString($row->StartDate . '~' . $row->EndDate);
            return [
                'No' => $offset + $index + 1,
                'Code' => $row->PriceListName,
                'Description' => $row->Description,
                'StartDate' => Carbon::parse($row->StartDate)->format('d-m-Y'),
                'EndDate' => Carbon::parse($row->EndDate)->format('d-m-Y'),
                'Status' => $btn_status,
                'View' =>
                    '<divclass="d-flex justify-content-start gap-2 flex-nowrap">
                <button type="button" class="btn btn-primary btn-sm" onclick="document_preview(\'' . $detail . '\')">
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </span>
                </button>
                </div>'
            ];
        });
        $count = $base->count();
        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => intval($count),
            'recordsFiltered' => intval($count),
            'data' => $data
        ]);
    }
    public function show_header(Request $request)
    {
        $wait_check = $this->PriceList->PriceList()->where('Status', 0)->count();
        $wait_app = $this->PriceList->PriceList()->where('Status', 1)->count();
        $wait_legal = $this->PriceList->PriceList()->where('Status', 2)->count();
        $all_doc = $this->PriceList->PriceList()->count();
        return response()->json([
            'status' => true,
            'wait_check' => $wait_check,
            'wait_app' => $wait_app,
            'wait_legal' => $wait_legal,
            'all_doc' => $all_doc
        ]);
    }
    public function create_view(Request $request)
    {
        try {
            if ($request->ref_doc == 'create') {
                return view('price_list.create');
            } else {
                return view('price_list.update');
            }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function pl_detail_view()
    {
        try {
            return view('price_list.approval_detail');
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function detail_pl_approval(Request $request)
    {
        $offset = $request->start;
        $limit = $request->length;
        $ref_doc = Crypt::decryptString($request->ref_doc);
        $start_date = explode('~', $ref_doc)[0];
        $end_date = explode('~', $ref_doc)[1];
        $base = $this->PriceList->PriceHwM()
            ->where('a.StartDate', $start_date)
            ->where('a.EndDate', $end_date)
            ->orderBy('b.CreatedAt', 'desc')
            ->offset($offset)
            ->limit($limit)
            ->get();
        $count = $this->PriceList->PriceHwM()
            ->where('a.StartDate', $start_date)
            ->where('a.EndDate', $end_date)
            ->count();
        $data = collect($base)->map(function ($row, $index) use ($offset) {
            return [
                'No' => $offset + $index + 1,
                'PartNo' => $row->PartNo,
                'ProductName' => $row->ProductName,
                'Spec' => $row->Spec,
                'Customer' => $row->Customer,
                'PriceKg' => 'Rp ' . number_format($row->PriceKg, 0, ',', '.'),
                'PriceSheet' => 'Rp ' . number_format($row->PriceSheet, 0, ',', '.'),
                'UnitWeight' => number_format($row->UnitWeight, 0, ',', '.')
            ];
        });
        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => intval($count),
            'recordsFiltered' => intval($count),
            'data' => $data
        ]);

    }
    public function get_status_approval()
    {
        $ref_doc = Crypt::decryptString(request()->ref_doc);
        [$start_date, $end_date] = explode('~', $ref_doc);
        $data = $this->PriceList->PriceList()
            ->where('StartDate', $start_date)
            ->where('EndDate', $end_date)
            ->first();
        $user = Auth::user()->username;
        $status = '';
        if ($user == '230715-001' || $user == '200525-001') {
            if ($data->Status == 0) {
                $status = 'pending';
            } else {
                $status = 'approved';
            }
        } else if ($user == '060120-001') {
            if ($data->Status == 1) {
                $status = 'pending';
            } else if ($data->Status > 1) {
                $status = 'approved';
            }
        } else if ($user == '190421-002') {
            if ($data->Status == 2) {
                $status = 'pending';
            } else if ($data->Status > 2) {
                $status = 'approved';
            }
        }
        return response()->json([
            'status' => $status
        ]);

    }
    public function list_currency(Request $request)
    {
        try {
            $page = $request->page ?? 1;
            $search = $request->search ?? '';
            $data = $this->PriceList->ListCurrency($search, $page);
            return response()->json([
                'results' => collect($data->items())->map(function ($item) {
                    return [
                        'id' => $item->CurrencyCode,
                        'text' => $item->CurrDesc
                    ];
                }),
                'pagination' => [
                    'more' => $data->hasMorePages()
                ]
            ]);
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $th->getMessage()
                ],
                500
            );
        }
    }
    public function submit_header(Request $request)
    {
        try {
            $check_data = $this->PriceList->PriceList()
                ->where('PriceListName', $request->price_list)
                ->first();
            if ($check_data) {
                return response()->json([
                    'status' => false,
                    'message' => 'Price list name already exists'
                ], 400);
            }
            $create = $this->PriceList->create([
                'PriceListName' => $request->price_list,
                'Description' => $request->description,
                'StartDate' => $request->start_date,
                'EndDate' => $request->end_date,
                'Currency' => $request->currency,
                'Type' => $request->type,
                'CreatedAt' => Date::now(),
                'CreatedBy' => Auth::user()->id,
                'Status' => 0
            ]);
            return response()->json([
                'status' => true,
                'id' => Crypt::encryptString($create),
                'message' => 'Price list header created successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function update_header(Request $request)
    {
        try {
            $id = Crypt::decryptString($request->id);
            $check_data = $this->PriceList->PriceList()
                ->where('PriceListName', $request->price_list)
                ->where('ID', '!=', $id)
                ->first();
            if ($check_data) {
                return response()->json([
                    'status' => false,
                    'message' => 'Price list name already exists'
                ], 400);
            }
            $this->PriceList->PriceList()->where('ID', $id)->update([
                'PriceListName' => $request->price_list,
                'Customer' => $request->customer,
                'Description' => $request->description,
                'StartDate' => $request->start_date,
                'EndDate' => $request->end_date,
                'Currency' => $request->currency,
                'Type' => $request->type,
                'UpdatedAt' => Date::now(),
                'UpdatedBy' => Auth::user()->id
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Price list header updated successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }

    }
    public function delete_header(Request $request)
    {
        try {
            $id = $request->id;
            $this->PriceList->PriceList()->where('ID', $id)->delete();
            $this->PriceList->AllPriceDetailPart()->where('HeaderID', $id)->delete();
            return response()->json([
                'status' => true,
                'message' => 'Price list header and its details deleted successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function first_preview(Request $request)
    {
        try {
            $id = Crypt::decryptString($request->id);
            $data = $this->PriceList
                ->PriceList()
                ->where('ID', $id)
                ->first();
            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function part_list(Request $request)
    {
        $offset = $request->start;
        $limit = $request->length;
        // $search = $request->input('search');
        $filter = $request->filter;
        $id = Crypt::decryptString($request->ref_doc);
        $base = $this->PriceList->AllPriceDetailPart()->where('HeaderID', $id)->orderBy('ID', 'desc');
        $data = $base->offset($offset)->limit($limit)->get();
        $data = collect($data)->map(function ($row, $index) use ($offset) {
            return [
                'No' => $offset + $index + 1,
                'PartNo' => $row->PartNo,
                'ProductName' => $row->ProductName,
                'Spec' => $row->Spec,
                'Customer' => $row->Customer,
                'PriceKg' => 'Rp ' . number_format($row->PriceKg, 0),
                'PriceSheet' => 'Rp ' . number_format($row->PriceSheet, 0),
                'UnitWeight' => number_format($row->UnitWeight, 0),
                'View' =>
                    '<div class="d-flex justify-center gap-1">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal' . $row->ID . '">
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </span>
                </button>
                <div class="modal fade" id="viewModal' . $row->ID . '" tabindex="-1" aria-labelledby="viewModalLabel' . $row->ID . '"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="viewModalLabel' . $row->ID . '">View Part</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-5">
                                                        <label class="form-label required">Part No</label>
                                                        <input type="text" class="form-control" id="part_no' . $row->ID . '" oninput="getPartNo(' . $row->ID . ')" value="' . $row->PartNo . '"  />
                                                    </div>
                                                    <div class="form-group mb-5">
                                                        <label class="form-label required">Product Name</label>
                                                        <input type="text" class="form-control"
                                                            id="product_name' . $row->ID . '" value="' . $row->ProductName . '" />
                                                    </div>
                                                    <div class="form-group mb-5">
                                                        <label class="form-label required">Price (Sheet)</label>
                                                        <input type="text" class="form-control"
                                                            id="price_sheet' . $row->ID . '" value="' . number_format($row->PriceSheet) . '" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-5">
                                                        <label class="form-label required">Spec / Size</label>
                                                        <input type="text" class="form-control" id="spec_size' . $row->ID . '" value="' . $row->Spec . '" />
                                                    </div>
                                                    <div class="form-group mb-5">
                                                        <label class="form-label">Customer</label>
                                                        <input type="text" class="form-control"
                                                            id="customer_part' . $row->ID . '" value="' . $row->Customer . '" />
                                                    </div>
                                                    <div class="form-group mb-5">
                                                        <label class="form-label required">Price (Kg)</label>
                                                        <input type="text" class="form-control" id="price_kg' . $row->ID . '" value="' . number_format($row->PriceKg) . '" />
                                                    </div>
                                                    <div class="form-group mb-5">
                                                        <label class="form-label required">Unit Weight (Kg/Sheet)
                                                        </label>
                                                        <input type="number" class="form-control"
                                                            id="unit_weight' . $row->ID . '" value="' . number_format($row->UnitWeight, 0, ',', '.') . '" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary"
                                                onclick="update_detail_part(' . $row->ID . ')">Update</button>
                                        </div>
                                    </div>
                                </div>
                </div>
                <button type="button" class="btn btn-danger btn-sm" onclick="partDelete(' . $row->ID . ')">
                <span class="svg-icon svg-icon-2">
                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </span>
                </button>
                </div>'
            ];
        });
        $count = $base->count();
        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => intval($count),
            'recordsFiltered' => intval($count),
            'data' => $data
        ]);
    }
    public function search_part(Request $request)
    {
        $spec = $this->PriceList->Part()
            ->where('PartNum', $request->part_no)
            ->first();
        $part_no = explode('-', $request->part_no)[0];
        $product = $this->PriceList->Part()
            ->where('PartNum', $part_no)
            ->first();
        return response()->json([
            'status' => true,
            'data' => [
                'Spec' => $spec?->PartDescription,
                'ProductName' => $product?->PartDescription
            ]
        ]);
    }
    public function submit_detail_part(Request $request)
    {
        try {
            $id = Crypt::decryptString($request->ref_doc);
            $Pricekg = str_replace(',', '', $request->price_kg);
            $PriceSheet = str_replace(',', '', $request->price_sheet);
            $UnitWeight = str_replace('.', '', $request->unit_weight);
            $this->PriceList->AllPriceDetailPart()->insert([
                'HeaderID' => $id,
                'PartNo' => $request->part_no,
                'ProductName' => $request->product_name,
                'Spec' => $request->spec_size,
                'Customer' => $request->customer,
                'PriceKg' => $Pricekg,
                'PriceSheet' => $PriceSheet,
                'UnitWeight' => $UnitWeight,
                'CreatedAt' => Date::now(),
                'CreatedBy' => Auth::user()->id
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Price list detail part created successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function delete_part(Request $request)
    {
        try {
            $this->PriceList->AllPriceDetailPart()->where('ID', $request->id)->delete();
            return response()->json([
                'status' => true,
                'message' => 'Price list detail part deleted successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function update_detail_part(Request $request)
    {
        try {
            $Pricekg = str_replace(',', '', $request->price_kg);
            $PriceSheet = str_replace(',', '', $request->price_sheet);
            $UnitWeight = str_replace('.', '', $request->unit_weight);
            $this->PriceList->AllPriceDetailPart()->where('ID', $request->id)->update([
                'PartNo' => $request->part_no,
                'ProductName' => $request->product_name,
                'Spec' => $request->spec,
                'Customer' => $request->customer,
                'PriceKg' => $Pricekg,
                'PriceSheet' => $PriceSheet,
                'UnitWeight' => $UnitWeight,
                'UpdatedAt' => Date::now(),
                'UpdatedBy' => Auth::user()->id
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Price list detail part updated successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }

    }
    public function confirmation_letter($id)
    {
        try {
            $id = Crypt::decryptString($id);
            $data = $this->PriceList->PriceList()
                ->first();
            if (!$data) {
                abort(404, 'Data tidak ditemukan');
            }
            $html = view('price_list.confirmation_letter_all', [
                'data' => $data
            ])->render();
            $pdf = new Pdf();

            $pdf->SetCreator('SAI');
            $pdf->SetAuthor('System');
            $pdf->SetTitle('Confirmation Letter');
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(true);
            $pdf->SetMargins(8, 10, 8);
            $pdf->AddPage();
            $pdf->writeHTML($html, true, false, true, false, '');
            return response($pdf->Output('confirmation_letter.pdf', 'S'))
                ->header('Content-Type', 'application/pdf');

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function confirmation_letter_all($id)
    {
        $id = Crypt::decryptString($id);
        $start_date = explode('~', $id)[0];
        $end_date = explode('~', $id)[1];
        $data = $this->PriceList->PriceList()
            ->where('StartDate', $start_date)
            ->where('EndDate', $end_date)
            ->get();
        $html = view('price_list.confirmation_letter_all', [
            'data' => $data
        ])->render();
        $pdf = new Pdf();

        $pdf->SetCreator('SAI');
        $pdf->SetAuthor('System');
        $pdf->SetTitle('Confirmation Letter');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(true);
        $pdf->SetMargins(8, 10, 8);
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');
        return response($pdf->Output('confirmation_letter.pdf', 'S'))
            ->header('Content-Type', 'application/pdf');
    }
    public function price_material($id)
    {
        try {
            $id = Crypt::decryptString($id);
            $data = $this->PriceList->AllPriceDetailPart()
                ->where('HeaderID', $id)
                ->get();
            if (!$data) {
                abort(404, 'Data tidak ditemukan');
            }
            $header = $this->PriceList->PriceList()
                ->leftJoin('users', 'PriceHeader.CreatedBy', '=', 'users.id')
                ->where('PriceHeader.ID', $id)
                ->select('PriceHeader.*', 'users.full_name as CreatedByName')
                ->first();
            $html = view('price_list.price_material', [
                'data' => $data,
                'header' => $header
            ])->render();
            $pdf = new Pdf();

            $pdf->SetCreator('SAI');
            $pdf->SetAuthor('System');
            $pdf->SetTitle('Price Material');
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->SetMargins(5, 10, 5);
            $pdf->AddPage('L', 'A4');
            $pdf->writeHTML($html, true, false, true, false, '');
            return response($pdf->Output('price_material.pdf', 'S'))
                ->header('Content-Type', 'application/pdf');

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function price_material_all($id)
    {
        try {
            $id = Crypt::decryptString($id);
            [$StartDate, $EndDate] = explode('~', $id);
            $header = $this->PriceList->PriceList()
                ->leftJoin('users', 'PriceHeader.CreatedBy', '=', 'users.id')
                ->where('PriceHeader.StartDate', $StartDate)
                ->where('PriceHeader.EndDate', $EndDate)
                ->select('PriceHeader.*', 'users.full_name as CreatedByName')
                ->get();
            $data = $this->PriceList->AllPriceDetailPart()
                ->whereIn('HeaderID', $header->pluck('ID'))
                ->get();
            if ($data->isEmpty()) {
                abort(404, 'Data tidak ditemukan');
            }
            $html = view('price_list.price_material_all', [
                'data' => $data,
                'header' => $header
            ])->render();
            $pdf = new Pdf();

            $pdf->SetCreator('SAI');
            $pdf->SetAuthor('System');
            $pdf->SetTitle('Price Material');
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->SetMargins(5, 10, 5);
            $pdf->AddPage('L', 'A4');
            $pdf->writeHTML($html, true, false, true, false, '');
            return response($pdf->Output('price_material.pdf', 'S'))
                ->header('Content-Type', 'application/pdf');

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function approved(Request $request)
    {
        try {
            $ref_doc = Crypt::decryptString($request->ref_doc);
            [$start_date, $end_date] = explode('~', $ref_doc);
            $data = $this->PriceList->PriceList()
                ->where('StartDate', $start_date)
                ->where('EndDate', $end_date)
                ->get();
            if ($data->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data not found'
                ], 404);
            }
            $this->PriceList->PriceList()
                ->where('StartDate', $start_date)
                ->where('EndDate', $end_date)
                ->update(['Status' => DB::raw('Status + 1')]);
            return response()->json([
                'status' => true,
                'message' => 'Price list approved successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }

    }
}
