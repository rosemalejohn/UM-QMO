<template>
	<div class="page-header md-shadow-z-1-i navbar navbar-fixed-top">
        <div class="page-header-inner container">
            <div class="page-logo">
                <a href="#/"></a>
                <div class="menu-toggler sidebar-toggler"></div>
            </div>
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"></a>

            <div class="page-top">
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img alt="" class="img-circle" :src="authUser.photo_url || '/img/default-photo.jpg'" />
                                <span class="username username-hide-on-mobile">{{ authUser.name }} </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a @click="viewProfile()">
                                        <i class="icon-user"></i> My Profile 
                                    </a>
                                </li>
                                <li>
                                    <a href="#/change-password">
                                        <i class="icon-settings"></i> Change password
                                    </a>
                                </li>
                                <li class="divider">
                                </li>
                                <li>
                                    <a @click="logout()" href="#">
                                        <i class="icon-key"></i> Log Out
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import swal from 'sweetalert'
    import User from './../api/user'

    export default {

        created() {
            User.GetAuthenticatedUser().then(response => {
                this.authUser = response.data;
                cookie.set('auth_user_id', response.data.id);
            })
        },

        data() {
            return {
                authUser: {}
            }
        },

        methods: {
            logout() {
                swal({   
                    title: "Are you sure?",   
                    text: "You will be logged out of the system!",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes, Log out!",   
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true 
                }, () => {
                    User.Logout().then(response => {
                        window.location.reload()
                    }).catch(err => {
                        window.location.reload()
                    })
                });
            },

            viewProfile() {
                router.push({ name: 'Profile', params: { userId: this.authUser.id } });
            }
        }

    }
</script>