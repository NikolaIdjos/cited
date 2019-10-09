<template>
    <div>
        <!-- Modal -->
        <div v-if="showModal" class="custom-modal">
            <!-- Modal content -->
            <div class="custom-modal-content">
                <!-- Modal header -->
                <div class="custom-modal-header pb-3">
                    <span class="close" @click="close">&times;</span>
                    <h3>Delete quote</h3>
                </div>
                <!-- Modal body -->
                <div class="custom-modal-body text-center py-3 font-16">
                    <p>Are you sure you want to delete this quote?</p>
                </div>
                <!-- Modal footer -->
                <div class="custom-modal-footer text-right pt-3">
                    <form v-on:submit.prevent="submit">
                        <button type="button" class="btn btn-secondary" @click="close">Close</button>
                        <button type="submit" class="btn btn-green">Delete quote</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                showModal: false,
                quoteData: [],
            }
        },
        methods: {
            /**
             * Open modal function
             */
            open(data) {
                // Get data
                this.quoteData = data;
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
             * Submit, close modal and emit next function
             */
            submit() {
                // Send request
                axios.delete('/admin/quotes/' + this.quoteData.id).then((response) => {
                    // Emit updates
                    this.$emit('updated', true);
                    // Close modal
                    this.showModal = false;
                });
            },
        }
    }
</script>
