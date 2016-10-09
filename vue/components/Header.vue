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
                        <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="icon-bell"></i>
                                <span class="badge badge-default">7 </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="external">
                                    <h3><span class="bold">12 pending</span> notifications</h3>
                                    <a href="">view all</a>
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                        <li>
                                            <a href="javascript:;">
                                                <span class="time">just now</span>
                                                <span class="details">
                                        <span class="label label-sm label-icon label-success">
                                        <i class="fa fa-plus"></i>
                                        </span> New user registered. </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img alt="" class="img-circle" src="/img/default-photo.jpg" />
                                <span class="username username-hide-on-mobile">Nick </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="#/profile">
                                        <i class="icon-user"></i> My Profile 
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

    export default {

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
                    this.$http.post('/logout').then(response => {
                        window.location.reload();
                    }).catch(err => {
                        window.location.reload();
                    });
                });
            }
        }

    }
</script>