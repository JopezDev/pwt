require('bootstrap/dist/js/bootstrap.bundle');

import $ from 'jquery';
import Chart from 'chart.js';


$(document).ready(() => {
  let ctx = $('#chart');

  fetch('api/data')
    .then((res) => res.json())
    .then((json) => {
      console.log(json.data);

      let chart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: json.data.labels,
          // steppedLine: false,
          datasets: [{
            label: 'Win/Loss',
            fill: 1,
            data: json.data.stats,
            pointBackgroundColor: 'rgba(0, 123, 255, 1)'

          }]
        }
      })

    })
    .catch(errors => {
      console.error(errors);
    })
    .finally(errors => {
      console.log('don');
    });

});


