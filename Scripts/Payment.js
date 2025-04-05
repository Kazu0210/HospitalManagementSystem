        function showPaymentFields() {
            let selectedMethod = document.querySelector('input[name="payment-method"]:checked');
            let paymentDetails = document.getElementById("payment-details");
            paymentDetails.innerHTML = "";
            if (!selectedMethod) return;
            
            if (selectedMethod.value === "credit-card") {
                paymentDetails.innerHTML = `
                    <label>Card Number:</label>
                    <input type="text" name="card-number" required><br>
                    <label>Expiration Date:</label>
                    <input type="text" name="expiration-date" required><br>
                    <label>CVV:</label>
                    <input type="text" name="cvv" required><br>
                `;
            } else if (selectedMethod.value === "paypal") {
                paymentDetails.innerHTML = `
                    <label>PayPal Email:</label>
                    <input type="email" name="paypal-email" required><br>
                `;
            } else if (selectedMethod.value === "bank-transfer") {
                paymentDetails.innerHTML = `
                    <label>Bank Account Number:</label>
                    <input type="text" name="bank-account" required><br>
                    <label>Bank Name:</label>
                    <input type="text" name="bank-name" required><br>
                `;
            }
        }
        
        function passPaymentMethod() {
            let selectedMethod = document.querySelector('input[name="payment-method"]:checked');
            if (!selectedMethod) {
                alert("Please select a payment method.");
                return false;
            }
            let selectedValue = selectedMethod.value;
            let form = document.querySelector("form");
            form.action = "ClarificationPage.html?payment-method=" + encodeURIComponent(selectedValue);
            return true;
        }