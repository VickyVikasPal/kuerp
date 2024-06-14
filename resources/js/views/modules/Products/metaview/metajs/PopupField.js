import lang from "@/views/modules/Products/language/en";

const genericField = {
        metaList:[
            {
                label:lang.LBL_PRODUCT_NAME,
                link:true,
                routePath:'categorys'/// routePath is required at start of object
            },
            {
                label:lang.LBL_PRODUCT_QTY,
                link:false,
                routePath:'categorys'/// routePath is required at start of object
            },
            {
                label:lang.LBL_STATUS,
                link:false,
                routePath:''
            }
    ],

    columns: ['name', 'product_qty', 'status'],
};

export default genericField;
