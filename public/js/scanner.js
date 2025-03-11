document.addEventListener("DOMContentLoaded", function () {
    const openModalBtn = document.getElementById("openModalBtn");
    const closeModalBtn = document.getElementById("closeModalBtn");
    const qrModal = document.getElementById("qrModal");
    const successPopup = document.getElementById("successPopup");

    let isScanning = false; // Flag untuk mencegah scan berulang
    let html5QrcodeScanner;

    // Menampilkan modal
    openModalBtn.addEventListener("click", function () {  
        qrModal.classList.remove("hidden");
        qrModal.classList.add("flex"); 
        startScanner();
    });

    // Menutup modal
    closeModalBtn.addEventListener("click", function () {  
        qrModal.classList.add("hidden");
        qrModal.classList.remove("flex");
        stopScanner();
    });

    function onScanSuccess(decodedText, decodedResult) {
        if (isScanning) return;
    
        isScanning = true;
    
        console.log(`Code matched = ${decodedText}`, decodedResult);
    
        fetch("/attendance/store", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({
                qr_data: decodedText,
            }),
        })
        .then((response) => response.json())
        .then((data) => {
            if (data.message === "Absen berhasil!") {
                successPopup.classList.remove("hidden");
    
                setTimeout(() => {
                    successPopup.classList.add("hidden");
                }, 3000);
            } else if (data.message === "Peserta tidak terdaftar pada acara!") {
                errorPopup.classList.remove("hidden");
    
                setTimeout(() => {
                    errorPopup.classList.add("hidden");
                }, 3000);
            } else if (data.message === "Peserta sudah absen hari ini!") {
                alreadyPopup.classList.remove("hidden");
    
                setTimeout(() => {
                    alreadyPopup.classList.add("hidden");
                }, 3000);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
        });
    
        setTimeout(() => {
            isScanning = false;
        }, 3000);
    }

    function onScanFailure(error) {
        // console.error('Scan error:', error);
    }

    function startScanner() {
        html5QrcodeScanner = new Html5QrcodeScanner(
            "reader",
            { fps: 10, qrbox: { width: 350, height: 350 } }, // Scanner lebih besar
            false
        );
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    }

    function stopScanner() {
        if (html5QrcodeScanner) {
            html5QrcodeScanner.clear();
        }
    }
});
