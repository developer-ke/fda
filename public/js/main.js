const showImage = (input) => {
    const preview = document.getElementById("preview");
    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
};
const Drawers = async () => {
    try {
        const res = await fetch("/json/data", {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
        });
        const output = await res.json();
        if (output.success) {
            // Create an object to store the counts for each document type
            const drawersCount = {};
            // Iterate over the data array
            output.drawers.forEach(item => {
                // Extract the document type
                const documentType = item.documentType;
                // If the document type already exists in the counts object, increment the count
                if (drawersCount[documentType]) {
                    drawersCount[documentType]++;
                } else {
                    // Otherwise, initialize the count to 1
                    drawersCount[documentType] = 1;
                }
            });
            const ctx = document.getElementById('drawersChart');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: Object.keys(drawersCount),
                    datasets: [{
                        label: 'grouped documents',
                        data: Object.values(drawersCount),
                        borderWidth: 1,
                        backgroundColor: [
                            'rgba(255, 26, 104, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(0, 0, 0, 0.2)'
                        ],
                    }],

                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

        }
    } catch (error) {
        alert("error");
        console.log(error);
    }

};

$(document).ready(function () {
    if (document.querySelector('#dashboard')) {
        Drawers();
    }
})


