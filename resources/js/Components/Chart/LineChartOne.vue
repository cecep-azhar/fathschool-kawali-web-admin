<template>
    <canvas id="lineChart1" height="70" class="width-100"></canvas>
</template>

<script>
import Chart from "chart.js/auto";

export default {
    props: {
        data: Array
    },
    mounted() {
        const ctx = document.getElementById('lineChart1');
        const myChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: this.data,
                datasets: [{
                    data: this.data,
                    borderColor: "#1890FF",
                    backgroundColor: "#D1E9FF",
                    fill: true
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                },
                elements: {
                    point: {
                        radius: 0
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            display: false
                        },
                    },
                    y: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            display: false
                        },
                    },
                }
            }
        });
    }
}
</script>
