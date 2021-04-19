$("#formToSend").submit(function(e) {

    e.preventDefault();
    var form = $(this);
    var url = form.attr('action');

    $.ajax({
        type: "GET",
        url: url,
        data: form.serialize(),
        success: function(data)
        {
            var output = JSON.parse(data);
            var size = Object.keys(output).length;

            if(output.msg){
                document.getElementById("output").innerText = output.msg;
            }
            else{
                document.getElementById("output").innerText = "";
                for(let i=0;i<size;i++){
                    document.getElementById("output").innerText += output[i].value + "\n";
                }
            }
        }
    });
});

$("#formToSend2").submit(function(e) {

    e.preventDefault();
    var form = $(this);
    var url = form.attr('action');

    $.ajax({
        type: "GET",
        url: url,
        data: form.serialize(),
        success: function(data)
        {
            var output = JSON.parse(data);
            var size = Object.keys(output).length;

            if(output.msg){

                document.getElementById("output").innerText = output.msg;
            }
            else{
                document.getElementById("output").innerText = "";
                for(let i=0;i<size;i++){
                    document.getElementById("output").innerText +="Day: " + output[i].day + " Month: " + output[i].month + "\n";
                }
            }
        }
    });
});

$("#formToSend3").submit(function(e) {

    e.preventDefault();
    var form = $(this);
    var url = form.attr('action');

    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(),
        success: function(data)
        {
            var output = JSON.parse(data);
            document.getElementById("output").innerText = output.msg;
            //console.log(data);
        }
    });
});

function getSKall(){
    var url = "api.php/nameday"
    $.ajax({
        type: "GET",
        url: url,
        data: {"type":"SKholi"},
        success: function(data)
        {
            var output = JSON.parse(data);
            var size = Object.keys(output).length;
            //console.log(size);
            document.getElementById("resultPar").innerText ="";
            for(let i=0;i<size;i++){
                document.getElementById("resultPar").innerText += output[i].value + " Day: " + output[i].day + " Month: " + output[i].month + "\n";
            }
        }
    });
}

function getCZall(){
    var url = "api.php/nameday"
    $.ajax({
        type: "GET",
        url: url,
        data: {"type":"CZholi"},
        success: function(data)
        {

            var output = JSON.parse(data);
            var size = Object.keys(output).length;
            //console.log(size);
            document.getElementById("resultPar").innerText ="";
            for(let i=0;i<size;i++){
                document.getElementById("resultPar").innerText += output[i].value + " Day: " + output[i].day + " Month: " + output[i].month + "\n";
            }
            //console.log(data); // show response from the php script.
        }
    });
}

function getSKdni(){
    var url = "api.php/nameday"
    $.ajax({
        type: "GET",
        url: url,
        data: {"type":"SKmem"},
        success: function(data)
        {
            var output = JSON.parse(data);
            var size = Object.keys(output).length;
            //console.log(size);
            document.getElementById("resultPar").innerText ="";
            for(let i=0;i<size;i++){
                document.getElementById("resultPar").innerText += output[i].value + " Day: " + output[i].day + " Month: " + output[i].month + "\n";
            }
            //console.log(data); // show response from the php script.
        }
    });
}

let btn1 = document.getElementById("allSkBtn");
let btn2 = document.getElementById("allCzBtn");
let btn3 = document.getElementById("allSkBtn2");
btn1.addEventListener('click',(() => {
    getSKall();
}))
btn2.addEventListener('click',(() => {
    getCZall();
}))
btn3.addEventListener('click',(() => {
    getSKdni();
}))