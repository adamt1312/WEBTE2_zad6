$("#form1").submit(function (e) {

    e.preventDefault();
    let form = $(this);
    let url = form.attr('action');

    $.ajax({
        type: "GET",
        url: url,
        data: form.serialize(),
        success: function(data)
        {
            let output = data;
            let size = Object.keys(output).length;
            console.log(output);

            if(output.msg) {
                document.getElementById("title1").innerText = output.msg;
            }
            else {
                document.getElementById("title1").innerText = "";
                for(let i=0;i<size;i++) {
                    document.getElementById("title1").innerText += output[i].value + "\n";
                }
            }
        }
    });
});

$("#form2").submit(function (e) {

    e.preventDefault();
    let form = $(this);
    let url = form.attr('action');

    $.ajax({
        type: "GET",
        url: url,
        data: form.serialize(),
        success: function(data)
        {
            let output = data;
            let size = Object.keys(output).length;

            if(output.msg){

                document.getElementById("title2").innerText = output.msg;
            }
            else{
                document.getElementById("title2").innerText = "";
                for(let i=0;i<size;i++){
                    document.getElementById("title2").innerText +=output[i].day + "." + output[i].month + "\n";
                }
            }
        }
    });
});

$("#form3").submit(function(e) {

    e.preventDefault();
    let form = $(this);
    let url = form.attr('action');

    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(),
        success: function(data)
        {
            let output = data;
            document.getElementById("title3").innerText = output.msg;
        }
    });
});

let json_obj = null;
let swtch = document.getElementById("mySwitch");
swtch.addEventListener('change', function() {
     insertDataIntoHTML(json_obj,Object.keys(json_obj).length);
});

const insertDataIntoHTML = (output,size) => {
    document.getElementById("resultPar").innerText = "";
    if (swtch.checked) {
        output.forEach((obj) => {
            document.getElementById("resultPar").innerText += JSON.stringify(obj) + "\n";
        });
    }
    else {
        for(let i=0; i<size; i++) {
            document.getElementById("resultPar").innerText += output[i].day + "." + output[i].month + " - " + output[i].value + "\n";
        }
    }

}

const getAllSkHolidays = () => {
    var url = "GET/holidays"
    $.ajax({
        type: "GET",
        url: url,
        data: {"lang":"sk"},
        success: function(data)
        {
            let output = data;
            json_obj = data;
            let size = Object.keys(output).length;
            insertDataIntoHTML(output,size);
        }
    });
}

const getAllCzHolidays = () => {
    var url = "GET/holidays"
    $.ajax({
        type: "GET",
        url: url,
        data: {"lang":"cz"},
        success: function(data)
        {
            let output = data;
            json_obj = data;
            let size = Object.keys(output).length;
            insertDataIntoHTML(output,size);
        }
    });
}

const getAllSkMemorial = () => {
    var url = "GET/memorial"
    $.ajax({
        type: "GET",
        url: url,
        success: function(data)
        {
            let output = data;
            json_obj = data;
            let size = Object.keys(output).length;
            insertDataIntoHTML(output,size);
        }
    });
}

let btn1 = document.getElementById("allSkBtn");
let btn2 = document.getElementById("allCzBtn");
let btn3 = document.getElementById("allSkBtn2");
btn1.addEventListener('click',(() => {
    getAllSkHolidays();
}))
btn2.addEventListener('click',(() => {
    getAllCzHolidays();
}))
btn3.addEventListener('click',(() => {
    getAllSkMemorial();
}))