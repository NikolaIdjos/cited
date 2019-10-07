<template>
    <div>
        <!-- Modal -->
        <div v-if="showModal" class="custom-modal">
            <!-- Modal content -->
            <div class="custom-modal-content">
                <div class="custom-modal-header pb-3">
                    <span class="close" @click="close">&times;</span>
                    <h3>Update quote</h3>
                </div>
                <form v-on:submit.prevent="submit">
                    <div class="custom-modal-body py-3">
                        <div class="form-group">
                            <textarea v-model="quoteData.description" class="form-control" placeholder="Quote" rows="5" required>{{quoteData.description}}</textarea>
                        </div>
                    </div>
                    <div class="custom-modal-footer text-right pt-3">
                        <button type="button" class="btn btn-secondary" @click="close">Close</button>
                        <button type="submit" class="btn btn-green">Update changes</button>
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
                this.quoteData = Object.assign({}, data);
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
                axios.put('/admin/quotes/' + this.quoteData.id, this.quoteData).then((response) => {
                    this.$emit('updated', true);
                    this.showModal = false;
                });
            },
        }
    }
</script>
