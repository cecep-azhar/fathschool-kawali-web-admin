<template>
    <canvas :id="id" :height="height" class="w-full mx-auto max-w-[250px]"></canvas>
</template>

<script>
import Chart from "chart.js/auto";

export default {
    props: {
        id: {
            type: String,
            default: 'pieChart'
        },
        height: {
            type: String,
            default: "400"
        },
        cutout: {
            type: Number,
            default: 100,
        },
        data: Array,
        colors: {
            type: Array,
            default: [
                'rgb(60,179,113)',
                'rgb(219,112,147)',
            ]
        },
        label: Array,
        labels: {
            type: Array,
            default: ['Collected Fees', 'Pending Collection']
        }
    },
    mounted() {
        const ctx = document.getElementById(this.id);
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
                cutout: this.cutout,
                responsive: false,
                barPercentage: 0.5,
                categoryPercentage: 1
            }
        });
    }
}
</script>
