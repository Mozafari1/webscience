// JavaScript source code
var numberOfS = 6;
var colors = generateRandomColors(numberOfS);
var squares = document.querySelectorAll(".square");
var pickedColor = pickColor();
var colorDisplay = document.getElementById("colorDisplay");
var messageDisplay = document.getElementById("message");
var h3 = document.querySelector("h3");
var resetButton = document.querySelector("#reset");
var easyB = document.querySelector("#easyB");
var hardB = document.getElementById("hardB");
easyB.addEventListener("click", function () {
    hardB.classList.remove("selected");
    easyB.classList.add("selected");
    numberOfS = 3;
    colors = generateRandomColors(numberOfS);
    pickedColor = pickColor();
    colorDisplay.textContent = pickedColor;
    for (var i = 0; i < squares.length; i++) {
        if (colors[i]) {

            squares[i].style.background = colors[i];
            
        } else {
            squares[i].style.display = "none";
        }
    }
});
hardB.addEventListener("click", function() {
    easyB.classList.remove("selected");
    hardB.classList.add("selected");
    numberOfS = 6;
    colors = generateRandomColors(numberOfS);
    pickedColor = pickColor();
    colorDisplay.textContent = pickedColor;
    for (var i = 0; i < squares.length; i++) {
       

            squares[i].style.background = colors[i];

       
            squares[i].style.display = "block";
      
    }
});

resetButton.addEventListener("click", function () {
    colors = generateRandomColors(numberOfS);
    pickedColor = pickColor();
    colorDisplay.textContent = pickedColor;
    for (var i = 0; i < squares.length; i++) {
        squares[i].style.background = colors[i];

    }
    h1.style.background = "steelblue";
});
colorDisplay.textContent = pickedColor;

for (var i = 0; i < squares.length; i++) {
    squares[i].style.background = colors[i];
    squares[i].addEventListener("click", function () {
        var clickedColor = this.style.background;
        if (clickedColor === pickedColor) {
            messageDisplay.textContent = "Correct!";
            resetButton.textContent = "Play Again ?";
            changeColors(clickedColor);
            h1.style.background= clickedColor;
            } else {
            this.style.background = "#232323";
            messageDisplay.textContent = "Try Again!";
            }
    });
}
function changeColors(color) {
    for (var i = 0; i < squares.length; i++) {
        squares[i].style.background = color;
    }
}
function pickColor() {
    var random = Math.floor(Math.random() * colors.length);
    return colors[random];
}
function generateRandomColors(num) {
    var arr = []
    for (var i = 0; i < num; i++) {
        arr.push(randomColor());
    }
    return arr;

}
function randomColor() {
   var r =  Math.floor(Math.random() * 256);
   var g = Math.floor(Math.random() * 256);
   var b = Math.floor(Math.random() * 256);
   return "rgb(" + r + ", " + g + ", " + b + ")";

}