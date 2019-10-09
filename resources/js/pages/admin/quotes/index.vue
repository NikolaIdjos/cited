<template>
    <div>
        <div class="container">
            <!-- Title -->
            <div class="text-center my-5">
                <h1 class="font-weight-bold green-font">Quotes</h1>
            </div>
            <!-- Search -->
            <div class="row mb-5">
                <div class="input-group col-7 col-md-5 col-lg-4">
                    <input type="text" v-model="searchKeyword" class="form-control input-lg" placeholder="Search"/>
                </div>
                <div class="input-group col-5 col-md-3 col-lg-2 ml-auto">
                    <button @click="$refs.createQuoteModal.open($event)" type="button" class="btn btn-green ml-auto">Create quote</button>
                </div>
            </div>
            <!-- Cards -->
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3 mb-4" v-for="quote in quotesData">
                    <div class="custom-card card-shadow card">
                        <div class="card-body d-flex align-items-start flex-column">
                            <h6 class="card-subtitle mb-2 green-font font-weight-bold">{{quote.created_at | moment('DD.MM.YYYY')}}</h6>
                            <a href="javascript:void(0)" class="card-text a-green" @click="showQuote(quote)">
                                {{quote.description.length > 100 ? quote.description.substring(0, 100) + '...' : quote.description}}
                            </a>
                            <div class="mt-auto ml-auto">
                                <a href="javascript:void(0)" class="card-link text-success" @click="updateQuote(quote)">Update</a>
                                <a href="javascript:void(0)" class="card-link text-danger" @click="deleteQuote(quote)">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Components-->
            <custom-pagination ref="customPagination" data-url="/admin/index/quotes" v-on:pagination="pageChanged($event)" :search-keyword="searchKeyword"></custom-pagination>
            <create-quote-modal v-on:openCreateQuoteModal="$refs.createQuoteModal.open($event)" ref="createQuoteModal" v-on:updated="updateData()"></create-quote-modal>
            <update-quote-modal ref="updateQuoteModal" v-on:updated="updateData()"></update-quote-modal>
            <delete-modal ref="deleteQuoteModal" v-on:updated="updateData()"></delete-modal>
            <show-quote-modal ref="showQuoteModal" v-on:updated="updateData()"></show-quote-modal>
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
            /**
             * Update quote
             */
            updateQuote(data) {
                // Open modal
                this.$refs.updateQuoteModal.open(data);
            },
            /**
             * Delete quote
             */
            deleteQuote(data) {
                // Open modal
                this.$refs.deleteQuoteModal.open(data);
            },
            /**
             * Show quote
             */
            showQuote(data) {
                // Open modal
                this.$refs.showQuoteModal.open(data);
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
