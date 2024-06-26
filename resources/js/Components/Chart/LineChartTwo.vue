<template>
    <canvas id="lineChart2" height="100" class="width-100"></canvas>
</template>

<script>
import Chart from "chart.js/auto";

export default {
    mounted() {
        var xValues = [100,200,300,400,500,600,700,800,900,1000];
        const ctx = document.getElementById('lineChart2');
        const myChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    data: [860, 1140, 1060, 1060, 1070, 1110, 1330, 2210, 1830, 2478],
                    borderColor: "#1890FF",
                    backgroundColor: "#D1E9FF",
                    fill: true
                }]
            },
            options: {
                plugins:{
                    legend: {
                        display: false
                    },
                },
                elements: {
                    point:{
                        radius: 0
                    }
                },
                scales:{
                    x:{
                        grid:{
                            display: false
                        },
                        ticks: {
                            display: false
                        },
                    },
                    y:{
                        grid:{
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
