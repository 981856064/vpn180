//
// $(document).ready(function () {
//     var ws = null;
//     //生成唯一ID
//     var uuid = Number(Math.random().toString().substr(3,length) + Date.now()).toString(36);
//     //创建websocket连接
//     ws = new WebSocket("ws://127.0.0.1:9090");
//     ws.onopen = function (){
//         ws.send(uuid);
//         console.log("WebSocket 成功连接");
//     }
//
//     ws.onmessage = function (data) {
//         // $('#text_chat_content').append(data.data);
//         console.log(data.data);
//         var websocketJson = $.parseJSON(data.data);
//         var array = websocketJson.data;
//         // //更新表格数据
//         chart.series[0].setData(array, true, false, false);
//     };
//
//     ws.onclose = function () {
//         console.log("websocket 断开连接")
//     };
//
//     // 监听窗口关闭事件，当窗口关闭时，主动去关闭websocket连接，防止连接还没断开就关闭窗口。
//     window.onbeforeunload = function() {
//         ws.close();
//     }
// });
//
// Highcharts.setOptions({
//     global: {
//         useUTC: false
//     }
// });
// function activeLastPointToolip(chart) {
//     var points = chart.series[0].points;
//     chart.tooltip.refresh(points[points.length -1]);
// }
// var chart = Highcharts.chart('container', {
//     chart: {
//         type: 'spline',
//         marginRight: 10,
//         events: {
//             load: function () {
//                 var series = this.series[0],
//                     chart = this;
//                 activeLastPointToolip(chart);
//                 setInterval(function () {
//                     var x = (new Date()).getTime(), // 当前时间
//                         y = Math.random();          // 随机值
//                     series.addPoint([x, y], true, true);
//                     activeLastPointToolip(chart);
//                 }, 1000);
//             }
//         }
//     },
//     title: {
//         text: '平均网络延迟'
//     },
//     xAxis: {
//         type: 'datetime',
//         tickPixelInterval: 150
//     },
//     yAxis: {
//         title: {
//             text: null
//         }
//     },
//     tooltip: {
//         formatter: function () {
//             return '<b>' + this.series.name + '</b><br/>' +
//                 Highcharts.dateFormat('%H:%M:%S', this.x) + '<br/>' +
//                 Highcharts.numberFormat(this.y, 2);
//         }
//     },
//     legend: {
//         enabled: false
//     },
//     credits: {
//         enabled: false
//     },
//     series: [{
//         name: '平均延时',
//         marker: {
//             //小圆点
//             enabled: false
//         },
//         data: (function () {
//             // 生成随机值
//             var data = [],
//                 time = (new Date()).getTime(),
//                 i;
//             for (i = -19; i <= 0; i += 1) {
//                 data.push({
//                     x: time + i * 1000,
//                     y: Math.random()
//                 });
//             }
//             return data;
//         }())
//     }]
// });
//
//
// var chart1 = Highcharts.chart('container1', {
//     chart: {
//         type: 'spline',
//         marginRight: 10,
//         events: {
//             load: function () {
//                 var series = this.series[0],
//                     chart = this;
//                 activeLastPointToolip(chart);
//                 setInterval(function () {
//                     var x = (new Date()).getTime(), // 当前时间
//                         y = Math.random();          // 随机值
//                     series.addPoint([x, y], true, true);
//                     activeLastPointToolip(chart);
//                 }, 1000);
//             }
//         }
//     },
//     title: {
//         text: '实时网络延迟'
//     },
//     xAxis: {
//         type: 'datetime',
//         tickPixelInterval: 150
//     },
//     yAxis: {
//         title: {
//             text: null
//         }
//     },
//     tooltip: {
//         formatter: function () {
//             return '<b>' + this.series.name + '</b><br/>' +
//                 Highcharts.dateFormat('%H:%M:%S', this.x) + '<br/>' +
//                 Highcharts.numberFormat(this.y, 2);
//         }
//     },
//     legend: {
//         enabled: false
//     },
//     credits: {
//         enabled: false
//     },
//     series: [{
//         name: '实时延时',
//         marker: {
//             //小圆点
//             enabled: false
//         },
//         data: (function () {
//             // 生成随机值
//             var data = [],
//                 time = (new Date()).getTime(),
//                 i;
//             for (i = -19; i <= 0; i += 1) {
//                 data.push({
//                     x: time + i * 1000,
//                     y: Math.random()
//                 });
//             }
//             return data;
//         }())
//     }]
// });
// var chart2 = Highcharts.chart('container2', {
//     chart: {
//         type: 'spline',
//         marginRight: 10,
//         events: {
//             load: function () {
//                 var series = this.series[0],
//                     chart = this;
//                 activeLastPointToolip(chart);
//                 setInterval(function () {
//                     var x = (new Date()).getTime(), // 当前时间
//                         y = Math.random();          // 随机值
//                     series.addPoint([x, y], true, true);
//                     activeLastPointToolip(chart);
//                 }, 1000);
//             }
//         }
//     },
//     title: {
//         text: '8K时钟锁定延时'
//     },
//     xAxis: {
//         type: 'datetime',
//         tickPixelInterval: 150
//     },
//     yAxis: {
//         title: {
//             text: null
//         }
//     },
//     tooltip: {
//         formatter: function () {
//             return '<b>' + this.series.name + '</b><br/>' +
//                 Highcharts.dateFormat('%H:%M:%S', this.x) + '<br/>' +
//                 Highcharts.numberFormat(this.y, 2);
//         }
//     },
//     legend: {
//         enabled: false
//     },
//     credits: {
//         enabled: false
//     },
//     series: [{
//         name: '锁定延时',
//         marker: {
//             //小圆点
//             enabled: false
//         },
//         data: (function () {
//             // 生成随机值
//             var data = [],
//                 time = (new Date()).getTime(),
//                 i;
//             for (i = -19; i <= 0; i += 1) {
//                 data.push({
//                     x: time + i * 1000,
//                     y: Math.random()
//                 });
//             }
//             return data;
//         }())
//     }]
// });