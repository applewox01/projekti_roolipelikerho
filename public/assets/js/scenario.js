
//pari ongelmaa
//kokoa muuttaessa, se voi ylittää näytön koon ja mennä ulkopuolelle
//avatessa uusi ikkuna, toinen ikkuna menee ulkopuolelle

document.addEventListener("DOMContentLoaded", function(){

    const icons = document.getElementsByClassName("icon-box");
    for (let icon of icons) {
        icon.addEventListener("click", function(){
            const icon_window = document.getElementById(`${icon.id}_window`)
            if (icon_window.style.display == "none") {
                icon_window.style.display = "block";
            } else {
                icon_window.style.display = "none";
            }
        })
    }

    const character_boxes = document.getElementsByClassName("character_box");
    for (let box of character_boxes) {
        box.addEventListener("click", function(){
            const character_info = box.getElementsByClassName("character_info");
            if (character_info.length > 0) {
                if (character_info[0].style.display == "none") {
                    character_info[0].style.display = "block"
                } else {
                    character_info[0].style.display = "none"
                }
            }

        })
    }

    const add_character = document.getElementById("add_character");
    add_character.addEventListener("click", function(){
        const unassigned_list = document.getElementById("unassigned_list")
        if (unassigned_list.style.display == "none") {
            unassigned_list.style.display = "block"
        } else {
            unassigned_list.style.display = "none"
        }
    })

    const objects = document.getElementsByClassName("moveable_window");
    for (let object of objects) {
        for (let child of object.querySelectorAll(".move_window")) {
                child.addEventListener("mousedown", function(){
                    document.addEventListener("mousemove", moveObject)
                    function moveObject(event) {
                        event.preventDefault();
                        object.style.position = "absolute";
                        let viewportWidth = window.innerWidth;
                        let viewportHeight = window.innerHeight;
                        object.style.opacity = 0.5;
                        object.style["pointer-events"] = "none";
                        
                        let content = object.querySelectorAll(".window_content")[0];
                        let trueMaxHeight = Number((content.style["max-height"]).replace('px', '')); 
                        let trueHeight = Number((content.style.height).replace('px', ''));
                        if (trueHeight > trueMaxHeight) {
                            trueHeight = trueMaxHeight;
                            content.style.height = trueMaxHeight + "px";
                        }
                        if (trueHeight < 100) {
                            trueHeight = 100;
                            content.style.height = 100 + "px";
                        }
                        trueHeight += 30;

                        let trueWidth = Number((content.style.width).replace('px', ''));
                        let trueMaxWidth = Number((content.style["max-width"]).replace('px', ''));
                        if (trueWidth > trueMaxWidth) {
                            trueWidth = trueMaxWidth;
                            content.style.width = trueMaxWidth + "px";
                        }
                        if (trueWidth < 200) {
                            trueWidth = 200;
                            content.style.width = 200 + "px";
                        }
        
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

                        let trueMaxHeight = Number((content.style["max-height"]).replace('px', '')); 
                        let trueHeight = Number((content.style.height).replace('px', ''));
                        if (trueHeight > trueMaxHeight) {
                            trueHeight = trueMaxHeight;
                            content.style.height = trueMaxHeight + "px";
                        }
                        if (trueHeight < 100) {
                            trueHeight = 100;
                            content.style.height = 100 + "px";
                        }
                        trueHeight += 30;

                        let trueWidth = Number((content.style.width).replace('px', ''));
                        let trueMaxWidth = Number((content.style["max-width"]).replace('px', ''));
                        if (trueWidth > trueMaxWidth) {
                            trueWidth = trueMaxWidth;
                            content.style.width = trueMaxWidth + "px";
                        }
                        if (trueWidth < 200) {
                            trueWidth = 200;
                            content.style.width = 200 + "px";
                        }

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
})
