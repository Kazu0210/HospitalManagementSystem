document.addEventListener("DOMContentLoaded", function() {
    let params = new URLSearchParams(window.location.search);
    let paymentDetails = "";
    params.forEach((value, key) => {
        paymentDetails += `<p><strong>${key.replace("-", " ")}:</strong> ${value}</p>`;
    });
    document.getElementById("selected-method").innerHTML = paymentDetails || "No payment method selected.";
});