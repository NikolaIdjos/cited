<template>
    <div>
        <div class="container">
            <div class="text-center my-5">
                <h1 class="font-weight-bold green-font">Quotes</h1>
            </div>
            <div class="row mb-5">
                <div class="input-group col-12 col-md-4">
                    <input type="text" v-model="searchKeyword" class="form-control input-lg" placeholder="Search"/>
                </div>
                <div class="input-group col-12 col-md-2 ml-auto">
                    <button type="button" class="btn btn-green ml-auto">Create quote</button>
                </div>
            </div>
            <div class="row">
                <div class="col-3 mb-4" v-for="quote in quotesData">
                    <div class="custom-card card">
                        <div class="card-body d-flex align-items-start flex-column">
                            <h6 class="card-subtitle mb-2 text-muted">{{quote.created_at | moment('DD.MM.YYYY')}}</h6>
                            <p class="card-text">{{quote.description.length > 100 ? quote.description.substring(0, 100) + '...' : quote.description}}</p>
                            <div class="mt-auto ml-auto">
                                <a href="#" class="card-link text-success">Update</a>
                                <a href="#" class="card-link text-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <custom-pagination ref="customPagination" data-url="/admin/index/quotes" v-on:pagination="pageChanged($event)" :search-keyword="searchKeyword"></custom-pagination>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                searchKeyword: '',
                quotesData: []
            }
        },
        methods: {
            /**
             * On page changed
             */
            pageChanged(data) {
                this.quotesData = data.data;
            },
        }
    }
</script>
