import lang from "@/views/modules/StateLists/language/en";
let formElement = {
    metaList: [
                {
                    type: 'selectcomponent',
                    name: 'countrylist_name',
                    label: lang.LBL_COUNTRY_NAME,
                    required: true,
                    linkComponent: 'countrylist',
                    moduleName: 'CountryLists',
                    parent_id: 'parent_id',
                    parent_type: 'parent_type',
                },
                {
                    'type':'text',
                    'name':'name',
                    'label':lang.LBL_STATE_NAME,
                    'required':false
                },
                {
                    type:'selectbox',
                    name:'status',
                    label: lang.LBL_STATUS,
                    items:[
                        {value: 'Active'},
                        {value: 'InActive'},
                    ],
                    required: false
                },
            ],
            urls: 'api/modules/statelists',

            routePath: {
                path: 'statelists',
                detail: false
            }
}

export default formElement;