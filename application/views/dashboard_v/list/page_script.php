<script id="source">
    $(function () {
        var ms_data = [{"label":"FOO","data":[[0,80],[1,70],[2,100],[3,60],[4,102]]},
            {"label":"BAR","data":[[0,10],[1,20],[2,30],[3,40],[4,80]]},
            {"label":"CAR","data":[[0,5],[1,10],[2,15],[3,20],[4,25]]}]
        var ms_ticks = [[0,"1/28"],[1,"1/29"],[2,"1/30"],[3,"1/31"],[4,"1/32"]];

        function plotWithOptions() {
            $.plot($("#placeholder"), ms_data, {
                bars: { show: true, barWidth: 0.6, series_spread: true, align: "center" },
                xaxis: { ticks: ms_ticks, autoscaleMargin: .10 },
                grid: { hoverable: true, clickable: true }
            });
        }

        function showTooltip(x, y, contents) {
            $('').css( {
                position: 'absolute',
                display: 'none',
                top: y + 5,
                left: x + 5,
                border: '1px solid #fdd',
                padding: '2px',
                'background-color': '#fee',
                opacity: 0.80
            }).appendTo("body").show();
        }

        plotWithOptions();

        $("#placeholder").bind("plothover", function (event, pos, item) {
            $("#x").text(pos.x.toFixed(2));
            $("#y").text(pos.y.toFixed(2));
            if (item) {
                if (previousPoint != item.datapoint) {
                    previousPoint = item.datapoint;

                    $("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(2),
                        y = item.datapoint[1].toFixed(2);

                    showTooltip(item.pageX, item.pageY,
                        item.series.label + " Group id: " + Math.floor(x) + ", y = " + y + ", seriesIndex: " + item.seriesIndex);
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;
            }
        });

        $("#placeholder").bind("plotclick", function (event, pos, item) {
            if (item) {
                $("#clickdata").text("You clicked bar " + item.dataIndex + " in " + item.series.label + ".");
            }
        });
    });
</script>