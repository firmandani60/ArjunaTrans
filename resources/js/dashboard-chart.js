import Chart from "chart.js/auto"; // Tambahkan baris ini untuk memanggil Chart.js

document.addEventListener("DOMContentLoaded", function () {
    if (typeof Chart === "undefined") return;

    const data = window.arjunaDashboardData || {};

    const fleetCanvas = document.getElementById("fleetCategoryChart");
    if (fleetCanvas) {
        new Chart(fleetCanvas.getContext("2d"), {
            type: "bar",
            data: {
                labels: data.fleetLabels || [],
                datasets: [
                    {
                        label: "Jumlah Unit",
                        data: data.fleetValues || [],
                        backgroundColor: "#f97316",
                        borderRadius: 10,
                        maxBarThickness: 56,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 },
                        grid: { color: "rgba(148,163,184,.15)" },
                    },
                    x: { grid: { display: false } },
                },
            },
        });
    }

    const statusCanvas = document.getElementById("contentStatusChart");
    if (statusCanvas) {
        new Chart(statusCanvas.getContext("2d"), {
            type: "doughnut",
            data: {
                labels: ["Aktif", "Draft"],
                datasets: [
                    {
                        data: data.contentStatus || [0, 0],
                        backgroundColor: ["#10b981", "#cbd5e1"],
                        borderWidth: 0,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: "68%",
                plugins: {
                    legend: {
                        position: "bottom",
                        labels: { usePointStyle: true, padding: 16 },
                    },
                },
            },
        });
    }
});
