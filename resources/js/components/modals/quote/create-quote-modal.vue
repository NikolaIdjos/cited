<template>
    <div>
        <!-- Modal -->
        <div v-if="showModal" class="custom-modal">
            <!-- Modal content -->
            <div class="custom-modal-content">
                <div class="custom-modal-header pb-3">
                    <span class="close" @click="close">&times;</span>
                    <h3>Create quote</h3>
                </div>
                <form v-on:submit.prevent="submit">
                    <div class="custom-modal-body py-3">
                        <div class="form-group">
                            <textarea v-model="quoteData.description" class="form-control" placeholder="Quote" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="custom-modal-footer text-right pt-3">
                        <button type="button" class="btn btn-secondary" @click="close">Close</button>
                        <button type="submit" class="btn btn-green">Save quote</button>
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
                this.showModal = true;
            },
            /**
             * Close modal function
             */
            close() {
                this.showModal = false;
            },
            /**
             * Submit, close modal and emit updates
             */
            submit() {
                axios.post('/admin/quotes', this.quoteData).then((response) => {
                    this.$emit('updated', true);
                    this.showModal = false;
                    this.quoteData = {};
                });
            },
        }
    }
</script>
