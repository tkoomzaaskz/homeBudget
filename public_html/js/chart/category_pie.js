// c3 experiment: https://jsfiddle.net/tomasz_ducin/8jxq23e6/59/
// https://jsfiddle.net/tomasz_ducin/fxq35avj/39/

// falling back to older versions of C3 that support pie charts with tooltips:
// https://bl.ocks.org/fmeola/01d3f6009a6d7021ce474021f0db1e21

var chart;

const getChart = () => c3.generate({
  data: {
    bindto: '#categoryChart',
    columns: [],
    type : 'pie',
  },
  size: {
    // width: 600,
    height: 640
  },
  pie: {
    label: {
      format(value, ratio, id) {
        return value;
      }
    }
  },
  tooltip: {
    format: {
      value: function (value, ratio, id) {
        var format = d3.format(",.2f");
        return format(value).replace(/,/g, ' ') + " zł";
      }
    }
  }
})

const getData = (url) => new Promise((res, rej) => {
  $.ajax({
    url,
    success: function(result){
      res(JSON.parse(result))
    }
  })
})

const chartURL = '/index.php/chart/category-pie/calculate'
const getRequestParams = () => ({
  'chart[date_from]': document.getElementById('_date_from').value,
  'chart[date_to]': document.getElementById('_date_to').value,
  'chart[created_by]': document.getElementById('chart_created_by').value,
  'chart[sum_subcategories]': document.getElementById('chart_sum_subcategories').checked,
})

function reloadSWF()
{
  var url = getQueryString(chartURL, { ...getRequestParams(), format: 'txt'});
  findSWF('chart').reload(url);
}

function reloadC3(){
  var url = getQueryString(chartURL, { ...getRequestParams(), format: 'json' });
  getData(url)
    .then(({ pie_labels, values }) => {
      const labels = pie_labels
      const columns = values.map((v, idx) => [labels[idx], v])
      return columns.sort(([k1, v1], [k2, v2]) => v2 - v1)
    })
    .then(columns => {
      chart.destroy()
      chart = getChart()
      chart.load({ columns })
    })
}

// main switch!
const reload = reloadC3;

$(document).ready(function(){
  chart = getChart()
  reload()
})
