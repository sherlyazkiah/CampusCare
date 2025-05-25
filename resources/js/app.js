import './bootstrap';

import Alpine from 'alpinejs';
import ApexCharts from 'apexcharts';

window.Alpine = Alpine;

Alpine.start();
document.addEventListener('DOMContentLoaded', function () {
    const chartEl = document.querySelector("#myChart");

    if (chartEl) {
        const options = {
            chart: {
                type: 'donut'
            },
            series: [44, 55, 13, 33],
            labels: ['Apple', 'Mango', 'Banana', 'Orange']
        };

        const chart = new ApexCharts(chartEl, options);
        chart.render();
    }
});