<html>
<head>
    <title>Html-Qrcode Demo</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('js/html5-qrcode.min.js') }}"></script>
</head>
<body>
    <div id="qr-reader" style="width:500px"></div>
    <div id="qr-reader-results"></div>

    <script>
        function docReady(fn) {
            if (document.readyState === "complete" || document.readyState === "interactive") {
                setTimeout(fn, 1);
            } else {
                document.addEventListener("DOMContentLoaded", fn);
            }
        }

        docReady(function () {
            var resultContainer = document.getElementById('qr-reader-results');
            var lastResult, countResults = 0;

            function onScanSuccess(decodedText, decodedResult) {
                if (decodedText !== lastResult) {
                    ++countResults;
                    lastResult = decodedText;

                    // Kirim data ke backend menggunakan AJAX
                    $.ajax({
                        type: 'POST',
                        url: 'https://tpa.badkokasihan.web.id/admin/events/scan-attendance/' + encodeURIComponent(decodedText),
                        data: {},
                        success: function (response) {
                            alert(response.message);
                        },
                        error: function (error) {
                            alert('Error while processing scan result');
                        }
                    });
                }
            }

            var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", { fps: 10, qrbox: 250 });
            html5QrcodeScanner.render(onScanSuccess);
        });
    </script>
</body>
</html>
