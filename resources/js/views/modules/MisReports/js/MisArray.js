import lang from "@/views/modules/MisReports/language/en";

let mis_array = [
    {
        'group_name':lang.LBL_CATEGORY_REPORT,
        'report_list':[
            {
                'name':'Category List',
                'icons':'fa fa-files-o',
                'url_link':'misreports/reprotsel',
                'rname':'category_list'
            },
            {
                'name':'Category List_1',
                'icons':'fa fa-files-o',
                'url_link':'misreports/reprotsel',
                'rname':'category_list_1'
            },
        ]
    },
    {
        'group_name':lang.LBL_PRODUCT_REPORT,
        'report_list':[
            {
                'name':'Product List',
                'icons':'fa fa-files-o',
                'url_link':'misreports/reprotsel',
                'rname':'product_list'
            },
            {
                'name':'Product List_1',
                'icons':'fa fa-files-o',
                'url_link':'misreports/reprotsel',
                'rname':'product_list_1'
            }
        ]
    },
 
];

export default {mis_array}