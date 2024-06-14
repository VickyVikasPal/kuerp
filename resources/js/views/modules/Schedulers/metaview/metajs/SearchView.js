
const GenericSearch = [
    
    {
        basic_search: true,
        basic_fields:[
            {
                type:'text',
                name:'name',
                label: 'Name',
                display: true
            },
           
            {
                type:'selectbox',
                name:'status',
                label: 'Status',
                items:[
                    {value: 'Active'},
                    {value: 'Inactive'},
                ],
                display: true
            },
           
              
        ]
    },

    // Advance Search here
    
    {
        advance_search: false,
        basic_fields:[
            {
                type:'text',
                name:'name',
                label: 'Name',
                display: true
            },
            {
                type:'text',
                name:'category',
                label: 'Category',
                display: true
            },
            {
                type:'selectbox',
                name:'status',
                label: 'Status',
                items:[
                    {value: 'Active'},
                    {value: 'Inactive'},
                ],
                display: true
            },
           


        ]
    }

];

export default GenericSearch;

