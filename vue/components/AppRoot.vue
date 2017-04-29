<template>
	<div v-if="isAppReady">
        <app-header></app-header>
        <div class="clearfix"></div>
        <div class="container">
            <div class="page-container">
                <app-sidebar></app-sidebar>
                <app-content></app-content>
            </div>
            <app-footer></app-footer>
        </div>   
    </div>
    <div id="app_loading" v-else>
        <div>
            <h1>QUALITY MANAGEMENT SYSTEM</h1>
            <div class="spinner" >
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </div>
    </div>
    
</template>


<script>
    import User from './../api/user'

    export default {

        name: 'app-root',

        mounted() {
            User.GetAuthenticatedUser()
                .then(response => {
                    cookie.set('auth', response.data);
                })
                .then(()=>{
                    setTimeout(()=>{
                        this.isAppReady = true;    
                    },0);
                });
        },

        data() {
            return {
                isAppReady: false
            }
        },

    }
</script>