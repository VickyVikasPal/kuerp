<template>
    <div class="pdfwrap">
        <table cellpadding="0" cellspacing="0" class="pdf-table">
            <tr>
                <td>
                    <table cellpadding="0" cellspacing="0" width="100%" class="table-header">
                        <tr>
                            <td width="30%" style="border-right:1px solid #000">
                                <img :src="'/assets/images/pdflogo.png'" alt="logo">
                            </td>
                            <td width="70%">
                                <table cellpadding="0" cellspacing="0" width="100%" class="pdf-inner-table">
                                    <tr>
                                        <td align="center"><b
                                                style="font-size: 18px;border-bottom: 1px solid #000;margin-bottom: 4px;text-transform: uppercase;">QUOTATION</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center"><b
                                                style="margin-bottom: 4px;text-transform: uppercase;">Gaurav Earthmoving
                                                Pvt Ltd</b></td>
                                    </tr>
                                    <tr>
                                        <td align="center">D, 112, 60 Feet Rd, Chhatarpur Hills, Pocket D, Chattarpur
                                            Enclave, Chhatarpur, New Delhi, Delhi 110074</td>
                                    </tr>
                                </table>
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td width="80px"><b>TIN No.</b></td>
                                        <td>:</td>
                                        <td>1234567890</td>
                                        <td width="120px"><b>PAN No.</b></td>
                                        <td>:</td>
                                        <td>1234567890</td>
                                    </tr>
                                    <tr>
                                        <td width="80px"><b>CST No.</b></td>
                                        <td>:</td>
                                        <td>1234567890</td>
                                        <td width="120px"><b>Services Tax No.</b></td>
                                        <td>:</td>
                                        <td>1234567890</td>
                                    </tr>
                                    <tr>
                                        <td width="80px"><b>CI No.</b></td>
                                        <td>:</td>
                                        <td>1234567890</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table cellpadding="0" cellspacing="0" width="100%" style="border-bottom: 1px solid #000;">
                        <tr>
                            <td width="55%" style="padding: 10px;">
                                <table cellpadding="0" cellspacing="0" width="100%" class="pdf-inner-table">
                                    <tr>
                                        <td width="100px"><b>Bill To</b></td>
                                        <td><b>123456 &nbsp; | ABHAY SINGH</b></td>
                                    </tr>
                                    <tr>
                                        <td width="100px"><b></b></td>
                                        <td>Address 1</td>
                                    </tr>
                                    <tr>
                                        <td width="100px"><b></b></td>
                                        <td>Address 2</td>
                                    </tr>
                                    <tr>
                                        <td width="100px"><b></b></td>
                                        <td>Address 3</td>
                                    </tr>
                                    <tr>
                                        <td width="100px"><b>Ship To</b></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td width="100px"><b></b></td>
                                        <td>Address 1</td>
                                    </tr>
                                    <tr>
                                        <td width="100px"><b></b></td>
                                        <td>Address 2</td>
                                    </tr>
                                    <tr>
                                        <td width="100px"><b></b></td>
                                        <td>Address 3</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="45%" style="padding: 10px;">
                                <table cellpadding="0" cellspacing="0" width="100%" class="pdf-inner-table">
                                    <tr>
                                        <td width="130px"><b>Document No.</b></td>
                                        <td width="20px">:</td>
                                        <td>123456</td>
                                    </tr>
                                    <tr>
                                        <td width="130px"><b>Date</b></td>
                                        <td width="20px">:</td>
                                        <td>22-07-2023</td>
                                    </tr>
                                    <tr>
                                        <td width="130px"><b>Customer CST</b></td>
                                        <td width="20px">:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td width="130px"><b>Customer TIN</b></td>
                                        <td width="20px">:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td width="130px"><b>Contact Number</b></td>
                                        <td width="20px">:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td width="130px"><b>Transport Mode</b></td>
                                        <td width="20px">:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td width="120px"><b>Sale Excutives</b></td>
                                        <td width="20px">:</td>
                                        <td>ABHAY PRATAP SINGH</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                    </table>
                    <table cellpadding="0" cellspacing="0" width="100%" style="border-bottom: 1px solid #000;">
                        <tr>
                            <td style="padding: 10px;">Hypothecation : SHRIRAM EQUIPMENT FINANCE COMPANY LIMITED ,MUMBAI
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table cellpadding="0" cellspacing="0" width="100%" border="1"
                        class="table table-bordered pdf-inner-table m-0">
                        <thead>
                            <tr>
                                <th align="left">SI. No.</th>
                                <th align="left">Catalouge No.</th>
                                <th align="left">Catalouge Decription</th>
                                <th align="right">Qty</th>
                                <th align="left">Rate</th>
                                <th align="center">Tax</th>
                                <th align="left">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>3DX-MAAAA</td>
                                <td>3DX ,BAXX,1/23/jk</td>
                                <td>1</td>
                                <td>200000000</td>
                                <td>VAT@5</td>
                                <td>199000000</td>
                            </tr>

                        </tbody>

                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table cellpadding="0" cellspacing="0" width="100%" class="pdf-inner-table"
                        style="border-bottom: 1px solid #000;">
                        <tr>
                            <td width="60%" style="padding: 10px;">
                                <table cellpadding="0" cellspacing="0" width="100%" class="pdf-inner-table">
                                    <tr>
                                        <td width="140px"><b>Total No. Of Items</b></td>
                                        <td>1</td>
                                        <td width="140px"><b>Total No. Of Qty</b></td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><b></b></td>

                                    </tr>
                                    <tr>
                                        <td width="140px"><b>M/C Serial No.</b></td>
                                        <td width="20px">:</td>
                                        <td colspan="2">1872147</td>

                                    </tr>
                                    <tr>
                                        <td width="140px"><b>Engine No.</b></td>
                                        <td width="20px">:</td>
                                        <td colspan="2">H00077779</td>

                                    </tr>
                                    <tr>
                                        <td width="140px"><b>Chassis No.</b></td>
                                        <td width="20px">:</td>
                                        <td colspan="2">HRTXERO980MN</td>

                                    </tr>
                                    <tr>
                                        <td width="140px"><b>Juridiction</b></td>
                                        <td width="20px">:</td>
                                        <td colspan="2">Jamshedpur</td>

                                    </tr>
                                    <tr>
                                        <td width="140px"><b>Amount In Words</b></td>
                                        <td width="20px">:</td>
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">Nineteen Crore Ninety Lakh Four Hundred Fifty Six </td>
                                    </tr>
                                </table>
                            </td>
                            <td width="40%" style="padding: 10px;">
                                <table cellpadding="0" cellspacing="0" width="100%" class="pdf-inner-table">
                                    <tr>
                                        <td><b>Sub Total</b></td>
                                        <td></td>
                                        <td align="right">0.00</td>
                                    </tr>
                                    <tr>
                                        <td><b>VAT@5</b></td>
                                        <td>10.00</td>
                                        <td align="right">0.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" height="70px"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Rounding</b></td>
                                        <td></td>
                                        <td align="right">0.00</td>
                                    </tr>
                                    <tr>
                                        <td><b>Freight</b></td>
                                        <td></td>
                                        <td align="right">0.00</td>
                                    </tr>
                                    <tr>
                                        <td><b>Total</b></td>
                                        <td></td>
                                        <td align="right">0.00</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table cellpadding="0" cellspacing="0" width="100%" style="border-bottom: 1px solid #000;">
                        <tr>
                            <td style="padding: 10px;"><b>TERMS & CONDITIONS :</b></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td style="padding: 10px;">
                                <table cellpadding="0" cellspacing="0" width="100%" class="pdf-inner-table">
                                    <tr>
                                        <td>
                                            1. Invoices or invoice creation are mandatory by the Government of India
                                            under GST laws. While making these invoices you have to take a lot of things
                                            under consideration.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2. One of these key elements is- The invoice payment terms and conditions.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3. One of these key elements is- The invoice payment terms and conditions.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4. One of these key elements is- The invoice payment terms and conditions.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="50px"> </td>
                                    </tr>
                                    
                                </table>
                                <table cellpadding="0" cellspacing="0" width="100%" class="pdf-inner-table">
                                    <tr>
                                        <td width="50%" valign="top">
                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                <tr>
                                                    <td height="28px"></td>
                                                </tr>
                                                <tr>
                                                    <td>Customer Signature</td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td width="50%" valign="top">
                                            <table cellpadding="0" cellspacing="0" width="100%" class="pdf-inner-table">
                                                <tr>
                                                    <td align="right">For : GAURAV EARTNMOVING PVT. LYD.</td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td align="center">Authorised Signature</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    
                                </table>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>

        </table>
    </div>


</template>
<script>
    export default {
        name: 'quoation-pdf',
    }
</script>
<style>
    .pdfwrap {
        width: 100%;
        max-width: 100%;
        width: 210mm;
        height: 259mm;
        margin: 0 auto;
    }

    .pdf-table {
        border: 1px solid #000;
    }

    .pdf-table tr td {
        font-size: 14px;
        line-height: 18px;
    }

    .table-header {
        border-bottom: 1px solid #000;
    }

    .table-header>tr>td {
        padding: 10px;
        vertical-align: top;
    }
    .table-header img{width: 100%;height: 130px;border-radius: 0.325rem;}

    .pdf-inner-table>tr>td {
        vertical-align: top;
        padding-bottom: 4px;
    }
</style>