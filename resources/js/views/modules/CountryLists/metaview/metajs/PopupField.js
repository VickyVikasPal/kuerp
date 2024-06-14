

const genericField = {
        metaList:[
            {
                label:'Name',
                link:true,
                routePath:'examples'/// routePath is required at start of object
            },
            {
                label:'Email',
                link:false,
                routePath:''
            }
    ],

    columns: ['name', 'email'],
};

export default genericField;
