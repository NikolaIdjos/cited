<template>
    <div>
        <!-- Modal -->
        <div v-if="showModal" class="custom-modal">
            <!-- Modal content -->
            <div class="custom-modal-content">
                <!-- Modal header -->
                <div class="custom-modal-header pb-3">
                    <span class="close" @click="close">&times;</span>
                    <h3>{{translate('quotes-page.updateQuote')}}</h3>
                </div>
                <form v-on:submit.prevent="submit">
                    <!-- Modal body -->
                    <div class="custom-modal-body py-3">
                        <div class="form-group">
                            <textarea v-model="quoteData.description" class="form-control" :placeholder="translate('general.quote')" rows="5" required>{{quoteData.description}}</textarea>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="custom-modal-footer text-right pt-3">
                        <button type="button" class="btn btn-secondary" @click="close">{{translate('general.close')}}</button>
                        <button type="submit" class="btn btn-green">{{translate('general.update')}}</button>
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
                quoteData: {},
            }
        },
        methods: {
            /**
             * Open modal function
             */
            open(data) {
                // Get data
                this.quoteData = Object.assign({}, data);
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
                axios.put('/admin/quotes/' + this.quoteData.id, this.quoteData).then((response) => {
                    // Emit updates
                    this.$emit('updated', true);
                    // Close modal
                    this.showModal = false;
                }).catch((error) => {
                    // Close modal
                    this.showModal = false;
                });
            },
        }
    }
</script>
