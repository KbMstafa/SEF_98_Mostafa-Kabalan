var charlist = "abcdefghijklmnopqrstuvwxyz";

function solve() 
{
    document.getElementById('pass').setAttribute('value', extractPass(248410397744610));
}

function extractPass(total) {
    if (total < 17) {
        return charlist.charAt(total - 1);
    }
    var newTotal = Math.floor(total / 17);
    var newChar = extractPass(newTotal);
    passChar = newChar + charlist.charAt((total % 17) - 1);
    return passChar;
}