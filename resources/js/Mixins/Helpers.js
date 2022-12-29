import moment, { months } from "moment";

export default {
    components: {
    },
    props: [],
    data() {
        return {
        }
    },
    methods: {
        DateFormat(date){
            var br = document.createElement('br');
            return moment(String(date)).format('ddd, MMM DD YYYY') +'<br />'+ moment(String(date)).format('hh:mm:ss a');
        },
        DateFormatDateOnly(date){
            var br = document.createElement('br');
            return moment(String(date)).format('ddd, MMM DD YYYY');
        },
        getCurrentMonthNumber(date){
            return moment(date).format('M');
        },
        MondeyDigitFormat(data){
            // let dollarUSLocale = Intl.NumberFormat('en-US');
            return data.toLocaleString('en-US', { style: 'currency', currency: 'PHP' });
            // return dollarUSLocale.format(data);
            // return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        },
        dueDate(startDate, addedNumberOfDays){
            return moment(startDate).add(addedNumberOfDays, 'd');
        },
        go_back(){
            window.history.back();
        },
        momentRange(){
            
        }
    },
    created: function(){

    }
}
