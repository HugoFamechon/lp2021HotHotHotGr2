function _doc(name){
    return document.getElementsByClassName(name);
  }
   
  let tabPanes = _doc("tab-header")[0].getElementsByTagName("div");
   
  for(let i=0;i<tabPanes.length;i++){
    tabPanes[i].addEventListener("click", function(e){

      $(".frameworkTabs.active").removeClass('active');
      $(".frameworkMetier.active").removeClass('active');

      if (e.target.className == 'frameworkTabs') {
        _doc("tab-indicator")[0].style.top = `calc(110px + ${i*50}px)`;

      } else {
        _doc("tab-indicator")[0].style.top = `calc(150px + ${i*50}px)`;
      }

      e.target.classList.add("active")
      
      _doc("tab-content")[0].getElementsByClassName("active")[0].classList.remove("active");
      _doc("tab-content")[0].getElementsByTagName("div")[i].classList.add("active");
      
    });
  }