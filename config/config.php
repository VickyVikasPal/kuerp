<?php
return $laravel_config = array(
    'PACS_CREDENTIALS' => 
  array (
    'url' => 'http://192.168.0.149/',
    'username' => 'hisuser',
    'password' => 'hisuser',
  ),
  'admin_access_control' => false,
  'login_with_captcha' => false,
  'admin_export_only' => false,
  'product_title' => 'ASHA ERP SOLUTIONS',
  'product_description' => 'Software for self service in Restaurants',
  //'logo_path' => '/assets/images/logo.png',
  'allow_chat' => 'false',
  'cache_dir' => 'cache/',
  'calculate_response_time' => 'true',
  'common_ml_dir' => '',
  'config_paytm' => false,
  'cosecdata_config' => 
  array (
    'cosecdata_host_url' => 'http://192.168.10.184/~Softdev',
    'cosecdata_host_user' => 'Softdev',
    'cosecdata_host_password' => 'Softdev1123',
  ),
  'create_default_user' => false,
  'cron_pdfreport' => 0,
  'currency' => '',
  'dashlet_display_row_options' => 
  array (
    0 => '1',
    1 => '3',
    2 => '5',
    3 => '10',
    4 => '15',
    5 => '20',
    6 => '40',
    7 => '60',
    8 => '80',
  ),
  'date_formats' => 
  array (
    'Y-m-d' => '2006-12-23',
    'm-d-Y' => '12-23-2006',
    'd-m-Y' => '23-12-2006',
    'Y/m/d' => '2006/12/23',
    'm/d/Y' => '12/23/2006',
    'd/m/Y' => '23/12/2006',
    'Y.m.d' => '2006.12.23',
    'd.m.Y' => '23.12.2006',
    'm.d.Y' => '12.23.2006',
  ),
  'datef' => 'd/m/Y',
  'dbconfig' => 
  array (
    'db_host_name' => '192.168.10.166',
    'db_host_instance' => 'SQLEXPRESS',
    'db_user_name' => 'root',
    'db_password' => 'Saahil@123',
    'db_name' => 'vknrl805',
    'db_type' => 'mysql',
    'driver' => 'pdo_mysql',
  ),
  'dbconfigoption' => 
  array (
    'persistent' => true,
    'autofree' => false,
    'debug' => 0,
    'seqname_format' => '%s_seq',
    'portability' => 0,
    'ssl' => false,
  ),
  'default_action' => 'index',
  'default_charset' => 'UTF-8',
  'default_currencies' => 
  array (
    'AUD' => 
    array (
      'name' => 'Australian Dollars',
      'iso4217' => 'AUD',
      'symbol' => '$',
    ),
    'BRL' => 
    array (
      'name' => 'Brazilian Reais',
      'iso4217' => 'BRL',
      'symbol' => 'R$',
    ),
    'GBP' => 
    array (
      'name' => 'British Pounds',
      'iso4217' => 'GBP',
      'symbol' => '£',
    ),
    'CAD' => 
    array (
      'name' => 'Canadian Dollars',
      'iso4217' => 'CAD',
      'symbol' => '$',
    ),
    'CNY' => 
    array (
      'name' => 'Chinese Yuan',
      'iso4217' => 'CNY',
      'symbol' => '￥',
    ),
    'EUR' => 
    array (
      'name' => 'Euro',
      'iso4217' => 'EUR',
      'symbol' => '€',
    ),
    'HKD' => 
    array (
      'name' => 'Hong Kong Dollars',
      'iso4217' => 'HKD',
      'symbol' => '$',
    ),
    'INR' => 
    array (
      'name' => 'Indian Rupees',
      'iso4217' => 'INR',
      'symbol' => '₨',
    ),
    'KRW' => 
    array (
      'name' => 'Korean Won',
      'iso4217' => 'KRW',
      'symbol' => '₩',
    ),
    'YEN' => 
    array (
      'name' => 'Japanese Yen',
      'iso4217' => 'JPY',
      'symbol' => '¥',
    ),
    'MXM' => 
    array (
      'name' => 'Mexican Pesos',
      'iso4217' => 'MXM',
      'symbol' => '$',
    ),
    'SGD' => 
    array (
      'name' => 'Singaporean Dollars',
      'iso4217' => 'SGD',
      'symbol' => '$',
    ),
    'CHF' => 
    array (
      'name' => 'Swiss Franc',
      'iso4217' => 'CHF',
      'symbol' => 'SFr.',
    ),
    'THB' => 
    array (
      'name' => 'Thai Baht',
      'iso4217' => 'THB',
      'symbol' => '฿',
    ),
    'USD' => 
    array (
      'name' => 'US Dollars',
      'iso4217' => 'USD',
      'symbol' => '$',
    ),
  ),
  'default_currency_iso4217' => 'INR',
  'default_currency_name' => 'India Rupees',
  'default_currency_significant_digits' => '2',
  'default_currency_symbol' => 'Rs. ',
  'default_date_format' => 'd/m/Y',
  'default_time_zone' => 'Asia/Calcutta',
  'default_decimal_seperator' => '.',
  'default_email_charset' => 'UTF-8',
  'default_email_client' => 'sugar',
  'default_email_editor' => 'html',
  'default_export_charset' => 'ISO-8859-1',
  'default_language' => 'en_us',
  'default_locale_name_format' => 's f l',
  'default_max_subtabs' => '10',
  'default_max_tabs' => '9',
  'default_module' => 'Home',
  'default_navigation_paradigm' => 'gm',
  'default_number_grouping_seperator' => ',',
  'default_password' => '',
  'default_patient_password' => 'sonakshi@123',
  'default_permissions' => 
  array (
    'dir_mode' => 1528,
    'file_mode' => 432,
    'user' => '',
    'group' => '',
  ),
  'default_subpanel_links' => false,
  'default_subpanel_tabs' => true,
  'default_swap_last_viewed' => true,
  'default_swap_shortcuts' => true,
  'default_theme' => 'Care2012',
  'default_time_format' => 'h:ia',
  'default_user_is_admin' => false,
  'default_user_name' => '',
  'developerMode' => false,
  'disable_count_query' => true,
  'disable_export' => false,
  'disable_persistent_connections' => false,
  'display_email_template_variable_chooser' => false,
  'display_header_footer_in_print' => '1',
  'display_inbound_email_buttons' => false,
  'dump_slow_queries' => false,
  'duplicate_patient_cron_limit' => 1,
  'email_default_client' => 'sugar',
  'email_default_delete_attachments' => true,
  'email_default_editor' => 'html',
  'email_num_autoreplies_24_hours' => 10,
  'email_outbound_save_raw' => false,
  'email_xss' => 'YToxMjp7czo2OiJhcHBsZXQiO3M6NjoiYXBwbGV0IjtzOjQ6ImJhc2UiO3M6NDoiYmFzZSI7czo1OiJlbWJlZCI7czo1OiJlbWJlZCI7czo0OiJmb3JtIjtzOjQ6ImZvcm0iO3M6NToiZnJhbWUiO3M6NToiZnJhbWUiO3M6ODoiZnJhbWVzZXQiO3M6ODoiZnJhbWVzZXQiO3M6NjoiaWZyYW1lIjtzOjY6ImlmcmFtZSI7czo2OiJpbXBvcnQiO3M6ODoiXD9pbXBvcnQiO3M6NToibGF5ZXIiO3M6NToibGF5ZXIiO3M6NDoibGluayI7czo0OiJsaW5rIjtzOjY6Im9iamVjdCI7czo2OiJvYmplY3QiO3M6MzoieG1wIjtzOjM6InhtcCI7fQ==',
  'enable_hl7' => '0',
  'enable_msteam' => '0',
  'epoc_loc' => '',
  'export_delimiter' => ',',
  'external_kitchen' => 'true',
  'fcminfo' => 
  array (
    'fcm_url' => 'https://tcm.googleapis.com/fcm/send',
    'fcm_serverkey' => 'AAAAJwX_F7A:APA91bGMmHzfsFBAwg4YDGn4xX6lHrtGp86Y_zRY6uRx5rRuP0TdAlyqZJNZT0ijrfJMPtq_dqKwXmcWV7JfFKAkRko-I-0PL0q_XFyHuAsAjeF8ATNdQko4jfAeVtRPIUj4RLiGW-sC',
    'sender_id' => '167604328368',
    'app_id' => '1:167604328368:android:3de58ffd2979aab2bea875',
  ),
  'ffmpeg_path' => '/usr/bin/',
  'gstin' => 'ABCF4567765AD',
  'healthcheckup_in_day' => '25',
  'history_max_viewed' => 5,
  'hospital_contact_address' => '',
  'hospitalname' => 
  array (
    'name' => 'VKNRL HOSPITAL',
    'address1' => 'NRL TOWNSHIP, POST: N.R COMPLEX',
    'address2' => 'NUMALIGARH, DIST: GOLAGHAT, ',
    'city' => '',
    'state' => 'ASSAM',
    'country' => 'India',
    'pin' => '785699',
    'phone' => '+91-03776266700',
    'site' => 'https://103.225.56.116',
    'email' => 'vknrl@nrl.co.in',
    'forsms' => 'Hospital Care Ltd',
  ),
  'host_name' => '173.201.33.103',
  'i18n_test' => false,
  'import_dir' => 'cache/import/',
  'import_max_execution_time' => 3600,
  'import_max_records_per_file' => '1000',
  'inactive_users_inactive_time' => 7,
  'inactive_users_logout_time' => 30,
  'installer_locked' => true,
  'integrate_fa' => true,
  'integrated_with_qms' => true,
  'internal_pharmacy' => 'true',
  'js_custom_version' => 1,
  'js_lang_version' => 1,
  'languages' => 
  array (
    'en_us' => 'English (US)',
    'jp_jp' => 'Japanese',
  ),
  'large_scale_test' => false,
  'list_max_entries_per_page' => '20',
  'list_max_entries_per_subpanel' => '10',
  'lock_default_user_name' => false,
  'lock_homepage' => 'false',
  'lock_screen_enabled' => false,
  'lock_screen_thread_time' => 15,
  'lock_screen_timeout' => 10,
  'lock_subpanels' => 'false',
  'log_dir' => 'storage/logs/',
  'log_file' => 'Softdev.log',
  'log_memory_usage' => false,
  'logger' => 
  array (
    'level' => 'info',
    'file' => 
    array (
      'ext' => '.log',
      'name' => 'ether',
      'dateFormat' => '%c',
      'maxSize' => '10MB',
      'maxLogs' => 10,
      'suffix' => '%m_%Y',
    ),
  ),
  'login_nav' => 'false',
  'crmapi' => 
  array (
    'ownerId' => '',
    'host' => 'https://eelenas.in/rest_service',
    'ApiKey' => '',
    'AccessKey' => '',
    'SecretKey' => '',
    'ApiMethod' => 
    array (
      1 => '/contact/add_contact.php',
      2 => '/deal/add_activity.php',
      3 => '/deal/add_deal.php',
      4 => '',
    ),
  ),
  'crmenabled' => true,
  'crmhost' => 'BNH',
  'max_dashlets_homepage' => '15',
  'max_recording_time' => '10',
  'name' => 'Ether',
  'onlinepayconfig' => 
  array (
    'payu_base_url' => 'https://test.payu.in/_payment',
    'merchant_key' => 'Jhcqna',
    'salt' => 'BWQJLByn',
    'surl' => 'http://10.0.0.12/~Softdev/trunk/index.php?module=Payments&action=Success',
    'fcurl' => 'http://10.0.0.12/~Softdev/trunk/index.php?module=Payments&action=Success',
    'csurl' => 'http://10.0.0.12/~Softdev/trunk/index.php?module=Payments&action=Success',
  ),
  'pan_no' => '',
  'password_sms' => true,
  'patientPortal' => 
  array (
    'paytmPayment' => 
    array (
      'payment' => 
      array (
        'Recieve' => 'https://securegw-stage.paytm.in/theia/api/v1/initiateTransaction',
      ),
      'paytmapihost' => 'https://securegw-stage.paytm.in',
      'enablePayment' => false,
      'merchantkey' => 'njiZ1_Y30OpyFA&q',
      'mid' => 'ITSDEN23958851312990',
      'websiteName' => 'WEBSTAGING',
      'currency' => 'INR',
      'callbackUrl' => 'http://127.0.0.1:8000/paymentresponse',
    ),
  ),
  'paytm' => 
  array (
    'wallet_url' => 'https://trust.paytm.in/wallet-web/v7/withdraw',
    'merchantGuid' => 'd1ead417-faaf-4c8c-a3b5-32f1b2af6bed',
    'merchantKey' => 'Jmu!p6g!Axb0XpDR',
    'mid' => 'ITSSUY76078195926643',
    'refund_url' => 'https://trust.paytm.in/wallet-web/refundWalletTxn',
    'txn_status_url' => 'https://trust.paytm.in/wallet-web/checkStatus',
  ),
  'paytmEDC' => 
  array (
    'channelId' => 'EDC',
    'payment' => 
    array (
      'Recieve' => 'https://securegw-stage.paytm.in/ecr/payment/request',
      'Refund' => 'https://securegw-stage.paytm.in/refund/apply',
    ),
    'status' => 
    array (
      'Recieve' => 'https://securegw-stage.paytm.in/ecr/payment/status',
      'Refund' => 'https://securegw-stage.paytm.in/v2/refund/status',
    ),
  ),
  'paytmEDCenabled' => false,
  'pdf_dir' => 'cache/Pdfdownloads',
  'pharma_fa' => true,
  'pharmacy_association_discount' => 10,
  'portal_view' => 'single_user',
  'print_header' => true,
  'qms_config' => 
  array (
    'qms_host_url' => 'http://192.168.10.168/~Softdev/6.0.3/RestAPI/index.php',
    'qms_host_user' => 'Softdev',
    'qms_host_password' => 'Softdev123',
    'qms_mid' => '5a50ba8c-6d84-468f-8d57-7311c0a80a77',
    'qms_mguid' => 'BNS001',
    'qms_merchant_key' => 'BNS',
    'qms_product_url' => 'http://192.168.10.168/~Softdev/6.0.3',
  ),
  'razorpay' => 
  array (
    'razorpay_base_url' => 'https://api.razorpay.com/v1',
    'key_id' => 'rzp_test_iGvS1Y0YfOwviD',
    'secret_id' => 'n6PD1ZhtvFzZKaInfofTS4vv',
  ),
  'refresh_logout_or_lock' => false,
  'registration_bill_required' => 'true',
  'repetitive_lab_duration' => '3',
  'repetitive_presc_duration' => '3',
  'require_accounts' => true,
  'resource_management' => 
  array (
    'special_query_limit' => 100000,
    'special_query_modules' => 
    array (
      0 => 'Reports',
      1 => 'Export',
      2 => 'Import',
      3 => 'Administration',
      4 => 'Sync',
      5 => 'Assets',
      6 => 'Po_recieveitems',
      7 => 'Purchaseorders',
    ),
    'default_limit' => 50000,
  ),
  'rss_cache_time' => '10800',
  'rupload_dir' => 'report/',
  'save_query' => 'all',
  'sendsmsconfig' => 
  array (
 //   'sms_host_name' => 'http://api.pinnacle.in/index.php/sms/send',
    'sms_host_name' => 'http://myapi.pinnacle.in/index.php/sms/send',
    'sms_host_user' => 'VKNRLH',
    'sms_host_password' => 'b38caf-085398-ca4c76-b741e0-10c187',
    'sms_host_orgid' => '1501440580000032151',
    'sms_country_code' => 
    array (
      'India' => '91',
      'USA' => '1',
    ),
  ),
  'session_dir' => 'sessions',
  'showDetailData' => true,
  'showThemePicker' => false,
  'show_created_time_in_system' => '1',
  'show_created_time_to_user' => '1',
  'show_duplicate_bill' => '0',
  'site_url' => 'http://192.168.10.189/~Softdev/8.0.14/',
  'skip_line' => 5,
  'slow_query_time_msec' => '100',
  'sms_enable' => true,
  'socialnetworksite' => 
  array (
    'facebook' => 'https://www.facebook.com/Softdevinfo/',
    'instagram' => 'https://www.facebook.com/Softdevinfo/',
    'youtube' => 'https://www.youtube.com',
    'twitter' => 'https://twitter.com/Softdev_India',
    'privateweblink' => 'https://sonakshichildrenhospital.co.in/privacy.html',
  ),
  'stack_trace_errors' => false,
  'sugar_version' => '5.2.0c',
  'sugarbeet' => true,
  'support_email' => 'support@Softdevinfo.com',
  'support_email_ticket_identifier' => 'TW',
  'tally_loc' => 'http://10.0.0.132:9000',
  'time_formats' => 
  array (
    'H:i' => '23:00',
    'h:ia' => '11:00pm',
    'h:iA' => '11:00PM',
    'H.i' => '23.00',
    'h.ia' => '11.00pm',
    'h.iA' => '11.00PM',
  ),
  'timef' => 'h:iA',
  'tin_no' => '',
  'tmp_dir' => 'cache/xml/',
  'translation_string_prefix' => false,
  'twiliovideocall' => 
  array (
    'account_sid' => 'AC4849fbca988ffa1a47069bcc3c2b9ce7',
    'auth_token' => '8fe3a7b0245cdf568129f426e5293b61',
    'api_key' => 'SKb74c90ab66b2cc8092d759e66a0d6826',
    'api_secret' => 'Z1iQEKEgmilBNdMm4XZcbRkEGO3kkbie',
  ),
  'unique_key' => '0db272e72648ffdec8c4c1c4659bf23d',
  'upload_badext' => 
  array (
    0 => 'php',
    1 => 'php3',
    2 => 'php4',
    3 => 'php5',
    4 => 'pl',
    5 => 'cgi',
    6 => 'py',
    7 => 'asp',
    8 => 'cfm',
    9 => 'js',
    10 => 'vbs',
    11 => 'html',
    12 => 'htm',
  ),
  'upload_dir' => 'upload/',
  'upload_image' => 25145728,
  'upload_maxsize' => 25145728,
  'upload_video' => 3145728,
  'use_common_ml_dir' => false,
  'use_php_code_json' => true,
  'use_real_names' => 'true',
  'user_expiry_days' => '45',
  'user_trial_days' => '14',
  'vcal_time' => '2',
  'verify_client_ip' => false,
  'whatsapp_enable' => false,
  'whatsappconfig' => 
  array (
    'whatsapp_host_name' => 'https://test1_api.pinnacle.in/pinwa/pinwav1.php?',
    'whatsapp_apikey' => '4f2272a5-ab74-11ec-a7c7-9606c7e32d76',
    'whatsapp_host_mobile' => '917015448525',
  ),
);
?>
