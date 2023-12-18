let numOptionsSelector = document.getElementById("num-options");

// hide the option 3 and option 4 divs by default
$(function () {
    $("#option3-div").hide();
    $("#option4-div").hide();
});

numOptionsSelector.addEventListener("input", function () {
    let numOptions = parseInt(numOptionsSelector.value);

    if (numOptions === 2) {
        $("#option3-div").hide();
        $("#option4-div").hide();
        $("#option3").attr("required", false);
        $("#option4").attr("required", false);
    } else if (numOptions === 3) {
        $("#option3-div").show();
        $("#option4-div").hide();
        $("#option3").attr("required", true);
        $("#option4").attr("required", false);
    } else if (numOptions === 4) {
        $("#option3-div").show();
        $("#option4-div").show();
        $("#option3").attr("required", true);
        $("#option4").attr("required", true);
    }
});
