
export default class number_word
{
    constructor(value){
        this.value = value;
    }

    number2text(value) {
        var fraction = Math.round(this.frac(value)*100);
        var f_text  = "";
    
        if(fraction > 0) {
            f_text = "And "+this.convert_number(fraction)+" Paise";
        }
    
        return this.convert_number(value)+" Rupees "+f_text+" Only";
    }
    
    frac(f) {
        return f % 1;
    }
    
    convert_number(number)
    {
        if ((number < 0) || (number > 999999999)) 
        { 
            return "NUMBER OUT OF RANGE!";
        }
        var Gn = Math.floor(number / 10000000);  /* Crore */ 
        number -= Gn * 10000000; 
        var kn = Math.floor(number / 100000);     /* lakhs */ 
        number -= kn * 100000; 
        var Hn = Math.floor(number / 1000);      /* thousand */ 
        number -= Hn * 1000; 
        var Dn = Math.floor(number / 100);       /* Tens (deca) */ 
        number = number % 100;               /* Ones */ 
        var tn= Math.floor(number / 10); 
        var one=Math.floor(number % 10); 
        var res = ""; 
    
        if (Gn>0) 
        { 
            res += (this.convert_number(Gn) + " Crore"); 
        } 
        if (kn>0) 
        { 
                res += (((res=="") ? "" : " ") + 
                this.convert_number(kn) + " Lakh"); 
        } 
        if (Hn>0) 
        { 
            res += (((res=="") ? "" : " ") +
            this.convert_number(Hn) + " Thousand"); 
        } 
    
        if (Dn) 
        { 
            res += (((res=="") ? "" : " ") + 
            this.convert_number(Dn) + " Hundred"); 
        } 
    
    
        var ones = Array("", "One", "Two", "Three", "Four", "Five", "Six","Seve", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen","Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen","Nineteen"); 
    var tens = Array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty","Seventy", "Eighty", "Ninety"); 
    
        if (tn>0 || one>0) 
        { 
            if (!(res=="")) 
            { 
                res += " And "; 
            } 
            if (tn < 2) 
            { 
                res += ones[tn * 10 + one]; 
            } 
            else 
            { 
    
                res += tens[tn];
                if (one>0) 
                { 
                    res += ("-" + ones[one]); 
                } 
            } 
        }
    
        if (res=="")
        { 
            res = "zero"; 
        } 
        return res;
    }

}