
document.addEventListener("DOMContentLoaded", function(){
    const objects = document.getElementsByClassName("moveable_window");
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
                        
                        let trueHeight = Number((object.querySelectorAll(".window_content")[0].style.height).replace('px', ''));
                        if (trueHeight > 600) {
                            trueHeight = 600
                        }
                        trueHeight += 30;
                        let trueWidth = Number((object.querySelectorAll(".window_content")[0].style.width).replace('px', ''));
                        if (trueWidth > 600) {
                            trueWidth = 600
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
                        child.parentNode.style.width = content.style.width;
                        content.style.display = "none";
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
