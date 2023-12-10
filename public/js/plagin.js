$(function() {
// .................calender..........
var location=window.location.origin;
var pathname= window.location.pathname;
var foldername=window.location.pathname.split("/")[1];

var url_loc = window.location.href; 

var base_url=location+pathname+'/';
var base_url111=location+'/'+foldername+'/';



                                // Select2
                                $('.select2').each(function() {
                                    $(this)
                                    .wrap('<div class="position-relative"></div>')
                                    .select2({
                                        placeholder: 'Select value',
                                        dropdownParent: $(this).parent()
                                    });
                                })

                                $('.datesingle').daterangepicker({
                                    singleDatePicker: true,
                                    showDropdowns: true,
                                    locale: {
                                      format: 'DD-MM-YYYY'
                                  },
                              });



                                $('.createddateformat').daterangepicker({
                                    singleDatePicker: true,
                                    showDropdowns: true,
                                    locale: {
                                      format: 'YYYY-MM-DD'
                                  },
                              });
                                
                            
})