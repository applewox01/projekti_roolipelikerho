

//pari ongelmaa
//kokoa muuttaessa, se voi ylittää näytön koon ja mennä ulkopuolelle
//avatessa uusi ikkuna, toinen ikkuna menee ulkopuolelle
//

document.addEventListener("DOMContentLoaded", function(){

const objects = document.getElementsByClassName("moveable_window");
for (const object of objects) {
    object.style.display = "none";

    const content = object.querySelectorAll(".window_content")[0];
    content.style.height = "200px";
    content.style.width = "200px";

    let previousHeight = content.style.height;
    let previousWidth = content.style.width;

    let viewportWidth = window.innerWidth;
    let viewportHeight = window.innerHeight;

    let trueHeight = Number((content.style.height).replace('px', ''));
    let trueWidth = Number((content.style.width).replace('px', ''));
    
    let trueTop = Number((object.style.top).replace('px', ''));
    let trueLeft = Number((object.style.left).replace('px', ''));

    function checkBoundaries() {
        trueHeight = Number((content.style.height).replace('px', ''));
        if (trueHeight > 800) {
            content.style.height = "800px";
        }
        else if (trueHeight < 200) {
            content.style.height = "200px";
        }
        trueHeight += 30;

        trueWidth = Number((content.style.width).replace('px', ''));
        if (trueWidth > 800) {
            content.style.width = "800px";
        }
        else if (trueWidth < 200) {
            content.style.width = "200px";
        }
    }

    function checkSize() {
        if (previousHeight != content.style.height || previousWidth != content.style.width) {
            object.style.position = "absolute";
            
            viewportWidth = window.innerWidth;
            viewportHeight = window.innerHeight;

            trueHeight = Number((content.style.height).replace('px', ''));
            trueWidth = Number((content.style.width).replace('px', ''));
            //jostakin syystä + 35, koska muuten ei toimi LOL
            if ((trueTop + trueHeight + 35) < viewportHeight) {
                previousHeight = content.style.height;
            } else {
                content.style.height = previousHeight;
            };
            if ((trueLeft + trueWidth) < viewportWidth) {
                previousWidth = content.style.width;
            } else {
                content.style.width = previousWidth;
            };
        };
    };
    new ResizeObserver(checkSize).observe(content);
    for (let child of object.querySelectorAll(".move_window")) {
            child.addEventListener("mousedown", function(){
                document.addEventListener("mousemove", moveObject)
                function moveObject(event) {
                    event.preventDefault();
                    object.style.position = "absolute";
                    object.style.opacity = 0.5;
                    object.style["pointer-events"] = "none";
                    viewportWidth = window.innerWidth;
                    viewportHeight = window.innerHeight;

                    trueTop = Number((object.style.top).replace('px', ''));
                    trueLeft = Number((object.style.left).replace('px', ''));

                    checkBoundaries()

                    if (event.clientY - 15 > 0 
                        && event.clientY + trueHeight - 15 < viewportHeight) {
                        object.style.top = (event.clientY - 15) + "px";
                   }
                    if (event.clientX - (trueWidth - 75) > 150
                        && event.clientX + (75) < viewportWidth) {
                        object.style.left = (event.clientX - trueWidth + 75) + "px";
                    }
                };
                
                document.addEventListener("mouseup", function(){
                    object.style.opacity = 1;
                    object.style["pointer-events"] = "all";
                    document.removeEventListener("mousemove", moveObject);
                    checkSize()
                });
                
                });
                break
    }
    for (let child of object.querySelectorAll(".hide_window")) {
        child.addEventListener("click", function(){
            for (let content of object.querySelectorAll(".window_content")) {
                if (content.style.display == "none") {
                    child.getElementsByClassName("material-icons")[0].innerHTML = "&#xe5ce;"
                    child.parentNode.style.width = "100%";
                    content.style.display = "inline-block";
                } else {
                    child.getElementsByClassName("material-icons")[0].innerHTML = "&#xe313;"
                    content.style.display = "none";

                    checkBoundaries()

                    child.parentNode.style.width = content.style.width;
                }
                break
            }
        })
        break
    }
    for (let child of object.querySelectorAll(".close_window")) {
        child.addEventListener("click", function(){
                    object.style.display = "none";
        })
        break
    }
};

});