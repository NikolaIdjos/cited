<template>
    <div>
        <div class="container-fluid">
            <div class="row d-flex align-items-center">
                <!-- Right side with form -->
                <div class="col-12 col-md-6 mt-5 mt-md-0">
                    <div class="w-75 text-center m-auto">
                        <div class="logo mb-5">
                            <i class="fas fa-quote-right"></i>
                        </div>
                        <h1 class="green-font font-weight-bold">Cited App</h1>
                        <p class="grey-font mt-5">
                            {{translate('landing-page.landingDesc')}}
                        </p>
                        <form v-on:submit.prevent="submit">
                            <div class="z-index-0 custom-group-input input-group input-group-lg mt-5">
                                <input v-model="subscriberData.email" style="z-index:0" type="email" class="form-control" :placeholder="translate('general.yourEmail')" required>
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text green-bg cursor-pointer white-color">{{translate('general.subscribe')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Left side with image -->
                <div class="col-12 col-md-6">
                    <img class="w-100" :src="'/img/background.jpg'">
                </div>
            </div>
        </div>
        <!-- Components -->
        <change-status-mail ref="changeStatusModal"></change-status-mail>
        <payment-modal ref="paymentModal"></payment-modal>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                subscriberData: {},
            }
        },
        methods: {
            /**
             * Submit and send data
             * Open modal
             */
            submit() {
                // Send request
                axios.post('/subscribers', this.subscriberData).then((response) => {
                    // Get data
                    this.subscriberData = response.data.entity;
                    // Open modal
                    if (this.subscriberData.status == this.$constants.UNPAID_STATUS) {
                        // If user is unpaid
                        this.$refs.paymentModal.open(response.data.entity);
                    } else if (this.subscriberData.status == this.$constants.ACTIVE_STATUS){
                        // If user is active
                        this.$refs.changeStatusModal.open(response.data.entity);
                    } else if (this.subscriberData.status == this.$constants.INACTIVE_STATUS){
                        // If user is inactive
                        this.$refs.changeStatusModal.open(response.data.entity);
                    } else {
                        // If user does not exist
                        this.$refs.paymentModal.open(response.data.entity);
                    }
                    // Empty data
                    this.subscriberData = {};
                });
            },
        }
    }
</script>
