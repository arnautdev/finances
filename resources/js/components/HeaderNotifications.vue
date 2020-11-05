<template>
    <div class="navbar-nav ml-auto">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" v-if="countUnreadNotifications > 0">
                    <!--                <a class="nav-link" data-toggle="dropdown" href="#">-->
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">{{ countUnreadNotifications }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-header">
                        {{ countUnreadNotifications }} {{ this.$root.trans('Notifications') }}
                    </span>

                    <div v-for="row in notificationsItems">
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> {{ row.data.title }}
                            <span class="float-right text-muted text-sm">{{ row.data.beforeDateTime }}</span>
                        </a>
                    </div>

                    <div class="dropdown-divider"></div>
                    <a href="/dashboard/notifications/all" class="dropdown-item dropdown-footer">
                        {{ this.$root.trans('See All Notifications') }}
                    </a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "HeaderNotifications",
    data: function () {
        return {
            countUnreadNotifications: 0,
            notificationsItems: [],
        }
    },
    mounted() {
        this.fetchNotifications();
        var $that = this;
        // Echo.private('App.User.' + $userId)
        //     .notification(function ($notif) {
        //         $that.fetchNotifications();
        //     });
    },
    methods: {
        fetchNotifications() {
            axios.get('/dashboard/notifications').then(response => {
                this.countUnreadNotifications = response.data.countUnreadNotifications;
                this.notificationsItems = response.data.notifications;
            });
        }
    }
}
</script>
