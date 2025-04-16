document.querySelector(".pdfBTN").addEventListener("click", function () {
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

    // Normal Tickets
    if (normalPriceNow > 0) {
        const normalCount = Math.round(normalPriceNow / unitNormal);
        totalTickets += normalCount;

        for (let i = 1; i <= normalCount; i++) {
            const code = "TKT-" + Math.floor(100000 + Math.random() * 900000);
            const ticket = document.createElement("div");
            ticket.classList.add("ticket");
            ticket.innerHTML = `
                <h2>🎫 Ticket</h2>
                <p><strong> Event:</strong> ${event.name}</p>
                <p><strong> Date:</strong> ${event.date}</p>
                <p><strong> Location:</strong> ${event.location}</p>
                <p><strong> Type:</strong> Normal</p>
                <p><strong> Price:</strong> ${unitNormal.toFixed(2)} DH</p>
                <p><strong> Code:</strong> <span>${code}</span></p>
            `;
            container.appendChild(ticket);
        }
    }

    // Special Tickets
    if (specialPriceNow > 0) {
        const specialCount = Math.round(specialPriceNow / unitSpecial);
        totalTickets += specialCount;

        for (let i = 1; i <= specialCount; i++) {
            const code = "TKT-" + Math.floor(100000 + Math.random() * 900000);
            const ticket = document.createElement("div");
            ticket.classList.add("ticket");
            ticket.innerHTML = `
                <h2>🎫 Ticket</h2>
                <p><strong> Event:</strong> ${event.name}</p>
                <p><strong> Date:</strong> ${event.date}</p>
                <p><strong> Location:</strong> ${event.location}</p>
                <p><strong> Type:</strong> Special</p>
                <p><strong> Price:</strong> ${unitSpecial.toFixed(2)} DH</p>
                <p><strong> Code:</strong> <span>${code}</span></p>
            `;
            container.appendChild(ticket);
        }
    }

    if (totalTickets === 0) {
        alert("Please increase the ticket count first.");
        return;
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
    });
});
