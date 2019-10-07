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
                <div class="custom-modal-body py-3">
                    <form>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Quote" rows="5" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="custom-modal-footer text-right pt-3">
                    <button type="button" class="btn btn-secondary" @click="close">Close</button>
                    <button type="button" class="btn btn-green" @click="submit">Save quote</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                showModal: false
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
             * Close modal and emit next function
             */
            submit() {
                this.showModal = false;
            },
        }
    }
</script>
