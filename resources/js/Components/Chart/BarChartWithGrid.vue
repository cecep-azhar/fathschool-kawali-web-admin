<template>
    <canvas id="barChart" height="400" class="width-100"></canvas>
</template>

<script>
import Chart from "chart.js/auto";

export default {
    props: {
        data_set1_label: Array,
        data_set1_value: Array,
        data_set2_value: Array,
    },
    mounted() {
        const ctx = document.getElementById('barChart');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: this.data_set1_label,
                datasets: [
                    {
                        label: 'Income',
                        data: this.data_set1_value,
                        backgroundColor: '#43a4ff',
                        borderColor: 'transparent',
                        borderWidth: 1,
                    },
                    {
                        label: 'Expense',
                        data: this.data_set2_value,
                        backgroundColor: '#ff7474',
                        borderColor: 'transparent',
                        borderWidth: 1,
                    }
                ]
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
                        beginAtZero: true,
                        grid: {
                            display: true,
                        },
                        barPercentage: 0.3
                    }
                },
                barPercentage: 0.5,
                categoryPercentage: 1
            }
        });
    }
}
</script>
