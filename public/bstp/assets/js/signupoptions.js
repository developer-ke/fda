/*To display either the company form or the individual form*/
        /*Option One*/
/*$(function () {
    $("#company").change(function() {

        if($("#individualoption").is(":selected")) {
//                        $("#individual").show();
            $("#individual").css({"display":"block"});
        }
        else {
//                        $("#individual").hide();
            $("#individual").css({"display":"none"});
        }
        if($("#institutionoption").is(":selected")) {
//                        $("#institution").show();
            $("#institution").css({"display":"block"});
        }
        else {
//                        $("#institution").hide();
            $("#institution").css({"display":"none"});
        }
    });
//                $("#signup").submit(function(e){
//                    e.preventDefault();
//                });
//                $("#submit").click(function(){ $("#signup").submit(); });
});*/


        /*Option Two*/
$(function () {
    var initval = $('#company').val();
    if(initval===""){
        $("#individual").hide();
        $("#institution").hide();
    }
    else if(initval==="individual"){
        $("#individual").show();
        $("#institution").hide();
    }
    else if(initval==="institution"){
        $("#institution").show();
        $("#individual").hide();
    }
//                $("#individual").hide();
//                $("#institution").hide();
    $("#company").change(function() {
      var val = $(this).val();
      if(val === "") {
          $("#individual").hide();
          $("#institution").hide();
      }
      else if(val === "institution") {
          $("#institution").show();
          $("#individual").hide();
      }
      else if(val === "individual"){
          $("#institution").hide();
          $("#individual").show();
      }
    });
});