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

var time = 1000;

var disks = [disk1 ,disk2 ,disk3 ,disk4 ,disk5 ,disk6 ,disk7 ,disk8];

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

function diskMove(diskNumber, source, destination) 
{
    var interval = setInterval(function move() 
    {
        var xSource = source.tower.getAttribute("x");
        var xDestination = destination.tower.getAttribute("x");
        if (xSource < xDestination) {
            var x = diskNumber.getAttribute("x");
            var newX = parseInt(x) + 40;
            if (newX > xDestination - (diskNumber.getAttribute("width")/2 - 2)) {
                clearInterval(interval);
                diskDrop(diskNumber, left, destination);
            }
            diskNumber.setAttribute("x", newX);
        } else {
            var x = diskNumber.getAttribute("x");
            var newX = parseInt(x) - 40;
            if (newX < xDestination - (diskNumber.getAttribute("width")/2 - 6)) {
                clearInterval(interval);
                diskDrop(diskNumber, left, destination);
            }
            diskNumber.setAttribute("x", newX);
        }
    }, 20);
}

function diskDrop(diskNumber, source, destination) 
{
    var interval = setInterval(function drop() 
    {
        var y = diskNumber.getAttribute("y");
        var newY = parseInt(y) + 10;
        if (newY >= destination.top) {
            clearInterval(interval);
            destination.top -= 20;
        }
        diskNumber.setAttribute("y", newY);
    }, 20);
}

function Hanoi(disk, source, dest, aux) 
{
    if (disk == 0) {
        setTimeout(diskPop, time, getDisk(disk), source, dest); 
        time += 1000;          
    } else {
        Hanoi(disk - 1, source, aux, dest);
        setTimeout(diskPop, time, getDisk(disk), source, dest);
        time += 1000;
        Hanoi(disk - 1, aux, dest, source);
    }
}

function getDisk(n) 
{
    return disks[n];
}

Hanoi (7, left, right, center);