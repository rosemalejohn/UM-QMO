<template>
	<div class="row">
        <div class="col-sm-8" style="padding-right:2px">
            <div class="portlet light " style="min-height:300px">
                <div class="portlet-title ">
                    <div class="caption">
                        <i class="icon-calendar font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">Calendar</span>
                    </div>
                    <div class="actions" v-if="authUser.is_admin">
                        <a href="javascript:;" class="btn btn-circle btn-primary"
                            v-on:click="addNewEvent()">
                            <i class="fa fa-plus"></i> Add 
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div v-if="showCalendar">
                        <full-calendar :events="events" 
                            default-view="month" 
                            editable="false"
                            selectable="false"
                        ></full-calendar>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4" style="padding-left:2px">
            <!-- BEGIN PORTLET-->
            <div class="portlet light" v-show="!showAddEvents">
                <div class="portlet-title tabbable-line">
                    <div class="caption">
                        <i class="icon-list font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">List</span>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_1_1" data-toggle="tab">
                            Today </a>
                        </li>
                        <li>
                            <a href="#tab_1_2" data-toggle="tab">
                            Upcoming </a>
                        </li>
                        <li>
                            <a href="#tab_1_3" data-toggle="tab">
                            Previous </a>
                        </li>
                    </ul>
                </div>
                <div class="portlet-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1_1">
                            <div class="scroller" style="height: 379px;overflow-y:auto">
                                <h4 class="text-muted text-center" style="margin-top:50px;" v-if="todayEvents.length == 0">NO EVENTS</h4>
                                <ul class="feeds" v-else>
                                    <li v-for="event in todayEvents">
                                        <a href="javascript:;" v-on:click="showEventDetails(event)">
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col2">
                                                    <div class="desc">
                                                        <b class="text-muted">{{event.title}}</b>
                                                        <p class="text-muted" style="margin-top:4px;">
                                                            <small>
                                                                <span class="label" :class="getEventsColor(event.type)">
                                                                    <i class="fa" :class="getEventsIcon(event.type)"></i>
                                                                    {{event.type}}
                                                                </span> 
                                                                <span style="margin-right:10px"></span>
                                                                <i class="fa fa-calendar"></i>
                                                                <span>{{event.from}}</span>
                                                                <span v-if="event.from != event.to"> to {{event.to}}</span>
                                                            </small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_1_2">
                            <div class="scroller" style="height: 379px;overflow-y:auto">
                                <h4 class="text-muted text-center" style="margin-top:50px;" v-if="upcomingEvents.length == 0">NO EVENTS</h4>
                                <ul class="feeds" v-else>
                                    <li v-for="event in upcomingEvents">
                                        <a href="javascript:;" v-on:click="showEventDetails(event)">
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col2">
                                                    <div class="desc">
                                                        <b class="text-muted">{{event.title}}</b>
                                                        <p class="text-muted" style="margin-top:4px;">
                                                            <small>
                                                                <span class="label" :class="getEventsColor(event.type)">
                                                                    <i class="fa" :class="getEventsIcon(event.type)"></i>
                                                                    {{event.type}}
                                                                </span> 
                                                                <span style="margin-right:10px"></span>
                                                                <i class="fa fa-calendar"></i>
                                                                <span>{{event.from}}</span>
                                                                <span v-if="event.from != event.to"> to {{event.to}}</span>
                                                            </small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_1_3">
                            <div class="scroller" style="height: 379px;overflow-y:auto" >
                                <h4 class="text-muted text-center" style="margin-top:50px;" v-if="previousEvents.length == 0">NO EVENTS</h4>
                                <ul class="feeds" v-else>
                                    <li v-for="event in previousEvents">
                                        <a href="javascript:;" v-on:click="showEventDetails(event)">
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col2">
                                                    <div class="desc">
                                                        <b class="text-muted">{{event.title}}</b>
                                                        <p class="text-muted" style="margin-top:4px;">
                                                            <small>
                                                                <span class="label" :class="getEventsColor(event.type)">
                                                                    <i class="fa" :class="getEventsIcon(event.type)"></i>
                                                                    {{event.type}}
                                                                </span> 
                                                                <span style="margin-right:10px"></span>
                                                                <i class="fa fa-calendar"></i>
                                                                <span>{{event.from}}</span>
                                                                <span v-if="event.from != event.to"> to {{event.to}}</span>
                                                            </small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="portlet light" v-show="showAddEvents">
                <div class="portlet-title tabbable-line">
                    <div class="caption">
                        <i class="icon-calendar font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">
                            <span v-if="event.hasOwnProperty('id')">Calendar Event</span>
                            <span v-else>New Calendar Event</span>
                        </span>
                    </div>
                </div>
                <div class="portlet-body">
                    <form @submit.prevent="submit" role="form">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" class="form-control" placeholder="Event Title..." required v-model="event.title" :disabled="canotUpdateEvent(event)">
                        </div>

                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea class="form-control" rows="4" placeholder="Tell me about it..." required v-model="event.body" :disabled="canotUpdateEvent(event)"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="">Date from</label>
                            <input type="date" class="form-control" placeholder="Date start.." required v-model="event.from"
                            :disabled="canotUpdateEvent(event)">
                        </div>

                        <div class="form-group">
                            <label for="">Date to <small class="text-muted">(Optional)</small> </label>
                            <input type="date" class="form-control" placeholder="Date end..." v-model="event.to"
                            :disabled="canotUpdateEvent(event)">
                        </div>

                        <div class="form-group">
                            <label for="">Type</label>
                            <select class="form-control" required="required" v-model="event.type"
                             :disabled="canotUpdateEvent(event)">
                                <option value="activity">Activity</option>
                                <option value="meeting">Meeting</option>
                                <option value="deadline">Deadline</option>
                            </select>
                        </div>
                        <div class="clearfix">
                        <div class="pull-right" v-if="!canotUpdateEvent(event)">
                            <button type="button" class="btn btn-default " v-on:click="showAddEvents = false">Cancel</button>
                            <button type="submit" class="btn btn-primary ">
                                <span v-show="!event.hasOwnProperty('id')"> Submit </span>
                                <span v-show="event.hasOwnProperty('id')"> Update </span>
                            </button>
                        </div>
                        <button type="button" class="btn btn-default pull-right" v-if="!authUser.is_admin || canotUpdateEvent(event)"
                                v-on:click="showAddEvents = false">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="sass">
    .portlet.light {
        padding: 10px;
    }
    .todo-tasklist-item {
        background: #f6fbfc;
        padding: 2px 10px;
        margin-bottom: 5px;
    }
    .todo-tasklist-item-title{
        padding-bottom:0px;
    }
    .feeds li .col1 > .cont {
        margin-right: 0px;
    }
    .feeds li .col1 > .cont > .cont-col2 > .desc {
        margin-left: 10px;
    }
    .fc-today{
        background-color: #fdf770 !important;
        color: #000 !important;
    }
</style>

<script>
    import EventService from './../../api/event'
    import toastr from 'toastr'
	export default {

        name: 'dashboard-calendar',

        mounted() {
            
            this.getEvents();
            this.authUser = JSON.parse(cookie.get('auth'));
            
        },

		data(){
			return {
                event : {title : null,body : null,from : moment().format('YYYY-MM-DD'),to : null,type : 'activity'},
                events: [],
                todayEvents : [],
                upcomingEvents : [],
                previousEvents : [],
                showAddEvents: false,
                showCalendar: false,
                authUser: {}
            }
		},
        
        methods: {
            submit() {
                EventService.Add(this.event).then(response => {
                    this.getEvents();
                })
                .then(()=>{
                    toastr.success('Events saved!')
                    this.event = {title : null,body : null,from : moment().format('YYYY-MM-DD'),to : null,type : 'activity'};
                    this.showAddEvents = false
                })

                .catch(err => {
                    toastr.error('Something wrong with the input!')
                })
            },
            showEventDetails(event){
                this.event = event;
                this.showAddEvents = true;
            },
            addNewEvent(){
                this.event = {title : null,body : null,from : moment().format('YYYY-MM-DD'),to : null,type : 'activity'};
                this.showAddEvents = true;
            },
            getEvents(){
                this.showCalendar = false;
                EventService.getEvents().then(response => {
                    let _events = response.data;
                    this.todayEvents = _events.today;
                    this.upcomingEvents = _events.upcoming;
                    this.previousEvents = _events.previous;
                    let formatedEvents = _events.events.map(_event => {
                        return {
                            title : _event.title,
                            start : _event.from,
                            end : _event.to || null,
                            color : this.getEventsCColor(_event.type)
                        };
                    });
                    this.events = formatedEvents;
                    this.showCalendar = true;
                }).catch(err => {
                    toastr.error("Something wrong! Can't fetch events list")
                });
            },
            getEventsIcon(type){
                if(type == 'activity'){
                    return 'fa-bell-o';
                }else if(type == 'meeting'){
                    return 'fa-bullhorn';
                }else{
                    return 'fa-bolt';
                }
            },
            getEventsColor(type){
                if(type == 'activity'){
                    return 'label-primary';
                }else if(type == 'meeting'){
                    return 'label-warning';
                }else{
                    return 'label-danger';
                }
            },
            getEventsCColor(type){
                if(type == 'activity'){
                    return '#337ab7';
                }else if(type == 'meeting'){
                    return '#ff5722';
                }else{
                    return '#F3565D';
                }
            },
            canotUpdateEvent(event){
                if(!event.hasOwnProperty('id')) return false;

                if(event.user_id == this.authUser.id){
                   return false; 
               } return true;
            }

        }

	}
</script>