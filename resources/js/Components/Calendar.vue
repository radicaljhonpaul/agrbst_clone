<style>
    .fc-event{
        cursor: pointer !important;
    }

    .fc-daygrid-day-frame{
        cursor: pointer !important;
    }
</style>
<template>
    <div :eventsData="eventsData" :RoutePrefix="RoutePrefix">
        <full-calendar ref="fullCalendar" :options="calendarOptions"> </full-calendar> 
    </div>
</template>

<script>
    import '@fullcalendar/core/vdom' // solves problem with Vite
    import FullCalendar from '@fullcalendar/vue3'
    import dayGridPlugin from '@fullcalendar/daygrid'
    import timeGridPlugin from '@fullcalendar/timegrid'
    import listGridPlugin from '@fullcalendar/list'
    import interactionPlugin from '@fullcalendar/interaction'
    import year from 'fullcalendar-year-view'
    import bootstrap5Plugin from '@fullcalendar/bootstrap5';
    import Helpers from '../Mixins/Helpers'
    
    export default {
        components: {
            FullCalendar // make the <FullCalendar> tag available
        },
        mixins: [Helpers],
        props: [
            'eventsData', 'RoutePrefix'
        ],
        data() {
        return {
            currentRoute: route().current(),
            calendarOptions: {
                plugins: [
                    bootstrap5Plugin,
                    dayGridPlugin,
                    timeGridPlugin,
                    listGridPlugin,
                    interactionPlugin // needed for dateClick
                ],
                themeSystem: 'bootstrap5',
                customButtons: {
                    Previous: {
                        text: 'Previous',
                        click: () => this.changeMonth('prev')
                    },
                    Next: {
                        text: 'Next',
                        click: () => this.changeMonth('next')
                    }
                },
                headerToolbar: {
                    left: 'Previous,today,Next',
                    center: 'title',
                    right: 'dayGridMonth,timeGridDay,list'
                    // right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                initialView: 'dayGridMonth',
                dateClick: this.handleDateClick,
                events: [],
                height: 590,
                // initialEvents: INITIAL_EVENTS, // alternatively, use the `events` setting to fetch from a feed
                editable: false,
                selectable: true,
                // selectMirror: true,
                showNonCurrentDates: false,
                dayMaxEvents: true,
                weekends: true,
                select: this.handleDateSelect,
                eventClick: this.handleEventClick,
                eventsSet: this.handleEvents,
                eventContent: function(arg) {
                    // return JSON.parse(arg.event.title);
                    var eventObj = JSON.parse(arg.event.title);
                    console.log(eventObj);
                    return {
                        html: '<div class="px-2">' +
                                '<p class="fs-9 mb-0">'+eventObj.crop +'</p>' +
                                '</div>'
                    }
                },

                /* you can update a remote database when these fire:
                eventAdd:
                eventChange:
                eventRemove:
                */
                },
            }
        },
        watch: {
            // whenever question changes, this function will run
            eventsData: function(newVal, oldVal) { // watch it
                // console.log('Prop changed: ', newVal, ' | was: ', oldVal)
                if(newVal){
                    this.calendarOptions.events = [];
                    this.pushToEvents();
                }
            }
        },
        methods: {
            changeMonth(type){
                let calendarApi = this.$refs.fullCalendar.calendar;
                // alert(this.currentRoute+'PerMonth');
                // axios call
                (type == 'prev') ? calendarApi.prev() : calendarApi.next();
                let month = this.getCurrentMonthNumber(calendarApi.getDate());

                axios.get(route(this.currentRoute+'PerMonth'), { params : { monthNum: month }})
                .then((response)=>{
                    console.log("response");
                    console.log(response.data);

                    var newEventData = response.data;
                    // Fire an event
                    this.calendarOptions.events = [];
                    this.$emit("updateEventData", newEventData);
                });

            },
            handleDateClick: function(arg) {
                console.log(route().current()+'PerDate');
                console.log(this.RoutePrefix);
                this.viewPerDate(route().current(), arg.dateStr);
            },
            viewPerDate(base, date){
                this.$inertia.get(route(base+'PerDate'), { date: date });
            },
            pushToEvents(){
                var arr = [];
                this.eventsData.forEach(element => {
                    this.calendarOptions.events.push({ 'title': JSON.stringify({ 'crop': element.crop.name, 'pool_no': element.pool_no, 'consolidated_qty' : element.consolidated_qty, 'consolidated_amount' : element.consolidated_amount }), 'date' : element.date });
                });
            }
        },
        mounted() {
            console.log('mounted Inventory');
        },
        created: function(){
            console.log('created Inventory');
            this.pushToEvents();
            console.log(this.yawa);       
        }
    }
</script>