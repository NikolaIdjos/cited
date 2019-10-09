<template>
    <div>
        <div class="container-fluid">
            <div class="row d-flex align-items-center">
                <!-- Right side with form -->
                <div class="col-6">
                    <div class="w-50 text-center m-auto">
                        <div class="logo mb-5">
                            <i class="fas fa-quote-right"></i>
                        </div>
                        <h1 class="green-font font-weight-bold">Cited App</h1>
                        <p class="grey-font mt-5">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                            when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                            It has survived not only five centuries, but also the leap into electronic typesetting,
                            remaining essentially unchanged.
                            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                            and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                        </p>
                        <form v-on:submit.prevent="submit">
                            <div class="custom-group-input input-group input-group-lg mt-5">
                                <input v-model="subscriberData.email" type="email" class="form-control" placeholder="Your email" required>
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text green-bg cursor-pointer white-color">Subscribe</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Left side with image -->
                <div class="col-6">
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
                    if (this.subscriberData.status == window.constants.UNPAID_STATUS) {
                        // If user is unpaid
                        this.$refs.paymentModal.open(response.data.entity);
                    } else if (this.subscriberData.status == window.constants.ACTIVE_STATUS){
                        // If user is active
                        this.$refs.changeStatusModal.open(response.data.entity);
                    } else if (this.subscriberData.status == window.constants.INACTIVE_STATUS){
                        // If user is inactive
                        this.$refs.changeStatusModal.open(response.data.entity);
                    } else {
                        // If user does not exist
                        this.$refs.paymentModal.open(response.data.entity);
                    }
                });
            },
        }
    }
</script>
