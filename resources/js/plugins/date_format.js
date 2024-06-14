
export default class DateFormat
{
    constructor(userformat){
        this.userformat = userformat;
    }
    getFormat()
    {
        if(this.userformat == '' || typeof(this.userformat) == undefined)
        {
            return "dd/MM/yyyy";
        }

        if(this.userformat != '')
        {
            if(this.userformat == 'Y-m-d'){
                return "yyyy-MM-dd";
            }
            if(this.userformat == 'd-m-Y'){
                return "dd-MM-yyyy";
            }
            if(this.userformat == 'd/m/Y'){
                return "DD/MM/yyyy";
            }
            if(this.userformat == 'm-d-Y'){
                return "MM-dd-yyyy";
            }
            if(this.userformat == 'Y/m/d'){
                return "yyyy/MM/dd";
            }
            if(this.userformat == 'm/d/Y'){
                return "MM/dd/yyyy";
            }
            if(this.userformat == 'Y.m.d'){
                return "yyyy.MM.dd";
            }
            if(this.userformat == 'd.m.Y'){
                return "dd.MM.yyyy";
            }
            if(this.userformat == 'm.d.Y'){
                return "MM.dd.yyyy";
            }
        }
    }
    printDate(){
            let d = new Date();
            let ye = new Intl.DateTimeFormat("en-IN", { year: "numeric" }).format(d);
            let mo = new Intl.DateTimeFormat("en-IN", { month: "numeric" }).format(d);
            let da = new Intl.DateTimeFormat("en-IN", { day: "2-digit" }).format(d);
           return `${ye}-${mo}-${da}`;
    }
    getTimepickerValue(selectedTimepicker){
        let tm = selectedTimepicker.defaultMT;
            tm = tm.toLowerCase();
       let timevalue = `${selectedTimepicker.defaultHR}:${selectedTimepicker.defaultMI}${tm}`;
        return timevalue;
    }
    displayDate(userDate){        
        let date_arr = userDate.split(" ");
        let return_date = date_arr[0].split("-").reverse().join("/");
        return return_date;
    }

    getDateFormat(userDate){
       // console.log(userDate);
    }
}