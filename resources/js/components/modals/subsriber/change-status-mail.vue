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
                    <p>You will receive a mail where you can change your status!
                        <br>
                        Your current status is: <b>{{subscriberData.status}}</b>
                    </p>
                </div>
                <div class="custom-modal-footer text-right pt-3">
                    <form v-on:submit.prevent="submit">
                        <button type="button" class="btn btn-secondary" @click="close">Close</button>
                        <button type="submit" class="btn btn-green">Send mail</button>
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
                subscriberData: {},
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
                axios.get('/mail/subscribers/' + this.subscriberData.id).then((response) => {
                    this.$emit('updated', true);
                    this.showModal = false;
                });
            },
        }
    }
</script>
