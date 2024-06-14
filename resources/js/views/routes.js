import AuthLayout from '@/layouts/App.vue';
import DahboardLayout from '@/layouts/Default.vue';
import LoginAuth from '@/views/modules/auth/login.vue';
import RegisterAuth from './modules/auth/register.vue';
import Homepage from '@/views/modules/home.vue';

// Import Category 
import EditCategory from '@/views/modules/Categorys/metaview/EditView.vue';
import NewCategory from '@/views/modules/Categorys/metaview/NewView.vue';
import ListCategory from '@/views/modules/Categorys/metaview/ListView.vue';
import DetailCategory from '@/views/modules/Categorys/metaview/DetailView.vue';

// Import Inventory 
import EditInventory from '@/views/modules/BulkInventorys/metaview/EditView.vue';
import NewInventory from '@/views/modules/BulkInventorys/metaview/NewView.vue';
import ListInventory from '@/views/modules/BulkInventorys/metaview/ListView.vue';
import DetailInventory from '@/views/modules/BulkInventorys/metaview/DetailView.vue';

// Import Product 
import EditProduct from '@/views/modules/Products/metaview/EditView.vue';
import NewProduct from '@/views/modules/Products/metaview/NewView.vue';
import ListProduct from '@/views/modules/Products/metaview/ListView.vue';
import DetailProduct from '@/views/modules/Products/metaview/DetailView.vue';
// Import Adminstration 
import Administration from "@/views/modules/Administration/Index.vue";
import AdministrationRepair from "@/views/modules/Administration/QuickRepair.vue";
import AdministrationUnique from "@/views/modules/Administration/Unique.vue";
import AdministrationSystemSetting from "@/views/modules/Administration/SystemSetting.vue";
import AdministrationLocalSetting from "@/views/modules/Administration/LocalSettings.vue";
import AdministrationPDFSetting from "@/views/modules/Administration/PdfSettings.vue";
import AdministrationApprovalSetting from "@/views/modules/Administration/ApprovalSettings.vue";
import AdministrationGlobalSetting from "@/views/modules/Administration/GlobalSettings.vue";
// Import Users
import UserList from "@/views/modules/Users/metaview/ListView.vue";
import UserEdit from "@/views/modules/Users/metaview/EditView.vue";
import UserNew from "@/views/modules/Users/metaview/NewView.vue";
import UserDetail from "@/views/modules/Users/metaview/DetailView.vue";
import LoginUsers from "@/views/modules/Users/LoginUsers.vue";
import UserChangeLog from "@/views/modules/Users/AuditLog.vue";

//Import Branchs 
import BranchList from "@/views/modules/Branchs/metaview/ListView.vue";
import BranchEdit from "@/views/modules/Branchs/metaview/EditView.vue";
import BranchNew from "@/views/modules/Branchs/metaview/NewView.vue";
import BranchDetail from "@/views/modules/Branchs/metaview/DetailView.vue";

//Import Schedulers
import SchedulersList from "@/views/modules/Schedulers/metaview/ListView.vue";
import SchedulersEdit from "@/views/modules/Schedulers/metaview/EditView.vue";
import SchedulersDetail from "@/views/modules/Schedulers/metaview/DetailView.vue";

//Import report auths 
import ReportAuthsList from "@/views/modules/ReportAuths/metaview/ListView.vue";
import ReportAuthsEdit from "@/views/modules/ReportAuths/metaview/EditView.vue";
import ReportAuthsDetail from "@/views/modules/ReportAuths/metaview/DetailView.vue";

// Import Users Dashlets
import UserDashletList from "@/views/modules/UserDashlets/metaview/ListView.vue";
import UserDashletNew from "@/views/modules/UserDashlets/metaview/NewView.vue";
import UserDashletEdit from "@/views/modules/UserDashlets/metaview/EditView.vue";
import UserDashletDetail from "@/views/modules/UserDashlets/metaview/DetailView.vue";
// Import User Report
import UserReportList from "@/views/modules/UserReports/metaview/ListView.vue";
import UserReportNew from "@/views/modules/UserReports/metaview/NewView.vue";
import UserReportEdit from "@/views/modules/UserReports/metaview/EditView.vue";
import UserReportDetail from "@/views/modules/UserReports/metaview/DetailView.vue";
import PdfRequestList from "@/views/modules/UserReports/PdfRequest.vue";
// import Format Setting
import FormatList from "@/views/modules/FormatSettings/ListView.vue";
import FormatEdit from "@/views/modules/FormatSettings/EditView.vue";
import FormatCurrentList from "@/views/modules/FormatSettings/ListCurrent.vue";
import FormatCurrentEdit from "@/views/modules/FormatSettings/EditCurrent.vue";
// Import Email
import EmailList from "@/views/modules/Emails/ListView.vue";
import EmailEdit from "@/views/modules/Emails/EditView.vue";
import EmailDetail from "@/views/modules/Emails/DetailView.vue";
// Import Client Master
import ClientMasterList from "@/views/modules/ClientMasters/metaview/ListView.vue";
import ClientMasterNew from "@/views/modules/ClientMasters/metaview/NewView.vue";
import ClientMasterEdit from "@/views/modules/ClientMasters/metaview/EditView.vue";
import ClientMasterDetail from "@/views/modules/ClientMasters/metaview/DetailView.vue";
// Import Vendor Master
import VendorMasterList from "@/views/modules/VendorMasters/metaview/ListView.vue";
import VendorMasterNew from "@/views/modules/VendorMasters/metaview/NewView.vue";
import VendorMasterEdit from "@/views/modules/VendorMasters/metaview/EditView.vue";
import VendorMasterDetail from "@/views/modules/VendorMasters/metaview/DetailView.vue";
// Import Purchase
import PurchaseList from "@/views/modules/Purchases/metaview/ListView.vue";
import PurchaseNew from "@/views/modules/Purchases/metaview/NewView.vue";
import PurchaseEdit from "@/views/modules/Purchases/metaview/EditView.vue";
import PurchaseDetail from "@/views/modules/Purchases/metaview/DetailView.vue";
// Import Invoice
import InvoiceList from "@/views/modules/Invoices/metaview/ListView.vue";
import InvoiceNew from "@/views/modules/Invoices/metaview/NewView.vue";
import InvoiceEdit from "@/views/modules/Invoices/metaview/EditView.vue";
import InvoiceDetail from "@/views/modules/Invoices/metaview/DetailView.vue";
// Import Quotation
import QuotationList from "@/views/modules/Quotations/metaview/ListView.vue";
import QuotationNew from "@/views/modules/Quotations/metaview/NewView.vue";
import QuotationEdit from "@/views/modules/Quotations/metaview/EditView.vue";
import QuotationDetail from "@/views/modules/Quotations/metaview/DetailView.vue";
//import QuotationPdf from "@/views/modules/Quotations/metapdf/PdfView.vue";
// Import Delivery Challan
import DeliverychallanList from "@/views/modules/DeliveryChallans/metaview/ListView.vue";
import DeliverychallanNew from "@/views/modules/DeliveryChallans/metaview/NewView.vue";
import DeliverychallanEdit from "@/views/modules/DeliveryChallans/metaview/EditView.vue";
import DeliverychallanDetail from "@/views/modules/DeliveryChallans/metaview/DetailView.vue";
import DeliverychallanPdf from "@/views/modules/DeliveryChallans/metapdf/PdfView.vue";
// Import Order
import OrderList from "@/views/modules/Orders/metaview/ListView.vue";
import OrderNew from "@/views/modules/Orders/metaview/NewView.vue";
import OrderEdit from "@/views/modules/Orders/metaview/EditView.vue";
import OrderDetail from "@/views/modules/Orders/metaview/DetailView.vue";
// import Taxtypes 
import TaxtypeList from "@/views/modules/Taxtypes/metaview/ListView.vue";
import TaxtypeNew from "@/views/modules/Taxtypes/metaview/NewView.vue";
import TaxtypeEdit from "@/views/modules/Taxtypes/metaview/EditView.vue";
import TaxtypeDetail from "@/views/modules/Taxtypes/metaview/DetailView.vue";
// import Country 
import CountryList from "@/views/modules/CountryLists/metaview/ListView.vue";
import CountryEdit from "@/views/modules/CountryLists/metaview/EditView.vue";
import CountryNew from "@/views/modules/CountryLists/metaview/NewView.vue";
import CountryDetail from "@/views/modules/CountryLists/metaview/DetailView.vue";
// import State 
import StateList from "@/views/modules/StateLists/metaview/ListView.vue";
import StateEdit from "@/views/modules/StateLists/metaview/EditView.vue";
import StateNew from "@/views/modules/StateLists/metaview/NewView.vue";
import StateDetail from "@/views/modules/StateLists/metaview/DetailView.vue";
// import User Roles 
import UserRoleList from "@/views/modules/UserRoles/metaview/ListView.vue";
import UserRoleNew from "@/views/modules/UserRoles/metaview/NewView.vue";
import UserRoleEdit from "@/views/modules/UserRoles/metaview/EditView.vue";
import UserRoleDetail from "@/views/modules/UserRoles/metaview/DetailView.vue";


// Import MIS Reports
import MisReport from "@/views/modules/MisReports/Index.vue";
import MisReportSel from "@/views/modules/MisReports/ReportSel.vue";
// Import Account
import AccountPage from "@/views/modules/Accounts/Account.vue";




import MasterData from "@/views/modules/Setups/Index.vue";

// Import NoPage
import NotFound from '@/layouts/NoPage.vue';

import PopupWindow from "@/components/layout/shared/popup/PopupWindow.vue";
import UserRoleChangeLog from "@/views/modules/UserRoles/AuditLog.vue";
//import DashboardNotFoundPage from "@/views/modules/Error/not-found.vue";
import PageNotFoundPage from "@/views/modules/Error/not-found.vue";
    



const routes = [
        { path: '/', component: AuthLayout,  redirect: '/auth/login'},
        {
            path: "/auth",component: AuthLayout, redirect: '/auth/login',  
            children:[
                {path: "login",  name: 'login',  component: LoginAuth, meta:{ requiresAuth:false  }},
                {path: 'register', name: 'register',  component: RegisterAuth,  meta:{ requiresAuth:true}},
            ]
        },
        
        {
            path: '/modules', name: 'modules', component: DahboardLayout,redirect:'/modules/home',meta:{ requiresAuth:true }, 
            children: [
                {path: 'home', component: Homepage, meta:{requiresAuth:true}},
                // Route for Category
                {path: 'bulkinventorys', component: ListInventory,  meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.ProductController' }},
                {path: 'bulkinventorys/edit', component: NewInventory,  meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.ProductController' }},
                {path: 'bulkinventorys/edit/:id', component: EditInventory,  meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.ProductController' }},
                {path: 'bulkinventorys/:id/detail', component:DetailInventory,  meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.ProductController' }},

                 // Route for Category
                 {path: 'categorys', component: ListCategory,  meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.CategoryController' }},
                 {path: 'categorys/edit', component: NewCategory,  meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.CategoryController' }},
                 {path: 'categorys/edit/:id', component: EditCategory,  meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.CategoryController' }},
                 {path: 'categorys/:id/detail', component:DetailCategory,  meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.CategoryController' }},
                
                // Route for Product
                {path: 'products', component: ListProduct,  meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.ProductController' }},
                {path: 'products/edit', component: NewProduct,  meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.ProductController' }},
                {path: 'products/edit/:id', component: EditProduct,  meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.ProductController' }},
                {path: 'products/:id/detail', component:DetailProduct,  meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.ProductController' }},

                // Route for Adminstration
                { path: 'administration',  component: Administration,  meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.AdministrationController' }},
                { path: 'administration/repair',  component: AdministrationRepair,  meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.AdministrationController' }},
                { path: 'administration/unique',  component: AdministrationUnique,  meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.SequenceController' }},
                { path: 'administration/systemsettings',  component: AdministrationSystemSetting,  meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.SystemSettingController' }},
                { path: 'administration/localsettings',  component: AdministrationLocalSetting,  meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.LocalSettingController' }},
                { path: 'administration/pdfconfig',  component: AdministrationPDFSetting,  meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.PdfSettingController' }},
                { path: 'administration/approvalsetting',  component: AdministrationApprovalSetting,  meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.AdministrationController' }},
                { path: 'administration/globalsetting',  component: AdministrationGlobalSetting,  meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.GlobalSettingController' }},
              
                // Route for Users
                { path: 'users', component: UserList, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.UserController' } },
                { path: 'users/edit', component: UserNew, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.UserController' } },
                { path: 'users/edit/:id', component: UserEdit, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.UserController' } },
                { path: 'users/:id/detail', component: UserDetail, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.UserController' } },
                { path: 'users/loginusers', component: LoginUsers, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.UserController' } },
              
                // Route for user Dashlet
                { path: 'userdashlets', component: UserDashletList, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.UserDashletController' } },
                { path: 'userdashlets/edit', component: UserDashletNew, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.UserDashletController' } },
                { path: 'userdashlets/edit/:id', component: UserDashletEdit, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.UserDashletController' } },
                { path: 'userdashlets/:id/detail', component: UserDashletDetail, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.UserDashletController' } },
              
                // Route for User Report
                { path: 'userreports', component: UserReportList, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.PossUserController' } },
                { path: 'userreports/edit', component: UserReportNew, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.PossUserController' } },
                { path: 'userreports/edit/:id', component: UserReportEdit, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.PossUserController' } },
                { path: 'userreports/:id/detail', component: UserReportDetail, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.PossUserController' } },
                { path: 'userreports/pdfrequest', component: PdfRequestList, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.PossUserController' } },

                // Route for Formate Setting
                { path: 'formatsetting/addprint',  component: FormatEdit,  meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.AdministrationController' }},
                { path: 'formatsetting/viewprint',  component: FormatList,  meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.AdministrationController' }},
                { path: 'formatsetting/addcurrentsetting',  component: FormatCurrentEdit,  meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.AdministrationController' }},
                { path: 'formatsetting/viewcurrentsetting',  component: FormatCurrentList,  meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.AdministrationController' }},
                // Route for Taxtypes Setting
                { path: 'taxtypes', component: TaxtypeList, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.TaxtypeController' } },
                { path: 'taxtypes/edit', component: TaxtypeNew, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.TaxtypeController' } },
                { path: 'taxtypes/edit/:id', component: TaxtypeEdit, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.TaxtypeController' } },
                { path: 'taxtypes/:id/detail', component: TaxtypeDetail, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.TaxtypeController' } },
                /// schedular
                { path: 'schedulers', component: SchedulersList, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.SchedulerController' } },
                { path: 'schedulers/edit', component: SchedulersEdit, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.SchedulerController' } },
                { path: 'schedulers/edit/:id', component: SchedulersEdit, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.SchedulerController' } },
                { path: 'schedulers/:id/detail', component: SchedulersDetail, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.SchedulerController' } },
                // reports auth
                { path: 'reportauths', component: ReportAuthsList, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.PossUserController' } },
                { path: 'reportauths/edit', component: ReportAuthsEdit, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.PossUserController' } },
                { path: 'reportauths/edit/:id', component: ReportAuthsEdit, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.PossUserController' } },
                { path: 'reportauths/:id/detail', component: ReportAuthsDetail, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.PossUserController' } },

                // mis reports
                { path: 'misreports',  component: MisReport,  meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.MISController' }},
                { path: 'misreports/reprotsel',  component: MisReportSel,  meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.MISController' }},
                // countrylists
                { path: 'countrylists', component: CountryList, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.CountryListController' } },
                { path: 'countrylists/edit', component: CountryNew, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.CountryListController' } },
                { path: 'countrylists/edit/:id', component: CountryEdit, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.CountryListController' } },
                { path: 'countrylists/:id/detail', component: CountryDetail, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.CountryListController' } },
                // status list
                { path: 'statelists', component: StateList, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.StateListController' } },
                { path: 'statelists/edit', component: StateNew, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.StateListController' } },
                { path: 'statelists/edit/:id', component: StateEdit, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.StateListController' } },
                { path: 'statelists/:id/detail', component: StateDetail, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.StateListController' } },

                // Route for Client Master
                { path: 'clientmasters', component: ClientMasterList, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.ClientMasterController' } },
                { path: 'clientmasters/edit', component: ClientMasterNew, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.ClientMasterController' } },
                { path: 'clientmasters/edit/:id', component: ClientMasterEdit, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.ClientMasterController' } },
                { path: 'clientmasters/:id/detail', component: ClientMasterDetail, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.ClientMasterController' } },

                // Route for Vendor Master
                { path: 'vendormasters', component: VendorMasterList, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.VendorMasterController' } },
                { path: 'vendormasters/edit', component: VendorMasterNew, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.VendorMasterController' } },
                { path: 'vendormasters/edit/:id', component: VendorMasterEdit, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.VendorMasterController' } },
                { path: 'vendormasters/:id/detail', component: VendorMasterDetail, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.VendorMasterController' } },

                // Route for Purchase
                { path: 'purchases', component: PurchaseList, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.PurchaseController' } },
                { path: 'purchases/edit', component: PurchaseNew, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.PurchaseController' } },
                { path: 'purchases/edit/:id', component: PurchaseEdit, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.PurchaseController' } },
                { path: 'purchases/:id/detail', component: PurchaseDetail, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.PurchaseController' } },

                // Route for Invoice
                { path: 'invoices', component: InvoiceList, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.InvoiceController' } },
                { path: 'invoices/edit', component: InvoiceNew, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.InvoiceController' } },
                { path: 'invoices/edit/:id', component: InvoiceEdit, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.InvoiceController' } },
                { path: 'invoices/:id/detail', component: InvoiceDetail, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.InvoiceController' } },

                // Route for Quotation
                { path: 'quotations', component: QuotationList, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.QuotationController' } },
                { path: 'quotations/edit', component: QuotationNew, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.QuotationController' } },
                { path: 'quotations/edit/:id', component: QuotationEdit, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.QuotationController' } },
                { path: 'quotations/:id/detail', component: QuotationDetail, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.QuotationController' } },
                

                // Route for Delivery Challans
                { path: 'deliverychallans', component: DeliverychallanList, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.DeliveryChallanController' } },
                { path: 'deliverychallans/edit', component: DeliverychallanNew, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.DeliveryChallanController' } },
                { path: 'deliverychallans/edit/:id', component: DeliverychallanEdit, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.DeliveryChallanController' } },
                { path: 'deliverychallans/:id/detail', component: DeliverychallanDetail, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.DeliveryChallanController' } },
                
                // Route for Order
                 { path: 'orders', component: OrderList, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.StateListController' } },
                 { path: 'orders/edit', component: OrderNew, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.StateListController' } },
                 { path: 'orders/edit/:id', component: OrderEdit, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.StateListController' } },
                 { path: 'orders/:id/detail', component: OrderDetail, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.StateListController' } },

                // Route for Email
                { path: 'emails', component: EmailList, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.EmailStatusController' } },
                { path: 'emails/edit', component: EmailEdit, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.EmailController' } },
                { path: 'emails/edit/:id', component: EmailEdit, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.EmailController' } },
                { path: 'emails/:id/detail', component: EmailDetail, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.EmailStatusController' } },

                // Branch
                { path: 'branchs', component: BranchList, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.BranchController' } },
                { path: 'branchs/edit', component: BranchNew, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.BranchController' } },
                { path: 'branchs/edit/:id', component: BranchEdit, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.BranchController' } },
                { path: 'branchs/:id/detail', component: BranchDetail, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.BranchController' } },
                // User Role
                { path: 'userroles', component: UserRoleList, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.UserRoleController' } },
                { path: 'userroles/edit', component: UserRoleNew, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.UserRoleController' } },
                { path: 'userroles/edit/:id', component: UserRoleEdit, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.UserRoleController' } },
                { path: 'userroles/:id/detail', component: UserRoleDetail, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.UserRoleController' } },
               
                { path: 'misreports',  component: MisReport,  meta: { middleware: 'auth'}},
                { path: 'misreports/reprotsel',  component: MisReportSel,  meta: { middleware: 'auth'}},

                // Accounts
                { path: 'account',  component: AccountPage,  meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.AccountController' }},
            ]
        },
        // New window open modal (new component)
        { path:'/popup', component:PopupWindow, meta: { middleware: 'auth' }}, 
        { path:'/user-roles/auditlog/:id', component:UserRoleChangeLog, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.UserRoleController' }}, 
        { path:'/users/auditlog/:id', component:UserChangeLog, meta: { middleware: 'auth', controller: 'App.Http.Controllers.Api.UserController'}}, 
        { path: '/:pathMatch(.*)*', component: PageNotFoundPage },
        {path:'/:pathMatch(.*)*',component: NotFound},
    ];
   

    
export default routes;