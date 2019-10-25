<template>
    <div>
        <!-- Modal -->
        <div v-if="showModal" class="custom-modal">
            <!-- Modal content -->
            <div class="custom-modal-content">
                <!-- Modal header -->
                <div class="custom-modal-header pb-3">
                    <span class="close" @click="close">&times;</span>
                    <h3>{{translate('quotes-page.createQuote')}}</h3>
                </div>
                <form v-on:submit.prevent="submit">
                    <!-- Modal body -->
                    <div class="custom-modal-body py-3">
                        <div class="form-group">
                            <textarea v-model="quoteData.description" class="form-control" :placeholder="translate('general.quote')" rows="5" required></textarea>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="custom-modal-footer text-right pt-3">
                        <button type="button" class="btn btn-secondary" @click="close">{{translate('general.close')}}</button>
                        <button type="submit" class="btn btn-green">{{translate('general.save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                showModal: false,
                quoteData: {}
            }
        },
        methods: {
            /**
             * Open modal function
             */
            open() {
                // Open modal
                this.showModal = true;
            },
            /**
             * Close modal function
             */
            close() {
                // Close modal
                this.showModal = false;
            },
            /**
             * Submit, close modal and emit updates
             */
            submit() {
                // Send request
                axios.post(this.$constants.ADMIN_ROUTE_PREFIX + this.$constants.QUOTES_ROUTE, this.quoteData).then((response) => {
                    // Emit updates
                    this.$emit('updated', true);
                    // Close modal
                    this.showModal = false;
                    // Clear data
                    this.quoteData = {};
                }).catch((error) => {
                    // Close modal
                    this.showModal = false;
                    // Clear data
                    this.quoteData = {};
                });
            },
        }
    }
</script>
