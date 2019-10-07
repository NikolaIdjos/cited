<template>
    <div>
        <!-- Modal -->
        <div v-if="showModal" class="custom-modal">
            <!-- Modal content -->
            <div class="custom-modal-content">
                <div class="custom-modal-header pb-3">
                    <span class="close" @click="close">&times;</span>
                    <h3>Create modal</h3>
                </div>
                <div class="custom-modal-body py-3">
                    <p>Some text in the Modal Body</p>
                    <p>Some other text...</p>
                </div>
                <div class="custom-modal-footer text-right pt-3">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="close">Close</button>
                    <button type="button" class="btn btn-green" @click="submit">Save changes</button>
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
