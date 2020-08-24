<template>
    <div id="root-header-notification-element">
        <a href="#" data-toggle="dropdown" class="dropdown-toggle f-s-14">
            <i class="fa fa-bell"></i>
            <span class="label" v-if="countUnreadNotifications > 0">{{ countUnreadNotifications }}</span>
        </a>
        <ul class="dropdown-menu media-list dropdown-menu-right">
            <li class="dropdown-header">
                {{ this.$root.trans('NOTIFICATIONS') }} ({{ countUnreadNotifications }})
            </li>

            <li class="media" v-for="row in notificationsItems">
                <a href="javascript:;">
                    <div class="media-left">
                        <i class="fa fa-bug media-object bg-silver-darker"></i>
                    </div>
                    <div class="media-body">
                        <h6 class="media-heading">{{ row.data.title}}</h6>
                        <p>{{ row.data.message }}</p>
                        <div class="text-muted f-s-11">
                            {{ row.data.beforeDateTime }}
                        </div>
                    </div>
                </a>
            </li>

            <li class="dropdown-footer text-center" v-if="countUnreadNotifications > 0">
                <a href="/dashboard/notifications">{{ this.$root.trans('View more') }}</a>
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
                axios.get('/user/notifications').then(response => {
                    this.countUnreadNotifications = response.data.countUnreadNotifications;
                    this.notificationsItems = response.data.notifications;
                });
            }
        }
    }
</script>