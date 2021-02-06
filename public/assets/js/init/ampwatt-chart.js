(function ($) {
  "use strict"; // Start of use strict

    var SufeeAdmin = {
        arusLoad: function () {
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

        var plot = $.plot("#arus", [getRandomData()], {
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
    };
     //Traffic chart chart-js
     if ($('#TrafficChart').length) {
        var ctx = document.getElementById( "TrafficChart" );
        ctx.height = 150;
        var myChart = new Chart( ctx, {
            type: 'line',
            data: {
                labels: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul" ],
                datasets: [
                {
                    label: "Visit",
                    borderColor: "rgba(4, 73, 203,.09)",
                    borderWidth: "1",
                    backgroundColor: "rgba(4, 73, 203,.5)",
                    data: [ 0, 2900, 5000, 3300, 6000, 3250, 0 ]
                },
                {
                    label: "Bounce",
                    borderColor: "rgba(245, 23, 66, 0.9)",
                    borderWidth: "1",
                    backgroundColor: "rgba(245, 23, 66,.5)",
                    pointHighlightStroke: "rgba(245, 23, 66,.5)",
                    data: [ 0, 4200, 4500, 1600, 4200, 1500, 4000 ]
                },
                {
                    label: "Targeted",
                    borderColor: "rgba(40, 169, 46, 0.9)",
                    borderWidth: "1",
                    backgroundColor: "rgba(40, 169, 46, .5)",
                    pointHighlightStroke: "rgba(40, 169, 46,.5)",
                    data: [1000, 5200, 3600, 2600, 4200, 5300, 0 ]
                }
                ]
            },
            options: {
                responsive: true,
                tooltips: {
                    mode: 'index',
                    intersect: false
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                }

            }
        } );
    }
    //Traffic chart chart-js  End

    $(document).ready(function () {
        SufeeAdmin.arusLoad();
        SufeeAdmin.teganganLoad();
    });

})(jQuery);
