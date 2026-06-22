document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('chart-keuntungan');

    if (!canvas) {
        return;
    }

    if (typeof Chart === 'undefined') {
        console.error('Chart.js belum ter-load.');
        return;
    }

    const apiUrl = '/api/chart-keuntungan-menu-dashboard';

    function parseNumber(value) {
        if (!value) return 0;

        let stringValue = String(value)
            .trim()
            .replace(/\s/g, '')
            .replace(/Rp\.?/gi, '');

        let multiplier = 1;

        if (stringValue.toUpperCase().includes('M')) {
            multiplier = 1000000;
            stringValue = stringValue.replace(/M/gi, '');
        }

        if (stringValue.toUpperCase().includes('K')) {
            multiplier = 1000;
            stringValue = stringValue.replace(/K/gi, '');
        }

        stringValue = stringValue.replace(/,/g, '');

        const numberValue = parseFloat(stringValue);

        return isNaN(numberValue) ? 0 : numberValue * multiplier;
    }

    function safeChartValue(value) {
        return value > 0 ? value : 1;
    }

    const initialKeuntungan = Number(canvas.dataset.keuntungan || 0);

    const chartKeuntungan = new Chart(canvas, {
        type: 'doughnut',
        data: {
            labels: ['Tahun ini', 'Tahun lalu'],
            datasets: [
                {
                    label: 'Keuntungan',
                    data: [
                        safeChartValue(initialKeuntungan),
                        safeChartValue(initialKeuntungan * 0.35),
                    ],
                    backgroundColor: [
                        'rgb(54, 162, 235)',
                        '#F2F5FD',
                    ],
                    borderWidth: 0,
                    hoverOffset: 4,
                    borderRadius: 10,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '50%',
            animation: {
                duration: 400,
            },
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            const value = context.raw || 0;
                            return `${context.label}: Rp. ${value.toLocaleString('id-ID')}`;
                        },
                    },
                },
            },
        },
    });

    fetch(apiUrl, {
        method: 'GET',
        headers: {
            Accept: 'application/json',
        },
    })
        .then(response => response.json())
        .then(data => {
            if (!data || !data.total || !data.total.total_keuntungan) {
                return;
            }

            const keuntungan = data.total.total_keuntungan;

            const keuntunganTahunIni = parseNumber(keuntungan.keuntungan_tahun_saat_ini);
            const keuntunganTahunLalu = parseNumber(keuntungan.keuntungan_tahun_lalu);

            chartKeuntungan.data.datasets[0].data = [
                safeChartValue(keuntunganTahunIni),
                safeChartValue(keuntunganTahunLalu),
            ];

            chartKeuntungan.update();
        })
        .catch(error => {
            console.error('Gagal update chart keuntungan dari API:', error);
        });
});