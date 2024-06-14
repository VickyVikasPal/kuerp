

const genericField = {
        metaList:[
            {
                label:'Name',
                link:true,
                routePath:'vendormasters'/// routePath is required at start of object
            },
            {
                label:'Status',
                link:false,
                routePath:''
            }
    ],

    columns: ['name', 'status'],
};

export default genericField;
