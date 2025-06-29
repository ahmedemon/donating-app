(function($) {
    /* "use strict" */

    var dlabChartlist = function() {

        var screenWidth = $(window).width();
        let draw = Chart.controllers.line.__super__.draw; //draw shadow

        var NewCustomers = function() {
            var options = {
                series: [{
                    name: 'Net Profit',
                    data: [100, 300, 100, 400, 200, 400],
                    /* radius: 30,	 */
                }, ],
                chart: {
                    type: 'line',
                    height: 50,
                    width: 100,
                    toolbar: {
                        show: false,
                    },
                    zoom: {
                        enabled: false
                    },
                    sparkline: {
                        enabled: true
                    }

                },

                colors: ['var(--primary)'],
                dataLabels: {
                    enabled: false,
                },

                legend: {
                    show: false,
                },
                stroke: {
                    show: true,
                    width: 6,
                    curve: 'smooth',
                    colors: ['var(--primary)'],
                },

                grid: {
                    show: false,
                    borderColor: '#eee',
                    padding: {
                        top: 0,
                        right: 0,
                        bottom: 0,
                        left: 0

                    }
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                xaxis: {
                    categories: ['Jan', 'feb', 'Mar', 'Apr', 'May'],
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        show: false,
                        style: {
                            fontSize: '12px',
                        }
                    },
                    crosshairs: {
                        show: false,
                        position: 'front',
                        stroke: {
                            width: 1,
                            dashArray: 3
                        }
                    },
                    tooltip: {
                        enabled: true,
                        formatter: undefined,
                        offsetY: 0,
                        style: {
                            fontSize: '12px',
                        }
                    }
                },
                yaxis: {
                    show: false,
                },
                fill: {
                    opacity: 1,
                    colors: '#FB3E7A'
                },
                tooltip: {
                    enabled: false,
                    style: {
                        fontSize: '12px',
                    },
                    y: {
                        formatter: function(val) {
                            return "$" + val + " thousands"
                        }
                    }
                }
            };

            var chartBar1 = new ApexCharts(document.querySelector("#NewCustomers"), options);
            chartBar1.render();

        }
        var NewCustomers1 = function() {
            var options = {
                series: [{
                    name: 'Net Profit',
                    data: [100, 300, 200, 400, 100, 400],
                    /* radius: 30,	 */
                }, ],
                chart: {
                    type: 'line',
                    height: 50,
                    width: 80,
                    toolbar: {
                        show: false,
                    },
                    zoom: {
                        enabled: false
                    },
                    sparkline: {
                        enabled: true
                    }

                },

                colors: ['#0E8A74'],
                dataLabels: {
                    enabled: false,
                },

                legend: {
                    show: false,
                },
                stroke: {
                    show: true,
                    width: 6,
                    curve: 'smooth',
                    colors: ['#145650'],
                },

                grid: {
                    show: false,
                    borderColor: '#eee',
                    padding: {
                        top: 0,
                        right: 0,
                        bottom: 0,
                        left: 0

                    }
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                xaxis: {
                    categories: ['Jan', 'feb', 'Mar', 'Apr', 'May'],
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        show: false,
                        style: {
                            fontSize: '12px',
                        }
                    },
                    crosshairs: {
                        show: false,
                        position: 'front',
                        stroke: {
                            width: 1,
                            dashArray: 3
                        }
                    },
                    tooltip: {
                        enabled: true,
                        formatter: undefined,
                        offsetY: 0,
                        style: {
                            fontSize: '12px',
                        }
                    }
                },
                yaxis: {
                    show: false,
                },
                fill: {
                    opacity: 1,
                    colors: '#FB3E7A'
                },
                tooltip: {
                    enabled: false,
                    style: {
                        fontSize: '12px',
                    },
                    y: {
                        formatter: function(val) {
                            return "$" + val + " thousands"
                        }
                    }
                }
            };

            var chartBar1 = new ApexCharts(document.querySelector("#NewCustomers1"), options);
            chartBar1.render();

        }
        var NewCustomers2 = function() {
            var options = {
                series: [{
                    name: 'Net Profit',
                    data: [100, 200, 100, 300, 200, 400],
                    /* radius: 30,	 */
                }, ],
                chart: {
                    type: 'line',
                    height: 50,
                    width: 80,
                    toolbar: {
                        show: false,
                    },
                    zoom: {
                        enabled: false
                    },
                    sparkline: {
                        enabled: true
                    }

                },

                colors: ['#0E8A74'],
                dataLabels: {
                    enabled: false,
                },

                legend: {
                    show: false,
                },
                stroke: {
                    show: true,
                    width: 6,
                    curve: 'smooth',
                    colors: ['#3385D6'],
                },

                grid: {
                    show: false,
                    borderColor: '#eee',
                    padding: {
                        top: 0,
                        right: 0,
                        bottom: 0,
                        left: 0

                    }
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                xaxis: {
                    categories: ['Jan', 'feb', 'Mar', 'Apr', 'May'],
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        show: false,
                        style: {
                            fontSize: '12px',
                        }
                    },
                    crosshairs: {
                        show: false,
                        position: 'front',
                        stroke: {
                            width: 1,
                            dashArray: 3
                        }
                    },
                    tooltip: {
                        enabled: true,
                        formatter: undefined,
                        offsetY: 0,
                        style: {
                            fontSize: '12px',
                        }
                    }
                },
                yaxis: {
                    show: false,
                },
                fill: {
                    opacity: 1,
                    colors: '#FB3E7A'
                },
                tooltip: {
                    enabled: false,
                    style: {
                        fontSize: '12px',
                    },
                    y: {
                        formatter: function(val) {
                            return "$" + val + " thousands"
                        }
                    }
                }
            };

            var chartBar1 = new ApexCharts(document.querySelector("#NewCustomers2"), options);
            chartBar1.render();

        }
        var NewCustomers3 = function() {
            var options = {
                series: [{
                    name: 'Net Profit',
                    data: [100, 200, 100, 300, 200, 400],
                    /* radius: 30,	 */
                }, ],
                chart: {
                    type: 'line',
                    height: 50,
                    width: 100,
                    toolbar: {
                        show: false,
                    },
                    zoom: {
                        enabled: false
                    },
                    sparkline: {
                        enabled: true
                    }

                },

                colors: ['#0E8A74'],
                dataLabels: {
                    enabled: false,
                },

                legend: {
                    show: false,
                },
                stroke: {
                    show: true,
                    width: 6,
                    curve: 'smooth',
                    colors: ['#B723AD'],
                },

                grid: {
                    show: false,
                    borderColor: '#eee',
                    padding: {
                        top: 0,
                        right: 0,
                        bottom: 0,
                        left: 0

                    }
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                xaxis: {
                    categories: ['Jan', 'feb', 'Mar', 'Apr', 'May'],
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        show: false,
                        style: {
                            fontSize: '12px',
                        }
                    },
                    crosshairs: {
                        show: false,
                        position: 'front',
                        stroke: {
                            width: 1,
                            dashArray: 3
                        }
                    },
                    tooltip: {
                        enabled: true,
                        formatter: undefined,
                        offsetY: 0,
                        style: {
                            fontSize: '12px',
                        }
                    }
                },
                yaxis: {
                    show: false,
                },
                fill: {
                    opacity: 1,
                    colors: '#FB3E7A'
                },
                tooltip: {
                    enabled: false,
                    style: {
                        fontSize: '12px',
                    },
                    y: {
                        formatter: function(val) {
                            return "$" + val + " thousands"
                        }
                    }
                }
            };

            var chartBar1 = new ApexCharts(document.querySelector("#NewCustomers3"), options);
            chartBar1.render();

        }
        var activityChart = function() {
            var activity = document.getElementById("activity");
            if (activity !== null) {
                var activityData = [{
                        first: [30, 35, 30, 50, 30, 50, 40, 45],
                        second: [20, 25, 20, 15, 25, 22, 24, 20],
                        third: [20, 21, 22, 21, 22, 15, 17, 20]
                    },
                    {
                        first: [35, 35, 40, 30, 38, 40, 50, 38],
                        second: [30, 20, 35, 20, 25, 30, 25, 20],
                        third: [35, 40, 40, 30, 38, 50, 42, 32]
                    },
                    {
                        first: [35, 40, 40, 30, 38, 32, 42, 32],
                        second: [20, 25, 35, 25, 22, 21, 21, 38],
                        third: [30, 35, 40, 30, 38, 50, 42, 32]
                    },
                    {
                        first: [35, 40, 30, 38, 32, 42, 30, 35],
                        second: [25, 30, 35, 25, 20, 22, 25, 38],
                        third: [35, 35, 40, 30, 38, 40, 30, 38]
                    }
                ];
                activity.height = 300;

                var config = {
                    type: "line",
                    data: {
                        labels: [
                            "Mar",
                            "Apr",
                            "May",
                            "June",
                            "Jul",
                            "Aug",
                            "Sep",
                            "Oct",
                        ],
                        datasets: [{
                                label: "Active",
                                backgroundColor: "rgba(82, 177, 65, 0)",
                                borderColor: "#3FC55E",
                                data: activityData[0].first,
                                borderWidth: 6
                            },
                            {
                                label: "Inactive",
                                backgroundColor: 'rgba(255, 142, 38, 0)',
                                borderColor: "#4955FA",
                                data: activityData[0].second,
                                borderWidth: 6,

                            },
                            {
                                label: "Inactive",
                                backgroundColor: 'rgba(255, 142, 38, 0)',
                                borderColor: "#F04949",
                                data: activityData[0].third,
                                borderWidth: 6,

                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        elements: {
                            point: {
                                radius: 0
                            }
                        },
                        legend: false,

                        scales: {
                            yAxes: [{
                                gridLines: {
                                    color: "rgba(89, 59, 219,0.1)",
                                    drawBorder: true
                                },
                                ticks: {
                                    fontSize: 14,
                                    fontColor: "#6E6E6E",
                                    fontFamily: "Poppins"
                                },
                            }],
                            xAxes: [{
                                //FontSize: 40,
                                gridLines: {
                                    display: false,
                                    zeroLineColor: "transparent"
                                },
                                ticks: {
                                    fontSize: 14,
                                    stepSize: 5,
                                    fontColor: "#6E6E6E",
                                    fontFamily: "Poppins"
                                }
                            }]
                        },
                        tooltips: {
                            enabled: false,
                            mode: "index",
                            intersect: false,
                            titleFontColor: "#888",
                            bodyFontColor: "#555",
                            titleFontSize: 12,
                            bodyFontSize: 15,
                            backgroundColor: "rgba(256,256,256,0.95)",
                            displayColors: true,
                            xPadding: 10,
                            yPadding: 7,
                            borderColor: "rgba(220, 220, 220, 0.9)",
                            borderWidth: 2,
                            caretSize: 6,
                            caretPadding: 10
                        }
                    }
                };

                var ctx = document.getElementById("activity").getContext("2d");
                var myLine = new Chart(ctx, config);

                var items = document.querySelectorAll("#user-activity .nav-tabs .nav-item");
                items.forEach(function(item, index) {
                    item.addEventListener("click", function() {
                        config.data.datasets[0].data = activityData[index].first;
                        config.data.datasets[1].data = activityData[index].second;
                        config.data.datasets[2].data = activityData[index].third;
                        myLine.update();
                    });
                });
            }


        }
        var activityBar1 = function() {
            var activity1 = document.getElementById("activity1");
            if (activity1 !== null) {
                var activity1Data = [{
                        first: [35, 18, 15, 35, 40, 20, 30, 25, 22, 20, 45, 35, 35]
                    },
                    {
                        first: [50, 35, 10, 45, 40, 50, 60, 35, 10, 50, 34, 35, 50]
                    },
                    {
                        first: [20, 35, 60, 45, 40, 35, 30, 35, 10, 40, 60, 20, 20]
                    },
                    {
                        first: [25, 88, 25, 50, 21, 42, 60, 33, 50, 60, 50, 20, 25]
                    }
                ];
                activity1.height = 200;

                var config = {
                    type: "bar",
                    data: {
                        labels: [
                            "01",
                            "02",
                            "03",
                            "04",
                            "05",
                            "06",
                            "07",
                            "08",
                            "09",
                            "10",
                            "11",
                            "12",
                            "13"
                        ],
                        datasets: [{
                            label: "My First dataset",
                            data: [35, 18, 15, 35, 40, 20, 30, 25, 22, 20, 45, 35, 35],
                            borderColor: 'var(--primary)',
                            borderWidth: "0",
                            barThickness: 'flex',
                            backgroundColor: '#F73A0B',
                            minBarLength: 10
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,

                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                gridLines: {
                                    color: "rgba(233,236,255,1)",
                                    drawBorder: true
                                },
                                ticks: {
                                    fontColor: "#6E6E6E",
                                    max: 60,
                                    min: 0,
                                    stepSize: 20
                                },
                            }],
                            xAxes: [{
                                barPercentage: 0.3,

                                gridLines: {
                                    display: false,
                                    zeroLineColor: "transparent"
                                },
                                ticks: {
                                    stepSize: 20,
                                    fontColor: "#6E6E6E",
                                    fontFamily: "Nunito, sans-serif"
                                }
                            }]
                        },
                        tooltips: {
                            mode: "index",
                            intersect: false,
                            titleFontColor: "#888",
                            bodyFontColor: "#555",
                            titleFontSize: 12,
                            bodyFontSize: 15,
                            backgroundColor: "rgba(255,255,255,1)",
                            displayColors: true,
                            xPadding: 10,
                            yPadding: 7,
                            borderColor: "rgba(220, 220, 220, 1)",
                            borderWidth: 1,
                            caretSize: 6,
                            caretPadding: 10
                        }
                    }
                };

                var ctx = document.getElementById("activity1").getContext("2d");
                var myLine = new Chart(ctx, config);

                var items = document.querySelectorAll("#user-activity1 .nav-tabs .nav-item");
                items.forEach(function(item, index) {
                    item.addEventListener("click", function() {
                        config.data.datasets[0].data = activity1Data[index].first;
                        myLine.update();
                    });
                });
            }
        }
        var pieChart1 = function() {
            var options = {
                series: [90, 68, 85],
                chart: {
                    type: 'donut',
                    height: 250
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 0,
                },
                colors: ['#1D92DF', '#4754CB', '#D55BC1'],
                legend: {
                    position: 'bottom',
                    show: false
                },
                responsive: [{
                    breakpoint: 1400,
                    options: {
                        chart: {
                            height: 200
                        },
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#pieChart1"), options);
            chart.render();

        }






        /* Function ============ */
        return {
            init: function() {},


            load: function() {
                // NewCustomers();
                // NewCustomers1();
                // NewCustomers2();
                // NewCustomers3();
                activityChart();
                activityBar1();
                // pieChart1();

            },

            resize: function() {}
        }

    }();



    jQuery(window).on('load', function() {
        setTimeout(function() {
            dlabChartlist.load();
        }, 1000);

    });



})(jQuery);