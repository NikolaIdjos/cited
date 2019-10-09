<template>
    <div>
        <div class="container">
            <div class="text-center my-5">
                <h1 class="font-weight-bold green-font">Users</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card-shadow card">
                        <div class="card-header text-center font-weight-bold py-4">
                            <ul class="nav nav-pills custom-pills d-flex justify-content-center" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-subscribers-tab" data-toggle="pill" href="#pills-subscribers" role="tab" aria-controls="pills-subscribers" aria-selected="true">Subscribers</a>
                                </li>
                                <li class="nav-item">
                                    <a @click="getUsers" class="nav-link" id="pills-admins-tab" data-toggle="pill" href="#pills-admins" role="tab" aria-controls="pills-admins" aria-selected="false">Admins</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="pills-tabContent">
                            <!--Subscribers pill-->
                            <div class="tab-pane fade show active" id="pills-subscribers" role="tabpanel" aria-labelledby="pills-subscribers-tab">
                                <div class="pt-4 px-4">
                                    <div class="row d-flex justify-content-center">
                                            <div class="input-group col-12 col-md-4">
                                                <input type="text" v-model="searchKeyword" class="form-control input-lg" placeholder="Search"/>
                                            </div>
                                            <div class="form-group col-12 col-md-4">
                                                <select @change="$refs.customPagination.fetchData(1, searchKeyword, filters)" class="form-control" v-model="filters.status">
                                                    <option :value="null" disabled selected hidden>Status</option>
                                                    <option value="ACTIVE">ACTIVE</option>
                                                    <option value="INACTIVE">INACTIVE</option>
                                                    <option value="UNPAID">UNPAID</option>
                                                </select>
                                            </div>
                                    </div>
                                </div>
                                <div class="card-body pb-4 px-4">
                                    <div id="table">
                                        <table class="table table-bordered table-responsive-md table-striped text-center">
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center">EMAIL</th>
                                                <th class="text-center">STATUS</th>
                                            </tr>
                                            <tr v-for="subscriber in subscribersData">
                                                <td class="pt-3-half">{{subscriber.id}}</td>
                                                <td class="pt-3-half">{{subscriber.email}}</td>
                                                <td class="pt-3-half">
                                                    <h4>
                                                        <span v-if="subscriber.status == 'UNPAID'" class="badge badge-secondary">{{subscriber.status}}</span>
                                                        <span v-else-if="subscriber.status == 'ACTIVE'" class="badge badge-success cursor-pointer" @click="updateStatus(subscriber)">{{subscriber.status}}</span>
                                                        <span v-else class="badge badge-danger cursor-pointer" @click="updateStatus(subscriber)">{{subscriber.status}}</span>
                                                    </h4>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <custom-pagination ref="customPagination" data-url="/admin/index/subscribers" v-on:pagination="pageChanged($event)" :filters-prop="filters" :search-keyword="searchKeyword"></custom-pagination>
                                <change-subscriber-status ref="changeSubscriberStatusModal" v-on:updated="updateData()"></change-subscriber-status>
                            </div>
                            <!--Admins pill-->
                            <div class="tab-pane fade" id="pills-admins" role="tabpanel" aria-labelledby="pills-admins-tab">
                                <div class="card-body pb-4 px-4">
                                    <div>
                                        <table class="table table-bordered table-responsive-md table-striped text-center">
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center">NAME</th>
                                                <th class="text-center">EMAIL</th>
                                            </tr>
                                            <tr v-for="user in usersData">
                                                <td class="pt-3-half">{{user.id}}</td>
                                                <td class="pt-3-half">{{user.name}}</td>
                                                <td class="pt-3-half">{{user.email}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                subscribersData: [],
                usersData: [],
                searchKeyword: '',
                filters: {
                    status: null,
                },
            }
        },
        methods: {
            /**
             * Get users
             */
            getUsers() {
                axios.get('/admin/index/users').then((response) => {
                    this.usersData = response.data.entity;
                });
            },
            /**
             * On page changed
             */
            pageChanged(data) {
                this.subscribersData = data.data;
            },
            /**
             * Update subscriber status
             */
            updateStatus(data) {
                this.$refs.changeSubscriberStatusModal.open(data);
            },
            /**
             * Update quotes data
             */
            updateData() {
                this.$refs.customPagination.fetchData();
            },
        }
    }
</script>
