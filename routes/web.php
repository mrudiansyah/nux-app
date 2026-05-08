<?php

use App\Http\Controllers\ApInvoiceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\IssueMaterialController;
use App\Http\Controllers\PriceListController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\ReceiptEntryController;
use App\Http\Controllers\SalesReportEntertainController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/get_captcha', [App\Http\Controllers\Controller::class, 'get_captcha'])->name('get_captcha');
Route::POST('/check_robot', [App\Http\Controllers\ApplicationsController::class, 'check_robot'])->name('check_robot');
Route::POST('/check_robot_login', [App\Http\Controllers\Auth\LoginController::class, 'check_robot_login'])->name('check_robot_login');
Route::POST('register_account', [App\Http\Controllers\Auth\RegisterController::class, 'register_account'])->name('register_account');
Route::POST('verification_account', [App\Http\Controllers\Auth\RegisterController::class, 'verification_account'])->name('verification_account');
Route::get('/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'index']);
Route::POST('/confirm_reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'confirm_reset'])->name('confirm_reset');
Route::POST('/change_password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'change_password'])->name('change_password');
Route::get('/confirm_password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'confirm_password']);

// Auth::routes();
Route::get('login', function () {
    return view('auth.login');
})->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/po_approval', [App\Http\Controllers\POApprovalController::class, 'index']);
    Route::POST('po_approval.front_table', [App\Http\Controllers\POApprovalController::class, 'front_table'])->name('po_approval.front_table');
    Route::post('po_approval.print_view', [App\Http\Controllers\POApprovalController::class, 'print_view'])->name('po_approval.print_view');
    Route::get('/po_preview', [App\Http\Controllers\POApprovalController::class, 'file_print'])->name('po_file_print');
    Route::get('export_po', [App\Http\Controllers\POApprovalController::class, 'export_front_table'])->name('export_po');
    Route::post('po_approval.get_attachment_list', [App\Http\Controllers\POApprovalController::class, 'get_attachment_list'])->name('po_approval.get_attachment_list');
    Route::post('po_approval.get_comment_list', [App\Http\Controllers\POApprovalController::class, 'get_comment_list'])->name('po_approval.get_comment_list');
    Route::post('po_approval.sent_comment', [App\Http\Controllers\POApprovalController::class, 'sent_comment'])->name('po_approval.sent_comment');
    Route::post('po_approval.get_count_document', [App\Http\Controllers\POApprovalController::class, 'get_count_document'])->name('po_approval.get_count_document');
    Route::post('po_approval.show_attachment', [App\Http\Controllers\POApprovalController::class, 'show_attachment'])->name('po_approval.show_attachment');
    Route::post('po_approval.submit_approval', [App\Http\Controllers\POApprovalController::class, 'submit_approval'])->name('po_approval.submit_approval');
    Route::post('po_approval.get_button_approve', [App\Http\Controllers\POApprovalController::class, 'get_button_approve'])->name('po_approval.get_button_approve');
    Route::post('po_approval.send_email_po', [App\Http\Controllers\POApprovalController::class, 'sendApprovalNotification'])->name('po_approval.send_email_po');


    Route::get('/pr_approval', [App\Http\Controllers\POApprovalController::class, 'index']);
    Route::POST('pr_approval.front_table', [App\Http\Controllers\POApprovalController::class, 'front_table'])->name('pr_approval.front_table');
    Route::post('pr_approval.print_view', [App\Http\Controllers\POApprovalController::class, 'print_view'])->name('pr_approval.print_view');
    Route::get('export_po', [App\Http\Controllers\POApprovalController::class, 'export_front_table'])->name('export_po');
    Route::post('pr_approval.get_attachment_list', [App\Http\Controllers\POApprovalController::class, 'get_attachment_list'])->name('pr_approval.get_attachment_list');
    Route::post('pr_approval.get_comment_list', [App\Http\Controllers\POApprovalController::class, 'get_comment_list'])->name('pr_approval.get_comment_list');
    Route::post('pr_approval.sent_comment', [App\Http\Controllers\POApprovalController::class, 'sent_comment'])->name('pr_approval.sent_comment');
    Route::post('pr_approval.get_count_document', [App\Http\Controllers\POApprovalController::class, 'get_count_document'])->name('pr_approval.get_count_document');
    Route::post('pr_approval.show_attachment', [App\Http\Controllers\POApprovalController::class, 'show_attachment'])->name('pr_approval.show_attachment');
    Route::post('pr_approval.submit_approval', [App\Http\Controllers\POApprovalController::class, 'submit_approval'])->name('pr_approval.submit_approval');
    Route::post('pr_approval.get_button_approve', [App\Http\Controllers\POApprovalController::class, 'get_button_approve'])->name('pr_approval.get_button_approve');

    Route::get('/pr_approval', [App\Http\Controllers\PRApprovalController::class, 'index']);
    Route::POST('pr_approval.front_table', [App\Http\Controllers\PRApprovalController::class, 'front_table'])->name('pr_approval.front_table');
    Route::post('pr_approval.print_view', [App\Http\Controllers\PRApprovalController::class, 'print_view'])->name('pr_approval.print_view');
    Route::get('/pr_preview', [App\Http\Controllers\PRApprovalController::class, 'file_print'])->name('pr_file_print');
    Route::get('export_pr', [App\Http\Controllers\PRApprovalController::class, 'export_front_table'])->name('export_pr');
    Route::post('pr_approval.get_attachment_list', [App\Http\Controllers\PRApprovalController::class, 'get_attachment_list'])->name('pr_approval.get_attachment_list');
    Route::post('pr_approval.get_comment_list', [App\Http\Controllers\PRApprovalController::class, 'get_comment_list'])->name('pr_approval.get_comment_list');
    Route::post('pr_approval.sent_comment', [App\Http\Controllers\PRApprovalController::class, 'sent_comment'])->name('pr_approval.sent_comment');
    Route::post('pr_approval.get_count_document', [App\Http\Controllers\PRApprovalController::class, 'get_count_document'])->name('pr_approval.get_count_document');
    Route::post('pr_approval.show_attachment', [App\Http\Controllers\PRApprovalController::class, 'show_attachment'])->name('pr_approval.show_attachment');
    Route::post('pr_approval.submit_approval', [App\Http\Controllers\PRApprovalController::class, 'submit_approval'])->name('pr_approval.submit_approval');
    Route::post('pr_approval.get_button_approve', [App\Http\Controllers\PRApprovalController::class, 'get_button_approve'])->name('pr_approval.get_button_approve');
    Route::post('pr_approval.send_email_pr', [App\Http\Controllers\PRApprovalController::class, 'sendApprovalNotification'])->name('pr_approval.send_email_pr');
    Route::post('pr_approval.send_email_pr2', [App\Http\Controllers\PRApprovalController::class, 'sendApprovalNotification2'])->name('pr_approval.send_email_pr2');


    Route::get('/del_confirm', [App\Http\Controllers\DelConfirmController::class, 'index']);
    Route::POST('delcon.front_table', [App\Http\Controllers\DelConfirmController::class, 'front_table'])->name('delcon.front_table');
    Route::POST('delcon.item_po_list', [App\Http\Controllers\DelConfirmController::class, 'item_po_list'])->name('delcon.item_po_list');
    Route::POST('delcon.listing_po', [App\Http\Controllers\DelConfirmController::class, 'listing_po'])->name('delcon.listing_po');
    Route::POST('delcon.proceed_to_draft', [App\Http\Controllers\DelConfirmController::class, 'proceed_to_draft'])->name('delcon.proceed_to_draft');
    Route::POST('delcon.get_head_properties', [App\Http\Controllers\DelConfirmController::class, 'get_head_properties'])->name('delcon.get_head_properties');
    Route::get('/del_confirm/di_form_edit', [App\Http\Controllers\DelConfirmController::class, 'di_form_edit']);
    Route::get('/del_confirm/di_form', [App\Http\Controllers\DelConfirmController::class, 'di_form']);
    Route::POST('delcon.store_head', [App\Http\Controllers\DelConfirmController::class, 'store_head'])->name('delcon.store_head');
    Route::POST('delcon.detail_order', [App\Http\Controllers\DelConfirmController::class, 'detail_order'])->name('delcon.detail_order');
    Route::POST('delcon.store_detail', [App\Http\Controllers\DelConfirmController::class, 'store_detail'])->name('delcon.store_detail');
    Route::POST('delcon.checking_all_rule', [App\Http\Controllers\DelConfirmController::class, 'checking_all_rule'])->name('delcon.checking_all_rule');
    Route::POST('delcon.document_confirm', [App\Http\Controllers\DelConfirmController::class, 'document_confirm'])->name('delcon.document_confirm');
    Route::POST('delcon.add_tag_label', [App\Http\Controllers\DelConfirmController::class, 'add_tag_label'])->name('delcon.add_tag_label');
    Route::POST('delcon.tag_lable_table', [App\Http\Controllers\DelConfirmController::class, 'tag_lable_table'])->name('delcon.tag_lable_table');
    Route::POST('delcon.store_tag_label', [App\Http\Controllers\DelConfirmController::class, 'store_tag_label'])->name('delcon.store_tag_label');
    Route::POST('delcon.destroy_tag_label', [App\Http\Controllers\DelConfirmController::class, 'destroy_tag_label'])->name('delcon.destroy_tag_label');
    Route::POST('delcon.clear_tag_label', [App\Http\Controllers\DelConfirmController::class, 'clear_tag_label'])->name('delcon.clear_tag_label');
    Route::POST('delcon.generate_tag_label', [App\Http\Controllers\DelConfirmController::class, 'generate_tag_label'])->name('delcon.generate_tag_label');
    Route::POST('delcon.cancel_confirm', [App\Http\Controllers\DelConfirmController::class, 'cancel_confirm'])->name('delcon.cancel_confirm');
    Route::get('/del_confirm/document_preview', [App\Http\Controllers\DelConfirmController::class, 'document_preview']);
    Route::get('di_print_preview', [App\Http\Controllers\DelConfirmController::class, 'file_print'])->name('di_print_preview');
    Route::POST('delcon.print_view', [App\Http\Controllers\DelConfirmController::class, 'print_view'])->name('delcon.print_view');
    Route::POST('delcon.print_label_view', [App\Http\Controllers\DelConfirmController::class, 'print_label_view'])->name('delcon.print_label_view');
    Route::POST('delcon.checking_revise', [App\Http\Controllers\DelConfirmController::class, 'checking_revise'])->name('delcon.checking_revise');
    Route::get('di_label_print', [App\Http\Controllers\DelConfirmController::class, 'file_label_print'])->name('di_label_print');
    Route::get('del_confirm/open_doc', [App\Http\Controllers\DelConfirmController::class, 'open_doc']);
    Route::POST('delcon.return_to_draft', [App\Http\Controllers\DelConfirmController::class, 'return_to_draft'])->name('delcon.return_to_draft');
    Route::POST('delcon.get_ref_doc_id', [App\Http\Controllers\DelConfirmController::class, 'get_ref_doc_id'])->name('delcon.get_ref_doc_id');
    Route::POST('delcon.document_delete', [App\Http\Controllers\DelConfirmController::class, 'document_delete'])->name('delcon.document_delete');

    Route::get('/production_jo', [App\Http\Controllers\ProductionJOController::class, 'index']);
    Route::get('/production_jo', [App\Http\Controllers\ProductionJOController::class, 'index']);

    Route::get('/customer_shipment', [App\Http\Controllers\CustomerShipmentController::class, 'index']);

    Route::get('/shipment_preparation', [App\Http\Controllers\ShipmentPreparationController::class, 'index']);
    Route::post('shipment_preparation.get_count_document', [App\Http\Controllers\ShipmentPreparationController::class, 'get_count_document'])->name('shipment_preparation.get_count_document');
    Route::post('shipment_preparation.get_preview_doc', [App\Http\Controllers\ShipmentPreparationController::class, 'get_preview_doc'])->name('shipment_preparation.get_preview_doc');
    Route::post('shipment_preparation.add_document', [App\Http\Controllers\ShipmentPreparationController::class, 'add_document'])->name('shipment_preparation.add_document');
    Route::post('shipment_preparation.set_order_number', [App\Http\Controllers\ShipmentPreparationController::class, 'set_order_number'])->name('shipment_preparation.set_order_number');
    Route::post('shipment_preparation.submit_label', [App\Http\Controllers\ShipmentPreparationController::class, 'submit_label'])->name('shipment_preparation.submit_label');
    Route::post('shipment_preparation.submit_label_by_slip_no', [App\Http\Controllers\ShipmentPreparationController::class, 'submit_label_by_slip_no'])->name('shipment_preparation.submit_label_by_slip_no');
    Route::post('shipment_preparation.update_detail', [App\Http\Controllers\ShipmentPreparationController::class, 'update_detail'])->name('shipment_preparation.update_detail');
    Route::post('shipment_preparation.post_detail', [App\Http\Controllers\ShipmentPreparationController::class, 'post_detail'])->name('shipment_preparation.post_detail');
    Route::post('shipment_preparation.check_before_delete', [App\Http\Controllers\ShipmentPreparationController::class, 'check_before_delete'])->name('shipment_preparation.check_before_delete');
    Route::post('shipment_preparation.detail_release_table', [App\Http\Controllers\ShipmentPreparationController::class, 'detail_release_table'])->name('shipment_preparation.detail_release_table');
    Route::post('shipment_preparation.get_button_approve', [App\Http\Controllers\ShipmentPreparationController::class, 'get_button_approve'])->name('shipment_preparation.get_button_approve');
    Route::post('shipment_preparation.front_table', [App\Http\Controllers\ShipmentPreparationController::class, 'front_table'])->name('shipment_preparation.front_table');
    Route::post('shipment_preparation.detail_table', [App\Http\Controllers\ShipmentPreparationController::class, 'detail_table'])->name('shipment_preparation.detail_table');
    Route::post('shipment_preparation.delete_document', [App\Http\Controllers\ShipmentPreparationController::class, 'delete_document'])->name('shipment_preparation.delete_document');
    Route::post('shipment_preparation.ready_to_print', [App\Http\Controllers\ShipmentPreparationController::class, 'ready_to_print'])->name('shipment_preparation.ready_to_print');
    Route::post('production_schedule.get_warehouse_id', [App\Http\Controllers\ProductionScheduleController::class, 'get_warehouse_id'])->name('production_schedule.get_warehouse_id');
    Route::post('shipment_preparation.un_ready_to_print', [App\Http\Controllers\ShipmentPreparationController::class, 'un_ready_to_print'])->name('shipment_preparation.un_ready_to_print');

    Route::get('/customer_shipment', [App\Http\Controllers\CustomerShipmentController::class, 'index']);
    Route::post('customer_shipment.get_count_document', [App\Http\Controllers\CustomerShipmentController::class, 'get_count_document'])->name('customer_shipment.get_count_document');
    Route::post('customer_shipment.get_preview_doc', [App\Http\Controllers\CustomerShipmentController::class, 'get_preview_doc'])->name('customer_shipment.get_preview_doc');
    Route::post('customer_shipment.add_document', [App\Http\Controllers\CustomerShipmentController::class, 'add_document'])->name('customer_shipment.add_document');
    Route::post('customer_shipment.set_order_number', [App\Http\Controllers\CustomerShipmentController::class, 'set_order_number'])->name('customer_shipment.set_order_number');
    Route::post('customer_shipment.submit_label', [App\Http\Controllers\CustomerShipmentController::class, 'submit_label'])->name('customer_shipment.submit_label');
    Route::post('customer_shipment.submit_label_by_slip_no', [App\Http\Controllers\CustomerShipmentController::class, 'submit_label_by_slip_no'])->name('customer_shipment.submit_label_by_slip_no');
    Route::post('customer_shipment.update_detail', [App\Http\Controllers\CustomerShipmentController::class, 'update_detail'])->name('customer_shipment.update_detail');
    Route::post('customer_shipment.post_detail', [App\Http\Controllers\CustomerShipmentController::class, 'post_detail'])->name('customer_shipment.post_detail');
    Route::post('customer_shipment.check_before_delete', [App\Http\Controllers\CustomerShipmentController::class, 'check_before_delete'])->name('customer_shipment.check_before_delete');
    Route::post('customer_shipment.detail_release_table', [App\Http\Controllers\CustomerShipmentController::class, 'detail_release_table'])->name('customer_shipment.detail_release_table');
    Route::post('customer_shipment.get_button_approve', [App\Http\Controllers\CustomerShipmentController::class, 'get_button_approve'])->name('customer_shipment.get_button_approve');
    Route::post('customer_shipment.front_table', [App\Http\Controllers\CustomerShipmentController::class, 'front_table'])->name('customer_shipment.front_table');
    Route::post('customer_shipment.detail_table', [App\Http\Controllers\CustomerShipmentController::class, 'detail_table'])->name('customer_shipment.detail_table');
    Route::post('customer_shipment.delete_document', [App\Http\Controllers\CustomerShipmentController::class, 'delete_document'])->name('customer_shipment.delete_document');
    Route::post('customer_shipment.ready_to_print', [App\Http\Controllers\CustomerShipmentController::class, 'ready_to_print'])->name('customer_shipment.ready_to_print');
    Route::post('production_schedule.get_warehouse_id', [App\Http\Controllers\ProductionScheduleController::class, 'get_warehouse_id'])->name('production_schedule.get_warehouse_id');
    Route::post('customer_shipment.un_ready_to_print', [App\Http\Controllers\CustomerShipmentController::class, 'un_ready_to_print'])->name('customer_shipment.un_ready_to_print');

    Route::get('/shipment_preparation_rm', [App\Http\Controllers\ShipmentPreparationRMController::class, 'index'])->name('/shipment_preparation_rm');
    Route::post('shipment_preparation_rm.get_count_document', [App\Http\Controllers\ShipmentPreparationRMController::class, 'get_count_document'])->name('shipment_preparation_rm.get_count_document');
    Route::post('shipment_preparation_rm.get_preview_doc', [App\Http\Controllers\ShipmentPreparationRMController::class, 'get_preview_doc'])->name('shipment_preparation_rm.get_preview_doc');
    Route::post('shipment_preparation_rm.add_document', [App\Http\Controllers\ShipmentPreparationRMController::class, 'add_document'])->name('shipment_preparation_rm.add_document');
    Route::post('shipment_preparation_rm.set_order_number', [App\Http\Controllers\ShipmentPreparationRMController::class, 'set_order_number'])->name('shipment_preparation_rm.set_order_number');
    Route::post('shipment_preparation_rm.submit_label', [App\Http\Controllers\ShipmentPreparationRMController::class, 'submit_label'])->name('shipment_preparation_rm.submit_label');
    Route::post('shipment_preparation_rm.submit_label_by_slip_no', [App\Http\Controllers\ShipmentPreparationRMController::class, 'submit_label_by_slip_no'])->name('shipment_preparation_rm.submit_label_by_slip_no');
    Route::post('shipment_preparation_rm.update_detail', [App\Http\Controllers\ShipmentPreparationRMController::class, 'update_detail'])->name('shipment_preparation_rm.update_detail');
    Route::post('shipment_preparation_rm.post_detail', [App\Http\Controllers\ShipmentPreparationRMController::class, 'post_detail'])->name('shipment_preparation_rm.post_detail');
    Route::post('shipment_preparation_rm.check_before_delete', [App\Http\Controllers\ShipmentPreparationRMController::class, 'check_before_delete'])->name('shipment_preparation_rm.check_before_delete');
    Route::post('shipment_preparation_rm.detail_release_table', [App\Http\Controllers\ShipmentPreparationRMController::class, 'detail_release_table'])->name('shipment_preparation_rm.detail_release_table');
    Route::post('shipment_preparation_rm.get_button_approve', [App\Http\Controllers\ShipmentPreparationRMController::class, 'get_button_approve'])->name('shipment_preparation_rm.get_button_approve');
    Route::post('shipment_preparation_rm.front_table', [App\Http\Controllers\ShipmentPreparationRMController::class, 'front_table'])->name('shipment_preparation_rm.front_table');
    Route::post('shipment_preparation_rm.detail_table', [App\Http\Controllers\ShipmentPreparationRMController::class, 'detail_table'])->name('shipment_preparation_rm.detail_table');
    Route::post('shipment_preparation_rm.delete_document', [App\Http\Controllers\ShipmentPreparationRMController::class, 'delete_document'])->name('shipment_preparation_rm.delete_document');
    Route::post('shipment_preparation_rm.ready_to_print', [App\Http\Controllers\ShipmentPreparationRMController::class, 'ready_to_print'])->name('shipment_preparation_rm.ready_to_print');
    // Route::post('production_schedule.get_warehouse_id', [App\Http\Controllers\ProductionScheduleController::class, 'get_warehouse_id'])->name('production_schedule.get_warehouse_id');
    Route::post('shipment_preparation_rm.un_ready_to_print', [App\Http\Controllers\ShipmentPreparationRMController::class, 'un_ready_to_print'])->name('shipment_preparation_rm.un_ready_to_print');

    Route::get('/production_schedule', [App\Http\Controllers\ProductionScheduleController::class, 'index']);
    Route::post('production_schedule.get_resource_group', [App\Http\Controllers\ProductionScheduleController::class, 'get_resource_group'])->name('production_schedule.get_resource_group');
    Route::post('production_schedule.get_resource_form', [App\Http\Controllers\ProductionScheduleController::class, 'get_resource_form'])->name('production_schedule.get_resource_form');
    Route::post('production_schedule.get_resource', [App\Http\Controllers\ProductionScheduleController::class, 'get_resource'])->name('production_schedule.get_resource');
    Route::post('production_schedule.get_preview_doc', [App\Http\Controllers\ProductionScheduleController::class, 'get_preview_doc'])->name('production_schedule.get_preview_doc');
    Route::post('production_schedule.detail_table', [App\Http\Controllers\ProductionScheduleController::class, 'detail_table'])->name('production_schedule.detail_table');
    Route::post('production_schedule.front_table', [App\Http\Controllers\ProductionScheduleController::class, 'front_table'])->name('production_schedule.front_table');
    Route::post('production_schedule.generate_tag_label', [App\Http\Controllers\ProductionScheduleController::class, 'generate_tag_label'])->name('production_schedule.generate_tag_label');
    Route::post('production_schedule.save_tag_label', [App\Http\Controllers\ProductionScheduleController::class, 'save_tag_label'])->name('production_schedule.save_tag_label');
    Route::post('production_schedule.clear_tag_label', [App\Http\Controllers\ProductionScheduleController::class, 'clear_tag_label'])->name('production_schedule.clear_tag_label');
    Route::post('production_schedule.delete_tag_label', [App\Http\Controllers\ProductionScheduleController::class, 'delete_tag_label'])->name('production_schedule.delete_tag_label');
    Route::post('production_schedule.tag_print_view', [App\Http\Controllers\ProductionScheduleController::class, 'tag_print_view'])->name('production_schedule.tag_print_view');
    Route::get('/production_schedule_tag_label_preview', [App\Http\Controllers\ProductionScheduleController::class, 'tag_label_print'])->name('production_schedule_tag_label_preview');
    Route::get('export_production_sch', [App\Http\Controllers\ProductionScheduleController::class, 'export_production_sch'])->name('export_production_sch');

    Route::get('/time_entry', [App\Http\Controllers\TimeEntryController::class, 'index']);
    Route::post('time_entry.get_resource_group', [App\Http\Controllers\TimeEntryController::class, 'get_resource_group'])->name('time_entry.get_resource_group');
    Route::post('time_entry.get_employee_list', [App\Http\Controllers\TimeEntryController::class, 'get_employee_list'])->name('time_entry.get_employee_list');
    Route::post('time_entry.get_resource', [App\Http\Controllers\TimeEntryController::class, 'get_resource'])->name('time_entry.get_resource');
    Route::post('time_entry.get_count_document', [App\Http\Controllers\TimeEntryController::class, 'get_count_document'])->name('time_entry.get_count_document');
    Route::post('time_entry.get_shift_list', [App\Http\Controllers\TimeEntryController::class, 'get_shift_list'])->name('time_entry.get_shift_list');
    Route::post('time_entry.get_job_list', [App\Http\Controllers\TimeEntryController::class, 'get_job_list'])->name('time_entry.get_job_list');
    Route::post('time_entry.add_document', [App\Http\Controllers\TimeEntryController::class, 'add_document'])->name('time_entry.add_document');
    Route::post('time_entry.submit_header', [App\Http\Controllers\TimeEntryController::class, 'submit_header'])->name('time_entry.submit_header');
    Route::post('time_entry.delete_header', [App\Http\Controllers\TimeEntryController::class, 'delete_header'])->name('time_entry.delete_header');
    Route::post('time_entry.submit_detail', [App\Http\Controllers\TimeEntryController::class, 'submit_detail'])->name('time_entry.submit_detail');
    Route::post('time_entry.change_time', [App\Http\Controllers\TimeEntryController::class, 'change_time'])->name('time_entry.change_time');
    Route::post('time_entry.get_new_detail', [App\Http\Controllers\TimeEntryController::class, 'get_new_detail'])->name('time_entry.get_new_detail');
    Route::post('time_entry.submit_detail_complete', [App\Http\Controllers\TimeEntryController::class, 'submit_detail_complete'])->name('time_entry.submit_detail_complete');
    Route::post('time_entry.get_reason_code_scrap_list', [App\Http\Controllers\TimeEntryController::class, 'get_reason_code_scrap_list'])->name('time_entry.get_reason_code_scrap_list');
    Route::post('time_entry.get_indirect_code_list', [App\Http\Controllers\TimeEntryController::class, 'get_indirect_code_list'])->name('time_entry.get_indirect_code_list');
    Route::post('time_entry.check_document_status', [App\Http\Controllers\TimeEntryController::class, 'check_document_status'])->name('time_entry.check_document_status');
    Route::post('time_entry.submit_form', [App\Http\Controllers\TimeEntryController::class, 'submit_form'])->name('time_entry.submit_form');
    Route::post('time_entry.recall_form', [App\Http\Controllers\TimeEntryController::class, 'recall_form'])->name('time_entry.recall_form');
    Route::post('time_entry.get_part_num_list', [App\Http\Controllers\TimeEntryController::class, 'get_part_num_list'])->name('time_entry.get_part_num_list');
    Route::post('time_entry.get_partnum_attr', [App\Http\Controllers\TimeEntryController::class, 'get_partnum_attr'])->name('time_entry.get_partnum_attr');
    Route::post('time_entry.get_jobnum_attr', [App\Http\Controllers\TimeEntryController::class, 'get_jobnum_attr'])->name('time_entry.get_jobnum_attr');
    Route::post('time_entry.front_table', [App\Http\Controllers\TimeEntryController::class, 'front_table'])->name('time_entry.front_table');


    Route::get('/inventory_move_in', [App\Http\Controllers\InventoryMoveInController::class, 'index']);
    Route::post('inventory_move_in.front_table', [App\Http\Controllers\InventoryMoveInController::class, 'front_table'])->name('inventory_move_in.front_table');
    Route::post('inventory_move_in.add_document', [App\Http\Controllers\InventoryMoveInController::class, 'add_document'])->name('inventory_move_in.add_document');
    Route::post('inventory_move_in.get_new_docnum', [App\Http\Controllers\InventoryMoveInController::class, 'get_new_docnum'])->name('inventory_move_in.get_new_docnum');
    Route::post('inventory_move_in.submit_form_mit', [App\Http\Controllers\InventoryMoveInController::class, 'submit_form_mit'])->name('inventory_move_in.submit_form_mit');
    Route::post('inventory_move_in.submit_delete_item', [App\Http\Controllers\InventoryMoveInController::class, 'submit_delete_item'])->name('inventory_move_in.submit_delete_item');
    Route::post('inventory_move_in.detail_table', [App\Http\Controllers\InventoryMoveInController::class, 'detail_table'])->name('inventory_move_in.detail_table');
    Route::post('inventory_move_in.submit_form_job', [App\Http\Controllers\InventoryMoveInController::class, 'submit_form_job'])->name('inventory_move_in.submit_form_job');
    Route::post('inventory_move_in.show-bin', [App\Http\Controllers\InventoryMoveInController::class, 'showBin']);
    Route::post('inventory_move_in.submit_form_packlist', [App\Http\Controllers\InventoryMoveInController::class, 'submit_form_packlist'])->name('inventory_move_in.submit_form_packlist');

    Route::get('/receipt_entry', [App\Http\Controllers\ReceiptEntryController::class, 'index']);
    Route::post('receipt_entry.get_count_document', [App\Http\Controllers\ReceiptEntryController::class, 'get_count_document'])->name('receipt_entry.get_count_document');
    Route::post('receipt_entry.get_preview_doc', [App\Http\Controllers\ReceiptEntryController::class, 'get_preview_doc'])->name('receipt_entry.get_preview_doc');
    Route::post('receipt_entry.add_document', [App\Http\Controllers\ReceiptEntryController::class, 'add_document'])->name('receipt_entry.add_document');
    Route::post('receipt_entry.get_header_attr', [App\Http\Controllers\ReceiptEntryController::class, 'get_header_attr'])->name('receipt_entry.get_header_attr');
    Route::post('receipt_entry.get_preview_doc_detail', [App\Http\Controllers\ReceiptEntryController::class, 'get_preview_doc_detail'])->name('receipt_entry.get_preview_doc_detail');
    Route::post('receipt_entry.get_attachment_list', [App\Http\Controllers\ReceiptEntryController::class, 'get_attachment_list'])->name('receipt_entry.get_attachment_list');
    Route::post('receipt_entry.show_attachment', [App\Http\Controllers\ReceiptEntryController::class, 'show_attachment'])->name('receipt_entry.show_attachment');
    Route::get('/gr_preview', [App\Http\Controllers\ReceiptEntryController::class, 'file_print'])->name('gr_file_print');
    Route::post('receipt_entry.print_view', [App\Http\Controllers\ReceiptEntryController::class, 'print_view'])->name('receipt_entry.print_view');
    Route::post('receipt_entry.print_tag_label_view', [App\Http\Controllers\ReceiptEntryController::class, 'print_tag_label_view'])->name('receipt_entry.print_tag_label_view');
    Route::post('receipt_entry.get_new_gr', [App\Http\Controllers\ReceiptEntryController::class, 'get_new_gr'])->name('receipt_entry.get_new_gr');
    Route::post('receipt_entry.update_gr', [App\Http\Controllers\ReceiptEntryController::class, 'update_gr'])->name('receipt_entry.update_gr');
    Route::post('receipt_entry.delete_gr', [App\Http\Controllers\ReceiptEntryController::class, 'delete_gr'])->name('receipt_entry.delete_gr');
    Route::post('receipt_entry.get_po_info', [App\Http\Controllers\ReceiptEntryController::class, 'get_po_info'])->name('receipt_entry.get_po_info');
    Route::post('receipt_entry.get_po_line_info', [App\Http\Controllers\ReceiptEntryController::class, 'get_po_line_info'])->name('receipt_entry.get_po_line_info');
    Route::post('receipt_entry.update_line_gr', [App\Http\Controllers\ReceiptEntryController::class, 'update_line_gr'])->name('receipt_entry.update_line_gr');
    Route::post('receipt_entry.detail_po_list_table', [App\Http\Controllers\ReceiptEntryController::class, 'detail_po_list_table'])->name('receipt_entry.detail_po_list_table');
    Route::post('receipt_entry.get_qty_info', [App\Http\Controllers\ReceiptEntryController::class, 'get_qty_info'])->name('receipt_entry.get_qty_info');
    Route::get('/gr_tag_label_preview', [App\Http\Controllers\ReceiptEntryController::class, 'tag_label_print'])->name('gr_tag_label_print');





    Route::post('receipt_entry.set_order_number', [App\Http\Controllers\ReceiptEntryController::class, 'set_order_number'])->name('receipt_entry.set_order_number');
    Route::post('receipt_entry.submit_label', [App\Http\Controllers\ReceiptEntryController::class, 'submit_label'])->name('receipt_entry.submit_label');
    Route::post('receipt_entry.submit_label_by_slip_no', [App\Http\Controllers\ReceiptEntryController::class, 'submit_label_by_slip_no'])->name('receipt_entry.submit_label_by_slip_no');
    Route::post('receipt_entry.update_detail', [App\Http\Controllers\ReceiptEntryController::class, 'update_detail'])->name('receipt_entry.update_detail');
    Route::post('receipt_entry.post_detail', [App\Http\Controllers\ReceiptEntryController::class, 'post_detail'])->name('receipt_entry.post_detail');
    Route::post('receipt_entry.check_before_delete', [App\Http\Controllers\ReceiptEntryController::class, 'check_before_delete'])->name('receipt_entry.check_before_delete');
    Route::post('receipt_entry.detail_release_table', [App\Http\Controllers\ReceiptEntryController::class, 'detail_release_table'])->name('receipt_entry.detail_release_table');
    Route::post('receipt_entry.get_button_approve', [App\Http\Controllers\ReceiptEntryController::class, 'get_button_approve'])->name('receipt_entry.get_button_approve');
    Route::post('receipt_entry.front_table', [App\Http\Controllers\ReceiptEntryController::class, 'front_table'])->name('receipt_entry.front_table');
    Route::post('receipt_entry.detail_table', [App\Http\Controllers\ReceiptEntryController::class, 'detail_table'])->name('receipt_entry.detail_table');
    Route::post('receipt_entry.delete_document', [App\Http\Controllers\ReceiptEntryController::class, 'delete_document'])->name('receipt_entry.delete_document');
    Route::post('receipt_entry.ready_to_print', [App\Http\Controllers\ReceiptEntryController::class, 'ready_to_print'])->name('receipt_entry.ready_to_print');
    Route::post('receipt_entry.un_ready_to_print', [App\Http\Controllers\ReceiptEntryController::class, 'un_ready_to_print'])->name('receipt_entry.un_ready_to_print');
    Route::post('receipt_entry.get_vendor_list', [App\Http\Controllers\ReceiptEntryController::class, 'get_vendor_list'])->name('receipt_entry.get_vendor_list');
    Route::post('receipt_entry.upload_attachment', [App\Http\Controllers\ReceiptEntryController::class, 'upload_attachment'])->name('receipt_entry.upload_attachment');
    Route::post('receipt_entry.delete_attachment', [App\Http\Controllers\ReceiptEntryController::class, 'delete_attachment'])->name('receipt_entry.delete_attachment');
    Route::post('receipt_entry.scan_document', [App\Http\Controllers\ReceiptEntryController::class, 'scan_document'])->name('receipt_entry.scan_document');
    //
    Route::post('receipt_entry.get_po_scan', [ReceiptEntryController::class, 'get_po_scan'])->name('receipt_entry.get_po_scan');
    Route::post('receipt_entry.rcvDtl', [ReceiptEntryController::class, 'rcvDtl'])->name('receipt_entry.rcvDtl');
    Route::post('receipt_entry.update_detail', [ReceiptEntryController::class, 'update_detail'])->name('receipt_entry.update_detail');
    Route::post('receipt_entry.insert_gr', [ReceiptEntryController::class, 'insert_gr'])->name('receipt_entry.insert_gr');
    Route::post('receipt_entry.new_insert_gr', [ReceiptEntryController::class, 'new_insert_gr'])->name('receipt_entry.new_insert_gr');
    Route::post('receipt_entry.delete_gr', [App\Http\Controllers\ReceiptEntryController::class, 'delete_gr'])->name('receipt_entry.delete_gr');
    #region GenbaManagement
    Route::get('/team', [App\Http\Controllers\GenbaManagementController::class, 'index'])->name('/team');
    Route::post('team.add_document', [App\Http\Controllers\GenbaManagementController::class, 'add_team'])->name('team.add_document');
    Route::post('team.get_team_data', [App\Http\Controllers\GenbaManagementController::class, 'get_team_data'])->name('team.get_team_data');
    Route::post('team.InsertTeam', [App\Http\Controllers\GenbaManagementController::class, 'InsertTeam'])->name('team.InsertTeam');
    Route::post('team.delete_document', [App\Http\Controllers\GenbaManagementController::class, 'delete_document'])->name('team.delete_document');
    Route::post('team.get_member_team', [App\Http\Controllers\GenbaManagementController::class, 'get_member_team'])->name('team.get_member_team');

    Route::get('/schedule', [App\Http\Controllers\GenbaManagementController::class, 'schedule'])->name('/schedule');
    Route::post('schedule.createSchedule', [App\Http\Controllers\GenbaManagementController::class, 'createSchedule'])->name('schedule.createSchedule');
    Route::get('schedule.get_schedule', [App\Http\Controllers\GenbaManagementController::class, 'get_schedule'])->name('schedule.get_schedule');
    Route::post('schedule.get_schedule_by_id', [App\Http\Controllers\GenbaManagementController::class, 'get_schedule_by_id'])->name('schedule.get_schedule_by_id');

    Route::get('/genba_activity', [App\Http\Controllers\GenbaManagementController::class, 'genba_activity'])->name('/genba_activity');
    Route::post('genba.activity', [App\Http\Controllers\GenbaManagementController::class, 'form_genba_activity'])->name('genba.activity');

    Route::post('genba.add_genba', [App\Http\Controllers\GenbaManagementController::class, 'add_genba'])->name('genba.add_genba');

    Route::get('schedule.get_schedule', [App\Http\Controllers\GenbaManagementController::class, 'get_schedule'])->name('schedule.get_schedule');
    Route::post('genba.post_form_spv', [App\Http\Controllers\GenbaManagementController::class, 'post_form_spv'])->name('genba.post_form_spv');
    Route::post('genba.post_photo_spv', [App\Http\Controllers\GenbaManagementController::class, 'post_photo_spv'])->name('genba.post_photo_spv');

    Route::get('/genba_management', [App\Http\Controllers\GenbaManagementController::class, 'view_table_spv'])->name('/genba_management');
    Route::post('genba.table_front', [App\Http\Controllers\GenbaManagementController::class, 'front_table'])->name('genba.table_front');
    Route::post('genba.get_genba_area', [App\Http\Controllers\GenbaManagementController::class, 'get_genba_area'])->name('genba.get_genba_area');
    Route::post('genba.get_genba_category', [App\Http\Controllers\GenbaManagementController::class, 'get_genba_category'])->name('genba.get_genba_category');
    Route::post('genba.delete_genba', [App\Http\Controllers\GenbaManagementController::class, 'delete_genba'])->name('genba.delete_genba');
    Route::post('genba.submit_form_mng', [App\Http\Controllers\GenbaManagementController::class, 'submit_form_mng'])->name('genba.submit_form_mng');
    Route::post('genba.get_data_photo', [App\Http\Controllers\GenbaManagementController::class, 'get_data_photo'])->name('genba.get_data_photo');
    Route::post('genba.submit_form_genba', [App\Http\Controllers\GenbaManagementController::class, 'submit_form_genba'])->name('genba.submit_form_genba');

    Route::get('/genba_mng_management', [App\Http\Controllers\GenbaManagementController::class, 'view_table_mng'])->name('/genba_mng_management');
    Route::post('genba.front_mng_table', [App\Http\Controllers\GenbaManagementController::class, 'front_mng_table'])->name('genba.front_mng_table');
    Route::post('genba.mng_activity', [App\Http\Controllers\GenbaManagementController::class, 'form_genba_mng_activity'])->name('genba.mng_activity');
    Route::post('genba.add_mng_genba', [App\Http\Controllers\GenbaManagementController::class, 'add_mng_genba'])->name('genba.add_mng_genba');
    Route::post('genba.delete_mng_genba', [App\Http\Controllers\GenbaManagementController::class, 'delete_mng_genba'])->name('genba.delete_mng_genba');
    Route::post('genba.delete_mng_genba_dtl', [App\Http\Controllers\GenbaManagementController::class, 'delete_mng_genba_dtl'])->name('genba.delete_mng_genba_dtl');
    Route::post('genba.post_form_mng', [App\Http\Controllers\GenbaManagementController::class, 'post_form_mng'])->name('genba.post_form_mng');
    Route::post('genba.post_photo_mng', [App\Http\Controllers\GenbaManagementController::class, 'post_photo_mng'])->name('genba.post_photo_mng');
    Route::post('genba.get_photo_findings', [App\Http\Controllers\GenbaManagementController::class, 'get_photo_findings'])->name('genba.get_photo_findings');
    Route::post('genba.save_action_plan', [App\Http\Controllers\GenbaManagementController::class, 'save_action_plan'])->name('genba.save_action_plan');

    Route::get('/spv_verification', [App\Http\Controllers\GenbaVerificationController::class, 'index'])->name('/spv_verification');
    Route::post('genba.verification_list', [App\Http\Controllers\GenbaVerificationController::class, 'verification_list'])->name('genba.verification_list');
    Route::post('genba.verification_activity', [App\Http\Controllers\GenbaVerificationController::class, 'verification_activity'])->name('genba.verification_activity');
    Route::post('genba.verification_activity_list', [App\Http\Controllers\GenbaVerificationController::class, 'verification_activity_list'])->name('genba.verification_activity_list');
    Route::post('genba.get_user_data', [App\Http\Controllers\GenbaVerificationController::class, 'get_user_data'])->name('genba.get_user_data');
    Route::post('genba.get_section', [App\Http\Controllers\GenbaVerificationController::class, 'get_section'])->name('genba.get_section');
    Route::post('genba.getVerifiedform', [App\Http\Controllers\GenbaVerificationController::class, 'getVerifiedform'])->name('genba.getVerifiedform');
    Route::post('genba.save_verified', [App\Http\Controllers\GenbaVerificationController::class, 'save_verified'])->name('genba.save_verified');
    Route::post('genba.do_verified', [App\Http\Controllers\GenbaVerificationController::class, 'do_verified'])->name('genba.do_verified');


    Route::get('/proses-audit/{id}', [App\Http\Controllers\GenbaManagementController::class, 'add_genba_rusty']);
    Route::post('genba.get_data_rusty', [App\Http\Controllers\GenbaManagementController::class, 'get_data_rusty'])->name('genba.get_data_rusty');
    Route::post('genba.delete_rusty', [App\Http\Controllers\GenbaManagementController::class, 'delete_rusty'])->name('genba.delete_rusty');
    Route::post('genba.upload_photo', [App\Http\Controllers\GenbaManagementController::class, 'upload_photo'])->name('genba.upload_photo');
    Route::post('genba.finish_activity', [App\Http\Controllers\GenbaManagementController::class, 'finish_activity'])->name('genba.finish_activity');

    Route::get('/execution_genba', [App\Http\Controllers\GenbaVerificationController::class, 'execution_genba'])->name('/execution_genba');
    Route::post('genba.execution_activity_list', [App\Http\Controllers\GenbaVerificationController::class, 'execution_activity_list'])->name('genba.execution_activity_list');
    Route::post('genba.show_findings', [App\Http\Controllers\GenbaVerificationController::class, 'show_findings'])->name('genba.show_findings');
    Route::post('genba.post_after_genba', [App\Http\Controllers\GenbaVerificationController::class, 'post_after_genba'])->name('genba.post_after_genba');
    Route::post('genba.show_findings_list', [App\Http\Controllers\GenbaVerificationController::class, 'show_findings_list'])->name('genba.show_findings_list');
    Route::post('genba.get_waitting_findings', [App\Http\Controllers\GenbaVerificationController::class, 'get_waitting_findings'])->name('genba.get_waitting_findings');

    Route::get('/memo_misc_issue', [App\Http\Controllers\GeneralMemoController::class, 'index']);
    Route::post('memo_misc_issue.get_part_number', [App\Http\Controllers\GeneralMemoController::class, 'get_part_number'])->name('memo_misc_issue.get_part_number');
    Route::post('memo_misc_issue.get_warehose', [App\Http\Controllers\GeneralMemoController::class, 'get_warehouse'])->name('memo_misc_issue.get_warehouse');
    Route::post('memo_misc_issue.get_bin', [App\Http\Controllers\GeneralMemoController::class, 'get_bin'])->name('memo_misc_issue.get_bin');
    Route::post('memo_misc_issue.get_part_bin', [App\Http\Controllers\GeneralMemoController::class, 'get_part_bin'])->name('memo_misc_issue.get_part_bin');
    Route::post('memo_misc_issue.get_approval', [App\Http\Controllers\GeneralMemoController::class, 'get_approval'])->name('memo_misc_issue.get_approval');
    Route::post('memo_misc_issue.get_approval_by_memo', [App\Http\Controllers\GeneralMemoController::class, 'get_approval_by_memo'])->name('memo_misc_issue.get_approval_by_memo');
    Route::post('memo_misc_issue.save_memo', [App\Http\Controllers\GeneralMemoController::class, 'save_memo'])->name('memo_misc_issue.save_memo');
    Route::post('memo_misc_issue.reset_memo', [App\Http\Controllers\GeneralMemoController::class, 'reset_memo'])->name('memo_misc_issue.reset_memo');
    Route::post('memo_misc_issue.delete_memo', [App\Http\Controllers\GeneralMemoController::class, 'delete_memo'])->name('memo_misc_issue.delete_memo');
    Route::post('memo_misc_issue.front_table', [App\Http\Controllers\GeneralMemoController::class, 'front_table'])->name('memo_misc_issue.front_table');

    #endregion
    #region Entertain Report

    Route::get('sales_report_entertain', [SalesReportEntertainController::class, 'index'])->name('sales_report_entertain.index');
    Route::get('sales_report_entertain.form_header', [SalesReportEntertainController::class, 'form_header'])->name('sales_report_entertain.form_header');
    Route::post('sales_report_entertain.add_report', [SalesReportEntertainController::class, 'add_report'])->name('sales_report_entertain.add_report');
    Route::get('sales-report-entertain.list', [SalesReportEntertainController::class, 'data_list_entertain_report_header'])->name('sales_report_entertain.get_reports');
    Route::post('sales-report-entertain.store', [SalesReportEntertainController::class, 'store'])->name('sales_report_entertain.store');
    Route::get('/sales-report-entertain/edit', [SalesReportEntertainController::class, 'edit_report_header'])->name('sales_report_entertain.edit_report_header');
    Route::post('/sales-report-entertain/delete', [SalesReportEntertainController::class, 'delete_report'])->name('sales_report_entertain.delete_report');
    Route::put('/sales_report_entertain/{SysID}', [SalesReportEntertainController::class, 'update_header'])->name('sales_report_entertain.update_header');

    Route::get('sales-report-entertain/form-detail', [SalesReportEntertainController::class, 'form_detail'])->name('sales_report_entertain.form_detail');
    Route::post('sales-report-entertain/store-detail', [SalesReportEntertainController::class, 'store_detail'])->name('sales_report_entertain.store_detail');
    Route::get('sales-report-entertain/get-details', [SalesReportEntertainController::class, 'get_details'])->name('sales_report_entertain.get_details');
    Route::put('sales-report-entertain/update-detail/{SysID}', [SalesReportEntertainController::class, 'update_detail'])->name('sales_report_entertain.update_detail');
    Route::delete('/sales-report-entertain/delete-detail', [SalesReportEntertainController::class, 'delete_detail']);
    Route::put('sales-report-entertain/update-members/{SysID}', [SalesReportEntertainController::class, 'update_members'])->name('sales_report_entertain.update_members');

    Route::post('/entertain/import', [SalesReportEntertainController::class, 'import'])->name('entertain.import');
    Route::get('/sales-report-entertain/export/{SysID}', [SalesReportEntertainController::class, 'export_report'])->name('sales_report_entertain.export');

    Route::get('/sales-report-entertain/summary', [SalesReportEntertainController::class, 'summary'])
        ->name('sales_report_entertain.summary');
    Route::get('/sales-report-entertain/summary/data', [SalesReportEntertainController::class, 'summaryData'])->name('sales_report_entertain.summary.data');

    Route::get('/sales-report-entertain/summary/export', [SalesReportEntertainController::class, 'summaryExport'])->name('sales_report_entertain.summary.export');

    Route::get('/ref/employee-names', [SalesReportEntertainController::class, 'refEmployeeNames'])
        ->name('ref.employee_names');
    Route::get('/ref/employee-by-name', [SalesReportEntertainController::class, 'refEmployeeByName'])
        ->name('ref.employee_by_name');

    // Route::get('/sales-report-entertain/print/{SysID}',  [SalesReportEntertainController::class, 'print_report'])->name('sales_report_entertain.print');
    #endregion

    #region Issue Miscellaneos
    Route::get('/issue_miscellaneous', [App\Http\Controllers\IssueMiscellaneousController::class, 'index'])->name('issue_miscellaneous.index');
    Route::post('issue_miscellaneous/front_table', [App\Http\Controllers\IssueMiscellaneousController::class, 'front_table'])->name('issue_miscellaneous.front_table');
    Route::post('issue_miscellaneous/add_document', [App\Http\Controllers\IssueMiscellaneousController::class, 'add_document'])->name('issue_miscellaneous.add_document');
    Route::post('issue_miscellaneous/showPart', [App\Http\Controllers\IssueMiscellaneousController::class, 'showPart'])->name('issue_miscellaneous.showPart');
    Route::post('issue_miscellaneous/reason_codes', [App\Http\Controllers\IssueMiscellaneousController::class, 'reason_codes'])->name('issue_miscellaneous.reason_codes');
    Route::post('issue_miscellaneous/approval_users', [App\Http\Controllers\IssueMiscellaneousController::class, 'approval_users'])->name('issue_miscellaneous.approval_users');
    Route::post('issue_miscellaneous/get_new_docnum', [App\Http\Controllers\IssueMiscellaneousController::class, 'get_new_docnum'])->name('issue_miscellaneous.get_new_docnum');
    Route::post('issue_miscellaneous/ShowUOM', [App\Http\Controllers\IssueMiscellaneousController::class, 'ShowUOM'])->name('issue_miscellaneous.ShowUOM');
    Route::post('issue_miscellaneous/store_item', [App\Http\Controllers\IssueMiscellaneousController::class, 'store_item'])->name('issue_miscellaneous.store_item');
    Route::post('issue_miscellaneous/detail_table', [App\Http\Controllers\IssueMiscellaneousController::class, 'detail_table'])->name('issue_miscellaneous.detail_table');
    Route::post('issue_miscellaneous/delete_item', [App\Http\Controllers\IssueMiscellaneousController::class, 'delete_item'])->name('issue_miscellaneous.delete_item');
    Route::post('issue_miscellaneous/submit_document', [App\Http\Controllers\IssueMiscellaneousController::class, 'submit_document'])->name('issue_miscellaneous.submit_document');
    Route::post('issue_miscellaneous/update_qty_submit', [App\Http\Controllers\IssueMiscellaneousController::class, 'update_qty_submit'])->name('issue_miscellaneous.update_qty_submit');
    Route::post('issue_miscellaneous/update_header_submitter', [App\Http\Controllers\IssueMiscellaneousController::class, 'update_header_submitter'])->name('issue_miscellaneous.update_header_submitter');
    Route::post('issue_miscellaneous/cancel_document', [App\Http\Controllers\IssueMiscellaneousController::class, 'cancel_document'])->name('issue_miscellaneous.cancel_document');

    // Approval routes
    Route::get('/issue_miscellaneous_approval', [App\Http\Controllers\IssueMiscellaneousController::class, 'approval_index'])->name('issue_miscellaneous.approval_index');
    Route::post('issue_miscellaneous.approval_table', [App\Http\Controllers\IssueMiscellaneousController::class, 'approval_table'])->name('issue_miscellaneous.approval_table');
    Route::post('issue_miscellaneous/approval_form', [App\Http\Controllers\IssueMiscellaneousController::class, 'approval_form'])->name('issue_miscellaneous.approval_form');
    Route::post('issue_miscellaneous.approval_detail', [App\Http\Controllers\IssueMiscellaneousController::class, 'approval_detail'])->name('issue_miscellaneous.approval_detail');
    Route::post('issue_miscellaneous.approve_document', [App\Http\Controllers\IssueMiscellaneousController::class, 'approve_document'])->name('issue_miscellaneous.approve_document');
    Route::post('issue_miscellaneous.reject_document', [App\Http\Controllers\IssueMiscellaneousController::class, 'reject_document'])->name('issue_miscellaneous.reject_document');
    Route::post('issue_miscellaneous/get_approval_status_counts', [App\Http\Controllers\IssueMiscellaneousController::class, 'get_approval_status_counts'])->name('issue_miscellaneous.get_approval_status_counts');

    #endregion


    Route::get('/pr_approval/export-excel', [App\Http\Controllers\PRApprovalController::class, 'exportExcel'])
        ->name('pr_approval.export_excel')
        ->middleware(['auth']);

    Route::get('/po_approval/export-excel', [App\Http\Controllers\POApprovalController::class, 'exportExcel'])
        ->name('po_approval.export_excel')
        ->middleware(['auth']);
    #AP INVOICE
    Route::prefix('ap_invoice')->group(function () {
        Route::get('', [ApInvoiceController::class, 'index']);
        Route::post('table_primary', [ApInvoiceController::class, 'tablePrimary']);
        Route::post('header', [ApInvoiceController::class, 'header']);
        Route::post('preview_doc', [ApInvoiceController::class, 'preview_doc']);
        Route::post('preview_doc/detail', [ApInvoiceController::class, 'previewDetail']);
        Route::post('approved', [ApInvoiceController::class, 'approved']);
        Route::post('cancel_approval', [ApInvoiceController::class, 'cancel_approval']);
        Route::post('check_status', [ApInvoiceController::class, 'check_status']);
        Route::post('terms', [ApInvoiceController::class, 'terms']);
        Route::post('submit_change', [ApInvoiceController::class, 'submit_change']);
        Route::post('detail_packslip', [ApInvoiceController::class, 'detailPackSlip']);
        Route::post('change_terms', [ApInvoiceController::class, 'change_terms']);
        Route::post('all_item_tbl', [ApInvoiceController::class, 'all_item_tbl']);
        Route::get('export', [ApInvoiceController::class, 'export']);
        Route::post('recalculate', [ApInvoiceController::class, 'Recalculate']);
        Route::post('show_new_approval', [ApInvoiceController::class, 'show_new_approval']);
        Route::post('show_pdf', [ApInvoiceController::class, 'show_pdf']);
        Route::post('reject', [ApInvoiceController::class, 'reject']);
        Route::post('submit_reject', [ApInvoiceController::class, 'submit_reject']);
    });
    Route::prefix('quotation')->group(function () {
        Route::get('/', [QuotationController::class, 'index']);
        Route::post('show_data', [QuotationController::class, 'quotation_show_data']);
        Route::post('find_data', [QuotationController::class, 'quotation_find_data']);
        Route::post('process_show', [QuotationController::class, 'quotation_process_show']);
        Route::post('sub_total_show', [QuotationController::class, 'quotation_sub_total_show']);
        Route::post('approved', [QuotationController::class, 'approved']);
        Route::post('canceled', [QuotationController::class, 'canceled']);
        Route::post('summary_table', [QuotationController::class, 'summary_table']);
        Route::post('total_header', [QuotationController::class, 'total_header']);
        Route::get('print_excel', [QuotationController::class, 'print_excel']);
        Route::get('print_out', [QuotationController::class, 'print_out']);
        Route::post('list_quotation', [QuotationController::class, 'list_quotation']);
        Route::get('print_pending_quo', [QuotationController::class, 'print_pending_quo']);
        Route::post('post_quo', [QuotationController::class, 'post_quo']);
    });
    Route::prefix('master_quotation')->group(function () {
        Route::get('/', [QuotationController::class, 'master_price_list']);
        Route::post('show_data', [QuotationController::class, 'master_price_list_show_data']);
        Route::post('store_data', [QuotationController::class, 'master_price_list_store_data']);
        Route::post('delete_data', [QuotationController::class, 'master_price_list_quotation_delete_data']);
        Route::post('get_supplier', [QuotationController::class, 'get_supplier']);
        Route::post('get_customer', [QuotationController::class, 'get_customer']);
        Route::post('get_period', [QuotationController::class, 'get_period']);
        Route::post('add_period', [QuotationController::class, 'add_period']);
        Route::post('update_master_header', [QuotationController::class, 'update_master_header']);
        Route::post('get_part_mtl', [QuotationController::class, 'get_part_mtl']);
        Route::post('store_material', [QuotationController::class, 'master_price_list_store_material']);
        Route::post('update_material', [QuotationController::class, 'master_price_list_update_material']);
        Route::post('store_process', [QuotationController::class, 'master_list_store_process']);
        Route::post('show_process', [QuotationController::class, 'master_price_list_show_process']);
        Route::post('find_process', [QuotationController::class, 'master_price_list_find_process']);
        Route::post('delete_process', [QuotationController::class, 'master_price_list_delete_process']);
        Route::post('find_data', [QuotationController::class, 'master_price_list_find_data']);
        Route::post('show_other_cost', [QuotationController::class, 'master_price_list_show_other_cost']);
        Route::post('show_purchase', [QuotationController::class, 'master_price_list_show_purchase']);
        Route::post('purchase_store', [QuotationController::class, 'master_price_list_purchase_store']);
        Route::post('find_purchase', [QuotationController::class, 'master_price_list_find_purchase']);
        Route::post('delete_purchase', [QuotationController::class, 'master_price_list_delete_purchase']);
        Route::post('update', [QuotationController::class, 'master_price_list_update']);
        Route::post('import', [QuotationController::class, 'import']);
        Route::post('preview', [QuotationController::class, 'master_price_list_preview']);
        Route::post('update_header', [QuotationController::class, 'update_header']);
        Route::post('delete_document', [QuotationController::class, 'master_price_list_delete_document']);
        Route::post('get_purchase_part', [QuotationController::class, 'get_purchase_part']);
        Route::post('show_data_part', [QuotationController::class, 'master_price_list_show_data_part']);
        Route::post('delete_part', [QuotationController::class, 'master_price_list_delete_part']);
        Route::post('back_mtl', [QuotationController::class, 'back_mtl']);
        Route::post('name_item_other_cost', [QuotationController::class, 'name_item_other_cost']);
        Route::post('store_other_cost', [QuotationController::class, 'store_other_cost']);
        Route::post('find_other_cost', [QuotationController::class, 'find_other_cost']);
        Route::post('update_other_cost', [QuotationController::class, 'update_other_cost']);
        Route::post('delete_other_cost', [QuotationController::class, 'delete_other_cost']);
        Route::post('confirm_master', [QuotationController::class, 'confirm_master']);
        Route::post('cancel_master', [QuotationController::class, 'cancel_master']);
        Route::post('document_view', [QuotationController::class, 'document_view']);
        Route::get('download_preview', [QuotationController::class, 'download_preview']);
        Route::get('download_all_preview', [QuotationController::class, 'download_all_preview']);
        Route::post('import_update', [QuotationController::class, 'import_update']);
    });
    Route::prefix('price_list')->group(function () {
        Route::get('/', [PriceListController::class, 'index']);
        Route::post('show_price_list', [PriceListController::class, 'show_price_list']);
        Route::post('show_header', [PriceListController::class, 'show_header']);
        Route::post('create_view', [PriceListController::class, 'create_view']);
        Route::Post('list_currency', [PriceListController::class, 'list_currency']);
        Route::post('submit_header', [PriceListController::class, 'submit_header']);
        Route::post('update_header', [PriceListController::class, 'update_header']);
        Route::post('delete_header', [PriceListController::class, 'delete_header']);
        Route::post('first_preview', [PriceListController::class, 'first_preview']);
        Route::post('part_list', [PriceListController::class, 'part_list']);
        Route::post('search_part', [PriceListController::class, 'search_part']);
        Route::post('submit_detail_part', [PriceListController::class, 'submit_detail_part']);
        Route::post('delete_part', [PriceListController::class, 'delete_part']);
        Route::post('update_detail_part', [PriceListController::class, 'update_detail_part']);
        Route::get('confirmation_letter/{id}', [PriceListController::class, 'confirmation_letter']);
        Route::get('price_material/{id}', [PriceListController::class, 'price_material']);
    });
    Route::prefix('pl_approval')->group(function () {
        Route::get('/', [PriceListController::class, 'index_approval']);
        Route::post('show_pl_approval', [PriceListController::class, 'show_pl_approval']);
        Route::post('pl_detail_view', [PriceListController::class, 'pl_detail_view']);
        Route::post('detail_pl_approval', [PriceListController::class, 'detail_pl_approval']);
        Route::post('get_status_approval', [PriceListController::class, 'get_status_approval']);
        Route::get('confirmation_letter/{id}', [PriceListController::class, 'confirmation_letter_all']);
        Route::get('price_material/{id}', [PriceListController::class, 'price_material_all']);
        Route::post('approved', [PriceListController::class, 'approved']);
    });
    Route::get('/inventory_rm_out', [IssueMaterialController::class, 'index'])->name('inventory_rm_out.index');
    Route::post('inventory_rm_out/load_form', [IssueMaterialController::class, 'form_load'])->name('inventory_rm_out.load_form');
    Route::post('inventory_rm_out/front_table', [IssueMaterialController::class, 'front_table'])->name('inventory_rm_out.front_table');
    Route::post('inventory_rm_out/get_job_category_counts', [IssueMaterialController::class, 'get_job_category_counts'])->name('inventory_rm_out.get_job_category_counts');
    Route::post('inventory_rm_out/material_options', [IssueMaterialController::class, 'material_options'])->name('inventory_rm_out.material_options');
    Route::post('inventory_rm_out/store_item', [IssueMaterialController::class, 'store_item'])->name('inventory_rm_out.store_item');
    Route::post('inventory_rm_out/detail_table', [IssueMaterialController::class, 'detail_table'])->name('inventory_rm_out.detail_table');
    Route::post('inventory_rm_out/delete_item', [IssueMaterialController::class, 'delete_item'])->name('inventory_rm_out.delete_item');
    Route::post('inventory_rm_out/sync_internal_api', [IssueMaterialController::class, 'sync_internal_api'])->name('inventory_rm_out.sync_internal_api');
    Route::post('inventory_rm_out/check_label', [IssueMaterialController::class, 'check_label']);
    #endregion
});
