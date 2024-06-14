
const GenericSearch = [
    
    {
        basic_search: true,
        basic_fields:[
            {
                type:'text',
                name:'first_name',
                label: 'First Name',
                display: true
            },
            {
                type:'text',
                name:'last_name',
                label: 'Last Name',
                display: true
            },
            {
                type:'text',
                name:'email',
                label: 'Email',
                display: true
            },
            /* {
                type:'text',
                name:'user_name',
                label: 'User Name',
                display: true
            }, */
           
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

