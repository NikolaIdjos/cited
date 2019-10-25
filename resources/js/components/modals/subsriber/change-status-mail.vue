<template>
    <div>
        <!-- Modal -->
        <div v-if="showModal" class="custom-modal">
            <!-- Modal content -->
            <div class="custom-modal-content">
                <!-- Modal header -->
                <div class="custom-modal-header pb-3">
                    <span class="close" @click="close">&times;</span>
                    <h5>{{subscriberData.email}}</h5>
                </div>
                <!-- Modal body -->
                <div class="custom-modal-body text-center py-3 font-16">
                    <p>{{translate('landing-page.receiveMail')}}
                        <br>
                        {{translate('landing-page.yourStatus')}}<b class="green-font">{{subscriberData.status}}</b>
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="custom-modal-footer text-right pt-3">
                    <form v-on:submit.prevent="submit">
                        <button type="button" class="btn btn-secondary" @click="close">{{translate('general.close')}}</button>
                        <button type="submit" class="btn btn-green">{{translate('landing-page.sendMail')}}</button>
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
                // Get data
                this.subscriberData = data;
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
                axios.get('/mail/subscribers/' + this.subscriberData.id).then((response) => {
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
