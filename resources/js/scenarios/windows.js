

//pari ongelmaa
//kokoa muuttaessa, se voi ylittää näytön koon ja mennä ulkopuolelle
//avatessa uusi ikkuna, toinen ikkuna menee ulkopuolelle
//korjattu?

document.addEventListener("DOMContentLoaded", function(){

const objects = document.getElementsByClassName("moveable_window");
for (const object of objects) {
    object.style.display = "none";

    const content = object.querySelectorAll(".window_content")[0];
    content.style.height = "200px";
    content.style.width = "220px"

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
        else if (trueHeight < 50) {
            content.style.height = "50px";
        }
        trueHeight += 30;
        if (content.style.display == "none") {
            trueHeight = 30;
        };

        trueWidth = Number((content.style.width).replace('px', ''));
        if (trueWidth > 800) {
            content.style.width = "800px";
        }
        else if (trueWidth < 220) {
            content.style.width = "220px";
        }
    }

    function zindex() {
        const other_windows = document.getElementsByClassName("moveable_window");
        for (const sW of other_windows) {
            sW.style["z-index"] = "0";
        };
        object.style["z-index"] = "1";
    };

    function checkSize() {
        if (previousHeight != content.style.height || previousWidth != content.style.width) {
            object.style.position = "absolute";
            zindex();
            viewportWidth = window.innerWidth;
            viewportHeight = window.innerHeight;

            trueHeight = Number((content.style.height).replace('px', ''));
            trueWidth = Number((content.style.width).replace('px', ''));
            //jostakin syystä + 35, koska muuten ei toimi
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

    document.addEventListener("mouseup", checkSize);

    object.addEventListener("click", zindex);

    const objectChildren = object.getElementsByTagName("*");
    for (let child of objectChildren) {
        child.addEventListener("click", zindex);
    };


    for (let child of object.querySelectorAll(".move_window")) {
            child.addEventListener("mousedown", function(){
                document.addEventListener("mousemove", moveObject)
                const objects_select = document.getElementsByClassName("moveable_window");
                for (const object_s of objects_select) {
                    object_s.style["user-select"] = "none";
                };
                function moveObject(event) {
                    event.preventDefault();
                    zindex();
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
                   };
                    if (event.clientX - (trueWidth/2) > 175
                        && event.clientX  + trueWidth/2 < viewportWidth) {
                        object.style.left = event.clientX - (trueWidth/2) + "px";
                        //clientx ei toimi elementin sisällä; mouseaction = none?
                        //console.log((event.clientX - trueLeft))
                        /*console.log("trueleft" + trueLeft);
                        console.log("clientx" + event.clientX);
                        console.log("trueleft + (client - truleft)" + (trueLeft + (event.clientX - trueLeft)))
                        console.log(`(${trueLeft} + (${event.clientX} - ${trueLeft}))`);*/
                    };
                };

                document.addEventListener("mouseup", function(){
                    object.style.opacity = 1;
                    object.style["pointer-events"] = "all";
                    const objects_select = document.getElementsByClassName("moveable_window");
                    for (const object_s of objects_select) {
                        object_s.style["user-select"] = "auto";
                    };
                    document.removeEventListener("mousemove", moveObject);
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
                    /*content.style.opacity = "1";
                    object.style["box-shadow"] = "0 0 20px black";*/
                } else {
                    child.getElementsByClassName("material-icons")[0].innerHTML = "&#xe313;"
                    content.style.display = "none";
                    child.parentNode.style.width = content.style.width;
                    checkBoundaries()
                    /*content.style.opacity = "0.05";
                    object.style["box-shadow"] = "0 0 0px black";*/
                }
                break
            }
        })
        break
    }
    for (let child of object.querySelectorAll(".close_window")) {
        child.addEventListener("click", function(){
                    object.style.display = "none";
                    let object_box_name = String(object.id).replace("_window","")
                    const object_box = document.getElementById(object_box_name);
                    object_box.style["background-color"] = "lightgray";
        })
        break
    }
};

});
