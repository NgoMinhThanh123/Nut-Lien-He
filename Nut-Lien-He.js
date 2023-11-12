 var goToTopButton = document.getElementById("goToTop");
        
window.onscroll = function() {
                    if (document.body.scrollTop > 1000 || document.documentElement.scrollTop > 1000) {
                        goToTopButton.style.display = "block";
                    } else {
                        goToTopButton.style.display = "none";
                    }
};
        
goToTopButton.onclick = function() {
                    document.body.scrollTop = 0; // For Safari
                    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE, and Opera
};


