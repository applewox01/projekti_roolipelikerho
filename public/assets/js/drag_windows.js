
document.addEventListener("DOMContentLoaded", function(){
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
        
                        let trueHeight = Number((object.style.height).replace('px', ''));
                        if (trueHeight > 600) {
                            trueHeight = 600
                        }
                        let trueWidth = Number((object.style.width).replace('px', ''));
                        if (trueWidth > 600) {
                            trueWidth = 600
                        }
        
        
                        if (event.clientY > 0 
                            && object.style.top - trueHeight < viewportHeight) {
                            object.style.top = (event.clientY - 15) + "px";
                       }
                        if (event.clientX + (trueWidth - 75) > 150-trueWidth + 75
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
                        content.style.display = "inline-block";
                    } else {
                        content.style.display = "none";
                    }
                    break
                }
            })
            break
        }
    };
})
