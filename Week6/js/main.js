var left = {"tower": document.getElementById("left"), "top": 112};
var center = {"tower": document.getElementById("center"), "top": 272};
var right = {"tower": document.getElementById("right"), "top": 272};

var disk1 = document.getElementById("disk1");
var disk2 = document.getElementById("disk2");
var disk3 = document.getElementById("disk3");
var disk4 = document.getElementById("disk4");
var disk5 = document.getElementById("disk5");
var disk6 = document.getElementById("disk6");
var disk7 = document.getElementById("disk7");
var disk8 = document.getElementById("disk8");


function diskPop(diskNumber, source, destination) 
{
    var interval = setInterval(function pop() {
        var y = diskNumber.getAttribute("y");
        var newY = parseInt(y) - 10;
        if (newY < 50) {
            clearInterval(interval);
            source.top += 20;
            diskMove(diskNumber, source, destination);
        }
        diskNumber.setAttribute("y", newY);
    }, 20);
}

