<script src="https://cdn.anychart.com/releases/v8/js/anychart-base.min.js"></script>
  <script src="https://cdn.anychart.com/releases/v8/js/anychart-ui.min.js"></script>
  <script src="https://cdn.anychart.com/releases/v8/js/anychart-exports.min.js"></script>
  <link href="https://cdn.anychart.com/releases/v8/css/anychart-ui.min.css" type="text/css" rel="stylesheet">
  <link href="https://cdn.anychart.com/releases/v8/fonts/css/anychart-font.min.css" type="text/css" rel="stylesheet">

  <style type="text/css">

    #chart-container {
      width: 50%;
      height: 100%;
    }
  
</style>

<div id="chart-container"></div>
  

  <script>

    anychart.onDocumentReady(function () {
      // create data set on our data
      var dataSet = anychart.data.set([
        ['Jan', 12814, 3054],
        ['Feb', 13012, 5067],
        ['Mar', 11624, 7004],
        ['Apr', 8814, 9054],
        ['May', 12998, 12043],
        ['Jun', 12321, 15067],
        ['Jul', 10342, 10119],
        ['Aug', 22998, 12043],
        ['Sep', 11261, 10419],
        ['Oct', 11261, 10419],
        ['Nov', 11261, 10419],
        ['Dec', 11261, 10419]
      ]);

      // map data for the first series, take x from the zero column and value from the first column of data set
      var firstSeriesData = dataSet.mapAs({ x: 0, value: 1 });

      // map data for the second series, take x from the zero column and value from the second column of data set
      var secondSeriesData = dataSet.mapAs({ x: 0, value: 2 });

      // create bar chart
      var chart = anychart.column();

      // turn on chart animation
      chart.animation(true);

      // force chart to stack values by Y scale.
      chart.yScale().stackMode('percent');

      // set chart title text settings
      chart.title(`<?php echo $currentYear; ?>` + ' Open ratio of sent emails');

      // set yAxis labels formatting, force it to add % to values
      chart.yAxis(0).labels().format('{%Value}%');

      // helper function to setup label settings for all series
      var setupSeries = function (series, name) {
        series.name(name).stroke('2 #fff 1');
        series.hovered().stroke('2 #fff 1');
      };

      // temp variable to store series instance
      var series;

      // create first series with mapped data
      series = chart.column(firstSeriesData);
      setupSeries(series, 'Not Opened');

      // create second series with mapped data
      series = chart.column(secondSeriesData);
      setupSeries(series, 'Opened');

      chart.interactivity().hoverMode('by-x');
      chart.tooltip().titleFormat('{%X}').displayMode('union');

      // turn on legend
      chart.legend().enabled(true).fontSize(13);

      // set container id for the chart
      chart.container('chart-container');

      // initiate chart drawing
      chart.draw();
    });
  
</script>