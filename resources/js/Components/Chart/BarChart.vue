<template>
    <canvas :id="id" height="400" class="width-100"></canvas>
</template>

<script>
import Chart from "chart.js/auto";

export default {
    props: {
        labels: {
            type: Array,
            default: ['Label 1', 'Label 2']
        },
        data: {
            type: Array,
            default: [23, 33]
        },
        id: {
            type: String,
            default: 'barChart'
        },
        barPercentage: {
            type: Number,
            default: 0.5
        }
    },
    mounted() {
        const ctx = document.getElementById(this.id);
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: this.labels,
                datasets: [{
                    label: '',
                    data: this.data,
                    backgroundColor: '#1890FF',
                    borderColor: 'transparent',
                    borderWidth: 1,
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                responsive: false,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,

                    },
                    x: {
                        beginAtZero: false,
                        grid: {
                            display: false,
                        },
                        barPercentage: 0.3
                    }
                },
                barPercentage: this.barPercentage,
                categoryPercentage: 1
            }
        });
    }
}
</script>

<style >
</style>
