document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("ticketBtn").addEventListener("click", function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Get current ticket quantities for the database
        const normalPrice = parseFloat(document.getElementById("normalPrice").textContent.replace(' DH', ''));
        const specialPrice = parseFloat(document.getElementById("specialPrice").textContent.replace(' DH', ''));
        
        const normalCount = Math.round(normalPrice / originalPrices.normal);
        const specialCount = Math.round(specialPrice / originalPrices.special);
        
        // Check if at least one ticket is selected
        if (normalCount === 0 && specialCount === 0) {
            alert("Please increase the ticket count first.");
            return;
        }

        // Create form data to send
        const formData = new FormData();
        formData.append('ticketBtn', 'true');
        formData.append('normal_tarif_quantity', normalCount);
        formData.append('special_tarif_quantity', specialCount);
        
        // Get the current event_id from the URL
        const urlParams = new URLSearchParams(window.location.search);
        const eventId = urlParams.get('event_id');
        
        // Send the data via AJAX
        fetch(`ticketcart.php?event_id=${eventId}`, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                // After successful database insertion, generate the PDF
                generateTicketPDF();
            } else {
                alert("There was an error saving your reservation. Please try again.");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("There was an error processing your request. Please try again.");
        });
    });

    function generateTicketPDF() {
        // This is your existing PDF generation code from pdfcart.js
        const normalPriceNow = parseFloat(document.getElementById("normalPrice").textContent.replace(' DH', ''));
        const specialPriceNow = parseFloat(document.getElementById("specialPrice").textContent.replace(' DH', ''));

        const unitNormal = originalPrices.normal;
        const unitSpecial = originalPrices.special;

        const container = document.getElementById("ticketContainer");
        container.innerHTML = "";

        const event = {
            name: document.getElementById("eventName").textContent.trim(),
            date: document.getElementById("eventDate").textContent.trim(),
            location: document.getElementById("eventLocation").textContent.trim(),
        };

        let totalTickets = 0;

        if (normalPriceNow > 0) {
            const normalCount = Math.round(normalPriceNow / unitNormal);
            totalTickets += normalCount;

            for (let i = 1; i <= normalCount; i++) {
                const code = "TKT-" + Math.floor(100000 + Math.random() * 900000);
                const ticket = document.createElement("div");
                ticket.classList.add("ticket");
                ticket.innerHTML = `
                    <p><strong>Event:</strong> ${event.name}</p>
                    <p><strong>Date:</strong> ${event.date}</p>
                    <p><strong>Location:</strong> ${event.location}</p>
                    <p><strong>Type:</strong> Normal</p>
                    <p><strong>Price:</strong> ${unitNormal.toFixed(2)} DH</p>
                    <p><strong>Code:</strong> <span style="color: #d30733;">${code}</span></p>
                `;
                container.appendChild(ticket);
            }
        }

        if (specialPriceNow > 0) {
            const specialCount = Math.round(specialPriceNow / unitSpecial);
            totalTickets += specialCount;

            for (let i = 1; i <= specialCount; i++) {
                const code = "TKT-" + Math.floor(100000 + Math.random() * 900000);
                const ticket = document.createElement("div");
                ticket.classList.add("ticket");
                ticket.innerHTML = `
                    <p><strong>Event:</strong> ${event.name}</p>
                    <p><strong>Date:</strong> ${event.date}</p>
                    <p><strong>Location:</strong> ${event.location}</p>
                    <p><strong>Type:</strong> Special</p>
                    <p><strong>Price:</strong> ${unitSpecial.toFixed(2)} DH</p>
                    <p><strong>Code:</strong> <span style="color: #d30733;">${code}</span></p>
                `;
                container.appendChild(ticket);
            }
        }
        

        container.style.display = "block";

        html2pdf().set({
            margin: 0.5,
            filename: 'tickets.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
        }).from(container).save().then(() => {
            container.style.display = "none";
            // If you have the generateInvoicePDF function, uncomment this line
            // generateInvoicePDF(normalPriceNow, specialPriceNow, unitNormal, unitSpecial, event);
            
            
        });
    }
});