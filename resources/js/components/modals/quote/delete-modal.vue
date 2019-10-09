<template>
    <div>
        <!-- Modal -->
        <div v-if="showModal" class="custom-modal">
            <!-- Modal content -->
            <div class="custom-modal-content">
                <div class="custom-modal-header pb-3">
                    <span class="close" @click="close">&times;</span>
                    <h3>Delete quote</h3>
                </div>
                <div class="custom-modal-body text-center py-3 font-16">
                    <p>Are you sure you want to delete this quote?</p>
                </div>
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
                this.quoteData = data;
                this.showModal = true;
            },
            /**
             * Close modal function
             */
            close() {
                this.showModal = false;
            },
            /**
             * Submit, close modal and emit next function
             */
            submit() {
                axios.delete('/admin/quotes/' + this.quoteData.id).then((response) => {
                    this.$emit('updated', true);
                    this.showModal = false;
                });
            },
        }
    }
</script>
