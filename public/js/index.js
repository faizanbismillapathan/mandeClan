/* ..................................................... */
$(document).ready(function(){
    $("#grid-view").click(function(){
        $(".grid-view").show();
        $(".list-view").hide();
    });
    $("#list-view").click(function(){
        $(".list-view").show();
        $(".grid-view").hide();
    });
});
/* ................................. */
$(document).ready(function(){
    $(".far.fa-heart").click(function(){
        $(".fas.fa-heart").show();
        $(".far.fa-heart").hide();
    });
    $(".fas.fa-heart").click(function(){
        $(".far.fa-heart").show();
        $(".fas.fa-heart").hide();
    });
});
/*.....................................................*/
$(document).ready(function(){
    $(".pending").click(function(){
        $(".done").show();
        $(".pending").hide();
    });
    $(".done").click(function(){
        $(".pending").show();
        $(".done").hide();
    });
    /*.. Wedding tool ..*/
    $(".newpage").click(function(){
        $(".list1").hide();
        $(".page-type").show();
    });
    $(".back").click(function(){
        $(".page-type").hide();
        $(".list1").show();
    });
    /*.....*/
    $(".pages-listing1 .row").click(function(){
        $(".list1").hide();
        $(".page-privacy").show();
    });
    $(".back").click(function(){
        $(".page-privacy").hide();
        $(".list1").show();
    });
    /*.....*/
    $(".close-div").click(function(){
        $(".pages-list").hide();
        $(".show-pages").show();
        $(".full-width").removeClass("col-md-9");
        $(".remove-class").removeClass("col-md-3");
        $(".full-width").addClass("col-md-12");
    });
    $(".show-pages-div").click(function(){
        $(".pages-list").show();
        $(".show-pages").hide();
        $(".page-type").hide();
        $(".full-width").addClass("col-md-9");
        $(".remove-class").addClass("col-md-3");
        $(".full-width").removeClass("col-md-12");
        $(".page-privacy").hide();
    });
    /*....*/
    $(".div1").click(function(){
        $(".div1").hide();
        $(".div-bordered1").show();
    });
    $(".div2").click(function(){
        $(".div-bordered1").hide();
        $(".div1").show();
    });
    /*....*/
    $(".diva").click(function(){
        $(".diva").hide();
        $(".divaa").show();
    });
    $(".divaa").click(function(){
        $(".divaa").hide();
        $(".diva").show();
    });
    $(".divb").click(function(){
        $(".div-bordered2").show();
    });
    $(".div11").click(function(){
        $(".div11").hide();
        $(".div12").show();
    });
    $(".div22").click(function(){
        $(".div12").hide();
        $(".div11").show();
    });
    $(".div33").click(function(){
        $(".div12").show();
    });
    /*....*/  
    $(".poll").click(function(){
        $(".polldiv").show();
    });
    $(".polldivhide").click(function(){
        $(".polldiv").hide();
    });
    $(".wedding-video-div").click(function(){
        $(".wedding-video-div").hide();
        $(".videodiv").show();
    });
    $(".video").click(function(){
        $(".wedding-video-div").hide();
    });  
    /* ...... */
    $(".excel.p1").click(function(){
        $(".downloadexcel").hide();
        $(".importexcel").show();
    });  
    $(".excelimport.p1").click(function(){
        $(".downloadexcel").show();
        $(".importexcel").hide();
    });
    $(".addemail").click(function(){
        $(".formhide").show();
        $(".addemail").hide();
    });
    $(".upload-photo-p").click(function(){
        $(".upload-sub-point").toggle();
    });
    $(".file-input-wrapper").click(function(){
        $(".btn-bottom").show();
    });    
    $(".choosephoto").click(function(){
        $(".upload-sub-point").hide();
    }); 
    $(".btn-bottom .btn").click(function(){
        $(".btn-bottom").hide();
    });
    $(".file-input-wrapper").click(function(){
        $(".upload-sub-point").hide();
    }); 
    /* ................ Mobile view .................. */
    $(".filter-options .location").click(function(){
        $(".filter-option-div").show();
        $(".mobile-filter .mobiled-cat").hide();
        $(".mobile-filter .mobiled-ser").hide();
    }); 
    $(".close-filter").click(function(){
        $(".filter-option-div").hide();
        $(".mobile-filter .mobiled-cat").show();
        $(".mobile-filter .mobiled-ser").show();
    });
    $(".filter-options .filter-icon").click(function(){
        $(".filter-option-div").show();
        $(".mobile-filter .mobiled-location").hide();
    }); 
    $(".close-filter").click(function(){
        $(".filter-option-div").hide();
        $(".mobile-filter .mobiled-location").show();
    });
    $(".RW-location").click(function(){
        $(".filter-option-div").show();
        $(".mobile-hide").show();
        $(".filter-ck-show").hide();
    }); 
    $(".RW-filter").click(function(){
        $(".filter-option-div").show();
        $(".mobile-hide").hide();
        $(".filter-ck-show").show();
    }); 
    $(".pt-filter").click(function(){
        $(".filter-option-div").show();
        $(".mobile-hide").hide();
        $(".mobile-keyword").show();
    });
    $(".pt-keyword").click(function(){
        $(".filter-option-div").show();
        $(".mobile-filter").show();
        $(".mobile-keyword").hide();
    }); 
    $(".bg-location").click(function(){
        $(".filter-option-div").show();
        $(".mobile-hide").hide();
        $(".mobile-keyword").show();
    }); 
    $(".bg-filter").click(function(){
        $(".filter-option-div").show();
        $(".mobile-hide").show();
        $(".mobile-keyword").hide();
    }); 
    $(".vs-location").click(function(){
        $(".filter-option-div").show();
        $(".mobile-hide").hide();
        $(".mobile-category").show();
    }); 
    $(".vs-filter").click(function(){
        $(".filter-option-div").show();
        $(".mobile-hide").show();
        $(".mobile-category").hide();
    }); 
});
/*.....................................*/
$(document).ready(function(){
    $(".deletediv").click(function(){
        $("#edittask.modal").css("z-index", "unset");
    });
    /*......*/
    $("#delete .btn, #delete .close").click(function(){
        $("#edittask.modal").css("z-index", "1050");
    });
    /*......*/
    $(".editguestname").click(function(){
        $(".form-control").css("pointer-events", "unset");
        $(".form-control").css("background-image", "linear-gradient(0deg,#009688 2px,rgba(0,150,136,0) 0),linear-gradient(0deg,rgba(0,0,0,.26) 1px,transparent 0)");
    });
});
/*.....................................*/
$(document).ready(function(){
  activaTab('Overview');
});

function activaTab(tab){
  $('.nav-tabs a[href="#' + tab + '"]').tab('show');
};
/* ....................................*/ 
$(document).ready(function(){
  activaTab('pending');
});

function activaTab(tab){
  $('.nav-tabs a[href="#' + tab + '"]').tab('show');
};
/* .................................... */
$(document).ready(function(){
  activaTab('New');
});

function activaTab(tab){
  $('.nav-tabs a[href="#' + tab + '"]').tab('show');
}; 
/* .................................... */
$(document).ready(function(){
  activaTab('Expences');
});

function activaTab(tab){
  $('.nav-tabs a[href="#' + tab + '"]').tab('show');
};
/* ..................................... */
$(document).ready(function(){
  activaTab('aaa');
});

function activaTab(tab){
  $('.nav-tabs a[href="#' + tab + '"]').tab('show');
};
/* .................................... */
$(document).ready(function(){
  activaTab('all');
});

function activaTab(tab){
  $('.nav-tabs a[href="#' + tab + '"]').tab('show');
};
/* .................................... */
$(document).ready(function(){
  activaTab('visits');
});

function activaTab(tab){
  $('.nav-tabs a[href="#' + tab + '"]').tab('show');
};
/* ....................................... */
$(document).ready(function(){
  activaTab('album1');
});

function activaTab(tab){
  $('.nav-tabs a[href="#' + tab + '"]').tab('show');
};
/* ....................................... */
function openNav() {
    document.getElementById("mySidenav").style.width = "320px";
    document.body.style.overflow = "hidden";
    document.getElementById("body").classList.add("overlay");
    document.getElementById("body").style.display = "block";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.body.style.overflow = "scroll";
    document.getElementById("body").classList.remove("overlay");
    document.getElementById("body").style.display = "none";
}
/*.... Design ...*/
function openNav1() {
    document.getElementById("mySidenav1").style.width = "320px";
    document.body.style.overflow = "hidden";
    document.getElementById("body").classList.add("overlay");
    document.getElementById("body").style.display = "block";
}

function closeNav1() {
    document.getElementById("mySidenav1").style.width = "0";
    document.body.style.overflow = "scroll";
    document.getElementById("body").classList.remove("overlay");
    document.getElementById("body").style.display = "none";
}
/*.... Setting ...*/
function openNav2() {
    document.getElementById("mySidenav2").style.width = "320px";
    document.body.style.overflow = "hidden";
    document.getElementById("body").classList.add("overlay");
    document.getElementById("body").style.display = "block";
}

function closeNav2() {
    document.getElementById("mySidenav2").style.width = "0";
    document.body.style.overflow = "scroll";
    document.getElementById("body").classList.remove("overlay");
    document.getElementById("body").style.display = "none";
}
/*.... Share ...*/
function openNav3() {
    document.getElementById("mySidenav3").style.width = "320px";
    document.body.style.overflow = "hidden";
    document.getElementById("body").classList.add("overlay");
    document.getElementById("body").style.display = "block";
}

function closeNav3() {
    document.getElementById("mySidenav3").style.width = "0";
    document.body.style.overflow = "scroll";
    document.getElementById("body").classList.remove("overlay");
    document.getElementById("body").style.display = "none";
}
/* ....................... Mobile menu ......................... */
function openmobilemenu() {
    document.getElementById("mymonilemenu").style.width = "80%";
    document.body.style.overflow = "hidden";
    document.getElementById("body").classList.add("overlay");
    document.getElementById("body").style.display = "block";
}

function closemobilemenu() {
    document.getElementById("mymonilemenu").style.width = "0";
    document.body.style.overflow = "scroll";
    document.getElementById("body").classList.remove("overlay");
    document.getElementById("body").style.display = "none";
} 
/*...................... Tool Menu ..................*/
function opentoolmenu() {
    document.getElementById("mytoolmenu").style.width = "80%";
    document.body.style.overflow = "hidden";
    document.getElementById("wedtoolovrlay1").classList.add("overlay");
    document.getElementById("wedtoolovrlay1").style.display = "block";
}

function closetoolmenu() {
    document.getElementById("mytoolmenu").style.width = "0";
    document.body.style.overflow = "scroll";
    document.getElementById("wedtoolovrlay1").classList.remove("overlay");
    document.getElementById("wedtoolovrlay1").style.display = "none";
}
/* ....................... Web tool menu................ */
function webtoolopennav() {
    document.getElementById("webtoolmenu").style.width = "80%";
    document.body.style.overflow = "hidden";
    document.getElementById("wedtoolovrlay").classList.add("overlay");
    document.getElementById("wedtoolovrlay").style.display = "block";
}

function webtoolclosenav() {
    document.getElementById("webtoolmenu").style.width = "0";
    document.body.style.overflow = "scroll";
    document.getElementById("wedtoolovrlay").classList.remove("overlay");
    document.getElementById("wedtoolovrlay").style.display = "none";
}
/* ....................................... */
function openviewwebmenu() {
    document.getElementById("viewwebmenu").style.width = "80%";
    document.body.style.overflow = "hidden";
    document.getElementById("viewwebmenuovrlay").classList.add("overlay");
    document.getElementById("viewwebmenuovrlay").style.display = "block";
}

function closeviewwebmenu() {
    document.getElementById("viewwebmenu").style.width = "0";
    document.body.style.overflow = "scroll";
    document.getElementById("viewwebmenuovrlay").classList.remove("overlay");
    document.getElementById("viewwebmenuovrlay").style.display = "none";
}
/* ....................................... */
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it

/*................................*/
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
    modal.style.display = "none";
}
/* ........................................... */
function showMyImage(fileInput) {
    var files = fileInput.files;
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var imageType = /image.*/;
        if (!file.type.match(imageType)) {
            continue;
        }
        var img = document.getElementById("thumbnil");
        img.file = file;
        var reader = new FileReader();
        reader.onload = (function(aImg) {
            return function(e) {
                aImg.src = e.target.result;
            };
        })(img);
        reader.readAsDataURL(file);
    }
}

$(document).ready(function(){
  $(".welcomepagesave").click(function(){
    $(".welcome-view, .edit-welcomepage").show();
    $(".welcomepage-add").hide();
  });
  $(".edit-welcomepage").click(function(){
    $(".welcomepage-add").show();
    $(".welcome-view, .edit-welcomepage").hide();
  });
  $(".wedding-blog-edit-view1").click(function(){
    $(".wedding-tool-add-view1").show();
    $(".wedding-blog-view1").hide();
  });
  $(".wedding-tool-save-view1").click(function(){
    $(".wedding-blog-view1").show();
    $(".wedding-tool-add-view1").hide();
  });
  $(".weddingtool-blog-addentry-view2").click(function(){
    $(".weddingtool-blog-add-view2").show();
    $(".weddingtool-blog-addentry-view2").hide();
  });
  $(".weddingtool-blog-save-view2").click(function(){
    $(".weddingtool-blog-add-view2").show();
    $(".weddingtool-blog-add-view2").hide();
  });
  $(".wedding-blog-edit-view2").click(function(){
    $(".weddingtool-blog-add-view2").show();
    $(".wedding-blog-view2").hide();
  });
  $(".weddingtool-blog-save-view2").click(function(){
    $(".weddingtool-blog-add-view2").show();
    $(".weddingtool-blog-addentry-view2").hide();
  });
  $(".weddingtool-blog-save-view2").click(function(){
    $(".wedding-blog-view2").show();
    $(".weddingtool-blog-add-view2").hide();
  });
  $(".weddingtool-blog-addentry-view3").click(function(){
    $(".weddingtool-blog-add-view3").show();
  });
  $(".tool-pages .website-tool-edit-address1").click(function(){
    $(".tool-pages .website-tool-add-address1").show();
    $(".tool-pages .website-tool-address-view1").hide();
  });
  $(".tool-pages .website-tool-save-address1").click(function(){
    $(".tool-pages .website-tool-address-view1").show();
    $(".tool-pages .website-tool-add-address1").hide();
  });
  $(".tool-pages .website-tool-add-addres2").click(function(){
    $(".tool-pages .website-tool-add-address2").show();
  });
  $(".tool-pages .website-tool-save-address2").click(function(){
    $(".tool-pages .website-tool-add-address2").hide();
    $(".tool-pages .website-tool-address-view2").show();
  });
  $(".tool-pages .wedding-address-edit-view2").click(function(){
    $(".tool-pages .website-tool-add-address2").show();
    $(".tool-pages .website-tool-address-view2").hide();
  });
  $(".tool-pages .wedding-photos-edit-view1").click(function(){
    $(".tool-pages .wedding-photos-add1").show();
    $(".tool-pages .wedding-photos-view1").hide();
  });
  $(".tool-pages .wedding-photos-save1").click(function(){
    $(".tool-pages .wedding-photos-view1").show();
    $(".tool-pages .wedding-photos-add1").hide();
  });
  $(".tool-pages .wedding-photos-edit2").click(function(){
    $(".tool-pages .wedding-photos-add2").show();
    $(".tool-pages .wedding-photos-view2").hide();
  });
  $(".tool-pages .wedding-photos-save2").click(function(){
    $(".tool-pages .wedding-photos-view2").show();
    $(".tool-pages .wedding-photos-add2").hide();
  });
  $(".tool-pages .wedding-photos-add3").click(function(){
    $(".tool-pages .wedding-photos-add2").show();
  });
  $(".tool-pages .wedding-videos-edit-view1").click(function(){
    $(".tool-pages .wedding-videos-add1").show();
    $(".tool-pages .wedding-videos-view1").hide();
  });
  $(".tool-pages .wedding-videos-save1").click(function(){
    $(".tool-pages .wedding-videos-view1").show();
    $(".tool-pages .wedding-videos-add1").hide();
  });
  $(".tool-pages .wedding-videos-edit2").click(function(){
    $(".tool-pages .wedding-videos-add2").show();
    $(".tool-pages .wedding-videos-view2").hide();
  });
  $(".tool-pages .wedding-videos-save2").click(function(){
    $(".tool-pages .wedding-videos-view2").show();
    $(".tool-pages .wedding-videos-add2").hide();
  });
  $(".tool-pages .wedding-videos-add3").click(function(){
    $(".tool-pages .wedding-videos-add2").show();
  });
  /*..Survey..*/
  $(".tool-pages .wedding-survey-edit-view1").click(function(){
    $(".tool-pages .wedding-survey-add1").show();
    $(".tool-pages .wedding-survey-view1").hide();
  });
  $(".tool-pages .wedding-survey-save1").click(function(){
    $(".tool-pages .wedding-survey-view1").show();
    $(".tool-pages .wedding-survey-add1").hide();
  });
  $(".tool-pages .wedding-survey-edit2").click(function(){
    $(".tool-pages .wedding-survey-add2").show();
    $(".tool-pages .wedding-survey-view2").hide();
  });
  $(".tool-pages .wedding-survey-save2").click(function(){
    $(".tool-pages .wedding-survey-view2").show();
    $(".tool-pages .wedding-survey-add2").hide();
  });
  $(".tool-pages .wedding-survey-add3").click(function(){
    $(".tool-pages .wedding-survey-add2").show();
  });
  /*..Quiz..*/
  $(".tool-pages .wedding-quiz-edit-view1").click(function(){
    $(".tool-pages .wedding-quiz-add1").show();
    $(".tool-pages .wedding-quiz-view1").hide();
  });
  $(".tool-pages .wedding-quiz-save1").click(function(){
    $(".tool-pages .wedding-quiz-view1").show();
    $(".tool-pages .wedding-quiz-add1").hide();
  });
  $(".tool-pages .wedding-quiz-edit2").click(function(){
    $(".tool-pages .wedding-quiz-add2").show();
    $(".tool-pages .wedding-quiz-view2").hide();
  });
  $(".tool-pages .wedding-quiz-save2").click(function(){
    $(".tool-pages .wedding-quiz-view2").show();
    $(".tool-pages .wedding-quiz-add2").hide();
  });
  $(".tool-pages .wedding-quiz-add3").click(function(){
    $(".tool-pages .wedding-quiz-add2").show();
  });
  /*..Events..*/
  $(".tool-pages .wedding-event-edit-view1").click(function(){
    $(".tool-pages .wedding-event-add1").show();
    $(".tool-pages .wedding-event-view1").hide();
  });
  $(".tool-pages .wedding-event-save1").click(function(){
    $(".tool-pages .wedding-event-view1").show();
    $(".tool-pages .wedding-event-add1").hide();
  });
  $(".tool-pages .wedding-event-edit2").click(function(){
    $(".tool-pages .wedding-event-add2").show();
    $(".tool-pages .wedding-event-view2").hide();
  });
  $(".tool-pages .wedding-event-save2").click(function(){
    $(".tool-pages .wedding-event-view2").show();
    $(".tool-pages .wedding-event-add2").hide();
  });
  $(".tool-pages .wedding-event-add3").click(function(){
    $(".tool-pages .wedding-event-add2").show();
  });
  /*..Contact..*/
  $(".tool-pages .wedding-contact-edit-view1").click(function(){
    $(".tool-pages .wedding-contact-add1").show();
    $(".tool-pages .wedding-contact-view1").hide();
  });
  $(".tool-pages .wedding-contact-save1").click(function(){
    $(".tool-pages .wedding-contact-view1").show();
    $(".tool-pages .wedding-contact-add1").hide();
  });
  $(".tool-pages .wedding-contact-edit2").click(function(){
    $(".tool-pages .wedding-contact-add2").show();
    $(".tool-pages .wedding-contact-view2").hide();
  });
  $(".tool-pages .wedding-contact-save2").click(function(){
    $(".tool-pages .wedding-contact-view2").show();
    $(".tool-pages .wedding-contact-add2").hide();
  });
  $(".tool-pages .wedding-contact-add3").click(function(){
    $(".tool-pages .wedding-contact-add2").show();
  });
});
/* ..................................................... */