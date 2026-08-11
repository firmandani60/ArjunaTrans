document.addEventListener('DOMContentLoaded', function() {
    const ctxLine = document.getElementById('armadaLineChart');
    if (ctxLine) {
        new Chart(ctxLine.getContext('2d'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Tersewa',
                    data: [8, 10, 12, 15, 18, 20],
                    borderColor: '#f97316',
                    backgroundColor: 'rgba(249, 115, 22, 0.05)',
                    fill: true,
                    tension: 0.3,
                    pointBackgroundColor: '#f97316',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                }, {
                    label: 'Tersedia',
                    data: [16, 14, 12, 9, 6, 4],
                    borderColor: '#94a3b8',
                    backgroundColor: 'rgba(148, 163, 184, 0.05)',
                    fill: true,
                    tension: 0.3,
                    pointBackgroundColor: '#94a3b8',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 20,
                            font: { size: 12, weight: 'bold' }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.04)' },
                        ticks: { stepSize: 5 }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    }

    const ctxBus = document.getElementById('busDonutChart');
    if (ctxBus) {
        new Chart(ctxBus.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Tersewa', 'Tersedia'],
                datasets: [{
                    data: [8, 4],
                    backgroundColor: ['#10b981', '#cbd5e1'],
                    borderWidth: 0,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: { legend: { display: false } }
            }
        });
    }

    const ctxElf = document.getElementById('elfDonutChart');
    if (ctxElf) {
        new Chart(ctxElf.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Tersewa', 'Tersedia'],
                datasets: [{
                    data: [5, 3],
                    backgroundColor: ['#10b981', '#cbd5e1'],
                    borderWidth: 0,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: { legend: { display: false } }
            }
        });
    }

    const ctxHiace = document.getElementById('hiaceDonutChart');
    if (ctxHiace) {
        new Chart(ctxHiace.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Tersewa', 'Tersedia'],
                datasets: [{
                    data: [2, 4],
                    backgroundColor: ['#10b981', '#cbd5e1'],
                    borderWidth: 0,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: { legend: { display: false } }
            }
        });
    }

    const ctxDest = document.getElementById('destinasiDoughnutChart');
    if (ctxDest) {
        new Chart(ctxDest.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Pantai', 'Ziarah', 'Taman'],
                datasets: [{
                    data: [70, 20, 10],
                    backgroundColor: ['#3b82f6', '#f59e0b', '#10b981'],
                    borderWidth: 0,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: { legend: { display: false } }
            }
        });
    }
});