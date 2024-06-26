<template>
    <canvas id="pieChart" max-height="400" class="pieChart width-100"></canvas>
</template>

<script>
import Chart from "chart.js/auto";

export default {
    props:{
        data: Array,
        colors: {
            type: Array,
            default: [
                'rgb(60,179,113)',
                'rgb(240,230,140)',
                'rgb(219,112,147)',
            ]
        },
        labels: {
            type: Array,
            default: ['Present', 'Late', 'Absent']
        }
    },
    mounted() {
        const ctx = document.getElementById('pieChart');
        const myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: this.labels,
                datasets: [{
                    data: this.data,
                    backgroundColor: this.colors,
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                cutout: 220,
                responsive: false,
                barPercentage: 0.5,
                categoryPercentage: 1
            }
        });
    }
}
</script>
