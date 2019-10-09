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
                    <p class="green-font">Pay {{constants.PRICE}}&#8364; to use application</p>
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
                subscriberData: {},
                constants: window.constants
            }
        },
        mounted() {
            // Create script and load it
            let recaptchaScript = document.createElement('script');
            recaptchaScript.setAttribute('src', 'https://www.paypal.com/sdk/js?client-id='+window.constants.PAYPAL_CLIENT_ID+'&currency=EUR');
            document.head.appendChild(recaptchaScript);
        },
        methods: {
            /**
             * Render PayPal element
             */
            renderPayPalElement() {
                paypal.Buttons({
                    createOrder: function (data, actions) {
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    value: constants.PRICE,
                                },
                                currency: 'EUR'
                            }]
                        });
                    },
                    onApprove: function (data, actions) {
                        return actions.order.capture().then(function (details) {
                            // Call your server to save the transaction
                            return fetch('/paypal-transaction-complete', {
                                method: 'post',
                                headers: {
                                    'content-type': 'application/json'
                                },
                                body: JSON.stringify({
                                    orderID: data.orderID
                                })
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
