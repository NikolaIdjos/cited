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
                    <p class="font-weight-bold green-font">Pay {{$constants.PRICE_STRING}}&#8364; to use application and
                        receive quotes!</p>
                    <div id="paypal-button-container"></div>
                </div>
                <!-- Modal footer -->
                <div class="custom-modal-footer text-right pt-3">
                    <button type="button" class="btn btn-secondary" @click="close">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                showModal: false,
                constants: this.$constants,
                subscriberData: {},
                paypal: process.env.MIX_PAYPAL_CLIENT_ID,
            }
        },
        mounted() {
            // Create script and load it
            let recaptchaScript = document.createElement('script');
            recaptchaScript.setAttribute('src', 'https://www.paypal.com/sdk/js?client-id=' + this.paypal + '&currency=EUR');
            document.head.appendChild(recaptchaScript);
        },
        methods: {
            /**
             * Render PayPal element
             */
            renderPayPalElement() {
                paypal.Buttons({
                    createOrder: (data, actions) => {
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    value: this.$constants.PRICE,
                                },
                                currency: 'EUR'
                            }]
                        });
                    },
                    onApprove: (data, actions) => {
                        return actions.order.capture().then( (details) => {
                            // Call server to save the transaction
                            // Send request
                            axios.get(this.$constants.STATUS_TO_ACTIVE_ROUTE + this.subscriberData.id).then((response) => {
                                // Close modal
                                this.close();
                                // Toastr
                                window.toastr.success(this.translate('general.'+response.data.message));
                            }).catch((error) => {
                                // Close modal
                                this.close();
                                // Toastr
                                window.toastr.error(this.translate('general.'+response.data.message));
                            });
                        });
                    }
                }).render('#paypal-button-container');
            },
            /**
             * Open modal function
             */
            open(data) {
                // Get data
                this.subscriberData = data;
                // Open modal
                this.showModal = true;
                // Render PayPal element
                this.$nextTick(() => {
                    this.renderPayPalElement();
                });
            },
            /**
             * Close modal function
             */
            close() {
                // Close modal
                this.showModal = false;
            },
        }
    }
</script>
