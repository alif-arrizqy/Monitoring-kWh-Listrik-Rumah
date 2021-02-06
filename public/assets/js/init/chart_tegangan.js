(function ($) {
  "use strict"; // Start of use strict

    var SufeeAdmin = {

        teganganLoad: function () {
        var data = [],
            totalPoints = 300;

        function getRandomData() {
            if (data.length > 0) data = data.slice(1);

            // Do a random walk

            while (data.length < totalPoints) {
            var prev = data.length > 0 ? data[data.length - 1] : 50,
                y = prev + Math.random() * 10 - 5;

            if (y < 0) {
                y = 0;
            } else if (y > 100) {
                y = 100;
            }

            data.push(y);
            }

            // Zip the generated y values with the x values

            var res = [];
            for (var i = 0; i < data.length; ++i) {
            res.push([i, data[i]]);
            }

            return res;
        }

        // Set up the control widget

        var updateInterval = 30;
        $("#updateInterval")
            .val(updateInterval)
            .change(function () {
            var v = $(this).val();
            if (v && !isNaN(+v)) {
                updateInterval = +v;
                if (updateInterval < 1) {
                updateInterval = 1;
                } else if (updateInterval > 3000) {
                updateInterval = 3000;
                }
                $(this).val("" + updateInterval);
            }
            });

        var plot = $.plot("#tegangan", [getRandomData()], {
            series: {
            shadowSize: 0, // Drawing is faster without shadows
            },
            yaxis: {
            min: 0,
            max: 100,
            },
            xaxis: {
            show: false,
            },
            colors: ["#00c292"],
            grid: {
            color: "transparent",
            hoverable: true,
            borderWidth: 0,
            backgroundColor: "transparent",
            },
            tooltip: true,
            tooltipOpts: {
            content: "Y: %y",
            defaultTheme: false,
            },
        });

        function update() {
            plot.setData([getRandomData()]);

            // Since the axes don't change, we don't need to call plot.setupGrid()

            plot.draw();
            setTimeout(update, updateInterval);
        }

        update();
        },

        lineTegangan: function () {
        // first chart
        var chart1Options = {
            series: {
            lines: {
                show: true,
            },
            points: {
                show: true,
            },
            },
            xaxis: {
            mode: "time",
            timeformat: "%m/%d",
            minTickSize: [1, "day"],
            },
            grid: {
            hoverable: true,
            },
            legend: {
            show: false,
            },
            grid: {
            color: "#fff",
            hoverable: true,
            borderWidth: 0,
            backgroundColor: "transparent",
            },
            tooltip: {
            show: true,
            content: "y: %y",
            },
        };
        var chart1Data = {
            label: "chart1",
            color: "#007BFF",
            data: [
            [1354521600000, 6322],
            [1354840000000, 6340],
            [1355223600000, 6368],
            [1355306400000, 6374],
            [1355487300000, 6388],
            [1355571900000, 6400],
            ],
        };
        $.plot($("#line_arus"), [chart1Data], chart1Options);
        },
    };

    $(document).ready(function () {
        SufeeAdmin.teganganLoad();
        SufeeAdmin.lineTegangan();
    });

    // Line Chart Tegangan
    var ctx = document.getElementById("lineChartTegangan");
    ctx.height = 150;
    var myChart = new Chart(ctx, {
        type: "line",
        data: {
        labels: [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember",
        ],
        datasets: [
            {
            label: "Data Tegangan Listrik Dalam 1 Tahun",
            borderColor: "rgba(0, 194, 146, 0.9)",
            borderWidth: "1",
            backgroundColor: "rgba(0, 194, 146, 0.5)",
            pointHighlightStroke: "rgba(26,179,148,1)",
            data: [20, 47, 35, 43, 565, 45, 35, 220, 50, 10, 13, 11],
            },
            // {
            //     label: "My Second dataset",
            //     borderColor: "rgba(0, 194, 146, 0.9)",
            //     borderWidth: "1",
            //     backgroundColor: "rgba(0, 194, 146, 0.5)",
            //     pointHighlightStroke: "rgba(26,179,148,1)",
            //     data: [ 16, 32, 18, 27, 42, 33, 44 ]
            // }
        ],
        },
        options: {
        responsive: true,
        tooltips: {
            mode: "index",
            intersect: false,
        },
        hover: {
            mode: "nearest",
            intersect: true,
        },
        },
    });
})(jQuery);
