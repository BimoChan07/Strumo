const select = document.getElementById("select");
select.onchange = function() {
    if (select.value === 'khalti') {
        document.getElementById("purchase").style.backgroundColor = "#5E338D"
        document.getElementById("purchase").innerHTML = "Pay with Khalti"

    }
    if (select.value === "e-sewa") {
        document.getElementById("purchase").style.backgroundColor = "#60BB46"
        document.getElementById("purchase").innerHTML = "Pay with e-sewa"
    }
}

const proceedPayment = () => {
    const pay_mode = document.getElementById("select").value;
    const address = document.getElementById("address").value
    var config = {
        "publicKey": "test_public_key_1059426c6e474dcd8aba71df6f39df8f",
        "productIdentity": "<?php echo $id ?>",
        "productName": "<?php echo $name; ?>",
        "productUrl": "http://localhost/products.php",
        "paymentPreference": [
            "KHALTI",
        ],
        "eventHandler": {
            onSuccess(payload) {
                $.post("./purchase.php", {
                    shipping_address: address,
                    payment_method: pay_mode
                }, result => {
                    if (result === "payment successfull")
                        alert(result);
                    window.location.href = "../index.php";
                })
                console.log(payload)
            },
            onError(error) {
                console.log(error);
            },
            onClose() {
                console.log('widget is closing');
            }
        }
    };

    var checkout = new KhaltiCheckout(config);
    var btn = document.getElementById("purchase");
    btn.onclick = function(event) {
        event.preventDefault();
        checkout.show({
            amount: <?php echo $gtotal; ?>
        });
    }
}