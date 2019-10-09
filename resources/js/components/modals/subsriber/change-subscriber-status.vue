<template>
    <div>
        <!-- Modal -->
        <div v-if="showModal" class="custom-modal">
            <!-- Modal content -->
            <div class="custom-modal-content">
                <div class="custom-modal-header pb-3">
                    <span class="close" @click="close">&times;</span>
                    <h5>{{subscriberData.email}}</h5>
                </div>
                <div class="custom-modal-body text-center py-3 font-16">
                    <p>Are you sure you want to change status to this subscriber?</p>
                </div>
                <div class="custom-modal-footer text-right pt-3">
                    <form v-on:submit.prevent="submit">
                        <button type="button" class="btn btn-secondary" @click="close">Close</button>
                        <button type="submit" class="btn btn-green">Change status</button>
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
                subscriberData: [],
            }
        },
        methods: {
            /**
             * Open modal function
             */
            open(data) {
                this.subscriberData = data;
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
                if (this.subscriberData.status == window.constants.ACTIVE_STATUS) {
                    this.subscriberData.status = window.constants.INACTIVE_STATUS
                } else {
                    this.subscriberData.status = window.constants.ACTIVE_STATUS
                }
                axios.put('/admin/subscribers/' + this.subscriberData.id, this.subscriberData).then((response) => {
                    this.$emit('updated', true);
                    this.showModal = false;
                });
            },
        }
    }
</script>
