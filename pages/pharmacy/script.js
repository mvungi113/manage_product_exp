function domReady(fn) {
    if (
        document.readyState === "complete" ||
        document.readyState === "interactive"
    ) {
        setTimeout(fn, 1000);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}

domReady(function () {

    function onScanSuccess(decodedText, decodedResult) {
        if (!decodedText) {
            alert("Error: No QR code data detected.");
            return;
        }

        const qrData = parseQRCodeData(decodedText);

        if (!qrData) {
            alert("Error: Invalid QR code data format.");
            return;
        }

        // Sending QR code data to PHP script
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "insert.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    alert(xhr.responseText); // Response from PHP script
                } else {
                    alert('Error: ' + xhr.status);
                }
            }
        };
        var data = "companyName=" + encodeURIComponent(qrData.companyName) +
                   "&productName=" + encodeURIComponent(qrData.productName) +
                   "&manufactureDate=" + encodeURIComponent(qrData.manufactureDate) +
                   "&expireDate=" + encodeURIComponent(qrData.expireDate);
        xhr.send(data);
    }

    function parseQRCodeData(decodedText) {
        const lines = decodedText.split('\n');

        if (lines.length !== 4) {
            return null; // Invalid data format
        }

        const companyName = lines[0].replace('Company Name: ', '');
        const productName = lines[1].replace('Product Name: ', '');
        const manufactureDate = lines[2].replace('Manufacture Date: ', '');
        const expireDate = lines[3].replace('Expire Date: ', '');

        return {
            companyName: companyName.trim(),
            productName: productName.trim(),
            manufactureDate: manufactureDate.trim(),
            expireDate: expireDate.trim()
        };
    }

    let htmlscanner = new Html5QrcodeScanner(
        "my-qr-reader",
        { fps: 10, qrbox: 250 }
    );
    htmlscanner.render(onScanSuccess);
});
