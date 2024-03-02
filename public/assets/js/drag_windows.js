
document.addEventListener("DOMContentLoaded", function(){
    const objects = document.getElementsByClassName("moveable_window");
    for (let object of objects) {
        for (let child of object.querySelectorAll(".move_here")) {
                child.addEventListener("mousedown", function(){
    
                    document.addEventListener("mousemove", moveObject)
                    function moveObject(event) {
                        event.preventDefault();
                        object.style.position = "absolute";
                        const viewportWidth = window.innerWidth;
                        const viewportHeight = window.innerHeight;
                        const scrollX = window.scrollX;
                        const scrollY = window.scrollY;
                        object.style.opacity = 0.5;
                        object.style["pointer-events"] = "none";
        
                        let trueHeight = Number((object.style.height).replace('px', ''));
                        let trueWidth = Number((object.style.width).replace('px', ''));
        
                        //console.log(event.clientY)
        
                        if (event.clientY-(trueHeight) > 0
                            && event.clientY < viewportHeight ) {
                            trueHeight = Number((object.style.height).replace('px', ''));
                            object.style.top = (event.clientY + scrollY - (trueHeight)) + "px"
                        }
                        if (event.clientX-(trueWidth) > 150
                            && event.clientX < viewportWidth) {
                            trueWidth = Number((object.style.width).replace('px', ''));
                            object.style.left = (event.clientX + scrollX - (trueWidth)) + "px"
                            //ongelma on siinä, että width on pikseleissä, kuitenkin laskuja tehdään ilman niitä
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
        
    };
})
