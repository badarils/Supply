var app = angular.module('serviceProviderApp', []);
app.controller('serviceProviderCtrl', function($scope, $http, $interval) {
    $http.get('http://nodejs.msupply.com/serviceprovider/api/v1.0/servicecities').then(function(r) {
        $scope.cities = r.data.message;
    });
    $scope.expertiseLimit = 5;
    $scope.expertiseLimit1 = 10;
    var tick = function() {
        $scope.date = Date.now();
    }
    tick();
    $interval(tick, 1000);

    $scope.change = function() {
        $scope.valueSelect = $scope.search.expertise;
    }


    $scope.citySelected = function() {
        $scope.cityName = this.check;
	if($scope.valueSelect != undefined){
			 $scope.search.expertise = "Architect";
		}
        $http.get('http://nodejs.msupply.com/serviceprovider/api/v1.0/uniqueExpertise?cityName=' + $scope.cityName).then(function(r) {
            $scope.uniqueExpertise = r.data.message;
            jQuery("#popupCity").hide();
        });
        $http.get('http://nodejs.msupply.com/serviceProvider/api/v1.0/listServiceProviders?cityName=' + $scope.cityName).then(function(r) {
            $scope.data = r.data;
        });
    }

});
app.directive('serviceProviderRepeatDirective', function() {
    return function(scope, element, attrs) {
        if (scope.$last) {
            jQuery(".load-more,.no-results-found,.main-layout h2").show();
        }
    };
});
app.directive('onFinishRender', function($timeout) {
    return {
        restrict: 'A',
        link: function(scope, element, attr) {
            if (scope.$last === true) {
                $timeout(function() {
                    scope.$emit('ngRepeatFinished');
                    jQuery(".form-input").each(function() {
                        if (jQuery(this).val() == "" || jQuery(this).val() == "0" || jQuery(this).val() == null) {
                            jQuery(this).val("–");
                            jQuery("#lnkConT").attr("href", "#");
                        }
                    });
                });
            }
        }
    }
});
jQuery(document).on('ready', function() {
    window.localStorage['customerConsent'] = false;
    jQuery(document).on('click', '.checkbox-field', function() {

        if (jQuery('#checkboxChecked1').is(':checked')) {
            window.localStorage['customerConsent'] = true;
        } else {
            window.localStorage['customerConsent'] = false;
        }
    });
    jQuery(document).on('click', '.checkbox-field1', function() {
        if (jQuery('#checkboxChecked').is(':checked')) {
            window.localStorage['customerConsent'] = true;
        } else {
            window.localStorage['customerConsent'] = false;
        }
    });
    jQuery("#inputClear").click(function() {
        jQuery(".content input,.content select,.content textarea").val("");
    });
    jQuery('form#serviceProviderForm').bind('submit', function(event) {
        jQuery(".required-field-error").hide();
        event.preventDefault();
        var form = this;
        document.getElementById('currentDate1').value = document.getElementById('currentDateVal1').innerHTML;
        var json = ConvertFormToJSON(form);
        var json1 = JSON.stringify(json);
        var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

        if (jQuery("#popup1 input[name='customerFirstName']").val().length == 0) {
            jQuery("#errorFirstName").show();
        } else if (jQuery("#popup1 input[name='customerLastName']").val().length == 0) {
            jQuery("#errorLastName").show();
        } else if (jQuery("#popup1 input[name='mobileNumber']").val().length == 0 || jQuery("#popup1 input[name='mobileNumber']").val().length < 10 || jQuery("#popup1 input[name='mobileNumber']").val().length > 10) {
            jQuery("#errorMobileNum").show();
        } else if (jQuery("#popup1 input[name='email']").val().length == 0) {
            jQuery("#errorEmail").show();
        } else if (jQuery("#popup1 input[name='email']").val().length > 0 && !testEmail.test(jQuery("#popup1 input[name='email']").val())) {
            jQuery("#errorEmail").hide();
            jQuery("#errorEmailFormat").show();
        } else if (jQuery("#popup1 select[name='expertiseRequested']").val() == null) {
            jQuery("#errorExpertiseRequested").show();
        } else {
            jQuery.ajax({
                type: "POST",
                url: "http://nodejs.msupply.com/serviceProvider/api/v1.0/captureDetails",
                dataType: "json",
                contentType: 'application/json',
                data: json1,
                success: function(data) {
                    if (data) {
                        jQuery("#serviceProviderForm input,#serviceProviderForm select,#serviceProviderForm textarea").val("");
                        jQuery("#popup1").hide();
                        jQuery("#popup4").show();
                        jQuery("body").addClass("modal-scroll");
                    } else {
                        alert("Not Added");
                    }
                },
                error: function(data) {
                    alert("error")
                }
            });
        }


    });

    jQuery("#closePopup2").click(function() {
        jQuery("#popup2").hide();
        jQuery("body").removeClass("modal-scroll");
    });
    jQuery("#closePopup1").click(function() {
        jQuery("#popup1").hide();
        jQuery("body").removeClass("modal-scroll");
    });
    jQuery("#closePopup3,#btnOK").click(function() {
        jQuery("#popup3").hide();
        jQuery("body").removeClass("modal-scroll");
    });
    jQuery(document).on('click', '#closePopup4,#btnOK1', function(event) {
        jQuery("#popup4").hide();
        jQuery("body").removeClass("modal-scroll");
    });
    jQuery("#dropNoImple").click(function() {
        jQuery("#popup1 input[name='customerFirstName'],#popup1 input[name='customerLastName'],#popup1 input[name='mobileNumber'],#popup1 input[name='email'],#popup1 textarea[name='description']").val("");
        jQuery("#popup1").show();
        jQuery("#selectListBox").text("");

        populateSelectList();
        jQuery("body").addClass("modal-scroll");
    });
    jQuery("#mobileNum,#mobileNum1,input[name='customerFirstName'],input[name='customerLastName']").bind("cut copy paste", function(e) {
        e.preventDefault();
    });
    jQuery("#mobileNum,#mobileNum1").keypress(function(e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
    jQuery("input[name='customerFirstName'],input[name='customerLastName']").keypress(function(e) {
        if ((e.which > 64 && e.which < 91) || (e.which > 96 && e.which < 123) || e.which == 32 || e.which == 8) {
            return true;
        } else {
            return false
        }
    });
    jQuery(document).on('click', '.btn-shortlist', function(event) {
        jQuery(".required-field-error").hide();
        document.getElementById('currentDate').value = document.getElementById('currentDateVal1').innerHTML;
        event.preventDefault();
        var form = jQuery(this).parent().parent().parent().parent();
        var json = ConnectJSONData(form);
        var exactData = JSON.stringify(json);
        jQuery("#popup2").show();
        jQuery("#popup2 input[name='customerFirstName']").focus();
        jQuery("body").addClass("modal-scroll");
        jQuery("#popup2 input[name='customerFirstName'],#popup2 input[name='customerLastName'],#popup2 input[name='mobileNumber'],#popup2 input[name='email'],#popup2 textarea[name='description']").val("");
        jQuery('.selectExpertise').text("")
        jQuery("#companyName").val(json.companyName);
        window.localStorage['firstName'] = json.providerFirstName;
        window.localStorage['lastName'] = json.providerLastName;
        window.localStorage['serviceProviderId'] = json.serviceProviderId;
        window.localStorage['mobile'] = json.providerMobileNumber;
        window.localStorage['email'] = json.providerEmail;
        var selectbox = jQuery('.selectExpertise');
        populateSelectBox(selectbox, json.expertiseRequested);
        var btn = jQuery(this)
        jQuery("#serviceProviderForm12").unbind('submit').bind('submit', function(event) {
            jQuery(".required-field-error").hide();
            event.preventDefault();
            var form = this;
            document.getElementById('currentDate2').value = document.getElementById('currentDateVal1').innerHTML;

            var json = ConvertFormToJSON1(form);
            var json1 = JSON.stringify(json);
            var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
            if (jQuery("#popup2 input[name='customerFirstName']").val().length == 0) {
                jQuery("#errorFirstName1").show();
            } else if (jQuery("#popup2 input[name='customerLastName']").val().length == 0) {
                jQuery("#errorLastName1").show();
            } else if (jQuery("#popup2 input[name='mobileNumber']").val().length == 0 || jQuery("#popup2 input[name='mobileNumber']").val().length < 10 || jQuery("#popup2 input[name='mobileNumber']").val().length > 10) {
                jQuery("#errorMobileNum1").show();
            } else if (jQuery("#popup2 input[name='email']").val().length == 0) {
                jQuery("#errorEmail1").show();
            } else if (jQuery("#popup2 input[name='email']").val().length > 0 && !testEmail.test(jQuery("#popup2 input[name='email']").val())) {
                jQuery("#errorEmail1").hide();
                jQuery("#errorEmailFormat1").show();
            } else if (jQuery("#popup2 select[name='expertiseRequested']").val() == null) {
                jQuery("#errorExpertiseRequested1").show();
            } else {
                jQuery.ajax({
                    type: "POST",
                    url: "http://nodejs.msupply.com/serviceProvider/api/v1.0/captureDetails",
                    dataType: "json",
                    contentType: 'application/json',
                    data: json1,
                    success: function(data) {
                        if (data) {
                            btn.text("Connected");
                            btn.addClass("connected-button");
                            btn.prop('disabled', true);
                            jQuery("#serviceProviderForm12 input,#serviceProviderForm12 textarea").val("");
                            jQuery("#serviceProviderForm12 select").text("");
                            jQuery("#successMsgPopup1").show();
                            jQuery("#popup2").hide();
                            jQuery("#popup3").show();
                            jQuery("body").addClass("modal-scroll");
                        } else {
                            alert("Not Added");
                        }

                    },
                    error: function(data) {
                        alert("error")
                    }
                });
            }
        });
    });

});

var populateSelectBox = function(selectbox, dataArray) {
    dataArray.forEach(function(data) {
        var data = data.trim();
        selectbox.append('<option value="' + data + '">' + data + '</option>');
    });
};

function populateSelectList() {
    var dataArray = ["Civil Contractor", "Interior Designer", "Architect", "Masonry Contractor", "Flooring Contractor", "Landscaping Consultant", "Gardening Consultant", "Electrical Contractor", "Carpentry Contractor", "Home Automation", "Plumbing Contractor", "Painting Contractor", "Solar Solutions", "Security Solutions", "Granite Layer", "Construction Project Manager", "Tile Layer", "Valuator", "Legal Advisor", "Borewell services", "Civil Engineer", "Project Manager", "Elevator maintenance", "Metal Fabricators", "Pest Control", "Water proofing solutions", "Water suppliers", "Wood carving", "Others"]
    dataArray.forEach(function(data) {
        var selectbox = jQuery('#selectListBox');
        var data = data.trim();
        selectbox.append('<option value="' + data + '">' + data + '</option>');
    });
};

function ConvertFormToJSON(form) {
    var array = jQuery(form).serializeArray();
    var json = {};
    var temp_expertise = [];
    var tempService;

    jQuery.each(array, function() {
        if (this.name === 'expertiseRequested') {
            temp_expertise.push(jQuery(this).attr("value"));
        } else if (this.name === 'serviceProviderChosen') {
            this.value = null;
        }
        json.customerConsent = JSON.parse(window.localStorage['customerConsent']);
        json[this.name] = this.value || null;
    });
    json.expertiseRequested = temp_expertise;
    return json;
}

function ConvertFormToJSON1(form) {
    var array = jQuery(form).serializeArray();
    var json = {};
    var json = {
        serviceProviderChosen: {}
    };


    var temp_expertise = [];
    jQuery.each(array, function() {
        if (this.name === 'expertiseRequested') {
            temp_expertise.push(jQuery(this).attr("value"));
        }
        json.serviceProviderChosen.serviceProviderId = JSON.parse(window.localStorage['serviceProviderId']);
        json.serviceProviderChosen.lastName = window.localStorage['lastName'];
        json.serviceProviderChosen.firstName = window.localStorage['firstName'];
        json.customerConsent = JSON.parse(window.localStorage['customerConsent']);
        json.serviceProviderChosen.mobile = window.localStorage['mobile'];
        json.serviceProviderChosen.email = window.localStorage['email'];
        json[this.name] = this.value || null;
    });
    json.expertiseRequested = temp_expertise;
    return json;
}

function ConnectJSONData(form) {
    var array = jQuery(form).serializeArray();
    var json = {};
    var temp_expertise = [];
    jQuery.each(array, function() {
        if (this.name === 'expertiseRequested') {
            temp_expertise.push(jQuery(this).attr("value"));
        }
        json[this.name] = this.value || '';
    });
    json.expertiseRequested = temp_expertise;
    return json;

}

function ajaxindicatorstart() {
    if (jQuery('body').find('#resultLoading').attr('id') != 'resultLoading') {
        jQuery('body').append('<div id="resultLoading" style="display:none"><div><div class="loader-gif"></div></div><div class="bg"></div></div>');
    }

    jQuery('#resultLoading').css({
        'width': '100%',
        'height': '100%',
        'position': 'fixed',
        'z-index': '10000000',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto'
    });

    jQuery('#resultLoading .bg').css({
        'background': '#000000',
        'opacity': '0.8',
        'width': '100%',
        'height': '100%',
        'position': 'absolute',
        'top': '0'
    });

    jQuery('#resultLoading>div:first').css({
        'width': '54px',
        'height': '58px',
        'position': 'fixed',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto',
        'z-index': '10',

    });

    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeIn(300);
    jQuery('body').css('cursor', 'wait');
}

function ajaxindicatorstop() {
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeOut(300);
    jQuery('body').css('cursor', 'default');
}

if (jQuery(".cms-serviceprovider").length == 1) {
    jQuery(document).ajaxStart(function() {
        ajaxindicatorstart();
    }).ajaxStop(function() {
        ajaxindicatorstop();
    });
}
