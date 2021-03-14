// $(document).ready(function () {

  
//     let dataRefresh;
//     $.ajax({
//         url: 'https://cors-anywhere.herokuapp.com/https://hothothot.dog/api/capteurs/',
//         headers: {
//             'Content-Type': 'application/x-www-form-urlencoded'
//         },
//         type: "GET",
//         dataType: "json",
//         success: function (result) {
//             dataRefresh = result;
//             console.log('dataRefresh :>> ', dataRefresh);

//             let currentValueIn = dataRefresh['capteurs'][0]['Valeur'];
//             let currentValueExt = dataRefresh['capteurs'][1]['Valeur'];

//             console.log('currentValueIn :>> ', currentValueIn);
//             console.log('currentValueIExt :>> ', currentValueExt);

//             };
//             // updateJSON(test);
//             $.ajax({
//                 type: "PUT",
//                 url: 'http://lp2021hothothotgr2.com/Assets/json/data.json',
//                 headers: {
//                     'Content-Type': 'application/x-www-form-urlencoded'
//                 },
//                 dataType: "json",
//                 data: test,
//                 success: function (result) {
//                     console.log('result :>> ', result);
//                 },
//                 error: function () {
//                     console.log("error");
//                 }
//             });
        
//         },
//         error: function () {
//             console.log("error");
//         }
//     });

//     // updateJSON(newJson) {
        

//     // }
//     setTimeout(function(){ 
//         var obj = JSON.parse(localStorage.getItem('jsonObj'));
//         console.log('ffesfesfsefesfesf :>> ');
//         console.log('obj :>> ', obj);
    
//      }, 3000);



//     // fetch("https://hothothot.dog/api/capteurs/")
//     // .then(function(data) {
//     //   return data.json();
//     // })
//     // .then(function(response) {
//     //   console.log(JSON.stringify(response));
//     // })


// });