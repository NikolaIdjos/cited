<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card mt-5">
                        <h3 class="card-header text-center font-weight-bold py-4">Users</h3>
                        <div class="pt-4 px-4">
                            <div class="row">
                                <div class="input-group col-12 col-md-4">
                                    <input type="text" class="form-control input-lg" placeholder="Search" />
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">@example.com</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pb-4 px-4">
                            <div id="table">
                                <table class="table table-bordered table-responsive-md table-striped text-center">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">EMAIL</th>
                                        <th class="text-center">STATUS</th>
                                        <th class="text-center">BAN</th>
                                    </tr>
                                    <tr>
                                        <td class="pt-3-half">1</td>
                                        <td class="pt-3-half">email@demo.com</td>
                                        <td class="pt-3-half">active</td>
                                        <td class="pt-3-half">dugme</td>
                                    </tr>
                                </table>
                            </div>
<!--                            <admin-pagination class="mt-4 pagination-pos" ref="adminPagination" data-url="/admin/api/users" v-on:pagination="pageChanged($event)" :search-keyword="searchKeyword"></admin-pagination>-->
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
                //
            }
        },
        methods: {
            //
        }
    }
</script>
