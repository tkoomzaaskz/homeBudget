// c3 experiment: https://jsfiddle.net/tomasz_ducin/pjv1cymu/19/

var chart;

function initialize(){
  chart = c3.generate({
    data: {
      type: 'bar',
      x: 'x',
      columns: [
      ],
      colors: {
        incomes: '#00BB00',
        outcomes: '#BB0000',
        savings: '#BBBB00'
      },
      groups: [
        ['incomes', 'outcomes']
      ],
      names: {
        incomes: 'Przychody',
        outcomes: 'Wydatki',
        savings: 'Oszczędności'
      },
    },
    axis: {
      x: {
        type: 'category',
        tick: {
          multiline: false
        },
      }
    },
    grid: {
      y: {
          show: true
      }
    },
    tooltip: {
      format: {
        value: function (value, ratio, id) {
          var format = d3.format(',.2f');
          return format(value).replace(',', ' ') + ' zł';
        }
      }
    }
  });
}

const getData = (url) => new Promise((res, rej) => {
  $.ajax({
    url,
    success: function(result){
      res(JSON.parse(result))
    }
  })
})

const chartURL = '/index.php/chart/monthly-balance-bars/calculate'
const getRequestParams = () => ({
  'chart[date_from]': document.getElementById('_date_from').value.substr(0, 7),
  'chart[date_to]': document.getElementById('_date_to').value.substr(0, 7),
  'chart[created_by]': document.getElementById('chart_created_by').value,
  'chart[sum_periods]': document.getElementById('chart_sum_periods').checked,
})

function reloadSWF()
{
  var url = getQueryString(chartURL, { ...getRequestParams(), format: 'txt'});
  findSWF('chart').reload(url);
}

const reloadC3 = () => {
  var url = getQueryString(chartURL, { ...getRequestParams(), format: 'json' });
  getData(url)
    .then(mapOldFormat)
    .then(columns => chart.load({ columns }))
}

// main switch!
const reload = reloadC3;

$(document).ready(function(){
  initialize()
  reload()
})
