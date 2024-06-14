import lang from "@/views/modules/MisReports/language/en";

let report_array = [
   
    {
        'rname':'category_list',
        'report_name':'category_wise_data',
        'module_name':'Categorys',
        'field_lists':
            [
                {
                    'type':'select',
                    'name':'category_id',
                    'lable':lang.LBL_SELECT_CATEGORY,
                    'function_name':'get_category_list' ////function name will be 'get_rname'
                },
                {
                    'type':'date',
                    'name':'date_range1',
                    'lable':lang.LBL_DATE_START,
                    'function_name':'' ////function name will be 'get_rname'
                },
                {
                    'type':'date',
                    'name':'date_range2',
                    'lable':lang.LBL_DATE_END,
                    'function_name':'' ////function name will be 'get_rname'
                }
            ]
        
    },
    {
        'rname':'product_list',
        'report_name':'product_wise_data',
        'module_name':'Products',
        'field_lists':
            [
                {
                    'type':'select',
                    'name':'product_id',
                    'lable':lang.LBL_SELECT_CATEGORY,
                    'function_name':'get_product_list' ////function name will be 'get_rname'
                },
                {
                    'type':'date',
                    'name':'date_range1',
                    'lable':lang.LBL_DATE_START,
                    'function_name':'' ////function name will be 'get_rname'
                },
                /* {
                    'type':'date',
                    'name':'date_range2',
                    'lable':lang.LBL_DATE,
                    'function_name':'' ////function name will be 'get_rname'
                } */
            ]
        
    }
];

export default {report_array}