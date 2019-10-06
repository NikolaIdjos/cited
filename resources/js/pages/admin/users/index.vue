<template>
    <div>
        <div class="container">
            <div class="text-center my-5">
                <h1 class="font-weight-bold green-font">Users</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header text-center font-weight-bold py-4">
                            <ul class="nav nav-pills custom-pills d-flex justify-content-center" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-subscribers-tab" data-toggle="pill" href="#pills-subscribers" role="tab" aria-controls="pills-subscribers" aria-selected="true">Subscribers</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-admins-tab" data-toggle="pill" href="#pills-admins" role="tab" aria-controls="pills-admins" aria-selected="false">Admins</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-subscribers" role="tabpanel" aria-labelledby="pills-subscribers-tab">
                                <div class="pt-4 px-4">
                                    <div class="row d-flex justify-content-center">
                                        <div class="input-group col-12 col-md-4">
                                            <input type="text" class="form-control input-lg" placeholder="Search"/>
                                        </div>
                                        <div class="form-group col-12 col-md-4">
                                            <select class="form-control">
                                                <option>1</option>
                                            </select>
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
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-admins" role="tabpanel" aria-labelledby="pills-admins-tab">
                                <div class="card-body pb-4 px-4">
                                    <div>
                                        <table class="table table-bordered table-responsive-md table-striped text-center">
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">NAME</th>
                                                <th class="text-center">EMAIL</th>
                                            </tr>
                                            <tr>
                                                <td class="pt-3-half">1</td>
                                                <td class="pt-3-half">Test</td>
                                                <td class="pt-3-half">email@demo.com</td>
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
                //
            }
        },
        methods: {
            //
        }
    }
</script>
